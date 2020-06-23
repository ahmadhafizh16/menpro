@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Data Kelompok @if(!$isAda) <button class="btn btn-success" @click="modalOpen('add')"><i class="fa fa-plus"></i> Daftarkan Kelompok</button> @endif
				<small></small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="row">
			<div class="col-md-6">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Data Kelompok</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								@if($isAda)
								<table class="table " style="font-size:16px;">
									<tbody>
									<tr>
										<td><b>Nama Kelompok</b></td>
										<td>: {{ $kelompok->nama_kel }}</td>
									</tr>
									<tr>
										<td><b>Anggota Kelompok</b></td>
										<td>
										@foreach ($kelompok->mhs()->get() as $mhs)
											
										 • [{{ $mhs->nim }}] {{ $mhs->nama }}<br>
										
										@endforeach
									</td>
									</tr>
									<tr>
										<td><b>Dosen Pembimbing</b></td>
										<td>:[{{ $kelompok->dosen->nid }}] {{ $kelompok->dosen->nama }}</td>
									</tr>
									<tr>
										<td><b>Kelas</b></td>
										<td>: [IF20201A] Informatika A</td>
									</tr>
									
								  </tbody>
								</table>
								@else
								<h2 class="text-center"> Belum Daftar Kelompok</h2>
								@endif
							</div>
						</div>
						<div class="ajax-content">
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
					</div>
					<!-- /.box-footer-->
				</div>
			</div>

			<div class="col-md-6">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Data Proposal</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<table class="table " style="font-size:16px;">
									<tbody>
									<tr>
										<td><b>Judul</b></td>
										<td>: Aplikasi Parkir Berbasis Web</td>
									</tr>
									<tr>
										<td><b>Topik</b></td>
										<td>: Topik Proposal</td>
									</tr>
									<tr>
										<td><b>Bidang</b></td>
										<td>: Informatika</td>
									</tr>
									<tr>
										<td><b>Status Laporan Akhir</b></td>
										<td>: Belum Mengumpulkan</td>
									</tr>
									
								  </tbody>
								</table>
							</div>
						</div>
						<div class="ajax-content">
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
					</div>
					<!-- /.box-footer-->
				</div>
			</div>

		</div>
		
			<h2>
				Histori Upload Proposal & Banner
				<small></small>
			</h2>
		
		<ul class="timeline">

			<!-- timeline time label -->
			<li class="time-label">
				<span class="bg-red">
					10 Feb. 2020
				</span>
			</li>
			<!-- /.timeline-label -->
		
			<!-- timeline item -->
			<li>
				<!-- timeline icon -->
				<i class="fa fa-file bg-blue"></i>
				<div class="timeline-item">
					<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
		
					<h3 class="timeline-header"><a href="#">Upload Proposal Revisi 4</a></h3>
		
					<div class="timeline-body">
						Revisi SWOT Dan Neraca
					</div>
		
					
				</div>
			</li>

			<li class="time-label">
				<span class="bg-green">
					1 Feb. 2020
				</span>
			</li>
			<!-- /.timeline-label -->
		
			<!-- timeline item -->
			<li>
				<!-- timeline icon -->
				<i class="fa fa-file bg-blue"></i>
				<div class="timeline-item">
					<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
		
					<h3 class="timeline-header"><a href="#">Upload Proposal Revisi 3</a></h3>
		
					<div class="timeline-body">
						Revisi Tujuan Pasar dan Cash Flow
					</div>
		
					
				</div>
			</li>

			<li class="time-label">
				<span class="bg-blue">
					20 Jan. 2020
				</span>
			</li>
			<!-- /.timeline-label -->
		
			<!-- timeline item -->
			<li>
				<!-- timeline icon -->
				<i class="fa fa-file bg-blue"></i>
				<div class="timeline-item">
					<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
		
					<h3 class="timeline-header"><a href="#">Upload Proposal Revisi 2</a></h3>
		
					<div class="timeline-body">
						Revisi Latar Belakang
					</div>
		
					
				</div>
			</li>
			<!-- END timeline item -->
			<li>
				<i class="fa fa-clock-o bg-gray"></i>
			</li>
		
		</ul>
		<div class="modal fade in" id="modal-default">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Daftarkan Kelompok</h4>
					</div>
					<div class="modal-body">
						<div :class="Boolean(errors.nama_kel)? 'form-group has-error' : 'form-group'">
							<label for="">Nama Kelompok</label>
							<input type="text"  class="error form-control" v-model="nama_kel" placeholder="Nama Kelompok">
							<span v-if="Boolean(errors.nama_kel)"class="help-block">
								<ul>
									<li v-for="(item,index) in errors.nama_kel">@{{ item }}</li>
								</ul>
							</span>
						</div>
						<div class="form-group">
							<label for="">Anggota Kelompok</label><br>
							<select class="select2mhs form-control" onchange="app.kel = $('.select2mhs').val()" multiple="multiple" style="width:100% !important;">
								<option></option>
							</select>
							<span v-if="Boolean(errors.name)"class="help-block">
								<ul>
									<li v-for="(item,index) in errors.name">@{{ item }}</li>
								</ul>
							</span>
						</div>
						<div class="form-group">
							<label for="">Dosen Pembimbing</label>
							<select class="select2dosen form-control" onchange="app.dosen = $('.select2dosen').val()" style="width:100% !important;">
								<option></option>
							</select>
							<span v-if="Boolean(errors.name)"class="help-block">
								<ul>
									<li v-for="(item,index) in errors.name">@{{ item }}</li>
								</ul>
							</span>
						</div>
						<div class="form-group">
							<label for="">Kelas</label>
							<select class="select2kelas form-control" onchange="app.kelas = $('.select2kelas').val()" style="width:100% !important;">
								<option></option>
							</select>
							<span v-if="Boolean(errors.name)"class="help-block">
								<ul>
									<li v-for="(item,index) in errors.name">@{{ item }}</li>
								</ul>
							</span>
						</div>
	
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
					<button v-if="mdTr == 'add'" type="button" class="btn btn-primary" @click="saveHandler">Tambah</button>
					<button v-if="mdTr == 'edit'" type="button" class="btn btn-primary" @click="editHandler">Simpan</button>
				</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
			</div>
		</div>
		
		
	</section>
	<!-- /.content -->
@endsection

@section('script')

<script>
$(document).ready(function() {
    $('.select2s').select2({
		maximumSelectionLength : 3
	});
});	
function reloadTable(id){
	app.reloadTable(id);
}

var app = new Vue({
	el: '#app',
	data: {
		orderType : 0,
		dt : 0,
		dtTb : {},
		nama_kel : '',
		kel : [],
		dosen : '',
		kelas : '',
		errors: {},
		dtId : '',
		mdTr : '',
		modal1 : false,
		tableLoading : false
	},
	methods: {
		modalOpen : function(tr) {
			this.mdTr = tr
			if(tr == "add"){
				$('#modal-default').modal('show')
				this.nama_kel = ''
				this.kel = []
				this.dosen = ''
				this.kelas = ''
				this.errors = {}
			}
			else if(tr == 'edit'){
				$('#modal-default').modal('show')
				this.errors = {}
			}
		},
		editData : function(id) {
			let d = this.getDataById(id)
			$('.select2s').val(d.id_jurusan);
			$('.select2s').trigger('change');
			$('.select2dosen').val(d.id_dosen);
			$('.select2dosen').trigger('change');
			this.jurusan = d.id_jurusan
			this.nama_kel = ''
			this.dosen = d.id_dosen
			this.kelas = d.kelas
			this.dtId = d.id
			this.errors = {}
			this.modalOpen('edit')
		},
		getDataById : function(id) {
			return this.dtTb.filter(dtTb => dtTb.id == id)[0]
		},
		editHandler : function() {
			axios.post('{{ url("editKelas") }}',{
				id : this.dtId,
				nama_kel : this.nama_kel,
				kel : this.kel,
				kelas : this.kelas,
				dosen : this.dosen
			})
			.then(function (response) {
				// console.log(response)
				app.errors = {}
				window.location.reload()
			})
			.catch(function (error) {
				if(Boolean(error.response.data.errors)){
					app.errors = error.response.data.errors;
				}
				else{
					app.errors = error.response.data.data;
				}
			})
		},
		saveHandler : function (){
			
			axios.post('{{ url("addKelompok") }}',{
				nama_kel : this.nama_kel,
				kel : this.kel,
				kelas : this.kelas,
				dosen : this.dosen
			})
			.then(function (response) {
				// console.log(response)
				app.errors = {}
				window.location.reload()
			})
			.catch(function (error) {
				if(Boolean(error.response.data.errors)){
					app.errors = error.response.data.errors;
				}
				else{
					app.errors = error.response.data.data;
				}
				console.log(app.errors)
			})
		},
		deleteHandler : async function (id) {
			swal({
				title: "Akan Menghapus?",
				text: "",
				icon: "warning",
				buttons: true,
			})
			.then(async (confirmed) => {
				if (confirmed) {
					await $.ajax({
						url : "{{ url('deleteKelas') }}",
						method : "POST",
						dataType : "JSON",
						data : {"id" : id},
						success : function (data){
							// console.log(data)
						}

					})

					swal("Data Dihapus!", {
					icon: "success",
					});

					this.dt.destroy();
					this.tableLoading = true
					await this.createDataTable();
					this.tableLoading = false

				}
			}); 
			
		},
		getDataKelas : function(){
			axios.get('{{ url("getKelas") }}')
			.then(function (response) {
				$('.select2kelas').select2({
					placeholder: "Pilih Kelas",
					data : response.data.data
				});
			})
			.catch(function (error) {
				if(Boolean(error.response.data.errors)){
					app.errors = error.response.data.errors;
				}
				else{
					app.errors = error.response.data.data;
				}
			})
		},
		getDataDosen : function(){
			axios.get('{{ url("getDosen") }}')
			.then(function (response) {
				$('.select2dosen').select2({
					placeholder: "Pilih Dosen Pembimbing",
					data : response.data.data
				});
			})
			.catch(function (error) {
				if(Boolean(error.response.data.errors)){
					app.errors = error.response.data.errors;
				}
				else{
					app.errors = error.response.data.data;
				}
			})
		},
		getDataMhs : function(){
			axios.get('{{ url("getMhs") }}')
			.then(function (response) {
				$('.select2mhs').select2({
					placeholder: "Pilih Anggota",
					data : response.data.data,
					maximumSelectionLength: 3
				});
			})
			.catch(function (error) {
				if(Boolean(error.response.data.errors)){
					app.errors = error.response.data.errors;
				}
				else{
					app.errors = error.response.data.data;
				}
			})
		}
	},
	async mounted() {
		await this.getDataKelas();
		await this.getDataDosen();
		await this.getDataMhs();
		// await this.createDataTable();
	},
	watch : {
		orderType : async function(){
			this.dt.destroy();
			this.tableLoading = true
			await this.createDataTable();
			this.tableLoading = false
		}
	}
})
</script>
@endsection