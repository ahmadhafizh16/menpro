@extends('layouts.home')

@section("content-header")
<style>
  .highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    margin: 1em auto;
}

#containerz {
    height: 600px;
    width : 100%;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>
<section class="content-header">
    <h1>
      Dashboard
      <small>Optional description</small>
    </h1>
  </section>

  <section class="content" style="min-height: 150px !important;">

    <!-- Default box -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Dosen KWU</span>
          <span class="info-box-number">{{ $dosen }}<small></small></span>
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
          <span class="info-box-number">{{ $kelompok }}<small></small></span>
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
          <span class="info-box-number">{{ $prop }}<small></small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-check-square-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Kelas Aktif</span>
          <span class="info-box-number">{{ $kelas }}<small></small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

   

    
    <!-- /.box -->

  </section>
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <figure class="highcharts-figure">
              <div id="containerz"></div>
            </figure>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
@endsection

@section("script")
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
Highcharts.chart('containerz', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Jumlah Proposal Upload Per jurusan'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [{!! $cat !!}],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Rainfall (mm)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} Proposal</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                crop: false,
                overflow: 'none'
            } 
        }
    },
    series: [{
        name: 'Total Proposal Masuk',
        data: [{{ $val }}]
    },
    @foreach($dB as $kk => $vv)
    {
        name : '{{ $kk }}',
        data : [{{ implode(",",$vv) }}]
    },
    @endforeach
    ]
});
</script>
@endsection