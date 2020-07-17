@extends('layouts.home')

@section("content-header")
<section class="content-header">
    <h1>
      Dashboard
      <small>Optional description</small>
    </h1>
  </section>

  <section class="content">

    <!-- Default box -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Dosen KWU</span>
          <span class="info-box-number">12<small></small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Jumlah Kelompok<br> Terdaftar</span>
          <span class="info-box-number">90<small></small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-pencil"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Proposal Masuk</span>
          <span class="info-box-number">30<small></small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-check-square-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Jumlah Mahasiswa</span>
          <span class="info-box-number">30<small></small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    
    <!-- /.box -->

  </section>
  <!-- /.content -->
@endsection