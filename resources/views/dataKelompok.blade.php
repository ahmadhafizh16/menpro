@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Data Kelompok
				<small></small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label>Pilih data kelas :</label>
										<select class="error form-control" v-model="idKelas">
											@foreach($kelas as $kel)
											<option value="{{ $kel->id }}">{{ $kel->jurusan->nama }} [{{ $kel->kelas }}]</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<h3>List Kelompok : </h3>
							<div v-if="tableLoading" class="fa-5x text-center">
									<i class="fa fa-spinner fa-spin"></i>
							</div>
						<table  v-if="!tableLoading" id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Kelompok</th>
									<th>Judul Proposal</th>
									<th>Dosen Pembimbing</th>
									<th>Nilai</th>
									<th>Stand</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
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
							<h4 class="modal-title">Tambah Jurusan</h4>
						</div>
						<div class="modal-body">
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" @click="saveHandler">Tambah</button>
						</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
					</div>

					<div class="modal fade in" id="modal-view">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span></button>
								<h4 class="modal-title">Detail Kelompok</h4>
							</div>
							<div class="modal-body">
								<table class="table " style="font-size:16px;">
									<tbody>
									<tr>
										<td><b>Nama Kelompok</b></td>
										<td>: @{{ keldt.nama_kel }}</td>
									</tr>
									<tr>
										<td><b>Anggota Kelompok</b></td>
										<td> 
											<div v-if="Boolean(keldt.anggota)">
												<p v-for="(item, index) in keldt.anggota" :key="item.nama">• [@{{ item.nomor }}] @{{ item.nama }}</p>
											 </div>
										</td>
									</tr>
									<tr>
										<td><b>Dosen Pembimbing</b></td>
										<td v-if="Boolean(keldt.dosen)">: [@{{ keldt.dosen.nomor }}] @{{ keldt.dosen.nama }}</td>
									</tr>
								
									<tr>
										<td><b>Judul</b></td>
										<td v-if="Boolean(keldt.proposal)">: @{{ keldt.proposal.judul }}</td>
										<td v-else>: </td>
									</tr>
									<tr>
										<td><b>Jenis</b></td>
										<td v-if="Boolean(keldt.proposal)">: @{{ keldt.proposal.jenis }}</td>
										<td v-else>: </td>
									</tr>
									<tr>
										<td><b>Bidang</b></td>
										<td v-if="Boolean(keldt.proposal)">: @{{ keldt.proposal.bidang }}</td>
										<td v-else>: </td>
									</tr>
									<tr>
										<td><b>Deskripsi</b></td>
										<td v-if="Boolean(keldt.proposal)" v-html='keldt.proposal.deskripsi'></td>
										<td v-else>: </td>
									</tr>
								
									<tr>
										<td><b>Banner</b></td>
										<td v-if="Boolean(keldt.proposal)" >
											<img v-if="keldt.proposal.banner != null" :src="'{{asset("/")}}'+keldt.proposal.banner" style="width:300px;">
											<span v-else>: Belum upload </span>
										</td>
										<td v-else>: </td>
									</tr>
									
								  </tbody>
								</table>
								<div v-if="Boolean(keldt.proposal)">
									<h4>File Proposal</h4>
									<table class="table table-bordered" style="font-size:16px;">
										<thead>
											<th>#</th>
											<th>File</th>
											<th>Judul</th>
											<th>Keterangan</th>
											<th>Tanggal</th>
										</thead>
										<tbody v-if="keldt.history.length != 0">
											<tr v-for="(item,index) in keldt.history">
												<td>@{{ index+1 }}</td>
												<td><a :href="'{{ asset("/") }}'+item.file_proposal" download="" class="btn btn-primary"><i class="fa fa-download"></i>  Download File </a></td>
												<td>@{{ item.judul_file }}</td>
												<td>@{{ item.keterangan }}</td>
												<td>@{{ item.upload_date }}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
						</div>
						<div class="modal fade in" id="modal-edit">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span></button>
									<h4 class="modal-title">Edit data</h4>
								</div>
								<div class="modal-body">
									<div :class="Boolean(errors.stand)? 'form-group has-error' : 'form-group'">
										<label for="exampleInputEmail1">Stand</label>
										<input type="text"  class="error form-control" id="exampleInputEmail1" v-model="stand" placeholder="Stand">
										<span v-if="Boolean(errors.stand)"class="help-block">
											<ul>
												<li v-for="(item,index) in errors.stand">@{{ item }}</li>
											</ul>
										</span>
									</div>

									<div :class="Boolean(errors.nilai)? 'form-group has-error' : 'form-group'">
										<label for="exampleInputEmail1">Nilai</label>
										<input type="text"  class="error form-control" id="exampleInputEmail1" v-model="nilai" placeholder="nilai">
										<span v-if="Boolean(errors.nilai)"class="help-block">
											<ul>
												<li v-for="(item,index) in errors.nilai">@{{ item }}</li>
											</ul>
										</span>
									</div>
		
									<div v-if="Boolean(errors.error)" class="alert alert-danger">
										<h4><i class="icon fa fa-danger"></i> Error !</h4>
										<ul>
											<li v-for="(item,index) in errors.error">@{{ item }}</li>
										</ul>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary" @click="editHandler">Simpan</button>
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
function reloadTable(id){
	app.reloadTable(id);
}

function viewDt(id){
	app.viewModal(id);
}

function editDt(id){
	app.editData(id);
}

var app = new Vue({
	el: '#app',
	data: {
		orderType : 0,
		dt : 0,
		keldt : {},
		dtTb : {},
		nilai : '',
		stand : '',
		errors: {},
		idKelas : '{{ $kelas->isEmpty() ? '' : $kelas[0]->id }}',
		modal1 : false,
		tableLoading : false
	},
	methods: {
		getDataById : function(id) {
			return this.dtTb.filter(dtTb => dtTb.id == id)[0]
		},
		editData : function(id) {
			let d = this.getDataById(id) 
			this.stand = d.stand
			this.nilai = d.nilai
			this.dtId = id
			this.errors = {}
			$("#modal-edit").modal("show");
		},
		editHandler : function() {
			axios.post('{{ url("editKelompok") }}',{
				id : this.dtId,
				nilai : this.nilai,
				stand : this.stand
			})
			.then(function (response) {
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
		viewModal : async function(id){
			await axios.get('{{ url("getKelDetail") }}/'+id)
			.then(function (response) {
				let { data } = response

				app.keldt = data.data
				console.log()
				$("#modal-view").modal("show");
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
			
			axios.post('asd',{
				orderId : this.orderId,
				domain : this.domain
			})
			.then(function (response) {
				console.log(response)
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
		reloadTable : async function (id) {
			swal({
				title: "Confirm Payment?",
				text: "",
				icon: "warning",
				buttons: true,
			})
			.then(async (confirmed) => {
				if (confirmed) {
					await $.ajax({
						url : "{{ url('user/deleteLicense') }}",
						method : "POST",
						dataType : "JSON",
						data : {"id" : id},
						success : function (data){
							// console.log(data)
						}

					})

					swal("License Deleted", {
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
						url : '{{ url("getTaughClass") }}/'+app.idKelas,
						type: "GET",
						dataType: "JSON",
						complete : function(d){
							app.dtTb = d.responseJSON.data
						}
				},
				columns: [
							{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
							{ data: 'nama_kel', name: 'nama_kel' },
							{ data: 'judul_prop', name: 'judul_prop' },
							{ data: 'dosen_name', name: 'dosen_name' },
							{ data: 'nilai', name: 'nilai' },
							{ data: 'stand', name: 'stand' },
							{ data: 'action', name: 'action' },
				]
				});
			});
		}
	},
	async mounted() {
		await this.createDataTable();
	},
	watch : {
		idKelas : async function(){
			this.dt.destroy();
			this.tableLoading = true
			await this.createDataTable();
			this.tableLoading = false
		}
	}
})
</script>
@endsection