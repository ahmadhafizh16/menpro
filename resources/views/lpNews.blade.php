@extends('layouts.landing')

@section('content')
<div class="post-wrapper pt-100">
        <!-- Start post Area -->
        <section class="post-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8" style="padding-bottom: 60px;">
                        <div class="single-page-post">
                            <img class="img-fluid" src="{{asset("$pen->thumbnail")}}" alt="" style="width:740px;height:487px;">
                            <div class="top-wrapper ">
                                <div class="row d-flex justify-content-between">
                                    <h2 class="col-lg-8 col-md-12 text-uppercase">
                                        {{ $pen->judul }}
                                    </h2>
                                    <div class="col-lg-4 col-md-12 right-side d-flex justify-content-end">
                                        <div class="desc">
                                           <h2>{{ $pen->dosen->nama }}</h2>
                                            <h3>{{ $pen->upload_date }}</h3>
                                        </div>
                                        <div class="user-img">
                                            <img src="img/user.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="tags">
                                <ul>
                                    <li><a href="#">Lifestyle</a></li>
                                    
                                    <li><a href="#">Technology</a></li>
                                    </ul>
                            </div> --}}
                            <div class="single-post-content">
                               {!! $pen->isi !!}
                            </div>
                            
                            <!-- End nav Area -->
                            
                            <!-- Start comment-sec Area -->
                            
                            <!-- End comment-sec Area -->
                            
                         
                            <!-- End commentform Area -->
                            
                        </div>
                    </div>
                    {{-- <div class="col-lg-4 sidebar-area ">
                        <div class="single_widget search_widget">
                            <div id="imaginary_container"> 
                                <div class="input-group stylish-input-group">
                                    <input type="text" class="form-control"  placeholder="Search" >
                                    <span class="input-group-addon">
                                        <button type="submit">
                                            <span class="lnr lnr-magnifier"></span>
                                        </button>  
                                    </span>
                                </div>
                            </div> 
                        </div>

                      
                        <div class="single_widget cat_widget">
                            <h4 class="text-uppercase pb-20">post categories</h4>
                            <ul>
                                <li>
                                    <a href="#">Technology <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Lifestyle <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Fashion <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Art <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Food <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Architecture <span>37</span></a>
                                </li>
                                <li>
                                    <a href="#">Adventure <span>37</span></a>
                                </li>                                
                            </ul>
                        </div>

                       


                        
                        <div class="single_widget tag_widget">
                            <h4 class="text-uppercase pb-20">Tag Clouds</h4>
                            <ul>
                                <li><a href="#">Lifestyle</a></li>
                                <li><a href="#">Art</a></li>
                                <li><a href="#">Adventure</a></li>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Technology</a></li>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Adventure</a></li>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Technology</a></li>
                            </ul>
                        </div>                                                 
                    </div> --}}
                </div>
            </div>    
        </section>
        <!-- End post Area -->  
    </div>
@endsection