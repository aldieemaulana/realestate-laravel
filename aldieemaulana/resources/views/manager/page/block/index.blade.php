@extends('manager.layouts.frame')
@section('title', 'Block')
@section('description', 'Block Management')

@section('content')
    <div class="container-fluid container-fixed-lg">
        <div class="row">

            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="m-t-0">Block</h4>
                        </div>
                        <a href="{{ url('manager/block/create') }}" class="btn btn-default pull-right btn-rounded btn-xs" type="button" style="width:28px;height:28px;"><i class="fa fa-plus" style="width:8px;"></i></a>
                    </div>
                    <div class="panel-body no-padding" style="background: #FFF">
                        <div class="row">
                            <table class="table table-hover de-left m-b-0 b-t-1">
                                <tbody>
                                <tr>
                                    <td width="10%">
                                        Action
                                    </td>
                                    <td>Name</td>
                                    <td width="10%" class="text-right">Jumlah</td>
                                    <td width="10%">Akad</td>
                                    <td width="10%">Kosong</td>
                                    <td width="10%">Terisi</td>
                                </tr>
                                @if(count($blocks))
                                    @foreach($blocks as $block)
                                        <tr id="{{ $block->id }}">
                                            <td>
                                                <a onClick="deleteData({{ $block->id }})" class="btn btn-default btn-rounded btn-xs" type="button" style="width:28px;height:28px;margin-right:4px;"><i class="fa fa-trash" style="width:8px;"></i></a>
                                            </td>
                                            <td class="font-montserrat all-caps fs-12" style="white-space: nowrap;">{{ $block->name }}</td>
                                            <td class="text-right b-r b-dashed b-grey" ><span class="hint-text small">{{ count($block->houses) }}</span></td>
                                            <td><span class="font-montserrat fs-10">{{ count($block->housesAkad) }}</span></td>
                                            <td><span class="font-montserrat fs-10">{{ count($block->housesKosong) }}</span></td>
                                            <td><span class="font-montserrat fs-10">{{ count($block->housesIsi) }}</span></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" style="background: #EEE;padding: 10px 20px;">
                                            Kosong
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="panel-footer" style="background: #FFF;color: #101010;font-size: 13px;font-weight: 300">
                        {{ (count($blocks) > 15) ? $blocks->links() : "Number of data: " . count($blocks) }}
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
            url: '{{url("manager/block")}}' + "/" + id + '?' + $.param({"_token" : '{{ csrf_token() }}' }),
            type: 'DELETE',
            complete: function(data) {
                $('#' + id).remove();
            }
        });
    }
</script>
@endpush
