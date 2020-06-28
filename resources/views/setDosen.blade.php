@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Dosen
				<small>Setting Dosen</small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-success" @click="modalOpen('add')"><i class="fa fa-plus"></i> Tambah Dosen </button>
							<h3>List Dosen  : </h3>
							<div v-if="tableLoading" class="fa-5x text-center">
									<i class="fa fa-spinner fa-spin"></i>
							</div>
						<table  v-if="!tableLoading" id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>NID</th>
									<th>Nama</th>
									<th>Username</th>
									<th>Role</th>
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
							<h4 v-if="mdTr == 'add'" class="modal-title">Tambah Dosen</h4>
							<h4 v-if="mdTr == 'edit'" class="modal-title">Edit Dosen</h4>
						</div>
						<div class="modal-body">
							<div :class="Boolean(errors.nama)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Nama</label>
								<input type="text"  class="error form-control"  v-model="nama" placeholder="Nama">
								<span v-if="Boolean(errors.nama)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.nama">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.nid)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">NID</label>
								<input type="text"  class="error form-control"  v-model="nid" placeholder="NID">
								<span v-if="Boolean(errors.nid)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.nid">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.email)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Email</label>
								<input type="text"  class="error form-control"  v-model="email" placeholder="Email">
								<span v-if="Boolean(errors.email)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.email">@{{ item }}</li>
									</ul>
								</span>
							</div>


							<div :class="Boolean(errors.username)? 'form-group has-error' : 'form-group'">
								<label >Username</label>
								<input type="text"  class="error form-control"  v-model="username" placeholder="Username">
								<span v-if="Boolean(errors.username)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.username">@{{ item }}</li>
									</ul>
								</span>
							</div>


							<div :class="Boolean(errors.password)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputpassword1">Password</label>
								<input type="password"  class="error form-control"  v-model="password" placeholder="Password">
								<span v-if="Boolean(errors.password)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.password">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.role)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputrole1">Role</label>
								<select class="error form-control"  v-model="role" placeholder="Role">
									<option value="3">Dosen Pengajar</option>
									<option value="2">Koordinator KWU</option>
								</select>

								<span v-if="Boolean(errors.role)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.role">@{{ item }}</li>
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
		nid : '',
		email : '',
		role : '3',
		username : '',
		password : '',
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
				this.nid = ''
				this.username =''
				this.password = ''
				this.role = '3'
				this.email = ''
				this.errors = {}
			}
			else if(tr == 'edit'){
				$('#modal-default').modal('show')
				this.errors = {}
			}
		},
		editData : function(id) {
			let d = this.getDataById(id) 
			this.dtId = d.id
			this.nama = d.nama
			this.nid = d.nomor
			this.username = d.username
			this.password = ''
			this.role = d.role
			this.email = d.email
			this.errors = {}
			this.modalOpen('edit')

		},
		getDataById : function(id) {
			return this.dtTb.filter(dtTb => dtTb.id == id)[0]
		},
		editHandler : function() {
			axios.post('{{ url("editDosen") }}',{
				id : this.dtId,
				nama : this.nama,
				nid : this.nid,
				username : this.username,
				password : this.password,
				role : this.role,
				email : this.email,
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
			
			axios.post('{{ url("addDosen") }}',{
				nama : this.nama,
				nid : this.nid,
				username : this.username,
				password : this.password,
				role : this.role,
				email : this.email,
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
						url : "{{ url('deleteDosen') }}",
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
						url : '{{ url("dosenData") }}',
						type: "GET",
						dataType: "JSON",
						complete : function(d){
							app.dtTb = d.responseJSON.data
							// console.log()
						}
				},
				columns: [
							{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
							{ data: 'nomor', name: 'nomor' },
							{ data: 'nama', name: 'nama' },
							{ data: 'username', name: 'username' },
							{ data: 'role_text', name: 'role_text' },
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