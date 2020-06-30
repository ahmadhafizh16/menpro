@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Pengumuman
				<small></small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						
						<button class="btn btn-success" @click="modalOpen('add')"><i class="fa fa-plus"></i> Buat Pengumuman</button>
						
						
						<div class="row">
							<div class="col-md-12">
								<h3>Data Pengumuman : </h3>
								<div v-if="tableLoading" class="fa-5x text-center">
										<i class="fa fa-spinner fa-spin"></i>
								</div>
							<table  v-if="!tableLoading" id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>Dibuat Oleh</th>
										<th>Tanggal Dibuat</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									
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
							<h4 class="modal-title">Buat Pengumuman</h4>
						</div>
						<div class="modal-body">
							<div :class="Boolean(errors.judul)? 'form-group has-error' : 'form-group'">
								<label >Judul Pengumuman</label>
								<input type="text"  class="error form-control"  v-model="judul" placeholder="Judul">
								<span v-if="Boolean(errors.judul)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.judul">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.file)? 'form-group has-error' : 'form-group'">
								<label >Gambar Thumbnail</label>
								<input type="file"  class="error form-control" ref="file" @change="fileHandler()" placeholder="file" accept=".jpg,.png,.jpeg">
								<small>*Jika tidak diisi akan menggunakan gambar default</small>
								<span v-if="Boolean(errors.file)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.file">@{{ item }}</li>
									</ul>
								</span>
							</div>
							<div id="ld" class="fa-5x text-center">
								<i class="fa fa-spinner fa-spin"></i>
							</div>
							<div id="hiide" :class="Boolean(errors.isi)? 'form-group has-error' : 'form-group'">
								<label>Isi</label>
								{{-- <input type="text"  class="error form-control" id="exampleInputEmail1" v-model="domain" placeholder="Nama Jurusan"> --}}
								<textarea id="texta" v-model="isi">@{{ isi }}</textarea>
								<span v-if="Boolean(errors.isi)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.isi">@{{ item }}</li>
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

				<div class="modal fade in" id="modal-view">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span></button>
							<h4 class="modal-title">Preview Pengumuman</h4>
						</div>
						<div class="modal-body">
							<img :src="img" class="img-responsive" style="max-height:600px;width:100%;margin : 10px auto;">
							<h2>@{{ judulView }}</h2>
							<hr/>
							<div v-html="isiView"></div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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

function viewDt(id){
	app.viewData(id);
}

	  
var app = new Vue({
	el: '#app',
	data: {
		orderType : 0,
		dt : 0,
		dtTb : {},
		file : undefined,
		judul : '',
		judulView : '',
		judulFile : '',
		isi : '',
		img : '',
		isiView : '',
		keterangan : '',
		jenis : 'jasa',
		bidang : 'informatika',
		kelas : '',
		errors: {},
		dtId : '',
		mdTr : '',
		modal1 : false,
		tableLoading : false
	},
	methods: {
		modalOpen : async function(tr) {
			$("#hiide").hide()
			$("#ld").show()
			this.mdTr = tr
			if(tr == "add"){
				$("#texta").summernote("destroy")
				$('#modal-default').modal('show')
				this.judul = ''
				this.isi = ''
				this.file = ''
				this.errors = {}
				await $('#modal-default').on('shown.bs.modal', function () {
					app.initNote()
					$("#ld").hide()
					$("#hiide").show()
				})
			}
			else if(tr == 'edit'){
				$('#modal-default').modal('show')
				this.errors = {}
			}
		},
		editData : async function(id) {
			$("#texta").summernote("destroy")
			let d = this.getDataById(id)
			this.judul = d.judul
			this.isi = d.isi_html
			this.file = undefined
			this.dtId = id
			this.errors = {}
			await $('#modal-default').on('shown.bs.modal', function () {
				app.initNote()
				$("#ld").hide()
				$("#hiide").show()
			})
			await this.modalOpen('edit')
		},
		viewData : function(id) {
			let d = this.getDataById(id)
			this.judulView = d.judul
			this.isiView = d.isi_html
			this.img = '{{ asset("/") }}'+d.thumbnail
			$('#modal-view').modal('show')
		},
		getDataById : function(id) {
			return this.dtTb.filter(dtTb => dtTb.id == id)[0]
		},
		editHandler : function() {
			this.isi = $("#texta").summernote("code")
			let formData = new FormData()
			formData.append('file', this.file);
			formData.append('judul', this.judul);
			formData.append('isi', this.isi);
			formData.append('id', this.dtId);

			axios.post( '{{ url('/editPengumuman') }}',
						formData,
						{
							headers: {
								'Content-Type': 'multipart/form-data'
							}
						}
				).then(function(){
					app.errors = {}
					window.location.reload()
					
				})
				.catch(function(error){
					if(Boolean(error.response.data.errors)){
						app.errors = error.response.data.errors;
					}
					else{
						app.errors = error.response.data.data;
					}
				});
		},
		fileHandler : function(){
			this.file = this.$refs.file.files[0]
		},
		saveHandler : function (){
			this.isi = $("#texta").summernote("code")
			let formData = new FormData()
			formData.append('file', this.file);
			formData.append('judul', this.judul);
			formData.append('isi', this.isi);

			axios.post( '{{ url('/addPengumuman') }}',
						formData,
						{
							headers: {
								'Content-Type': 'multipart/form-data'
							}
						}
				).then(function(){
					app.errors = {}
					window.location.reload()
					
				})
				.catch(function(error){
					if(Boolean(error.response.data.errors)){
						app.errors = error.response.data.errors;
					}
					else{
						app.errors = error.response.data.data;
					}
				});
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
						url : "{{ url('deletePengumuman') }}",
						method : "POST",
						dataType : "JSON",
						data : {"id" : id},
						success : function (data){
							// console.log(data)
						}

					})

					await swal("Data Dihapus!", {
						icon: "success",
					});

					window.location.reload()

				}
			}); 
			
		},
		createDataTable : function(){
			$(document).ready(function(){
				app.dt = $('#example1').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
						url : '{{ url("getPengumuman") }}',
						type: "GET",
						dataType: "JSON",
						complete : function(d){
							app.dtTb = d.responseJSON.data
							// console.log()
						}
				},
				columns: [
							{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
							{ data: 'judul', name: 'nama' },
							{ data: 'dosen_name', name: 'dosen_name' },
							{ data: 'upload_date', name: 'upload_date' },
							{ data: 'action', name: 'action' },
				]
				});
			});
		},
		initNote : function(){
			$('#texta').summernote({
			height : 200,
			placeholder : "Isi Berita",
			toolbar: [
					['style', ['style']],
					['font', ['bold', 'underline', 'clear']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['table', ['table']],
					['insert', ['link']],
					['view', ['help']]
				]
			});
		}
	},
	async mounted() {
		await this.createDataTable();
	},
	watch : {
		
	}
})
</script>
@endsection