@extends('layouts.auth.frame')

@section('content')
<div class="login-container bg-white">
    <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
        <img alt="logo" data-src="{{url('img/logo.png')}}" data-src-retina="{{url('img/logo_2x.png')}}" height="22" src="{{url('img/logo.png')}}" width="78">
        <p class="p-t-35">Forgot password account extranet panel</p>
        <form class="p-t-15" role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}
            <div class="form-group form-group-default">
                <label>Email</label>
                <div class="controls">
                    <input class="form-control" name="email" required="" value="{{ old('email') }}" autofocus placeholder="Email" type="email">
                </div>
                
            </div>
            @if (session('status'))
                <label class="error">
                    {{ session('status') }}
                </label>
            @endif
            
            <button class="btn btn-primary btn-cons m-t-10" type="submit">Send Password Reset Link</button>
        </form>
        <div class="pull-bottom sm-pull-bottom">
            <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">						
                <div class="col-sm-12 no-padding m-t-10">
                    <p><small>If you have any problem with your account, please contact your technical support, <a class="text-success" href="{{ url('/login') }}">
                                    Login?
                                </a></small></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
