<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/fav.png">
  <!-- Author Meta -->
  <meta name="author" content="colorlib">
  <!-- Meta Description -->
  <meta name="description" content="">
  <!-- Meta Keyword -->
  <meta name="keywords" content="">
  <!-- meta character set -->
  <meta charset="UTF-8">
  <!-- Site Title -->
  <title>Itenas</title>

  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="{{asset("blog/css/linearicons.css")}}">
    <link rel="stylesheet" href="{{asset("blog/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("blog/css/bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset("blog/css/owl.carousel.css")}}">
    <link rel="stylesheet" href="{{asset("blog/css/main.css")}}">
  </head>
  <body>

    <!-- Start Header Area -->
    <header class="default-header">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url("/") }}">
              <img src="{{asset("images/logoz.png")}}" alt="" style="width:34px;"> Kewirausahaan
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
              <ul class="navbar-nav">
              <li><a href="{{ url("/") }}">Home</a></li>
              <li><a href="#news">Pengumuman</a></li>
              
              <li><a href="#team">Tim Dosen</a></li>
              <li><a href="{{ url("/proposal") }}">Proposal</a></li>
              @if(!Auth::check())
              <li><a href="{{ url("login") }}">Log In</a></li>
              @endif
              <!-- Dropdown -->
                {{-- <li class="dropdown">
                  <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Pages
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="single.html">Single</a>
                    <a class="dropdown-item" href="category.html">Category</a>
                    <a class="dropdown-item" href="search.html">Search</a>
                    <a class="dropdown-item" href="archive.html">Archive</a>
                    <a class="dropdown-item" href="generic.html">Generic</a>
                    <a class="dropdown-item" href="elements.html">Elements</a>
                  </div>
                </li>								 --}}
              </ul>
            </div>						
        </div>
      </nav>
    </header>
    <!-- End Header Area -->

    <!-- start banner Area -->
    @yield("content")
    <!-- End team Area -->
    
    <!-- start footer Area -->		
    <footer class="footer-area section-gap">
      <div class="container">
        <div class="row">
          <div class="col-lg-3  col-md-12">
            
          </div>
          <div class="col-lg-6  col-md-12">
           
          </div>
          <div class="col-lg-3  col-md-12">
           
          </div>						
        </div>

        <div class="row footer-bottom d-flex justify-content-between">
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          <p class="col-lg-8 col-sm-12 footer-text">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          <div class="col-lg-4 col-sm-12 footer-social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-dribbble"></i></a>
            <a href="#"><i class="fa fa-behance"></i></a>
          </div>
        </div>
      </div>
    </footer>
    <!-- End footer Area -->		

    <script src="{{asset("blog/js/vendor/jquery-2.2.4.min.js")}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="{{asset("blog/js/vendor/bootstrap.min.js")}}"></script>
    <script src="{{asset("blog/js/jquery.ajaxchimp.min.js")}}"></script>
    <script src="{{asset("blog/js/parallax.min.js")}}"></script>			
    <script src="{{asset("blog/js/owl.carousel.min.js")}}"></script>		
    <script src="{{ asset("dist/js/vue.js") }}"></script>
    <script src="{{asset("blog/js/jquery.magnific-popup.min.js")}}"></script>				
    <script src="{{asset("blog/js/jquery.sticky.js")}}"></script>
    <script src="{{asset("blog/js/main.js")}}"></script>	
    @yield("script")
  </body>
</html>