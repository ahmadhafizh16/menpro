@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Tim Koordinator
				<small>Setting Tim Koordinator</small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-success" @click="modalOpen('add')"><i class="fa fa-plus"></i> Tambah Koordinator </button>
						<button class="btn btn-warning" @click=";$('#modal-default2').modal('show')"><i class="fa fa-edit"></i> Edit Text Koordinator </button>
							<h3>List Koordinator  : </h3>
							<div v-if="tableLoading" class="fa-5x text-center">
									<i class="fa fa-spinner fa-spin"></i>
							</div>
						<table  v-if="!tableLoading" id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Foto</th>
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
							<h4 v-if="mdTr == 'add'" class="modal-title">Tambah Koordinator</h4>
							<h4 v-if="mdTr == 'edit'" class="modal-title">Edit Koordinator</h4>
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

							<div :class="Boolean(errors.file2)? 'form-group has-error' : 'form-group'">
								<label >Foto</label>
								<input type="file"  class="error form-control" ref="file2" @change="fileHandler2()" placeholder="file" accept=".png,jpg,jpeg">
								<span v-if="Boolean(errors.file2)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.file2">@{{ item }}</li>
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

					<div class="modal fade in" id="modal-default2">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span></button>
								<h4>Edit Text Koordinator</h4>
								
							</div>
							<div class="modal-body">
								<div :class="Boolean(errors.deskripsi)? 'form-group has-error' : 'form-group'">
									<label>Deskripsi</label>
									{{-- <input type="text"  class="error form-control" id="exampleInputEmail1" v-model="domain" placeholder="Nama Jurusan"> --}}
									<textarea id="texta" class='texta' v-model="deskripsi">@{{ deskripsi }}</textarea>
									<span v-if="Boolean(errors.deskripsi)"class="help-block">
										<ul>
											<li v-for="(item,index) in errors.deskripsi">@{{ item }}</li>
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
							
								<button type="button" class="btn btn-primary" @click="editHandler2">Simpan</button>
							</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
						</div>
			</div>
			
			
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
@section('style')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@endsection

@section('script')

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

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
		file : undefined,
		email : '',
		role : '3',
		deskripsi : '{!! str_replace("'","&apos;",$deskripsi ) !!}',
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
				this.file = undefined
				this.errors = {}
			}
			else if(tr == 'edit'){
				$('#modal-default').modal('show')
				this.errors = {}
			}
		},
		editHandler2 : function() {
			this.deskripsi = $("#texta").summernote("code")

			axios.post('{{ url("editKoorText") }}',{
				deskripsi : this.deskripsi
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
		fileHandler2 : function(){
			this.file2 = this.$refs.file2.files[0]
		},
		editData : function(id) {
			let d = this.getDataById(id) 
			this.dtId = d.id
			this.nama = d.name
			this.errors = {}
			this.modalOpen('edit')

		},
		getDataById : function(id) {
			return this.dtTb.filter(dtTb => dtTb.id == id)[0]
		},
		editHandler : function() {
			let formData = new FormData()
			formData.append('id', this.dtId);
			formData.append('file2', this.file2);
			formData.append('name', this.nama);
			axios.post('{{ url("editKoor") }}',
				formData,
				{
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				}
			)
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
			let formData = new FormData()
			formData.append('file2', this.file2);
			formData.append('name', this.nama);
			axios.post('{{ url("addKoor") }}',
				formData,
				{
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				}
			)
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
						url : "{{ url('deleteKoor') }}",
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
						url : '{{ url("koorData") }}',
						type: "GET",
						dataType: "JSON",
						complete : function(d){
							app.dtTb = d.responseJSON.data
							// console.log()
						}
				},
				columns: [
							{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
							{ data: 'name', name: 'name' },
							{ data: 'foto', name: 'foto' },
							{ data: 'action', name: 'action' },
				]
				});
			});
		}
	},
	async mounted() {
		await this.createDataTable();
		$('.texta').summernote({
			height : 200,
			placeholder : "",
			toolbar: [
			['font', ['bold', 'underline', 'clear']],
			['para', ['ul', 'ol', 'paragraph']],
			]
		});
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