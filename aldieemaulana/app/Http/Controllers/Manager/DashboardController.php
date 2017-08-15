<?php

namespace App\Http\Controllers\Manager;

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

class DashboardController extends Controller
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
    public function dashboard()
    {
        $blocks = Block::all();
        $locations = Location::pluck('name', 'id')->prepend("Semua Perumahan", 0);
        return view('manager.page.dashboard.index', compact('blocks', 'locations'));
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
                        $url = url('manager/dashboard/'.$house->id.'/'.$title);
                    }else if($house->status == "akad") {
                        $url = url('manager/dashboard/'.$house->id.'/'.$title.'/edit');
                    }else {
                        $url = url('manager/dashboard/'.$house->id.'/'.$title.'/show');
                    }

                    if($house->status == 'akad') {
                        $a = '<a class="btn btn-default btn-xs fs-10" href=""'.$url.'"" ><i class="fa fa-pencil"></i> </a>
                        <a class="btn btn-danger btn-xs fs-10" onClick="deleteData('.$house->id .')" ><i class="fa fa-trash-o"></i> </a>';
                    }else {
                        $a = '<a href="'.$url.'" class="btn btn-default btn-xs fs-12" >'.$house->number.'</a>';
                    }

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


    /**
     * Show the form for create new input.
     *
     * @param  int  $id
     * @param  string  $title
     *
     * @return \Illuminate\View\View
     */
    public function create($id, $title)
    {
        $information = House::findOrFail($id);

        /**
        if (!Schema::hasTable('syarat_umums') && !Schema::hasTable('pegawai_tetaps') && !Schema::hasTable('data_banks')
            && !Schema::hasTable('akad_kredits') && !Schema::hasTable('follow_up_banks')) {
            Schema::create('syarat_umums', function (Blueprint $table) {
                $syarat_umums = array("form_bank", "foto_copy_ktp_suami_istri", "foto_copy_kartu_keluarga", "foto_copy_buku_nikah_/_surat_cerai",
                    "surat_keterangan_belum_memiliki_rumah_dari_kelurahan", "foto_copy_tabungan_btn");

                $table->increments('id');
                $table->smallInteger('id_house');
                $table->boolean('status')->default(0);

                foreach ($syarat_umums as $syarat_umum) {
                    $table->boolean($syarat_umum)->default(0);
                }
                $table->timestamps();
            });
            Schema::create('pegawai_tetaps', function (Blueprint $table) {
                $pegawai_tetaps = array("surat_keterangan_kerja", "surat_pengakatan_karyawan_tetap", "slip_gaji_terbaru", "kartu_pegawai",
                    "gaji_cash", "rekening_koran_3_bulan_terakhir", "foto_copy_npwp_pribadi", "spt_/_sk_spt");

                $table->increments('id');
                $table->smallInteger('id_house');
                $table->boolean('status')->default(0);

                foreach ($pegawai_tetaps as $pegawai_tetap) {
                    $table->boolean($pegawai_tetap)->default(0);
                }
                $table->timestamps();
            });
            Schema::create('data_banks', function (Blueprint $table) {
                $data_banks = array("form_lampiran_iv_a", "form_lampiran_v", "form_lampiran_vi", "form_lampiran_vii", "form_lampiran_ixb",
                    "form_lampiran_xia", "form_lampiran_xib", "form_data_alamat_debitur", "form_sbum", "form_keterangan_penjual");

                $table->increments('id');
                $table->smallInteger('id_house');
                $table->boolean('status')->default(0);

                foreach ($data_banks as $data_bank) {
                    $table->boolean($data_bank)->default(0);
                }
                $table->timestamps();
            });
            Schema::create('akad_kredits', function (Blueprint $table) {
                $akad_kredits = array("sp3k", "foto_copy_kartu_keluarga", "foto_copy_ktp_suami_istri", "foto_copy_npwp_pribadi", "foto_copy_buku_nikah_/_surat_cerai");

                $table->increments('id');
                $table->smallInteger('id_house');
                $table->boolean('status')->default(0);
                $table->date('tanggal')->nullable();

                foreach ($akad_kredits as $akad_kredit) {
                    $table->boolean($akad_kredit)->default(0);
                }
                $table->timestamps();
            });
            Schema::create('follow_up_banks', function (Blueprint $table) {
                $follow_up_banks = array("form_lampiran_ixb", "form_lampiran_xia", "form_lampiran_xib", "form_data_alamat_debitur", "form_sbum", "form_keterangan_penjual");

                $table->increments('id');
                $table->smallInteger('id_house');
                $table->boolean('status')->default(0);
                $table->date('tanggal')->nullable();

                foreach ($follow_up_banks as $follow_up_bank) {
                    $table->boolean($follow_up_bank)->default(0);
                }
                $table->timestamps();
            });
        }
         */

        $syarat_umus = $this->remove_array(Schema::getColumnListing('syarat_umums'), ["status", "id", "id_house", "created_at", "updated_at"]);
        $pegawai_tetaps = $this->remove_array(Schema::getColumnListing('pegawai_tetaps'), ["status", "id", "id_house", "created_at", "updated_at"]);
        $data_banks = $this->remove_array(Schema::getColumnListing('data_banks'), ["status", "id", "id_house", "created_at", "updated_at"]);
        $akad_kredits = $this->remove_array(Schema::getColumnListing('akad_kredits'), ["status", "id", "id_house", "created_at", "updated_at", "tanggal"]);
        $follow_up_banks = $this->remove_array(Schema::getColumnListing('follow_up_banks'), ["status", "id", "id_house", "created_at", "updated_at", "tanggal"]);


        return view('manager.page.dashboard.house.create', compact("id", "title", "information", "syarat_umus", 'pegawai_tetaps', 'data_banks', 'akad_kredits', 'follow_up_banks'));
    }


    /**
     * Store the form value from create page.
     *
     * @param  int  $id
     * @param  string  $title
     *
     * @return redirect
     */
    public function store(Request $request, $id, $title)
    {
        $array = $request->all();
        $id_house = $id;

        $indikator_1 = 1;
        $indikator_satu_validation = array("form_bank", "foto_copy_ktp_suami_istri", "foto_copy_kartu_keluarga",
            "foto_copy_npwp_pribadi", "foto_copy_tabungan_btn", "surat_keterangan_kerja", "surat_pengakatan_karyawan_tetap",
            "slip_gaji_terbaru", "rekening_koran_3_bulan_terakhir",  "spt_/_sk_spt", "form_lampiran_iv_a", "form_lampiran_vi", "form_keterangan_penjual");

        $su = array();$pt = array();$db = array();$ak = array();$fub = array();
        foreach($array as $key => $value) {
            if(substr($key,0, 3) == "su_"){
                $index = str_replace("su_", "", $key);
                $su[$index] = $value;

                if(array_search($index, $indikator_satu_validation) == true)
                    $indikator_1++;

            }else if(substr($key,0, 3) == "xp_"){
                $index = str_replace("xp_", "", $key);
                $pt[$index] = $value;

                if(array_search($index, $indikator_satu_validation) == true)
                    $indikator_1++;

            }else if(substr($key,0, 3) == "db_"){
                $index = str_replace("db_", "", $key);
                $db[$index] = $value;

                if(array_search($index, $indikator_satu_validation) == true)
                    $indikator_1++;

            }else if(substr($key,0, 3) == "ak_"){
                $index = str_replace("ak_", "", $key);
                $ak[$index] = $value;

            }else if(substr($key,0, 4) == "fub_"){
                $index = str_replace("fub_", "", $key);
                $fub[$index] = $value;

            }
        }

        $array["booking_fee"] = $this->toNumber($request->booking_fee);
        $array["kpr_diajukan"] = $this->toNumber($request->kpr_diajukan);
        $array["kpr_disetujui"] = $this->toNumber($request->kpr_disetujui);
        $array["kpr_selisih"] = $this->toNumber($request->kpr_selisih);
        $array["dp_1"] = $this->toNumber($request->dp_1);
        $array["dp_2"] = $this->toNumber($request->dp_2);
        $array["dp_3"] = $this->toNumber($request->dp_3);
        $array["dp_4"] = $this->toNumber($request->dp_4);
        $array["dp_5"] = $this->toNumber($request->dp_5);
        $array["id_house"] = $id_house;

        Booking::create($array);

        $house = House::findOrFail($id_house);
        $house->update(["status" => "akad"]);

        $tanggal = Date("Y-m-d");

        $isi = 0;

        $su["id_house"] = $id_house;
        $su = DB::table('syarat_umums')->insertGetId($su);

        $pt["id_house"] = $id_house;
        $pt = DB::table('pegawai_tetaps')->insertGetId($pt);

        $db["id_house"] = $id_house;
        $db = DB::table('data_banks')->insertGetId($db);

        $ak["id_house"] = $id_house;
        $ak["tanggal"] = $tanggal;
        $ak = DB::table('akad_kredits')->insertGetId($ak);

        if($request->bayar && $request->tanggal_bayar){
            DB::table('akad_kredits')->whereId($ak)->update(["status" => 1]);
            $house->update(["indicator_dua" => 1]);
            $isi++;
        }

        $fub["id_house"] = $id_house;
        $fub["tanggal"] = $tanggal;
        $fub = DB::table('follow_up_banks')->insertGetId($fub);

        if($request->metode_bayar == "credit" && $request->tanggal_akad){
            DB::table('follow_up_banks')->whereId($ak)->update(["status" => 1]);
            $house->update(["indicator_tiga" => 1]);
            $isi++;
        }else{
            DB::table('follow_up_banks')->whereId($ak)->update(["status" => 1]);
        }

        if($indikator_1 == count($indikator_satu_validation)){
            $house->update(["indicator_satu" => 1]);
            $isi++;
            DB::table('syarat_umums')->whereId($su)->update(["status" => 1]);
            DB::table('pegawai_tetaps')->whereId($pt)->update(["status" => 1]);
            DB::table('data_banks')->whereId($db)->update(["status" => 1]);
        }

        if($isi == 3) {
            $house->update(["status" => "isi"]);
        }

        return redirect('manager/dashboard');
    }

    function remove_array( $array, $items) {
        foreach($items as $item){
            $index = array_search($item, $array);
            if ( $index !== false ) {
                unset( $array[$index] );
            }
        }

        return $array;
    }

    function toNumber($money) {
        $number = str_replace("Rp ", "", $money);
        $number = str_replace(".", "", $number);
        $number = str_replace(",", "", $number);

        return ($number != "") ? $number : 0;
    }



    /**
     * Show the form for edit input.
     *
     * @param  int  $id
     * @param  string  $title
     *
     * @return \Illuminate\View\View
     */
    public function edit($id, $title)
    {
        $information = House::findOrFail($id);

        $syarat_umus = $this->remove_array(Schema::getColumnListing('syarat_umums'), ["status", "id", "id_house", "created_at", "updated_at"]);
        $pegawai_tetaps = $this->remove_array(Schema::getColumnListing('pegawai_tetaps'), ["status", "id", "id_house", "created_at", "updated_at"]);
        $data_banks = $this->remove_array(Schema::getColumnListing('data_banks'), ["status", "id", "id_house", "created_at", "updated_at"]);
        $akad_kredits = $this->remove_array(Schema::getColumnListing('akad_kredits'), ["status", "id", "id_house", "created_at", "updated_at", "tanggal"]);
        $follow_up_banks = $this->remove_array(Schema::getColumnListing('follow_up_banks'), ["status", "id", "id_house", "created_at", "updated_at", "tanggal"]);

        $su = SyaratUmum::whereIdHouse($id)->first();
        $pt = PegawaiTetap::whereIdHouse($id)->first();
        $db = DataBank::whereIdHouse($id)->first();
        $ak = AkadKredit::whereIdHouse($id)->first();
        $fub = FollowUpBank::whereIdHouse($id)->first();
        $bo = Booking::whereIdHouse($id)->first();

        return view('manager.page.dashboard.house.edit', compact("id", "title", "information", "syarat_umus", 'pegawai_tetaps', 'data_banks', 'akad_kredits', 'follow_up_banks', 'su', 'pt', 'db', 'ak', 'fub' , 'bo'));
    }


    /**
     * Store the form value from create page.
     *
     * @param  int  $id
     * @param  string  $title
     *
     * @return redirect
     */
    public function update(Request $request, $id, $title)
    {
        $array = $request->all();
        $id_house = $id;

        $indikator_1 = 1;
        $indikator_satu_validation = array("form_bank", "foto_copy_ktp_suami_istri", "foto_copy_kartu_keluarga",
            "foto_copy_npwp_pribadi", "foto_copy_tabungan_btn", "surat_keterangan_kerja", "surat_pengakatan_karyawan_tetap",
            "slip_gaji_terbaru", "rekening_koran_3_bulan_terakhir",  "spt_/_sk_spt", "form_lampiran_iv_a", "form_lampiran_vi", "form_keterangan_penjual");

        $su = array();$pt = array();$db = array();$ak = array();$fub = array();
        foreach($array as $key => $value) {
            if(substr($key,0, 3) == "su_"){
                $index = str_replace("su_", "", $key);
                $su[$index] = $value;

                if(array_search($index, $indikator_satu_validation) == true)
                    $indikator_1++;

            }else if(substr($key,0, 3) == "xp_"){
                $index = str_replace("xp_", "", $key);
                $pt[$index] = $value;

                if(array_search($index, $indikator_satu_validation) == true)
                    $indikator_1++;

            }else if(substr($key,0, 3) == "db_"){
                $index = str_replace("db_", "", $key);
                $db[$index] = $value;

                if(array_search($index, $indikator_satu_validation) == true)
                    $indikator_1++;

            }else if(substr($key,0, 3) == "ak_"){
                $index = str_replace("ak_", "", $key);
                $ak[$index] = $value;

            }else if(substr($key,0, 4) == "fub_"){
                $index = str_replace("fub_", "", $key);
                $fub[$index] = $value;

            }
        }

        $array["booking_fee"] = $this->toNumber($request->booking_fee);
        $array["kpr_diajukan"] = $this->toNumber($request->kpr_diajukan);
        $array["kpr_disetujui"] = $this->toNumber($request->kpr_disetujui);
        $array["kpr_selisih"] = $this->toNumber($request->kpr_selisih);
        $array["dp_1"] = $this->toNumber($request->dp_1);
        $array["dp_2"] = $this->toNumber($request->dp_2);
        $array["dp_3"] = $this->toNumber($request->dp_3);
        $array["dp_4"] = $this->toNumber($request->dp_4);
        $array["dp_5"] = $this->toNumber($request->dp_5);
        $array["id_house"] = $id_house;

        $booking = Booking::findOrFail($request->bo);
        $booking->update($array);

        $house = House::findOrFail($id_house);
        $house->update(["status" => "akad"]);

        $tanggal = Date("Y-m-d");

        $isi = 0;

        if($su) {
            $su["id_house"] = $id_house;
            $sux = SyaratUmum::findOrFail($request->su);
            $sux->update($su);

        }

        if($pt) {
            $pt["id_house"] = $id_house;
            $ptx = PegawaiTetap::findOrFail($request->pt);
            $ptx->update($pt);
        }

        if($db) {
            $db["id_house"] = $id_house;
            $dbx = DataBank::findOrFail($request->db);
            $dbx->update($db);
        }

        if($ak) {
            $ak["id_house"] = $id_house;
            $ak["tanggal"] = $tanggal;

            $akx = AkadKredit::findOrFail($request->ak);
            $akx->update($ak);

            if($request->bayar && $request->tanggal_bayar){
                DB::table('akad_kredits')->whereId($akx->id)->update(["status" => 1]);
                $house->update(["indicator_dua" => 1]);
                $isi++;
            }
        }

        if($fub) {
            $fub["id_house"] = $id_house;
            $fub["tanggal"] = $tanggal;

            $fubx = FollowUpBank::findOrFail($request->fub);
            $fubx->update($fub);

            if($request->metode_bayar == "credit" && $request->tanggal_akad){
                DB::table('follow_up_banks')->whereId($akx->id)->update(["status" => 1]);
                $house->update(["indicator_tiga" => 1]);
                $isi++;
            }else{
                DB::table('follow_up_banks')->whereId($akx->id)->update(["status" => 1]);
            }
        }

        if($indikator_1 == count($indikator_satu_validation)){
            $house->update(["indicator_satu" => 1]);
            $isi++;
            DB::table('syarat_umums')->whereId($sux->id)->update(["status" => 1]);
            DB::table('pegawai_tetaps')->whereId($ptx->id)->update(["status" => 1]);
            DB::table('data_banks')->whereId($dbx->id)->update(["status" => 1]);
        }

        if($isi == 3) {
            $house->update(["status" => "isi"]);
        }

        return redirect('manager/dashboard');
    }



    /**
     * Show the form for see the input.
     *
     * @param  int  $id
     * @param  string  $title
     *
     * @return \Illuminate\View\View
     */
    public function show($id, $title)
    {
        $information = House::findOrFail($id);

        $syarat_umus = $this->remove_array(Schema::getColumnListing('syarat_umums'), ["status", "id", "id_house", "created_at", "updated_at"]);
        $pegawai_tetaps = $this->remove_array(Schema::getColumnListing('pegawai_tetaps'), ["status", "id", "id_house", "created_at", "updated_at"]);
        $data_banks = $this->remove_array(Schema::getColumnListing('data_banks'), ["status", "id", "id_house", "created_at", "updated_at"]);
        $akad_kredits = $this->remove_array(Schema::getColumnListing('akad_kredits'), ["status", "id", "id_house", "created_at", "updated_at", "tanggal"]);
        $follow_up_banks = $this->remove_array(Schema::getColumnListing('follow_up_banks'), ["status", "id", "id_house", "created_at", "updated_at", "tanggal"]);

        $su = SyaratUmum::whereIdHouse($id)->first();
        $pt = PegawaiTetap::whereIdHouse($id)->first();
        $db = DataBank::whereIdHouse($id)->first();
        $ak = AkadKredit::whereIdHouse($id)->first();
        $fub = FollowUpBank::whereIdHouse($id)->first();
        $bo = Booking::whereIdHouse($id)->first();

        return view('manager.page.dashboard.house.show', compact("id", "title", "information", "syarat_umus", 'pegawai_tetaps', 'data_banks', 'akad_kredits', 'follow_up_banks', 'su', 'pt', 'db', 'ak', 'fub' , 'bo'));
    }

    public function destroy($id) {
        $information = House::findOrFail($id);
        $information->update(["indicator_satu" => 0, "indicator_dua" => 0, "indicator_tiga" => 0, 'status' => 'kosong']);

        SyaratUmum::whereIdHouse($id)->delete();
        PegawaiTetap::whereIdHouse($id)->delete();
        DataBank::whereIdHouse($id)->delete();
        AkadKredit::whereIdHouse($id)->delete();
        FollowUpBank::whereIdHouse($id)->delete();
        Booking::whereIdHouse($id)->delete();

        return redirect('manager/dashboard');
    }

}
