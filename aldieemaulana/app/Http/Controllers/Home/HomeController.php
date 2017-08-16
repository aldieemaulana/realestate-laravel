<?php

namespace App\Http\Controllers\Home;

use App\AkadKredit;
use App\Block;
use App\DataBank;
use App\FollowUpBank;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\House;
use App\Location;
use App\PegawaiTetap;
use App\SyaratUmum;
use App\Booking;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;
use File;

class HomeController extends Controller
{

    /**
     * Display a dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $blocks = Block::all();
        $locations = Location::pluck('name', 'id')->prepend("Semua Perumahan", 0);
        return view('home.page.dashboard.index', compact('blocks', 'locations'));
    }

    /**
     * Display a dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function filter($id)
    {
        if($id > 0)
            $blocks = Block::whereIdLocation($id)->get();
        else    
            $blocks = Block::all();
        
        $ret = "";

        if(count($blocks) == 0){
            $ret = '<div class="panel panel-default">
                        <div class="panel-body" style="background: #FFF;">
                            <h5>Kosong</h5>
                        </div>
                    </div>';
        }else{
            foreach($blocks as $block) {
    $ret .= '<div class="panel panel-default">
            <div class="panel-body" style="background: #FFF;">
                <h5>Perumahan '. $block->location->name .' | Blok, '. $block->name .',
                    <small class="pull-right m-t-10">
                        Jumlah: <b>'. count($block->houses) .'</b> |
                        Terisi: <b>'. count($block->housesIsi) .'</b> |
                        Akad: <b>'. count($block->housesAkad) .'</b> |
                        Kosong: <b>'. count($block->housesKosong) .'</b>
                    </small></h5>
                <hr/>
                <div>
                    <div class="row m-t-20">';
                foreach($block->houses as $house) {
                    $title = strtolower('blok-' . str_replace(" ", "-", $block->name) . "-no-" . $house->number);
                    if($house->status == "kosong") {
                        $url = url('home/dashboard/'.$house->id.'/'.$title);
                    }else if($house->status == "akad") {
                        $url = url('home/dashboard/'.$house->id.'/'.$title.'/edit');
                    }else {
                        $url = url('home/dashboard/'.$house->id.'/'.$title.'/show');
                    }

                    $a = '<a  class="btn btn-default btn-xs fs-12" >'.$house->number.'</a>';

                    $indicator_satu = ($house->indicator_satu == "1") ? "done" : "Satu!";
                    $indicator_dua = ($house->indicator_dua == "1") ? "done" : "Dua!";
                    $indicator_tiga = ($house->indicator_tiga == "1") ? "done" : "Tiga!";

                    $ret .= '<div class="col-xs-4 col-md-1 col-sm-2 text-center">';
                    $ret .= '
                        <a>
                        <div class="wrap '.$house->status .'" style="color: #101010;">
                            <div class="col-xs-4 indicator '.  $indicator_satu . '"></div>
                            <div class="col-xs-4 indicator '.  $indicator_dua . '"></div>
                            <div class="col-xs-4 indicator '.  $indicator_tiga . '"></div>
                            <h5>
                                '.$a.'
                            </h5>
                            <label>'.ucwords($house->status) .'</label>
                        </div>
                        </a>
                    ';
                    $ret .= '</div>';
                }
        $ret .= '
                        </div>
                    </div>
        
                </div>
            </div>';
            }
        }

        return $ret;
    }
}
