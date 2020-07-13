@extends('layouts.landing')

@section('content')
<div class="post-wrapper pt-100">
        <!-- Start post Area -->
        <section class="post-area" >
            <div class="container" style="border: 1px solid #c9c9c9; background:white;padding-top:40px;border-radius:5px;box-shadow: 1px 1px 8px; margin-bottom:70px;">
                <div class="row justify-content-center">
                    <div class="col-lg-8" style="padding-bottom: 60px;">
                        <div class="single-page-post">
                            @if(!empty($pen->canvas))
                            <img class="img-fluid" src="{{asset("$pen->canvas")}}" onclick="window.open('{{ asset($pen->canvas) }}')" alt="Klik untuk lihat detail" style="width:60%;max-height:487px;margin-left:25%;border: 1px solid #c9c9c9;">
                            @else
                            <img class="img-fluid" src="{{asset("$pen->banner")}}" onclick="window.open('{{ asset($pen->banner) }}')" alt="Klik untuk lihat detail" style="width:60%;max-height:487px;margin-left:25%;border: 1px solid #c9c9c9;">
                            @endif
                            <div class="top-wrapper ">
                                <div class="row d-flex justify-content-between">
                                    <h2 class="col-lg-8 col-md-12 text-uppercase">
                                       Judul : {{ $pen->judul }}  @if(Auth::check() && Auth::user()->role != 4)
                                       <a  href="{{ url($pen->historyLatest()->first()->file_proposal) }}" download class="btn btn-info" style="color:#f9f9f9 !important;font-size:12px;"><i class="fa fa-download" style="color:#f9f9f9 !important"></i>  Download Proposal </a>
                                       @endif
                                    </h2>
                                    <div class="col-lg-4 col-md-12 right-side d-flex justify-content-end">
                                        <div class="desc">
                                            
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
                                
                                <h4>Nama Kelompok :</h4>
                                @foreach ($pen->kelompok->mhs()->get() as $kel)
                                • [{{ $kel->nomor }}] {{ $kel->nama }}<br>
                                 @endforeach
                                 <br>
                                 <h4>Jurusan : </h4>
                                 {{ $pen->kelompok->kelas->jurusan->nama }}
                                 <br><br>
                                 <h4>Jenis : </h4>
                                 {{ ucfirst($pen->jenis) }}
                                 
                                 
                                  @foreach ($data as $k => $v)
                                  <br><br>
                                  <h4>{{ $v }} : </h4>
                                  {!! $pen->{$k} !!}     
                                  @endforeach
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