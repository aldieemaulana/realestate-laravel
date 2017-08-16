<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Outlet;
use App\Role;
use Illuminate\Http\Request;
use Session;

use DB;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('supervisor');
    }


    /**
     * Update the specified user in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request["phone"] = ($request->phone == "") ? "0" : $request->phone;
        $request["password"] = ($request->password == "") ? $request->password_old : bcrypt($request->password);

        $requestData = $request->all();

        $information = User::findOrFail($id);
        $information->update($requestData);

        return redirect('supervisor/setting');
    }


}
