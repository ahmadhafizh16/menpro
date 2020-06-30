@extends('layouts.landing')

@section('content')
<section class="banner-area relative" id="home" data-parallax="scroll" data-image-src="{{asset("blog/img/itens")}}.jpg" style="height:300px;">
    <div class="overlay-bg overlay"></div>
    <div class="container" id>
      <div class="row ">
        <div class="banner-content d-flex align-items-center col-lg-12 col-md-12" style="margin: 8% auto 9% auto !important; ">
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
  

  <section class="team-area section-gap" id="team" style="padding-top:40px !important;">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="menu-content pb-30 col-lg-8">
          <div class="title text-center">
            <h1 class="mb-10">Proposal Kewirausahaan</h1>
            <p></p>
          </div>
        </div>
      </div>						
        <div class="col-lg-12">
          
          <div class="row" id="app">
              {{-- <div class="col-md-3" style="">
               
                <div class="form-group">
                  <label>Filter Jurusan</label>
                  <select class="form-control"></select>
                </div><!-- - /input-group -->
                
              </div> --}}

              <div class="col-md-3" style="">
                
                  <div class="form-group">
                    <label>Filter Jenis</label>
                    <select class="error form-control" v-model="jenis" placeholder="Jenis">
                      <option value="0">Semua</option>
                      <option value="jasa">Jasa</option>
                      <option value="produk">Produk</option>
                    </select>
                  </div><!-- /input-group -->
                
              </div>

              <div class="col-md-4" style="">
                
                <div class="form-group">
                  <label>Filter Bidang</label>
                  <select class="error form-control" v-model="bidang" placeholder="Bidang">
                    <option value="0">Semua</option>
                    <option value="informatika">Informatika</option>
                    <option value="life style">Life style</option>
                    <option value="elektronika">Elektronika</option>
                    <option value="kuliner">Kuliner</option>
                    <option value="agrobisnis">Agrobisnis</option>
                  </select>
                </div><!-- /input-group -->
                
              </div>

              <div class="col-md-5" style="padding-top:30px;">
                
                  <div class="input-group">
                    <input type="text" class="form-control" v-model="search" placeholder="Cari judul proposal">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button" @click="reloc()" style="border:1px solid #ccc;cursor :pointer;"><i class="fa fa-search"></i></button>
                    </span>
                  </div><!-- /input-group -->
                
              </div>
          </div>
          <div class="row" style="padding-top:50px;">
         
              
                @foreach ($prop2 as $p2)
                <div class="col-md-12" style="color:#222;margin-bottom:30px;">
                  <img class="" src="{{asset("$p2->banner")}}" alt="" style="width:200px;height:300px; float:left;margin-right:20px;">
                  <div class="dates" style="position: absolute;top:0 ; left :15px;background:#111;color:#f9f9f9;padding:5px 15px;text-align:center;font-size:16px;">
                    <span>{{ explode(" ",$p2->historyLatest()->first()->upl_date)[0] }}</span>
                    <br><span>{{ explode(" ",$p2->historyLatest()->first()->upl_date)[1] }}</span>
                  </div>
                  <div class="media-body">
                    <h4 class="mt-0" style="margin-bottom: 20px;"><a href="#">{{ $p2->judul }}</a></h4>
                    <p>
                      <a class="btn btn-info" style="color:white;padding : 2px 10px !important;">{{ ucfirst($p2->jenis) }}</a>
                      <a class="btn btn-success" style="color:white;padding : 2px 10px !important;">{{ ucfirst($p2->bidang) }}</a>
                    </p>
                    <table style="float:right;width:79%">
                      <tr>
                        <td width=210><b> Kelompok:</b><br>  {{ $p2->kelompok->nama_kel }}</td>
                        <td width=210><b> Jurusan:</b><br> {{ $p2->kelompok->kelas->jurusan->nama }}</td>
                        <td><b> Anggota:</b><br>
                          @foreach ($p2->kelompok->mhs()->get() as $kel)
                            {{ $kel->nama }},
                          @endforeach
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3">
                          <b> <br>Deskripsi:</b><br>
                          {!! $p2->deskripsi !!}
                        <br>
                        @if(Auth::check() && Auth::user()->role != 4)
                        <a  href="{{ url($p2->historyLatest()->first()->file_proposal) }}" download class="btn btn-primary" ><i class="fa fa-download" style="color:#f9f9f9"></i>  Download Proposal </a>
                        @endif
                      </tr>
                    </table>
                 
                    <div class="meta-bottom d-flex justify-content-between">
                      
                    </div>							 
                  </div>
                
                </div>
                @endforeach
                
          </div>
          <div class="row">
            <div class="col-md-4" style="margin: 0 auto;">
              
              {{ $prop2->links() }}
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>	
  </section>
@endsection

@section("script")
  <script>
    var app = new Vue({
            el: '#app',
            data: {
              jenis : '{{ $jenis }}',
              bidang : '{{ $bidang }}',
              search : '{{ (!is_null($search))? "$search" : ""}}',
            },
            methods: {
              reloc : function(){
                  console.log("{{ url('proposal') }}/0/"+this.jenis+"/"+this.bidang+"/"+this.search)
                  window.location = "{{ url('proposal') }}/0/"+this.jenis+"/"+this.bidang+"/"+this.search+""
              }
            },
            watch: {
                jenis : function(){
                    this.reloc();
                },
                bidang : function(){
                    this.reloc();
                }
            },
            
  })
  </script>
@endsection