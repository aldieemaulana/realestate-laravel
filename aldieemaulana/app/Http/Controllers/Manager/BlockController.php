<?php

namespace App\Http\Controllers\Manager;

use App\Block;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Location;
use App\Subscriber;
use App\House;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;
use File;

class BlockController extends Controller
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
        $blocks = Block::paginate(15);
        return view('manager.page.block.index', compact('blocks'));
    }

    /**
     * Show the form for creating.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $locations = Location::pluck('name', 'id');
        return view('manager.page.block.create', compact( 'locations'));
    }

    /**
     * Show the form for creating.
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $request["available"] = 1;
        $block = Block::create($request->all());

        for($i=1;$i<=$request->number;$i++) {
            $houses[] = array('id_block' => $block->id,
                'number' => $i,
                'status' => 'kosong',
                'indicator_satu' => 0,
                'indicator_dua' => 0,
                'indicator_tiga' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"));
        }

        $house = House::insert($houses);

        return redirect('manager/block');
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
        Block::destroy($id);
        House::whereIdBlock($id)->delete();

        return "success";
    }

}
