@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Kelas
				<small>Setting Kelas</small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-success" @click="modalOpen('add')"><i class="fa fa-plus"></i> Tambah Kelas</button>
							<h3>Data Kelas : </h3>
							<div v-if="tableLoading" class="fa-5x text-center">
									<i class="fa fa-spinner fa-spin"></i>
							</div>
						<table  v-if="!tableLoading" id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Tahun Ajaran</th>
									<th>Nama Dosen</th>
									<th>Jurusan</th>
									<th>Kelas</th>
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
							<h4 v-if="mdTr == 'add'" class="modal-title">Tambah Kelas</h4>
							<h4 v-if="mdTr == 'edit'" class="modal-title">Edit Kelas</h4>
						</div>
						<div class="modal-body">
							<div :class="Boolean(errors.tahun)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Tahun Ajaran</label>
								<select class="error form-control" v-model="tahun">
									<option value="{{ $ta->id }}">{{ $ta->tahun }} - {{ $ta->semester_act }}</option>
								</select>
								<span v-if="Boolean(errors.tahun)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.tahun">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.jurusan)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Jurusan</label>
								<select class="select2s form-control" onchange="app.jurusan = $('.select2s').val()" style="width:100% !important;">
									<option></option>
								</select>
								<span v-if="Boolean(errors.jurusan)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.jurusan">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.dosen)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Dosen Pengajar</label>
								<select class="select2dosen form-control" onchange="app.dosen = $('.select2dosen').val()" style="width:100% !important;">
									<option></option>
								</select>
								<span v-if="Boolean(errors.dosen)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.dosen">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.kelas)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Kelas</label>
								<select class="form-control" v-model="kelas">
									<option disabled hidden value="">--- Kelas ---</option>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="C">C</option>
									<option value="D">D</option>
								</select>
								<span v-if="Boolean(errors.kelas)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.kelas">@{{ item }}</li>
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
	<script type="text/x-template" id="demo-template">
	
	  <select2 :options="options" v-model="selected">
		<option disabled value="0">Select one</option>
	  </select2>

  </script>
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
		tahun : '{{ $ta->id }}',
		jurusan : '',
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
				this.jurusan = ''
				this.tahun = '{{ $ta->id }}'
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
			this.tahun = '{{ $ta->id }}'
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
				tahun : this.tahun,
				jurusan : this.jurusan,
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
			
			axios.post('{{ url("addKelas") }}',{
				tahun : this.tahun,
				jurusan : this.jurusan,
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
		await this.getDataJurusan();
		await this.getDataDosen();
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