@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Upload Proposal
				<small></small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						@if(empty($kelompok->id_proposal))
						<button class="btn btn-success" @click="modalOpen('add')"><i class="fa fa-plus"></i> Upload Data Proposal</button>
						@else
						<button class="btn btn-info" @click="editData({{ $kelompok->id_proposal }})"><i class="fa fa-plus"></i> Edit Data Proposal</button>
						@endif
							<h3>  </h3>
							<div v-if="tableLoading" class="fa-5x text-center">
									<i class="fa fa-spinner fa-spin"></i>
							</div>
							<div class="row">
								<div class="col-md-12">
									@if(empty($kelompok->id_proposal))
									<h2 class="text-center"> Belum input data proposal</h2>
									</hr>
									@else
									<table class="table " style="font-size:16px;width:50%">
										<tbody>
										<tr>
											<td><b>Judul</b></td>
											<td>: {{ $kelompok->proposal->judul }}</td>
										</tr>
										<tr>
											<td><b>Topik</b></td>
											<td>: {{ $kelompok->proposal->topik }}</td>
										</tr>
										<tr>
											<td><b>Bidang</b></td>
											<td>: {{ $kelompok->proposal->bidang }}</td>
										</tr>				
									  </tbody>
									@endif
									</table>
								</div>
							</div>
							<button class="btn btn-success" @click=";$('#modal-default').modal('show')"><i class="fa fa-plus"></i> Upload File & Revisi Proposal</button>

							<div class="row">
								<div class="col-md-12"><br>
									<table class="table table-bordered table-hover" style="font-size:16px;">
										<tbody>
										<tr>
											<th>#</td>
											<th>Link File</th>
											<th>Judul</th>
											<th>Keterangan</th>
											<th>Tanggal</th>
											<th>Aksi</th>
										</tr>
										<tr>
											<td>1</td>
											<td><a class="btn btn-primary"><i class="fa fa-download"></i>  Download File </a></td>
											<td> Proposal Tahap Awal </td>
											<td> Proposal Tahap Awal </td>
											<td> 20 Februari 2020 </td>
											<td> <button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button> </td>
										</tr>
										<tr>
											<td>2</td>
											<td><a class="btn btn-primary"><i class="fa fa-download"></i>  Download File </a></td>
											<td> Proposal Revisi 1 </td>
											<td> Perbaikan  Latar Belakang</td>
											<td> 22 Februari 2020 </td>
											<td> <button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button> </td>
										</tr>
										<tr>
											<td>3</td>
											<td><a class="btn btn-primary"><i class="fa fa-download"></i>  Download File </a></td>
											<td> Proposal Revisi 2 </td>
											<td> Perbaikan SWOT Analisis </td>
											<td> 25 Februari 2020 </td>
											<td> <button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button> </td>
										</tr>
														
									  </tbody>
									</table>
								</div>
							</div>
					</div>
				</div>
				<div class="ajax-content">
				</div>
				<div class="modal fade in" id="modal-default">
					<div class="modal-dialog">
						<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span></button>
							<h4 class="modal-title">Upload Data Proposal</h4>
						</div>
						<div class="modal-body">
							<div :class="Boolean(errors.judul)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Judul</label>
								<input type="text"  class="error form-control" id="exampleInputEmail1" v-model="judul" placeholder="Judul">
								<span v-if="Boolean(errors.judul)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.judul">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.topik)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Topik</label>
								<input type="text"  class="error form-control" id="exampleInputEmail1" v-model="topik" placeholder="Topik">
								<span v-if="Boolean(errors.topik)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.topik">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.bidang)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Bidang</label>
								<input type="text"  class="error form-control" id="exampleInputEmail1" v-model="bidang" placeholder="Bidang">
								<span v-if="Boolean(errors.bidang)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.bidang">@{{ item }}</li>
									</ul>
								</span>
							</div>

							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button v-if="mdTr == 'add'" type="button" class="btn btn-primary" @click="saveHandler">Tambah</button>
							<button v-if="mdTr == 'edit'" type="button" class="btn btn-primary" @click="editHandler">Simpan</button>
						</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
					</div>
			</div>
			
			<!-- /.box-body -->
			<div class="box-footer">
				Footer
			</div>
			<!-- /.box-footer-->
		</div>
		<!-- /.box -->
		
	</section>
</div>
	<!-- /.content -->
@endsection

@section('script')

<script>

function deleteDt(id){
	app.deleteHandler(id);
}

function editDt(id){
	app.editData(id);
}


	  
var app = new Vue({
	el: '#app',
	data: {
		orderType : 0,
		dt : 0,
		dtTb : {},
		judul : '',
		topik : '',
		bidang : '',
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
				this.judul = ''
				this.topik = ''
				this.bidang = ''
				this.errors = {}
			}
			else if(tr == 'edit'){
				$('#modal-default').modal('show')
				this.errors = {}
			}
		},
		editData : function(id) {
			this.judul = '{{ $kelompok->proposal->judul }}'
			this.topik = '{{ $kelompok->proposal->topik }}'
			this.bidang = '{{ $kelompok->proposal->bidang }}'
			this.dtId = id
			this.errors = {}
			this.modalOpen('edit')
		},
		getDataById : function(id) {
			return this.dtTb.filter(dtTb => dtTb.id == id)[0]
		},
		editHandler : function() {
			axios.post('{{ url("editProposal") }}',{
				id : this.dtId,
				judul : this.judul,
				topik : this.topik,
				bidang : this.bidang,	
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
			
			axios.post('{{ url("addProposal") }}',{
				judul : this.judul,
				topik : this.topik,
				bidang : this.bidang,		
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
		createDataTable : function(){
			$(document).ready(function(){
				app.dt = $('#example1').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
						url : '{{ url("kelasData") }}',
						type: "GET",
						dataType: "JSON",
						complete : function(d){
							app.dtTb = d.responseJSON.data
							// console.log()
						}
				},
				columns: [
							{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
							{ data: 'tahunAj', name: 'tahunAj' },
							{ data: 'dosen_name', name: 'dosen_name' },
							{ data: 'jurusan_name', name: 'jurusan_name' },
							{ data: 'kelas', name: 'kelas' },
							{ data: 'action', name: 'action' },
				]
				});
			});
		},
		getDataJurusan : function(){
			axios.get('{{ url("getJurusanActive") }}')
			.then(function (response) {
				console.log(response.data)
				$('.select2s').select2({
					placeholder: "Pilih Jurusan",
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
				console.log(response.data)
				$('.select2dosen').select2({
					placeholder: "Pilih Dosen Pengajar",
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
		}
	},
	async mounted() {
	
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