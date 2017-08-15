<?php

namespace App\Http\Controllers\Manager;

use App\Block;
use App\House;
use App\Http\Controllers\Controller;

use App\Location;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;
use File;

class LocationController extends Controller
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
        $locations = Location::paginate(15);
        return view('manager.page.location.index', compact('locations'));
    }

    /**
     * Show the form for creating.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('manager.page.location.create');
    }

    /**
     * Show the form for creating.
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $location = Location::create($request->all());

        return redirect('manager/location');
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

        return view('manager.page.location.edit', compact("information"));
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

        return redirect('manager/location');
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
        Location::destroy($id);
        $block = Block::whereIdLocation($id)->first();
        House::whereIdBlock($block->id)->delete();
        Block::whereIdLocation($id)->delete();

        return "success";
    }

}
