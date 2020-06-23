<aside class="main-sidebar">
    @php
        $path = Request::path();
        $isAda = '';
        if(auth()->guard("web")->check()){

          $mhs =auth()->guard("web")->user()->id;
          $dtKel = \DB::table("detail_kelompok")->where("id_mahasiswa",$mhs);
          
          $isAda = $dtKel->exists();
          
          if($isAda){
            $dtKel = $dtKel->first();
            // $kelompok = App\Kelompok::find($dtKel->id_kelompok);
            // dd($kelompok->mhs()->get());
          }
        }
    @endphp
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <div class="img-circle" alt="User Image" style="margin-left:-5px;font-weight:bold;font-size:20px;color:white;background: #222d32;border:3px solid #fff;border-radius:50%;padding:3px 12px;">{{ strtoupper(Auth::guard($grd)->user()->nama[0]) }}</div>
        </div>
        <div class="pull-left info">
          <p>{{ Auth::guard($grd)->user()->nama }}</p>
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
        @if(Auth::guard("web")->check())
        <li><a href="{{ route("regis") }}"><i class="fa fa-users"></i> <span>Kelompok </span></a></li>
        @if($isAda)
        <li><a href="{{ route("uplProposal") }}"><i class="fa fa-file"></i> <span>Upload Proposal</span></a></li>
        @else
        <li><a href="#" onclick="alert('Belum Input Data Kelompok')"><i class="fa fa-file"></i> <span>Upload Proposal</span></a></li>
        @endif
        <li><a href="{{ route("regis") }}"><i class="fa fa-image"></i> <span>Upload Banner</span></a></li>
        @elseif(Auth::guard("admin")->check())
        @if(Auth::guard("admin")->user()->nama == "admin")
        <li><a href="{{ route("dashboard") }}"><i class="fa fa-dashboard"></i> <span>Dashboard </span></a></li>
        <li><a href="{{ route("manage_jurusan") }}"><i class="fa fa-building"></i> <span>Setting Jurusan</span></a></li>
        <li><a href="{{ route("tahunajaran") }}"><i class="fa fa-clock-o"></i> <span>Setting Tahun Ajaran</span></a></li>
        <li><a href="{{ route("setKelas") }}"><i class="fa fa-hourglass-half"></i> <span>Setting Kelas</span></a></li>
        @else
        <li><a href="{{ route("dashboard") }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ route("dataKelompok") }}"><i class="fa fa-users"></i> <span>Data Kelompok & Kelas</span></a></li>
        <li><a href="{{ route("dataProposal") }}"><i class="fa fa-file"></i> <span>Proposal Masuk</span></a></li>
        <li><a href="{{ route("createPengumuman") }}"><i class="fa fa-bullhorn"></i> <span>Buat Pengumuman</span></a></li>
        @endif
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