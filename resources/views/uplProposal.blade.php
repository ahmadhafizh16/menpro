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
							@if(!empty($kelompok->id_proposal))
							<button class="btn btn-success" @click=";$('#modal-file').modal('show')"><i class="fa fa-plus"></i> Upload File & Revisi Proposal</button>
							@endif

							<div class="row">
								<div class="col-md-12"><br>
									@if($isUploaded->isEmpty())
										@if(!empty($kelompok->id_proposal))
										<h2 class="text-center"> Belum pernah upload file.</h2>
										@endif
									@else
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
										@foreach ($isUploaded as $k => $file)
										<tr>
											<td>{{ $k+1 }}</td>
											<td><a  href="{{ url($file->file_proposal) }}" download class="btn btn-primary"><i class="fa fa-download"></i>  Download File </a></td>
											<td> {{ $file->judul_file }} </td>
											<td> {{ $file->keterangan }} </td>
											<td> {{ $file->upload_date }} </td>
											<td> <button class="btn btn-danger" @click="deleteDt({{ $file->id }})"><i class="fa fa-trash"></i> Hapus</button> </td>
										</tr>
										@endforeach
														
									  </tbody>
									</table>
									@endif
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
								<label >Judul</label>
								<input type="text"  class="error form-control"  v-model="judul" placeholder="Judul">
								<span v-if="Boolean(errors.judul)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.judul">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.topik)? 'form-group has-error' : 'form-group'">
								<label >Topik</label>
								<input type="text"  class="error form-control"  v-model="topik" placeholder="Topik">
								<span v-if="Boolean(errors.topik)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.topik">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.bidang)? 'form-group has-error' : 'form-group'">
								<label >Bidang</label>
								<input type="text"  class="error form-control"  v-model="bidang" placeholder="Bidang">
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
			

			<div class="modal fade in" id="modal-file">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Upload Data Proposal</h4>
					</div>
					<div class="modal-body">
						<div :class="Boolean(errors.judulFile)? 'form-group has-error' : 'form-group'">
							<label >Judul File</label>
							<input type="text"  class="error form-control"  v-model="judulFile" placeholder="Judul File">
							<span v-if="Boolean(errors.judulFile)"class="help-block">
								<ul>
									<li v-for="(item,index) in errors.judulFile">@{{ item }}</li>
								</ul>
							</span>
						</div>

						<div :class="Boolean(errors.keterangan)? 'form-group has-error' : 'form-group'">
							<label >Keterangan</label>
							<input type="text"  class="error form-control"  v-model="keterangan" placeholder="keterangan">
							<span v-if="Boolean(errors.keterangan)"class="help-block">
								<ul>
									<li v-for="(item,index) in errors.keterangan">@{{ item }}</li>
								</ul>
							</span>
						</div>

						<div :class="Boolean(errors.file)? 'form-group has-error' : 'form-group'">
							<label >file</label>
							<input type="file"  class="error form-control" ref="file" @change="fileHandler()" placeholder="file" accept=".doc,.docx,.pdf">
							<span v-if="Boolean(errors.file)"class="help-block">
								<ul>
									<li v-for="(item,index) in errors.file">@{{ item }}</li>
								</ul>
							</span>
						</div>

						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" @click="uploadHandler">Tambah</button>
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
		file : undefined,
		judul : '',
		judulFile : '',
		keterangan : '',
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
			@if(!empty($kelompok->id_proposal))
			this.judul = '{{ $kelompok->proposal->judul }}'
			this.topik = '{{ $kelompok->proposal->topik }}'
			this.bidang = '{{ $kelompok->proposal->bidang }}'
			@endif
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
		fileHandler : function(){
			console.log(this.$refs.file.files[0])
			this.file = this.$refs.file.files[0]
		},
		uploadHandler : function(){
			let formData = new FormData()
			formData.append('file', this.file);
			formData.append('judulFile', this.judulFile);
			formData.append('keterangan', this.keterangan);

			axios.post( {{ url('/uploadProp') }},
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
			// console.log(this.$refs.file.files[0])
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
						url : "{{ url('deleteProp') }}",
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
	},
	async mounted() {
	
	},
	watch : {
		
	}
})
</script>
@endsection