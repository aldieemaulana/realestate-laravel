<?php

namespace App\Http\Controllers\Manager;

use App\Block;
use App\Booking;
use App\House;
use App\Http\Controllers\Controller;

use App\Location;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;
use File;

class TransactionController extends Controller
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
     * Display a dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $transactions = Booking::paginate(15);
        return view('manager.page.transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('manager.page.transaction.create');
    }

    /**
     * Show the form for creating.
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $transaction = Location::create($request->all());

        return redirect('manager/transaction');
    }

    /**
     * Show the form for editing the specified.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $information = Location::findOrFail($id);

        return view('manager.page.transaction.edit', compact("information"));
    }

    /**
     * Update the specified gallery in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $requestData = $request->all();

        $information = Location::findOrFail($id);
        $information->update($requestData);

        return redirect('manager/transaction');
    }

    /**
     * Remove the specified resource from gallery.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Booking::destroy($id);

        return "success";
    }

}
