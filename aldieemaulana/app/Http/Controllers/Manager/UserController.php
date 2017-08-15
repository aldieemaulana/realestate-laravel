<?php

namespace App\Http\Controllers\Manager;

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
        $this->middleware('manager');
    }

    /**
     * Display a index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('manager.page.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->prepend("pilih role", 0);
        return view('manager.page.user.create', compact('roles'));
    }

    /**
     * Store the specified user in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        $request["phone"] = ($request->phone == "") ? "0" : $request->phone;
        $request["password"] = bcrypt($request->password);
        $request["id_manager"] = Auth::User()->id_manager;

        $requestData = $request->all();

        $information = User::create($requestData);

        return redirect('manager/user');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $information = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->prepend("pilih role", 0);

        return view('manager.page.user.edit', compact("information", 'roles'));
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

        return redirect('manager/user');
    }

    /**
     * Remove the specified resource from user.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        User::destroy($id);

        return "success";
    }

}
