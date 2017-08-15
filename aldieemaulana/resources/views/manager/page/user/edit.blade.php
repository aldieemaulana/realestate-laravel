@extends('manager.layouts.frame')
@section('title', 'Update User')
@section('description', 'Please make sure to check all input')
@section('button')
  <a href="{{ url('/manager/user') }}" class="btn btn-info btn-xs no-border">Back</a>
@endsection

@section('content')
  <div class="container-fluid container-fixed-lg">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">

            {!! Form::model($information, [
                    'method' => 'PATCH',
                    'url' => ['/manager/user', $information->id],
                    'files' => true,
                    'id' => 'formValidate',
                ]) !!}

            <div class="row">
              <div class="col-md-6">
                <div aria-required="true" class="form-group form-group-default {{ $errors->has('name') ? 'has-error' : ''}}">
                  {!! Form::label('name', "name") !!}
                  {!! Form::text('name', null, ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "name"]) !!}
                  {!! $errors->first('name', '<label class="error">:message</label>') !!}
                </div>

                <div aria-required="true" class="form-group form-group-default {{ $errors->has('username') ? 'has-error' : ''}}">
                  {!! Form::label('username', "username") !!}
                  {!! Form::text('username', null, ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "username"]) !!}
                  {!! $errors->first('username', '<label class="error">:message</label>') !!}
                </div>

                <div aria-required="true" class="form-group form-group-default {{ $errors->has('password') ? 'has-error' : ''}}">
                  {!! Form::label('password', "password") !!}
                  {!! Form::password('password', ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "password"]) !!}
                  {!! Form::hidden('password_old', $information->password, ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "password"]) !!}
                  {!! $errors->first('password', '<label class="error">:message</label>') !!}
                </div>
              </div>
              <div class="col-md-6">
                <div aria-required="true" class="form-group form-group-default {{ $errors->has('phone') ? 'has-error' : ''}}">
                  {!! Form::label('phone', "phone number") !!}
                  {!! Form::number('phone', null, ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "phone number"]) !!}
                  {!! $errors->first('phone', '<label class="error">:message</label>') !!}
                </div>

                <div aria-required="true" class="form-group form-group-default {{ $errors->has('email') ? 'has-error' : ''}}">
                  {!! Form::label('email', "email") !!}
                  {!! Form::email('email', null, ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "email"]) !!}
                  {!! $errors->first('email', '<label class="error">:message</label>') !!}
                </div>

                @if($information->id <> Auth::User()->id)
                <div aria-required="true" class="form-group form-group-default {{ $errors->has('role') ? 'has-error' : ''}}">
                  {!! Form::label('role', "role") !!}
                  {!! Form::select('role', $roles, $information->role, ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "role"]) !!}
                  {!! $errors->first('role', '<label class="error">:message</label>') !!}
                </div>
                @endif


              </div>

            </div>

            <div class="pull-left m-b-20">
              <div class="checkbox check-success">
                <input id="checkbox-agree" type="checkbox" required> <label for="checkbox-agree"><small>Saya sudah mengecek data sebelum menyimpan</small></label>
              </div>
            </div>

            <br/>

            <button class="btn btn-default btn-rounded btn-sm p-l-30 p-r-30 m-r-10" type="reset">CLEAR</button>
            {!! Form::submit('CREATE', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-sm p-l-30 p-r-30']) !!}


            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#formValidate').validate();

    });
  </script>
@endpush
