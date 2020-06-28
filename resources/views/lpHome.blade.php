@extends('layouts.landing')

@section('content')
<section class="banner-area relative" id="home" data-parallax="scroll" data-image-src="{{asset("blog/img/itens")}}.jpg">
    <div class="overlay-bg overlay"></div>
    <div class="container">
      <div class="row ">
        <div class="banner-content d-flex align-items-center col-lg-12 col-md-12" style="margin: 16% auto 9% auto !important; ">
          <h1>
            Sistem Manajemen<br>
            Hari Kewirausahaan Itenas.								
          </h1>
      
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
  <section class="category-area section-gap" id="news">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-70 col-lg-8">
          <div class="title text-center">
            <h1 class="mb-10">Pengumuman Terbaru Kewirausahaan Itenas</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
          </div>
        </div>
      </div>						
      <div class="active-cat-carusel">
        <div class="item single-cat">
          <img src="{{asset("blog/img/c1.jpg")}}" alt="">
          <p class="date">10 Jan 2018</p>
        <h4><a href="{{url("/news")}}">Pengumpulan Revisi Proposal #3</a></h4>
        </div>
        <div class="item single-cat">
          <img src="{{asset("blog/img/c2.jpg")}}" alt="">
          <p class="date">10 Jan 2018</p>
          <h4><a href="{{url("/news")}}">Pengumpulan Revisi Proposal #2</a></h4>
        </div>
        <div class="item single-cat">
          <img src="{{asset("blog/img/c3.jpg")}}" alt="">
          <p class="date">10 Jan 2018</p>
          <h4><a href="{{url("/news")}}">Jadwal Kuliah Tamu</a></h4>
        </div>							
      </div>												
    </div>	
  </section>
  <!-- End category Area -->
  
  <!-- Start travel Area -->
  <section class="travel-area section-gap" id="travel">
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
          <div class="single-travel media pb-70">
            <img class="img-fluid d-flex  mr-3" src="{{asset("blog/img/t1.jpg")}}" alt="">
            <div class="dates">
              <span>20</span>
              <p>Dec</p>
            </div>
            <div class="media-body align-self-center">
              <h4 class="mt-0"><a href="#">Aplikasi Penunjuk Arah Pendaki</a></h4>
              <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
            <div class="meta-bottom d-flex justify-content-between">
              
            </div>							 
            </div>
          </div>
          <div class="single-travel media">
            <img class="img-fluid d-flex  mr-3" src="{{asset("blog/img/t3.jpg")}}" alt="">
            <div class="dates">
              <span>20</span>
              <p>Dec</p>
            </div>							  
            <div class="media-body align-self-center">
              <h4 class="mt-0"><a href="#">Aplikasi Pengukur Suhu</a></h4>
              <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
            <div class="meta-bottom d-flex justify-content-between">
              
            </div>							 
            </div>
          </div>														
        </div>
        <div class="col-lg-6 travel-right">
          <div class="single-travel media pb-70">
            <img class="img-fluid d-flex  mr-3" src="{{asset("blog/img/t2.jpg")}}" alt="">
            <div class="dates">
              <span>20</span>
              <p>Dec</p>
            </div>							  
            <div class="media-body align-self-center">
              <h4 class="mt-0"><a href="#">Aplikasi Image Enhancer</a></h4>
              <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
            <div class="meta-bottom d-flex justify-content-between">
              
            </div>							 
            </div>
          </div>
          <div class="single-travel media">
            <img class="img-fluid d-flex  mr-3" src="{{asset("blog/img/t4.jpg")}}" alt="">
            <div class="dates">
              <span>20</span>
              <p>Dec</p>
            </div>							  
            <div class="media-body align-self-center">
              <h4 class="mt-0"><a href="#">Aplikasi Menghitung Budget Traveling</a></h4>
              <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
            <div class="meta-bottom d-flex justify-content-between">
              
            </div>							 
            </div>
          </div>								
        </div>
        <a href="#" class="primary-btn load-more pbtn-2 text-uppercase mx-auto mt-60">Load More </a>		
      </div>
    </div>					
  </section>
  <!-- End travel Area -->
  
  <!-- Start fashion Area -->
  
  <!-- End fashion Area -->
  
  <!-- Start team Area -->
  <section class="team-area section-gap" id="team">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-70 col-lg-8">
          <div class="title text-center">
            <h1 class="mb-10">Tentang Team Dosen</h1>
            <p>Who are in extremely love with eco friendly system.</p>
          </div>
        </div>
      </div>						
      <div class="row justify-content-center d-flex align-items-center">
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
            <div class="single-team">
                <div class="thumb">
                    <img class="img-fluid" src="{{asset("blog/img/team1.jpg")}}" alt="">
                    <div class="align-items-center justify-content-center d-flex">
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                  <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="meta-text mt-30 text-center">
                  <h4>Dora Walker</h4>
                  <p>Dosen Kewirausahaan</p>									    	
                </div>
            </div>
            <div class="single-team">
                <div class="thumb">
                    <img class="img-fluid" src="{{asset("blog/img/team2.jpg")}}" alt="">
                    <div class="align-items-center justify-content-center d-flex">
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                  <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="meta-text mt-30 text-center">
                  <h4>Lena Keller</h4>
                  <p>Dosen Kewirausahaanr</p>			    	
                </div>
            </div>													
          </div>
        </div>
      </div>
    </div>	
  </section>
@endsection