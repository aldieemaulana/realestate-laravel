@extends('supervisor.layouts.frame')
@section('title', 'Lihat Detail Pembelian Rumah')
@section('description', 'Please make sure to check all input')
@section('button')
    <a href="{{ url('/supervisor/dashboard') }}" class="btn btn-info btn-xs no-border">Back</a>
@endsection

@section('content')
    {!! Form::model($bo, [
      'method' => 'PATCH',
      'url' => ['supervisor/dashboard/'.$id.'/'.$title.'/edit'],
      'files' => true,
      'id' => 'formValidate',
      ]) !!}


    <div class="container-fluid container-fixed-lg col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5 class="text-bold-ter title m-b-0">Informasi Calon Pemilik</h5>
                        <h6 class="title m-t-5 fs-15">Lengkapi data sesuai dengan yang tertera pada kartu kepedudukan</h6><br/>
                        <div class="row">
                            <div class="col-md-4">
                                <div aria-required="true" class="form-group form-group-default  {{ $errors->has('blok') ? 'has-error' : ''}}">
                                    {!! Form::label('blok', "Blok") !!}
                                    {!! Form::text('blok',  $information->block->name, ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "Blok", "style" => "color: #000 !important;", 'readonly' => 'readonly']) !!}
                                </div>
                                {!! $errors->first('blok', '<label class="error">:message</label>') !!}
                                <div aria-required="true" class="form-group form-group-default required {{ $errors->has('no') ? 'has-error' : ''}}">
                                    {!! Form::label('no', "No") !!}
                                    {!! Form::number('no',  $information->number , ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "No", "style" => "color: #000 !important;", 'readonly' => 'readonly']) !!}
                                </div>
                                {!! $errors->first('no', '<label class="error">:message</label>') !!}
                                <div aria-required="true" class="form-group form-group-default required {{ $errors->has('nama') ? 'has-error' : ''}}">
                                    {!! Form::label('nama', "Nama Lengkap") !!}
                                    {!! Form::text('nama',  null, ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "Nama anda"]) !!}
                                </div>
                                {!! $errors->first('nama', '<label class="error">:message</label>') !!}
                                <div class="form-group form-group-default form-group-default-select2 required {{ $errors->has('status') ? 'has-error' : ''}}">
                                    {!! Form::label('status', "Status") !!}
                                    {{ Form::select('status', ["belum_menikah" => "Belum Menikah"
                                    ,"menikah" => "Menikah", "cerai" => "Cerai"], $bo->status, ['class' => 'full-width', 'required' => 'required', 'data-init-plugin' => 'select2']) }}
                                </div>
                                {!! $errors->first('status', '<label class="error">:message</label>') !!}
                                <div aria-required="true" class="form-group form-group-default {{ $errors->has('telepon') ? 'has-error' : ''}}">
                                    {!! Form::label('telepon', "No. Telepon") !!}
                                    {!! Form::number('telepon',  null, ['class' => 'form-control input-md', 'placeholder' => "Telepon anda"]) !!}
                                </div>
                                {!! $errors->first('telepon', '<label class="error">:message</label>') !!}
                                <div class="form-group form-group-default {{ $errors->has('telepon') ? 'has-error' : ''}}">
                                    <div class="form-input-group ">
                                        {!! Form::label('tanggal_wawancara', "Tanggal Wawancara") !!}
                                        <input type="text" value="{{ $bo->tanggal_wawancara }}" class="form-control tanggal-picker" placeholder="Pick a date" name="tanggal_wawancara">
                                    </div>
                                </div>
                                {!! $errors->first('tanggal_wawancara', '<label class="error">:message</label>') !!}
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group form-group-default {{ $errors->has('booking_fee') ? 'has-error' : ''}}">
                                            <div class="form-input-group ">
                                                {!! Form::label('fee', "Booking Fee") !!}
                                                <input type="text" value="{{ $bo->booking_fee }}" class="form-control autonumeric" data-a-sign="Rp " placeholder="-" name="booking_fee">
                                            </div>
                                        </div>
                                        {!! $errors->first('booking_fee', '<label class="error">:message</label>') !!}
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group form-group-default {{ $errors->has('tanggal_booking_fee') ? 'has-error' : ''}}">
                                            <div class="form-input-group ">
                                                {!! Form::label('tanggal_booking_fee', "Tanggal Booking Fee") !!}
                                                <input type="text" value="{{ $bo->tanggal_booking_fee }}" class="form-control tanggal-picker" placeholder="Pick a date" name="tanggal_booking_fee">
                                            </div>
                                        </div>
                                        {!! $errors->first('tanggal_booking_fee', '<label class="error">:message</label>') !!}
                                    </div>
                                </div>
                                @for($i=1;$i<=5;$i++)
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group form-group-default {{ $errors->has('dp_'.$i) ? 'has-error' : ''}}">
                                                <div class="form-input-group ">
                                                    {!! Form::label('dp_'.$i, "DP " . $i) !!}
                                                    @php $n = 'dp_'.$i; $o = 'tanggal_dp_'.$i; @endphp
                                                    <input type="text"  value="{{ $bo->$n }}" class="form-control autonumeric" data-a-sign="Rp " placeholder="-" name="{{ 'dp_'.$i }}">
                                                </div>
                                            </div>
                                            {!! $errors->first('dp_'.$i, '<label class="error">:message</label>') !!}
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group form-group-default {{ $errors->has('tanggal_dp_'.$i) ? 'has-error' : ''}}">
                                                <div class="form-input-group ">
                                                    {!! Form::label('tanggal_dp_'.$i, "Tanggal DP " . $i) !!}
                                                    <input type="text" class="form-control tanggal-picker" value="{{ $bo->$o }}" placeholder="Pick a date" name="{{ 'tanggal_dp_'.$i }}">
                                                </div>
                                            </div>
                                            {!! $errors->first('tanggal_dp_'.$i, '<label class="error">:message</label>') !!}
                                        </div>
                                    </div>
                                @endfor


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid container-fixed-lg">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="indicator-right {{ ($information->indicator_satu == '1') ? "done" : '' }}"> - </div>
                        <h5 class="text-bold-ter title m-b-0">Indikator Satu, Syarat KPR</h5>
                        <h6 class="title m-t-5 fs-15">Penuhi semua kebutuhan persyaratan dibawah ini</h6><br/>
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="titlee">Syarat Umum</h5>

                                @foreach($syarat_umus as $syarat_umum)
                                    <div aria-required="true" class="form-group {{ $errors->has('su_'.$syarat_umum) ? 'has-error' : ''}}">
                                        <div class="checkbox check-info">
                                            <input type="checkbox" value="1" id="{{ 'su_'.$syarat_umum }}" name="su_{{ $syarat_umum }}"
                                                    {{ (count($su) > 0)  ? ($su->$syarat_umum == 1) ? 'checked' : '' : ''  }}>
                                            <label for="{{ 'su_'.$syarat_umum }}">{{ ucwords(str_replace("_", " ", $syarat_umum)) }}</label>
                                        </div>
                                    </div>
                                    {!! $errors->first('su_'.$syarat_umum, '<label class="error pull-right error-top">:message</label>') !!}
                                @endforeach


                            </div>
                            <div class="col-md-4">
                                <h5 class="titlee">Pegawai Tetap</h5>

                                @foreach($pegawai_tetaps as $pegawai_tetap)
                                    <div aria-required="true" class="form-group {{ $errors->has('xp_'.$pegawai_tetap) ? 'has-error' : ''}}">
                                        <div class="checkbox check-info">
                                            <input type="checkbox" value="1" id="{{ 'xp_'.$pegawai_tetap }}" name="{{ 'xp_'.$pegawai_tetap }}"
                                                    {{ (count($pt) > 0)  ? ($pt->$pegawai_tetap == 1) ? 'checked' : '' : ''  }}>
                                            <label for="{{ 'xp_'.$pegawai_tetap }}">{{ ucwords(str_replace("_", " ", $pegawai_tetap)) }}</label>
                                        </div>
                                    </div>
                                    {!! $errors->first('xp_'.$pegawai_tetap, '<label class="error pull-right error-top">:message</label>') !!}
                                @endforeach


                            </div>
                            <div class="col-md-4">
                                <h5 class="titlee">Data Bank</h5>

                                @foreach($data_banks as $data_bank)
                                    <div aria-required="true" class="form-group required {{ $errors->has('db_'.$data_bank) ? 'has-error' : ''}}">
                                        <div class="checkbox check-info">
                                            <input type="checkbox" value="1" id="{{ 'db_'.$data_bank }}" name="{{ 'db_'.$data_bank }}"
                                                    {{ (count($db) > 0)  ? ($db->$data_bank == 1) ? 'checked' : '' : ''  }}>
                                            <label for="{{ 'db_'.$data_bank }}">{{ ucwords(str_replace("_", " ", $data_bank)) }}</label>
                                        </div>
                                    </div>
                                    {!! $errors->first('db_'.$data_bank, '<label class="error pull-right error-top">:message</label>') !!}
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container-fluid">
            <div class="container-fluid container-fixed-lg col-md-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default" style="min-height: 420px;">
                            <div class="panel-body">
                                <div class="indicator-right {{ ($information->indicator_dua == '1') ? "done" : '' }}"> - </div>
                                <h5 class="text-bold-ter title m-b-0">Indikator Dua, Akad Kredit</h5>
                                <h6 class="title m-t-5 fs-15">Penuhi semua kebutuhan persyaratan dibawah ini</h6><br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="titlee">Akad Kredit</h5>

                                        @foreach($akad_kredits as $akad_kredit)
                                            <div aria-required="true" class="form-group {{ $errors->has('ak_'.$akad_kredit) ? 'has-error' : ''}}">
                                                <div class="checkbox check-info">
                                                    <input type="checkbox" value="1" id="{{ 'ak_'.$akad_kredit }}" name="{{ 'ak_'.$akad_kredit }}"
                                                            {{ (count($ak) > 0)  ? ($ak->$akad_kredit == 1) ? 'checked' : '' : ''  }}>
                                                    <label for="{{ 'ak_'.$akad_kredit }}">{{ ucwords(str_replace("_", " ", $akad_kredit)) }}</label>
                                                </div>
                                            </div>
                                            {!! $errors->first('ak_'.$akad_kredit, '<label class="error pull-right error-top">:message</label>') !!}
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid container-fixed-lg col-md-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default" style="min-height: 420px;">
                            <div class="panel-body">
                                <h5 class="text-bold-ter title m-b-0">Indikator Dua, SP3K</h5>
                                <h6 class="title m-t-5 fs-15">Kebutuhan untuk akad</h6><br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="titlee">SP3K</h5>

                                        <div class="row m-t-10">
                                            <div class="col-md-12">

                                                <div aria-required="true" class="form-group form-group-default {{ $errors->has('kpr_diajukan') ? 'has-error' : ''}}">
                                                    {!! Form::label('kpr_diajukan', "KPR Diajukan") !!}
                                                    {!! Form::text('kpr_diajukan', null, ['class' => 'form-control input-md autonumeric', 'id' => 'satu', 'data-a-sign' => 'Rp ',  'placeholder' => "Rp 0"]) !!}
                                                </div>
                                                {!! $errors->first('kpr_diajukan', '<label class="error">:message</label>') !!}
                                            </div>
                                        </div>
                                        <div class="row m-t-5">
                                            <div class="col-md-12">
                                                <div aria-required="true" class="form-group form-group-default  {{ $errors->has('kpr_disetujui') ? 'has-error' : ''}}">
                                                    {!! Form::label('kpr_disetujui', "KPR Disetujui") !!}
                                                    {!! Form::text('kpr_disetujui',  null, ['class' => 'form-control input-md autonumeric', 'id' => 'dua', 'data-a-sign' => 'Rp ',  'placeholder' => "Rp 0"]) !!}
                                                </div>
                                                {!! $errors->first('kpr_disetujui', '<label class="error">:message</label>') !!}
                                            </div>
                                        </div>
                                        <div class="row m-t-5">
                                            <div class="col-md-12">
                                                <div aria-required="true" class="form-group form-group-default {{ $errors->has('kpr_selisih') ? 'has-error' : ''}}">
                                                    {!! Form::label('kpr_selisih', "Selisih KPR") !!}
                                                    {!! Form::text('kpr_selisih',  null, ['class' => 'form-control input-md', 'id' => 'selisih', 'placeholder' => "Rp 0",
                                                    "style" => "color: #000 !important;", 'readonly' => 'readonly']) !!}
                                                </div>
                                                {!! $errors->first('kpr_selisih', '<label class="error">:message</label>') !!}
                                            </div>
                                        </div>
                                        <div class="row m-t-5">
                                            <div class="col-md-8">
                                                <div class="form-group form-group-default">
                                                    <div class="form-input-group ">
                                                        {!! Form::label('tanggal_bayar', "Tanggal Bayar") !!}
                                                        <input type="tanggal_bayar"  value="{{ $bo->tanggal_bayar }}"  class="form-control" placeholder="Pick a date" name="tanggal_bayar" id="tanggal_bayar">
                                                    </div>
                                                </div>
                                                {!! $errors->first('tanggal_bayar', '<label class="error">:message</label>') !!}
                                            </div>
                                            <div class="col-md-2">
                                                <div aria-required="true" class="form-group {{ $errors->has('bayar') ? 'has-error' : ''}}">
                                                    <div class="checkbox check-info">
                                                        <input type="checkbox" value="1" id="bayar" name="bayar" {{ ($bo->bayar == 1) ? 'checked' : '' }}>
                                                        <label for="bayar">Bayar</label>
                                                    </div>
                                                </div>
                                                {!! $errors->first('ak_'.$akad_kredit, '<label class="error pull-right error-top">:message</label>') !!}
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid container-fixed-lg col-md-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default" style="min-height: 420px;">
                            <div class="panel-body">
                                <div class="indicator-right {{ ($information->indicator_tiga == '1') ? "done" : '' }}"> - </div>
                                <h5 class="text-bold-ter title m-b-0">Indikator Tiga, Follow up Bank</h5>
                                <h6 class="title m-t-5 fs-15">Penuhi semua kebutuhan persyaratan dibawah ini</h6><br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="titlee">Follow Up Bank</h5>

                                        @foreach($follow_up_banks as $follow_up_bank)
                                            <div aria-required="true" class="form-group {{ $errors->has('fub_'.$follow_up_bank) ? 'has-error' : ''}}">
                                                <div class="checkbox check-info">
                                                    <input type="checkbox" value="1" id="{{ 'fub_'.$follow_up_bank }}" name="{{ 'fub_'.$follow_up_bank }}"
                                                            {{ (count($fub) > 0)  ? ($fub->$follow_up_bank == 1) ? 'checked' : '' : ''  }}>
                                                    <label for="{{ 'fub_'.$follow_up_bank }}">{{ ucwords(str_replace("_", " ", $follow_up_bank)) }}</label>
                                                </div>
                                            </div>
                                            {!! $errors->first('fub_'.$follow_up_bank, '<label class="error pull-right error-top">:message</label>') !!}
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid container-fixed-lg col-md-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default" style="min-height: 420px;">
                            <div class="panel-body">
                                <h5 class="text-bold-ter title m-b-0">Indikator Tiga, Status Akhir</h5>
                                <h6 class="title m-t-5 fs-15">Kebutuhan untuk keputusan status</h6><br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="titlee">Status Akhir</h5>

                                        <div class="row m-t-10">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default form-group-default-select2">
                                                    {!! Form::label('metode_pembayaran', "Metode Pembayaran") !!}
                                                    {{ Form::select('metode_bayar', ["credit" => "Kredit", "cash" => "Tunai"], $bo->metode_bayar, ['class' => 'full-width', 'id' => 'metode', 'data-init-plugin' => 'select2']) }}
                                                </div>
                                                {!! $errors->first('metode_pembayaran', '<label class="error">:message</label>') !!}
                                            </div>
                                        </div>
                                        <div class="row m-t-5 credit">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default">
                                                    <div class="form-input-group ">
                                                        {!! Form::label('tanggal_akad', "Tanggal Akad") !!}
                                                        <input type="text" value="{{ $bo->tanggal_akad }}" class="form-control tanggal-picker" placeholder="Pick a date" name="tanggal_akad" id="tanggal_akad">
                                                    </div>
                                                </div>
                                                {!! $errors->first('tanggal_akad', '<label class="error">:message</label>') !!}
                                            </div>
                                        </div>
                                        <div class="row m-t-5 credit">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-default">
                                                    <div class="form-input-group ">
                                                        {!! Form::label('tanggal_cair', "Tanggal Cair") !!}
                                                        <input type="text"  value="{{ $bo->tanggal_cair }}" class="form-control tanggal-picker" placeholder="Pick a date" name="tanggal_cair" id="tanggal_cair">
                                                    </div>
                                                </div>
                                                {!! $errors->first('tanggal_cair', '<label class="error">:message</label>') !!}
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="bo" value="{{ $bo->id }}"/>
    <input type="hidden" name="su" value="{{ $su->id }}"/>
    <input type="hidden" name="pt" value="{{ $pt->id }}"/>
    <input type="hidden" name="db" value="{{ $db->id }}"/>
    <input type="hidden" name="ak" value="{{ $ak->id }}"/>
    <input type="hidden" name="fub" value="{{ $fub->id }}"/>
    <div class="container-fluid container-fixed-lg">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <button class="btn btn-default btn-rounded btn-sm p-l-30 p-r-30 m-r-10" type="reset">CLEAR</button>
                        {!! Form::submit('SAVE', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-sm p-l-30 p-r-30']) !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        if($("#metode option:selected").val() == "cash"){
            $(".credit").css("display", "none");
        }else{
            $(".credit").css("display", "block");
        }

        $('#formValidate').validate();
        $('#tanggal_bayar, .tanggal-picker').datepicker({
            format: 'yyyy/mm/dd'
        });
        $('.autonumeric').autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0'});

        $('#satu, #dua').on('keyup', function() {

            var val = $('#satu').autoNumeric('get') - $('#dua').autoNumeric('get');
            $('#selisih').val("Rp "+val.toLocaleString());
        });

        $('#metode').on('change', function (e) {
            if($("#metode option:selected").val() == "cash"){
                $(".credit").css("display", "none");
            }else{
                $(".credit").css("display", "block");
            }
        });

    });

</script>
@endpush
