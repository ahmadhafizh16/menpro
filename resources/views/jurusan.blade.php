@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Jurusan
				<small>Setting Jurusan</small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-success" @click="modalOpen('add')"><i class="fa fa-plus"></i> Tambah Jurusan</button>
							<h3>List Jurusan : </h3>
							<div v-if="tableLoading" class="fa-5x text-center">
									<i class="fa fa-spinner fa-spin"></i>
							</div>
						<table  v-if="!tableLoading" id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Jurusan</th>
									<th>Semester Aktif</th>
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
							<h4 v-if="mdTr == 'add'" class="modal-title">Tambah Jurusan</h4>
							<h4 v-if="mdTr == 'Edit'" class="modal-title">Edit Jurusan</h4>
						</div>
						<div class="modal-body">
							<div :class="Boolean(errors.nama)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Nama Jurusan</label>
								<input type="text"  class="error form-control"  v-model="nama" placeholder="Nama Jurusan">
								<span v-if="Boolean(errors.nama)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.nama">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.semester_aktif)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Semester Aktif</label>
								<select class="error form-control" v-model="semester_aktif" placeholder="Semester Aktif">
									<option value="1">Ganjil</option>
									<option value="2">Genap</option>
								</select>
								<span v-if="Boolean(errors.semester_aktif)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.semester_aktif">@{{ item }}</li>
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
		nama : '',
		semester_aktif : '1',
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
				this.nama = ''
				this.semester_aktif = '1'
				this.errors = {}
			}
			else if(tr == 'edit'){
				$('#modal-default').modal('show')
				this.errors = {}
			}
		},
		editData : function(id) {
			let d = this.getDataById(id) 
			this.nama = d.nama
			this.dtId = d.id
			this.semester_aktif = d.semester_aktif
			this.errors = {}
			this.modalOpen('edit')

		},
		getDataById : function(id) {
			return this.dtTb.filter(dtTb => dtTb.id == id)[0]
		},
		editHandler : function() {
			axios.post('{{ url("editJurusan") }}',{
				id : this.dtId,
				nama : this.nama,
				semester_aktif : this.semester_aktif
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
			
			axios.post('{{ url("addJurusan") }}',{
				nama : this.nama,
				semester_aktif : this.semester_aktif
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
						url : "{{ url('deleteJurusan') }}",
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
						url : '{{ url("jurusanData") }}',
						type: "GET",
						dataType: "JSON",
						complete : function(d){
							app.dtTb = d.responseJSON.data
							// console.log()
						}
				},
				columns: [
							{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
							{ data: 'nama', name: 'nama' },
							{ data: 'semester_act', name: 'semester_act' },
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