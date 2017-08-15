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
{{--                        <a href="{{ url('manager/transaction/create') }}" class="btn btn-default pull-right btn-rounded btn-xs" type="button" style="width:28px;height:28px;"><i class="fa fa-plus" style="width:8px;"></i></a>--}}
                    </div>
                    <div class="panel-body no-padding" style="background: #FFF">
                        <div class="row">
                            <table class="table table-hover de-left m-b-0 b-t-1">
                                <tbody>
                                <tr>
                                    <td width="15%">
                                        Action
                                    </td>
                                    <td>Nama</td>
                                    <td>Status</td>
                                    <td>Telepon</td>
                                    <td>Wawancara</td>
                                    <td>Booking Fee</td>
                                    <td>DP 1</td>
                                    <td>DP 2</td>
                                    <td>DP 3</td>
                                    <td>DP 4</td>
                                    <td>DP 5</td>
                                </tr>
                                @if(count($transactions))
                                    @foreach($transactions as $transaction)
                                        <tr id="{{ $transaction->id }}">
                                            <td>
                                                <a onClick="deleteData({{ $transaction->id }})" class="btn btn-default btn-rounded btn-xs" type="button" style="width:28px;height:28px;margin-right:4px;"><i class="fa fa-trash" style="width:8px;"></i></a>
                                                {{--<a href="{{ url('manager/transaction/'.$transaction->id.'/edit') }}" class="btn btn-default btn-rounded btn-xs" type="button" style="width:28px;height:28px;"><i class="fa fa-pencil" style="width:8px;"></i></a>--}}
                                            </td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ ucwords($transaction->nama) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ ucwords($transaction->status) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ ucwords($transaction->telepon) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ ucwords($transaction->tanggal_wawancara) }}</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->booking_fee) }},00,-</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->dp1) }},00,-</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->dp2) }},00,-</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->dp3) }},00,-</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->dp4) }},00,-</td>
                                            <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">Rp{{ number_format($transaction->dp5) }},00,-</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2" style="background: #EEE;padding: 10px 20px;">
                                            Kosong
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="panel-footer" style="background: #FFF;color: #101010;font-size: 13px;font-weight: 300">
                        {{ (count($transactions) > 15) ? $transactions->links() : "Number of data: " . count($transactions) }}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <input type="hidden" id="deleteID" />
@endsection


@push("script")
<script>

    function deleteData(id) {
        $('#modalDelete').modal('show');
        $('#deleteID').val(id);
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
</script>
@endpush
