@extends('manager.layouts.frame')
@section('title', 'User')
@section('description', 'User Management')

@section('content')
  <div class="container-fluid container-fixed-lg">
    <div class="row">

      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title">
              <h4 class="m-t-0">User</h4>
            </div>
            <a href="{{ url('manager/user/create') }}" class="btn btn-default pull-right btn-rounded btn-xs" type="button" style="width:28px;height:28px;"><i class="fa fa-plus" style="width:8px;"></i></a>
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
                  <td>Username</td>
                  <td>Role</td>
                </tr>
                @if(count($users))
                  @foreach($users as $user)
                    <tr id="{{ $user->id }}">
                      <td>
                        <a onClick="deleteData({{ $user->id }})" class="btn btn-default btn-rounded btn-xs" type="button" style="width:28px;height:28px;margin-right:4px;"><i class="fa fa-trash" style="width:8px;"></i></a>
                        <a href="{{ url('manager/user/'.$user->id.'/edit') }}" class="btn btn-default btn-rounded btn-xs" type="button" style="width:28px;height:28px;"><i class="fa fa-pencil" style="width:8px;"></i></a>
                      </td>
                      <td class="font-montserrat all-caps fs-12 p-t-25" style="white-space: nowrap;">{{ $user->name }}</td>
                      <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ $user->username }}</td>
                      <td class="font-montserrat fs-12 p-t-25" style="white-space: nowrap;">{{ $user->roles->name }}</td>
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
            {{ (count($users) > 15) ? $users->links() : "Number of data: " . count($users) }}
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
          url: '{{url("manager/user")}}' + "/" + id + '?' + $.param({"_token" : '{{ csrf_token() }}' }),
          type: 'DELETE',
          complete: function(data) {
          $('#' + id).remove();
          }
      });
  }
</script>
@endpush
