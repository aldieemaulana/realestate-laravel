@extends('manager.layouts.frame')
@section('title', 'Create Block')
@section('description', 'Please make sure to check all input')
@section('button')
  <a href="{{ url('/manager/block') }}" class="btn btn-info btn-xs no-border">Back</a>
@endsection

@section('content')
  <div class="container-fluid container-fixed-lg">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            {!! Form::open(['url' => 'manager/block', 'id' => 'formValidate', 'files' => true]) !!}

              <div class="row">
                <div class="col-md-7">
                  <div aria-required="true" class="form-group form-group-default required {{ $errors->has('name') ? 'has-error' : ''}}">
                      {!! Form::label('name', "Nama") !!}
                      {!! Form::text('name', null, ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "Nama"]) !!}
                  </div>
                  {!! $errors->first('name', '<label class="error">:message</label>') !!}
                </div>

                <div class="col-md-3">
                  <div aria-required="true" class="form-group form-group-default required {{ $errors->has('number') ? 'has-error' : ''}}">
                      {!! Form::label('number', "Jumlah") !!}
                      {!! Form::number('number', 1, ['class' => 'form-control input-md', 'required' => 'required', 'placeholder' => "Jumlah"]) !!}
                  </div>
                  {!! $errors->first('number', '<label class="error">:message</label>') !!}
                </div>

                <div class="col-md-2">
                  <div class="form-group form-group-default form-group-default-select2 required {{ $errors->has('id_location') ? 'has-error' : ''}}">
                      {!! Form::label('id_location', "Lokasi") !!}
                    {{ Form::select('id_location', $locations, null, ['class' => 'full-width', 'required' => 'required', 'data-init-plugin' => 'select2']) }}
                  </div>
                  {!! $errors->first('id_location', '<label class="error">:message</label>') !!}
                </div>

              </div>


              <br/>

              <button class="btn btn-default btn-rounded btn-sm p-l-30 p-r-30 m-r-10" type="reset">CLEAR</button>
              {!! Form::submit('SAVE', ['type' => 'submit', 'class' => 'btn btn-success btn-rounded btn-sm p-l-30 p-r-30']) !!}


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
