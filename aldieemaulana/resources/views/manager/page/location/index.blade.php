@extends('manager.layouts.frame')
@section('title', 'Location')
@section('description', 'Location Management')

@section('content')
    <div class="container-fluid container-fixed-lg">
        <div class="row">

            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="m-t-0">Location</h4>
                        </div>
                        <a href="{{ url('manager/location/create') }}" class="btn btn-default pull-right btn-rounded btn-xs" type="button" style="width:28px;height:28px;"><i class="fa fa-plus" style="width:8px;"></i></a>
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
                                </tr>
                                @if(count($locations))
                                    @foreach($locations as $location)
                                        <tr id="{{ $location->id }}">
                                            <td>
                                                <a onClick="deleteData({{ $location->id }})" class="btn btn-default btn-rounded btn-xs" type="button" style="width:28px;height:28px;margin-right:4px;"><i class="fa fa-trash" style="width:8px;"></i></a>
                                                <a href="{{ url('manager/location/'.$location->id.'/edit') }}" class="btn btn-default btn-rounded btn-xs" type="button" style="width:28px;height:28px;"><i class="fa fa-pencil" style="width:8px;"></i></a>
                                            </td>
                                            <td class="font-montserrat all-caps fs-12 p-t-25" style="white-space: nowrap;">{{ $location->name }}</td>
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
                        {{ (count($locations) > 15) ? $locations->links() : "Number of data: " . count($locations) }}
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
            url: '{{url("manager/location")}}' + "/" + id + '?' + $.param({"_token" : '{{ csrf_token() }}' }),
            type: 'DELETE',
            complete: function(data) {
                $('#' + id).remove();
            }
        });
    }
</script>
@endpush
