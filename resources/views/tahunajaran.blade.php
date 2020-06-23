@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Tahun Ajaran
				<small>Setting Tahun Ajaran</small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-success" @click="modalOpen('add')"><i class="fa fa-plus"></i> Tambah Tahun Ajaran</button>
							<h3>Data Tahun Ajaran : </h3>
							<div v-if="tableLoading" class="fa-5x text-center">
									<i class="fa fa-spinner fa-spin"></i>
							</div>
						<table  v-if="!tableLoading" id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Tahun Ajaran</th>
									<th>Semester</th>
									<th>Aktif</th>
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
							<h4 v-if="mdTr == 'add'" class="modal-title">Tambah Tahun Ajaran</h4>
							<h4 v-if="mdTr == 'Edit'" class="modal-title">Edit Tahun Ajaran</h4>
						</div>
						<div class="modal-body">
							<div :class="Boolean(errors.tahun)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Tahun Ajaran</label>
								<select class="error form-control" v-model="tahun">
									<option disabled hidden value="null">--- Tahun Ajaran ---</option>
									@for($i = date("Y");$i <= (date("Y")+10); $i++)
									<option value="{{ $i }}/{{ $i+1 }}">{{ $i }}/{{ $i+1 }}</option>
									@endfor
								</select>
								<span v-if="Boolean(errors.tahun)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.tahun">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.semester)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Semester</label>
								<select class="error form-control" v-model="semester" placeholder="Semester">
									<option value="1">Ganjil</option>
									<option value="2">Genap</option>
								</select>
								<span v-if="Boolean(errors.semester)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.semester">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.isActive)? 'form-group has-error' : 'form-group'">
								<label for="exampleInputEmail1">Jadikan Semester Aktif</label>
								<select class="error form-control" v-model="isActive" placeholder="isActive">
									<option value="0">Tidak</option>
									<option value="1">Ya</option>
								</select>
								<span v-if="Boolean(errors.isActive)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.isActive">@{{ item }}</li>
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
		tahun : null,
		semester : '1',
		isActive : 0,
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
				this.tahun = null
				this.semester = '1'
				this.isActive = 0
				this.errors = {}
			}
			else if(tr == 'edit'){
				$('#modal-default').modal('show')
				this.errors = {}
			}
		},
		editData : function(id) {
			this.dtId = id
			this.errors = {}
			this.editHandler();
		},
		getDataById : function(id) {
			return this.dtTb.filter(dtTb => dtTb.id == id)[0]
		},
		editHandler : function() {
			axios.post('{{ url("editTAjaran") }}',{
				id : this.dtId,
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
			
			axios.post('{{ url("addTAjaran") }}',{
				tahun : this.tahun,
				semester : this.semester,
				isActive : this.isActive
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
						url : "{{ url('deleteTAjaran') }}",
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
						url : '{{ url("tajaranData") }}',
						type: "GET",
						dataType: "JSON",
						complete : function(d){
							app.dtTb = d.responseJSON.data
							// console.log()
						}
				},
				columns: [
							{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
							{ data: 'tahun', name: 'tahun' },
							{ data: 'semester_act', name: 'semester_act' },
							{ data: 'isActIco', name: 'isActIco' },
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