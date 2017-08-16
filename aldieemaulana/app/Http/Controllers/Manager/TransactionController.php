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
    public function index(Request $request)
    {
        $transactions = Booking::join('houses', 'houses.id', '=', 'bookings.id_house')
            ->join('blocks', 'blocks.id', '=', 'houses.id_block')
            ->join('locations', 'locations.id', '=', 'blocks.id_location')
        ->select([
                DB::raw('bookings.id AS id'),
                DB::raw('bookings.nama AS nama'),
                DB::raw('locations.name AS block_location_name'),
                DB::raw('locations.name AS block_location_name'),
                DB::raw('blocks.name AS block_name'),
                DB::raw('houses.number AS block_number'),
                DB::raw('bookings.telepon AS telepon'),
                DB::raw('bookings.status AS status'),
                DB::raw('bookings.tanggal_wawancara AS tanggal_wawancara'),
                DB::raw('bookings.booking_fee AS booking_fee'),
                DB::raw('bookings.fee_status AS fee_status'),
                DB::raw('bookings.tanggal_booking_fee AS tanggal_booking_fee'),
                DB::raw('bookings.dp_1 AS dp_1'),
                DB::raw('bookings.dp_2 AS dp_2'),
                DB::raw('bookings.dp_3 AS dp_3'),
                DB::raw('bookings.dp_4 AS dp_4'),
                DB::raw('bookings.dp_5 AS dp_5')
            ]);

        $locations = Location::pluck('name', 'id')->prepend("Semua lokasi", 0);
        $blocks = ["Pilih lokasi dulu"];

        if($request->get('id_location') > 0) {
            $id_location = $request->get('id_location');
            $blocks = Block::whereIdLocation($id_location)->pluck('name', 'id')->prepend("Semua lokasi", 0);

            $transactions = $transactions->where('locations.id', '=', $id_location);

            if($request->get('id_block') > 0)
                $transactions = $transactions->where('blocks.id', '=', $request->get('id_block'));

        }

        if($request->get('tanggal_mulai') != "" && $request->get('tanggal_selesai') != "") {
            $transactions = $transactions->whereBetween('bookings.tanggal_booking_fee', [$request->get('tanggal_mulai'), $request->get('tanggal_selesai')]);
        }

        $transactions = $transactions->paginate(15);
        return view('manager.page.transaction.index', compact('transactions', 'locations', 'blocks'));
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

    /**
     * Return block
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getBlock($id)
    {
        $blocks = Block::whereIdLocation($id)->get();

        $str = '
                <label for="id_block" class="fade">Block</label>
                <select class="full-width" required="required" id="id_block" name="id_block">
                <option value="0">Semua Block</option>';
        foreach($blocks as $block) {
            $str .= '<option value="'.$block->id.'">'.$block->name.'</option>';
        }
        $str .= '</select>';

        return $str;
    }

    /**
     * Update the specified fee in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateFee($id, Request $request)
    {
        $requestData = $request->all();

        $information = Booking::findOrFail($id);
        $information->update(["fee_status" => 1]);

        return "success";
    }



}
