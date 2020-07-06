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
						
						<div class="row">
							<div class="col-md-12">
								@if(empty($kelompok->id_proposal))
									<h2 class="text-center"> Belum input data proposal</h2>
								</hr>
								@else
								<h3> Data Proposal </h3>
									<table class="table " style="font-size:16px;width:50%">
										<tbody>
										<tr>
											<td><b>Judul</b></td>
											<td>: {{ $kelompok->proposal->judul }}</td>
										</tr>
										<tr>
											<td><b>jenis</b></td>
											<td>: {{ ucfirst($kelompok->proposal->jenis) }}</td>
										</tr>
										<tr>
											<td><b>Bidang</b></td>
											<td>: {{ ucfirst($kelompok->proposal->bidang) }}</td>
										</tr>	
										<tr>
											<td><b>Deskripsi</b></td>
											<td> {!! $kelompok->proposal->deskripsi !!}</td>
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

							<div :class="Boolean(errors.jenis)? 'form-group has-error' : 'form-group'">
								<label >Jenis</label>
								<select class="error form-control" v-model="jenis" placeholder="Jenis">
									<option value="jasa">Jasa</option>
									<option value="produk">Produk</option>
								</select>
								<span v-if="Boolean(errors.jenis)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.jenis">@{{ item }}</li>
									</ul>
								</span>
							</div>
							

							<div :class="Boolean(errors.bidang)? 'form-group has-error' : 'form-group'">
								<label >Bidang</label>
								<select class="error form-control" v-model="bidang" placeholder="Bidang">
									<option value="informatika">Informatika</option>
									<option value="life style">Life style</option>
									<option value="elektronika">Elektronika</option>
									<option value="kuliner">Kuliner</option>
									<option value="agrobisnis">Agrobisnis</option>
								</select>
								<span v-if="Boolean(errors.bidang)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.bidang">@{{ item }}</li>
									</ul>
								</span>
							</div>

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

							<div :class="Boolean(errors.deskripsi)? 'form-group has-error' : 'form-group'">
								<label>Segmentasi Konsumen</label>
								{{-- <input type="text"  class="error form-control" id="exampleInputEmail1" v-model="domain" placeholder="Nama Jurusan"> --}}
								<textarea id="texta1" class="texta" v-model="segmentasi">@{{ segmentasi }}</textarea>
								<span v-if="Boolean(errors.segmentasi)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.segmentasi">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.proposisi)? 'form-group has-error' : 'form-group'">
								<label>Proposisi Nilai</label>
								{{-- <input type="text"  class="error form-control" id="exampleInputEmail1" v-model="domain" placeholder="Nama Jurusan"> --}}
								<textarea id="texta2" class="texta" v-model="proposisi">@{{ proposisi }}</textarea>
								<span v-if="Boolean(errors.proposisi)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.proposisi">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.jalur)? 'form-group has-error' : 'form-group'">
								<label>Jalur</label>
								{{-- <input type="text"  class="error form-control" id="exampleInputEmail1" v-model="domain" placeholder="Nama Jurusan"> --}}
								<textarea id="texta3" class="texta" v-model="jalur">@{{ jalur }}</textarea>
								<span v-if="Boolean(errors.jalur)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.jalur">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.hubungan_pel)? 'form-group has-error' : 'form-group'">
								<label>Hubungan dengan pelanggan</label>
								{{-- <input type="text"  class="error form-control" id="exampleInputEmail1" v-model="domain" placeholder="Nama Jurusan"> --}}
								<textarea id="texta4" class="texta" v-model="hubungan_pel">@{{ hubungan_pel }}</textarea>
								<span v-if="Boolean(errors.hubungan_pel)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.hubungan_pel">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.mitra_kunci)? 'form-group has-error' : 'form-group'">
								<label>Mitra Kunci</label>
								{{-- <input type="text"  class="error form-control" id="exampleInputEmail1" v-model="domain" placeholder="Nama Jurusan"> --}}
								<textarea id="texta5" class="texta" v-model="mitra_kunci">@{{ mitra_kunci }}</textarea>
								<span v-if="Boolean(errors.mitra_kunci)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.mitra_kunci">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.struktur_pembiayaan)? 'form-group has-error' : 'form-group'">
								<label>Struktur Pembiayaan</label>
								{{-- <input type="text"  class="error form-control" id="exampleInputEmail1" v-model="domain" placeholder="Nama Jurusan"> --}}
								<textarea id="texta6" class="texta" v-model="struktur_pembiayaan">@{{ struktur_pembiayaan }}</textarea>
								<span v-if="Boolean(errors.struktur_pembiayaan)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.struktur_pembiayaan">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.pendapatan)? 'form-group has-error' : 'form-group'">
								<label>Sumber Pendapatan</label>
								{{-- <input type="text"  class="error form-control" id="exampleInputEmail1" v-model="domain" placeholder="Nama Jurusan"> --}}
								<textarea id="texta6" class="texta" v-model="pendapatan">@{{ pendapatan }}</textarea>
								<span v-if="Boolean(errors.pendapatan)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.pendapatan">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.aktivitas_kunci)? 'form-group has-error' : 'form-group'">
								<label>Aktivitas Kunci</label>
								{{-- <input type="text"  class="error form-control" id="exampleInputEmail1" v-model="domain" placeholder="Nama Jurusan"> --}}
								<textarea id="texta7" class="texta" v-model="aktivitas_kunci">@{{ aktivitas_kunci }}</textarea>
								<span v-if="Boolean(errors.aktivitas_kunci)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.aktivitas_kunci">@{{ item }}</li>
									</ul>
								</span>
							</div>

							<div :class="Boolean(errors.sumberdaya)? 'form-group has-error' : 'form-group'">
								<label>Sumber Daya Utama</label>
								{{-- <input type="text"  class="error form-control" id="exampleInputEmail1" v-model="domain" placeholder="Nama Jurusan"> --}}
								<textarea id="texta8" class="texta" v-model="sumberdaya">@{{ sumberdaya }}</textarea>
								<span v-if="Boolean(errors.sumberdaya)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.sumberdaya">@{{ item }}</li>
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
							<label >File proposal</label>
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
		file : undefined,
		judul : '',
		judulFile : '',
		@if(!empty($kelompok->id_proposal))
		deskripsi : '{!!  str_replace("'","&apos;",$kelompok->proposal->deskripsi) !!}',
		segmentasi : '{!! str_replace("'","&apos;",$kelompok->proposal->segmentasi) !!}',
		proposisi : '{!! str_replace("'","&apos;",$kelompok->proposal->proposisi) !!}',
		jalur : '{!! str_replace("'","&apos;",$kelompok->proposal->jalur) !!}',
		hubungan_pel : '{!! str_replace("'","&apos;",$kelompok->proposal->hubungan_pel) !!}',
		mitra_kunci : '{!! str_replace("'","&apos;",$kelompok->proposal->mitra_kunci) !!}',
		struktur_pembiayaan : '{!! str_replace("'","&apos;",$kelompok->proposal->struktur_pembiayaan) !!}',
		pendapatan : '{!! str_replace("'","&apos;",$kelompok->proposal->pendapatan) !!}',
		aktivitas_kunci : '{!! str_replace("'","&apos;",$kelompok->proposal->aktivitas_kunci) !!}',
		sumberdaya : '{!! str_replace("'","&apos;",$kelompok->proposal->sumberdaya) !!}',
		@else
		deskripsi : '',
		segmentasi : '',
		proposisi : '',
		jalur : '',
		hubungan_pel : '',
		mitra_kunci : '',
		struktur_pembiayaan : '',
		pendapatan : '',
		aktivitas_kunci : '',
		sumberdaya : '',
		@endif
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
		modalOpen : function(tr) {
			this.mdTr = tr
			if(tr == "add"){
				$('#modal-default').modal('show')
				this.judul = ''
				this.deskripsi = ''
				this.jenis = 'jasa'
				this.bidang = 'informatika'
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
			this.jenis = '{{ $kelompok->proposal->jenis }}'
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
			this.deskripsi = $("#texta").summernote("code")
			this.segmentasi = $("#texta1").summernote("code")
			this.proposisi = $("#texta2").summernote("code")
			this.jalur = $("#texta3").summernote("code")
			this.hubungan_pel = $("#texta4").summernote("code")
			this.mitra_kunci = $("#texta5").summernote("code")
			this.struktur_pembiayaan = $("#texta5").summernote("code")
			this.pendapatan = $("#texta6").summernote("code")
			this.aktivitas_kunci = $("#texta7").summernote("code")
			this.sumberdaya = $("#texta8").summernote("code")

			axios.post('{{ url("editProposal") }}',{
				id : this.dtId,
				judul : this.judul,
				jenis : this.jenis,
				deskripsi : this.deskripsi,
				bidang : this.bidang,
				segmentasi : this.segmentasi,
				proposisi : this.proposisi,
				jalur : this.jalur,
				hubungan_pel : this.hubungan_pel,
				mitra_kunci : this.mitra_kunci,
				struktur_pembiayaan : this.struktur_pembiayaan,
				pendapatan : this.pendapatan,
				aktivitas_kunci : this.aktivitas_kunci,
				sumberdaya : this.sumberdaya,		
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
			this.file = this.$refs.file.files[0]
		},
		uploadHandler : function(){
			let formData = new FormData()
			formData.append('file', this.file);
			formData.append('judulFile', this.judulFile);
			formData.append('keterangan', this.keterangan);

			axios.post( '{{ url('/uploadProp') }}',
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
			this.deskripsi = $("#texta").summernote("code")
			this.segmentasi = $("#texta1").summernote("code")
			this.proposisi = $("#texta2").summernote("code")
			this.jalur = $("#texta3").summernote("code")
			this.hubungan_pel = $("#texta4").summernote("code")
			this.mitra_kunci = $("#texta5").summernote("code")
			this.struktur_pembiayaan = $("#texta5").summernote("code")
			this.pendapatan = $("#texta6").summernote("code")
			this.aktivitas_kunci = $("#texta7").summernote("code")
			this.sumberdaya = $("#texta8").summernote("code")

			axios.post('{{ url("addProposal") }}',{
				judul : this.judul,
				jenis : this.jenis,
				deskripsi : this.deskripsi,
				bidang : this.bidang,
				segmentasi : this.segmentasi,
				proposisi : this.proposisi,
				jalur : this.jalur,
				hubungan_pel : this.hubungan_pel,
				mitra_kunci : this.mitra_kunci,
				struktur_pembiayaan : this.struktur_pembiayaan,
				pendapatan : this.pendapatan,
				aktivitas_kunci : this.aktivitas_kunci,
				sumberdaya : this.sumberdaya,		
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
		
	}
})
</script>
@endsection