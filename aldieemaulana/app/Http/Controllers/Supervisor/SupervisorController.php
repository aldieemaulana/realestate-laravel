<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;
use File;

class SupervisorController extends Controller
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
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function setting()
    {
        $information = User::findOrFail(Auth::User()->id);

        return view('supervisor.page.user.edit', compact("information"));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function settingUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request["phone"] = ($request->phone == "") ? "0" : $request->phone;
        $request["password"] = ($request->password == "") ? $request->password_old : bcrypt($request->password);

        $requestData = $request->all();

        $information = User::findOrFail(Auth::User()->id);
        $information->update($requestData);

        return redirect('supervisor/setting');
    }

}
