<li class="m-t-30">
    <a class="{{ (Request::is('supervisor/dashboard*')) ? 'active' : ''}}" href="{{ url('supervisor/dashboard') }}"><span class="title">Dashboard</span></a> <span class=" {{ (Request::is('supervisor/dashboard*')) ? 'bg-success' : ''}} icon-thumbnail"><i class="pg-home"></i></span>
</li>
