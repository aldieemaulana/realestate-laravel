<li class="m-t-30">
    <a class="{{ (Request::is('manager/dashboard*')) ? 'active' : ''}}" href="{{ url('manager/dashboard') }}"><span class="title">Dashboard</span></a> <span class=" {{ (Request::is('manager/dashboard*')) ? 'bg-success' : ''}} icon-thumbnail"><i class="pg-home"></i></span>
</li>

<li>
    <a class="{{ (Request::is('manager/user*')) ? 'active' : ''}}" href="{{ url('manager/user') }}">
        <span class="title">User</span>
    </a>
    <span class=" {{ (Request::is('manager/user*')) ? 'bg-success' : ''}} icon-thumbnail"><i class="fa fa-users"></i></span>
</li>


<li>
    <a class="{{ (Request::is('manager/location*')) ? 'active' : ''}}" href="{{ url('manager/location') }}">
        <span class="title">Lokasi</span>
    </a>
    <span class=" {{ (Request::is('manager/location*')) ? 'bg-success' : ''}} icon-thumbnail"><i class="fa fa-map-marker"></i></span>
</li>

<li>
    <a class="{{ (Request::is('manager/block*')) ? 'active' : ''}}" href="{{ url('manager/block') }}">
        <span class="title">Rumah</span>
    </a>
    <span class=" {{ (Request::is('manager/block*')) ? 'bg-success' : ''}} icon-thumbnail"><i class="fa fa-institution"></i></span>
</li>

<li>
    <a class="{{ (Request::is('manager/history*')) ? 'active' : ''}}" href="{{ url('manager/history') }}">
        <span class="title">Riwayat</span>
    </a>
    <span class=" {{ (Request::is('manager/history*')) ? 'bg-success' : ''}} icon-thumbnail"><i class="fa fa-history"></i></span>
</li>

<li>
    <a class="{{ (Request::is('manager/transaction*')) ? 'active' : ''}}" href="{{ url('manager/transaction') }}">
        <span class="title">Transaksi</span>
    </a>
    <span class=" {{ (Request::is('manager/transaction*')) ? 'bg-success' : ''}} icon-thumbnail"><i class="fa fa-database"></i></span>
</li>

