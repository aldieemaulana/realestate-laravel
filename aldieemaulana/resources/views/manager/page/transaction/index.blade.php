@extends('manager.layouts.frame')
@section('title', 'Transaction')
@section('description', 'Transaction Management')

@section('content')
    <div class="container-fluid container-fixed-lg">
        <div class="row">

            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="m-t-0">Transaction</h4>
                        </div>
                        <div class="row">
                            {!! Form::open(['url' => 'manager/transaction', 'method' => 'GET', 'id' => 'formValidate', 'files' => true]) !!}
                            <div class="col-md-2 col-xs-6">
                                <div class="form-group form-group-default">
                                    <div class="form-input-group ">
                                        {!! Form::label('tanggal_mulai', "Tanggal Mulai") !!}
                                        <input type="text" class="form-control tanggal-picker" placeholder="Pick a date" name="tanggal_mulai" id="tanggal_mulai" value="{{ Request::get('tanggal_mulai') }}">
                                    </div>
                                </div>
                                {!! $errors->first('tanggal_mulai', '<label class="error">:message</label>') !!}
                            </div>
                            <div class="col-md-2 col-xs-6">
                                <div class="form-group form-group-default">
                                    <div class="form-input-group ">
                                        {!! Form::label('tanggal_selesai', "Tanggal Selesai") !!}
                                        <input type="text" class="form-control tanggal-picker" placeholder="Pick a date" name="tanggal_selesai" id="tanggal_selesai" value="{{ Request::get('tanggal_selesai') }}">
                                    </div>
                                </div>
                                {!! $errors->first('tanggal_selesai', '<label class="error">:message</label>') !!}
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="form-group form-group-default form-group-default-select2 {{ $errors->has('id_location') ? 'has-error' : ''}}">
                                    {!! Form::label('id_location', "Lokasi") !!}
                                    {{ Form::select('id_location', $locations, Request::get('id_location'), ['class' => 'full-width', 'data-init-plugin' => 'select2']) }}
                                </div>
                                {!! $errors->first('id_location', '<label class="error">:message</label>') !!}
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="form-group form-group-default form-group-default-select2 {{ $errors->has('id_block') ? 'has-error' : ''}}" id="id_blocked">
                                    {!! Form::label('id_block', "Block") !!}
                                    {{ Form::select('id_block', $blocks, Request::get('id_block'), ['class' => 'full-width', 'data-init-plugin' => 'select2']) }}
                                </div>
                                {!! $errors->first('id_block', '<label class="error">:message</label>') !!}
                            </div>
                            <div class="col-md-2 col-xs-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" style="height: 53px;"><i class="fa fa-search"></i> FILTER</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="panel-body no-padding table-responsive " style="background: #FFF">
                        <div class="row">
                            <table class="table table-hover de-left m-b-0 b-t-1">
                                <tbody>
                                <tr>
                                    <td width="10%">
                                        Action
                                    </td>
                                    <td>Nama</td>
                                    <td>Perum</td>
                                    <td>Blok</td>
                                    <td>Status</td>
                                    <td>Telepon</td>
                                    <td>Wawancara</td>
                                    <td>Fee Status</td>
                                    <td>Booking Fee</td>
                                    <td>Tanggal Booking</td>
                                    <td>DP 1</td>
                                    <td>DP 2</td>
                                    <td>DP 3</td>
                                    <td>DP 4</td>
                                    <td>DP 5</td>
                                    <td>Total DP</td>
                                </tr>
                                @if(count($transactions))
                                    @foreach($transactions as $transaction)
                                        <tr id="{{ $transaction->id }}">
                                            <td>
                                                <a onClick="deleteData({{ $transaction->id }})" class="btn btn-default btn-rounded btn-xs" type="button" style="width:28px;height:28px;margin-right:4px;"><i class="fa fa-trash" style="width:8px;"></i></a>
                                                <a onClick="confirmData({{ $transaction->id }})" class="btn btn-success btn-rounded btn-xs" type="button" style="width:28px;height:28px;margin-right:4px;"><i class="fa fa-check" style="width:8px;"></i></a>
                                                {{--<a href="{{ url('manager/transaction/'.$transaction->id.'/edit') }}" class="btn btn-default btn-rounded btn-xs" type="button" style="width:28px;height:28px;"><i class="fa fa-pencil" style="width:8px;"></i></a>--}}
                                            </td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ ucwords($transaction->nama) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ ucwords($transaction->block_location_name) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ ucwords($transaction->block_name . " NO." . $transaction->block_number) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ ucwords(str_replace("_", " ", $transaction->status)) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ ucwords($transaction->telepon) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ ucwords($transaction->tanggal_wawancara) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ ($transaction->fee_status == 1) ? 'Cair' : 'Belum Cair' }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->booking_fee) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ ucwords($transaction->tanggal_booking_fee) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->dp_1) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->dp_2) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->dp_3) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->dp_4) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->dp_5) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->dp_1 + $transaction->dp_2 + $transaction->dp_3 + $transaction->dp_4 + $transaction->dp_5) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="14" style="background: #EEE;padding: 10px 20px;">
                                            Kosong
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="panel-footer" style="background: #FFF;color: #101010;font-size: 13px;font-weight: 300">
                        {{ (count($transactions) > 14) ? $transactions->appends(['tanggal_mulai' =>  Request::get('tanggal_mulai'),
                        'tanggal_selesai' =>  Request::get('tanggal_selesai'),
                        'id_location' =>  Request::get('id_location'),
                        'id_block' =>  Request::get('id_block')])->links() : "Number of data: " . count($transactions) }}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <input type="hidden" id="deleteID" />
    <input type="hidden" id="confirmID" />
@endsection


@push("script")
<script>

    $(document).ready(function() {
        $('.tanggal-picker').datepicker({
            format: 'yyyy/mm/dd'
        });

    });

    function deleteData(id) {
        $('#modalDelete').modal('show');
        $('#deleteID').val(id);
    }

    function confirmData(id) {
        $('#modalConfirm').modal('show');
        $('#confirmID').val(id);
    }

    function confirm(){
        $('#modalConfirm').modal('hide');
        var id = $('#confirmID').val();
        $.ajax({
            url: '{{url("manager/transaction")}}' + "/fee/" + id + '?' + $.param({"_token" : '{{ csrf_token() }}' }),
            type: 'PATCH',
            complete: function(data) {
                window.location.href = '{{ url('manager/transaction') }}';
            }
        });
    }

    function hapus(){
        $('#modalDelete').modal('hide');
        var id = $('#deleteID').val();
        $.ajax({
            url: '{{url("manager/transaction")}}' + "/" + id + '?' + $.param({"_token" : '{{ csrf_token() }}' }),
            type: 'DELETE',
            complete: function(data) {
                $('#' + id).remove();
            }
        });
    }


    $('#id_location').on('change', function (e) {
        var id = $("#id_location option:selected").val();
        $.ajax({
            url: '{{url("manager/transaction/location")}}' + "/" + id + '?' + $.param({"_token" : '{{ csrf_token() }}' }),
            type: 'GET',
            complete: function(data) {
                $('#id_blocked').html(data.responseText);
                $('#id_block').select2();
            }
        });
    });
</script>
@endpush
