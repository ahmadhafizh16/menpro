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
						<button class="btn btn-success" @click=";$('#modal-default').modal('show')"><i class="fa fa-plus"></i> Upload Data Proposal</button>
							<h3>  </h3>
							<div v-if="tableLoading" class="fa-5x text-center">
									<i class="fa fa-spinner fa-spin"></i>
							</div>
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
									  </tbody>
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
							<div :class="Boolean(errors.domain)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Judul</label>
								<input type="text"  class="error form-control" id="exampleInputEmail1" v-model="domain" placeholder="Judul">
								<span v-if="Boolean(errors.domain)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.domain">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.domain)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail2">Topik</label>
								<input type="text"  class="error form-control" id="exampleInputEmail2" v-model="domain" placeholder="Topik">
								<span v-if="Boolean(errors.domain)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.domain">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.domain)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail2">Bidang</label>
								<input type="text"  class="error form-control" id="exampleInputEmail2" v-model="domain" placeholder="Bidang">
								<span v-if="Boolean(errors.domain)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.domain">@{{ item }}</li>
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
							<button type="button" class="btn btn-primary" @click="saveHandler">Tambah</button>
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

var app = new Vue({
	el: '#app',
	data: {
		orderType : 0,
		dt : 0,
		domain : '',
		errors: {},
		orderId : 1,
		modal1 : false,
		tableLoading : false
	},
	methods: {
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
						url : '{{ url("datagen/3/year,number,number") }}/',
						type: "GET",
						dataType: "JSON",
				},
				columns: [
							{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
							{ data: 'idx0', name: 'idx0' },
							{ data: 'idx1', name: 'idx1' },
							{ data: 'idx2', name: 'idx2' },
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