<aside class="main-sidebar">
    @php
        $path = Request::path();
    @endphp
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <div class="img-circle" alt="User Image" style="margin-left:-5px;font-weight:bold;font-size:20px;color:white;background: #222d32;border:3px solid #fff;border-radius:50%;padding:3px 12px;">{{ strtoupper(Auth::user()->name[0]) }}</div>
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> --}}
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
        <!-- Optionally, you can add icons to the links -->
        @if(Auth::user()->name == "mhs")
        <li><a href="{{ route("regis") }}"><i class="fa fa-users"></i> <span>Kelompok</span></a></li>
        <li><a href="{{ route("uplProposal") }}"><i class="fa fa-file"></i> <span>Upload Proposal</span></a></li>
        <li><a href="{{ route("regis") }}"><i class="fa fa-image"></i> <span>Upload Banner</span></a></li>
        @elseif(Auth::user()->name == "dosen")
        <li><a href="{{ route("dashboard") }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ route("dataKelompok") }}"><i class="fa fa-users"></i> <span>Data Kelompok & Kelas</span></a></li>
        <li><a href="{{ route("dataProposal") }}"><i class="fa fa-file"></i> <span>Proposal Masuk</span></a></li>
        <li><a href="{{ route("createPengumuman") }}"><i class="fa fa-bullhorn"></i> <span>Buat Pengumuman</span></a></li>
        @else
        <li><a href="{{ route("dashboard") }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ route("manage_jurusan") }}"><i class="fa fa-building"></i> <span>Setting Jurusan</span></a></li>
        <li><a href="{{ route("tahunajaran") }}"><i class="fa fa-clock-o"></i> <span>Setting Tahun Ajaran</span></a></li>
        <li><a href="{{ route("setKelas") }}"><i class="fa fa-hourglass-half"></i> <span>Setting Kelas</span></a></li>
        @endif
        {{-- <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li> --}}
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>