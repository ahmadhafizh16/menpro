@extends('layouts.landing')

@section('content')
<section class="banner-area relative" id="home" data-parallax="scroll" data-image-src="{{asset("blog/img/itens")}}.jpg" style="height:200px;">
    <div class="overlay-bg overlay"></div>
    <div class="container">
      <div class="row ">
        <div class="banner-content d-flex align-items-center col-lg-12 col-md-12" style="margin: 4% auto 11% auto !important; ">
          <h2 style="color:#f9f9f9;margin-top:3%;">
            Sistem Manajemen<br>
            Hari Kewirausahaan Itenas.								
          </h2>
      
        </div>	
        <div class="head-bottom-meta d-flex justify-content-between align-items-end col-lg-12">
          <div class="col-lg-6 flex-row d-flex meta-left no-padding">
            
          </div>
          <div class="col-lg-6 flex-row d-flex meta-right no-padding justify-content-end">
           
          </div>
        </div>												
      </div>
    </div>
  </section>
  <!-- End banner Area -->	


  <!-- Start category Area -->
  <section class="category-area section-gap" id="news" style="padding-top :50px;">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-30 col-lg-8">
          <div class="title text-center">
            <h2 class="">Pengumuman Terbaru Kewirausahaan Itenas</h2>
          </div>
        </div>
      </div>						
      <div class="active-cat-carusel">
        @foreach ($peng as $p)
        <div class="item single-cat">
          <img src="{{asset("$p->thumbnail")}}" alt="" style="width:340px;height:226px;">
          <p class="date">{{ $p->upl_date }}</p>
          <h4><a href="{{url("/news/".$p->id)}}">{{ $p->judul }}</a></h4>
        </div>
        @endforeach
      							
      </div>												
    </div>	
  </section>
  <!-- End category Area -->
  
  <!-- Start travel Area -->
  {{-- <section class="travel-area section-gap" id="travel">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-70 col-lg-8">
          <div class="title text-center">
            <h1 class="mb-10">Proposal Paling Baru</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
          </div>
        </div>
      </div>						
      <div class="row">
        <div class="col-lg-6 travel-left">
          @foreach ($prop1 as $p1)
          <div class="single-travel media pb-70">
            <img class="img-fluid d-flex  mr-3" src="{{asset("$p1->banner")}}" alt="" style="width:200px;height:300px;">
            <div class="dates">
              <span>{{ explode(" ",$p1->historyLatest()->first()->upl_date)[0] }}</span>
              <p>{{ explode(" ",$p1->historyLatest()->first()->upl_date)[1] }}</p>
            </div>
            <div class="media-body">
              <h4 class="mt-0"><a href="#">{{ $p1->judul }}</a></h4>
              <p>
                <a class="btn btn-info" style="color:white;padding : 2px 10px !important;">{{ ucfirst($p1->jenis) }}</a>
                <a class="btn btn-success" style="color:white;padding : 2px 10px !important;">{{ ucfirst($p1->bidang) }}</a>
              </p>
              <p>Nama Kelompok : {{ $p1->kelompok->nama_kel }}</p>
              <p>Nama Jurusan : {{ $p1->kelompok->kelas->jurusan->nama }}</p>
              <p>Nama Anggota :</p>
              @foreach ($p1->kelompok->mhs()->get() as $kel)
                  <p>- [{{ $kel->nomor }}] {{ $kel->nama }}</p>
              @endforeach
              <div class="meta-bottom d-flex justify-content-between">
                
              </div>							 
            </div>
          </div>
          @endforeach
         						
        </div>
        <div class="col-lg-6 travel-right">
          @foreach ($prop2 as $p2)
          <div class="single-travel media pb-70">
            <img class="img-fluid d-flex  mr-3" src="{{asset("$p2->banner")}}" alt="" style="width:200px;height:300px;">
            <div class="dates">
              <span>{{ explode(" ",$p2->historyLatest()->first()->upl_date)[0] }}</span>
              <p>{{ explode(" ",$p2->historyLatest()->first()->upl_date)[1] }}</p>
            </div>
            <div class="media-body">
              <h4 class="mt-0"><a href="#">{{ $p2->judul }}</a></h4>
              <p>
                <a class="btn btn-info" style="color:white;padding : 2px 10px !important;">{{ ucfirst($p2->jenis) }}</a>
                <a class="btn btn-success" style="color:white;padding : 2px 10px !important;">{{ ucfirst($p2->bidang) }}</a>
              </p>
              <p>Nama Kelompok : {{ $p2->kelompok->nama_kel }}</p>
              <p>Nama Jurusan : {{ $p2->kelompok->kelas->jurusan->nama }}</p>
              <p>Nama Anggota :</p>
              @foreach ($p2->kelompok->mhs()->get() as $kel)
                  <p>- [{{ $kel->nomor }}] {{ $kel->nama }}</p>
              @endforeach
              <div class="meta-bottom d-flex justify-content-between">
                
              </div>							 
            </div>
          </div>
          @endforeach
          				
        </div>
        <a href="#" class="primary-btn load-more pbtn-2 text-uppercase mx-auto mt-60">Load More </a>		
      </div>
    </div>					
  </section> --}}
  <!-- End travel Area -->
  
  <!-- Start fashion Area -->
  
  <!-- End fashion Area -->
  
  <!-- Start team Area -->

  <section class="team-area section-gap" id="team">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-70 col-lg-8">
          <div class="title text-center">
            <h1 class="mb-10">Team Koordinator Kewirausahaan</h1>
            <p></p>
          </div>
        </div>
      </div>
      <div class="row align-item-center d-flex justify-content-center">
      <div class="col-lg-6 team-left">	
        <p>	
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.	
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>	
        <p>	
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.	
        </p>	
      </div>
        <div class="col-lg-6 team-right d-flex justify-content-center">
          <div class="row active-team-carusel">
            <div class="single-cat">
                <div class="thumb">
                    <img class="img-fluid" src="{{asset("blog/img/koor1.jpg")}}" alt="">
                    <div class="align-items-center justify-content-center d-flex">
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                  <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="meta-text mt-30 text-center">
                  <h4>Agung Pecunk</h4>
                  									    	
                </div>
            </div>

            <div class="single-cat">
              <div class="thumb">
                  <img class="img-fluid" src="{{asset("blog/img/koor2.jpg")}}" alt=""  style="width: 240px;height:240px;">
                  <div class="align-items-center justify-content-center d-flex">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div>
              </div>
              <div class="meta-text mt-30 text-center">
                <h4>Andry Masry</h4>
                									    	
              </div>
          </div>

          <div class="single-cat">
            <div class="thumb">
                <img class="img-fluid" src="{{asset("blog/img/koor3.jpg")}}" alt="" style="width: 240px;height:240px;">
                <div class="align-items-center justify-content-center d-flex">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>
            <div class="meta-text mt-30 text-center">
              <h4>Dewi Rosmala</h4>
              									    	
            </div>
          </div>
            
            <div class="single-cat">
              <div class="thumb">
                  <img class="img-fluid" src="{{asset("blog/img/koor4.jpg")}}" alt="">
                  <div class="align-items-center justify-content-center d-flex">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                  </div>
              </div>
              <div class="meta-text mt-30 text-center">
                <h4>Syalaf Udin</h4>
                									    	
              </div>
          </div>		
          </div>
          </div>
        </div>
      </div>
    </div>	
  </section>
@endsection