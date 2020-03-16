@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Data Kelompok <button class="btn btn-success" @click=";$('#modal-default').modal('show')"><i class="fa fa-plus"></i> Daftarkan Kelompok</button>
				<small></small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="row">
			<div class="col-md-6">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Data Kelompok</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<table class="table " style="font-size:16px;">
									<tbody>
									<tr>
										<td><b>Nama Kelompok</b></td>
										<td>: Kelompok A Informatika</td>
									</tr>
									<tr>
										<td><b>Anggota Kelompok</b></td>
										<td>: • [15-2016-120] Randy Hardianto</option>
											<br>&nbsp; • [15-2016-121] Ridwa Ismail</option>
											<br>&nbsp; • [15-2016-122] Gustian P</option></td>
									</tr>
									<tr>
										<td><b>Dosen Pembimbing</b></td>
										<td>:[120011591] Dr. Zane Stroman</td>
									</tr>
									<tr>
										<td><b>Kelas</b></td>
										<td>: [IF20201A] Informatika A</td>
									</tr>
									
								  </tbody>
								</table>
							</div>
						</div>
						<div class="ajax-content">
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
					</div>
					<!-- /.box-footer-->
				</div>
			</div>

			<div class="col-md-6">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Data Proposal</h3>
					</div>
					<div class="box-body">
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
									<tr>
										<td><b>Status Laporan Akhir</b></td>
										<td>: Belum Mengumpulkan</td>
									</tr>
									
								  </tbody>
								</table>
							</div>
						</div>
						<div class="ajax-content">
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
					</div>
					<!-- /.box-footer-->
				</div>
			</div>

		</div>
		
			<h2>
				Histori Upload Proposal & Banner
				<small></small>
			</h2>
		
		<ul class="timeline">

			<!-- timeline time label -->
			<li class="time-label">
				<span class="bg-red">
					10 Feb. 2020
				</span>
			</li>
			<!-- /.timeline-label -->
		
			<!-- timeline item -->
			<li>
				<!-- timeline icon -->
				<i class="fa fa-file bg-blue"></i>
				<div class="timeline-item">
					<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
		
					<h3 class="timeline-header"><a href="#">Upload Proposal Revisi 4</a></h3>
		
					<div class="timeline-body">
						Revisi SWOT Dan Neraca
					</div>
		
					
				</div>
			</li>

			<li class="time-label">
				<span class="bg-green">
					1 Feb. 2020
				</span>
			</li>
			<!-- /.timeline-label -->
		
			<!-- timeline item -->
			<li>
				<!-- timeline icon -->
				<i class="fa fa-file bg-blue"></i>
				<div class="timeline-item">
					<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
		
					<h3 class="timeline-header"><a href="#">Upload Proposal Revisi 3</a></h3>
		
					<div class="timeline-body">
						Revisi Tujuan Pasar dan Cash Flow
					</div>
		
					
				</div>
			</li>

			<li class="time-label">
				<span class="bg-blue">
					20 Jan. 2020
				</span>
			</li>
			<!-- /.timeline-label -->
		
			<!-- timeline item -->
			<li>
				<!-- timeline icon -->
				<i class="fa fa-file bg-blue"></i>
				<div class="timeline-item">
					<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
		
					<h3 class="timeline-header"><a href="#">Upload Proposal Revisi 2</a></h3>
		
					<div class="timeline-body">
						Revisi Latar Belakang
					</div>
		
					
				</div>
			</li>
			<!-- END timeline item -->
			<li>
				<i class="fa fa-clock-o bg-gray"></i>
			</li>
		
		</ul>

		<div class="modal fade in" id="modal-default">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
					<h4 class="modal-title">Daftarkan Kelompok</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Nama Kelompok</label>
						<input type="text"  class="error form-control" id="" placeholder="Nama Kelompok">
						<span v-if="Boolean(errors.name)"class="help-block">
							<ul>
								<li v-for="(item,index) in errors.name">@{{ item }}</li>
							</ul>
						</span>
					</div>
					<div class="form-group">
						<label for="">Anggota Kelompok</label><br>
						<select class="select2s form-control" name="states[]" multiple="multiple" style="width:100% !important;">
							<option value="AL">[15-2016-120] Randy Hardianto</option>
							<option value="AL">[15-2016-121] Ridwa Ismail</option>
							<option value="AL">[15-2016-122] Gustian P</option>
							<option value="AL">[15-2016-123] Yulianto A N</option>
							<option value="AL">[15-2016-124] Rifki M</option>
							<option value="AL">[15-2016-125] Lukman A</option>
							<option value="AL">[15-2016-126] Diki A</option>
							<option value="AL">[15-2016-127] Ahmad H</option>
							<option value="AL">[15-2016-128] Bachtiar A</option>
							<option value="AL">[15-2016-129] Mahasiswa</option>
							<option value="AL">[15-2016-130] Randy ABC</option>
							
						</select>
						<span v-if="Boolean(errors.name)"class="help-block">
							<ul>
								<li v-for="(item,index) in errors.name">@{{ item }}</li>
							</ul>
						</span>
					</div>
					<div class="form-group">
						<label for="">Dosen Pembimbing</label>
						<select class="select2s form-control" name="sz" style="width:100% !important;">
							<option value="AL">[120011591] Dr. Zane Stroman</option>
							<option value="AL">[120011592] Dr. Niman Zein</option>
							<option value="AL">[120011593] Prof. Ade Gustian P</option>
							<option value="AL">[120011594] Prof. Yulianto A N</option>
							<option value="AL">[120011595] Ir. Rifki M</option>
							<option value="AL">[120011596] Lukman A, S.Kom,. M.T</option>
							<option value="AL">[120011597] Diki A, S.Kom,. M.T</option>
							<option value="AL">[120011598] Ahmad H, S.Kom,. M.T</option>
							<option value="AL">[120011599] Bachtiar A, S.Kom,. M.T</option>
							<option value="AL">[120011610] Mahasiswa</option>
							<option value="AL">[120011211] Randy ABC</option>
							
						</select>
						<span v-if="Boolean(errors.name)"class="help-block">
							<ul>
								<li v-for="(item,index) in errors.name">@{{ item }}</li>
							</ul>
						</span>
					</div>
					<div class="form-group">
						<label for="">Kelas</label>
						<select class="select2s form-control" name="sz" style="width:100% !important;">
							<option value="AL">[IF20201A] Informatika A</option>
							<option value="AL">[IF20201B] Informatika B</option>
							<option value="AL">[IF20201C] Informatika C</option>
							<option value="AL">[IF20201D] Informatika D</option>
							
							
						</select>
						<span v-if="Boolean(errors.name)"class="help-block">
							<ul>
								<li v-for="(item,index) in errors.name">@{{ item }}</li>
							</ul>
						</span>
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
		
	</section>
</div>
	<!-- /.content -->
@endsection

@section('script')

<script>
$(document).ready(function() {
    $('.select2s').select2({
		maximumSelectionLength : 3
	});
});	
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
		order : function(){
			if(this.orderType == 0){
				return 'Pending'
			}
			else if (this.orderType == 1) {
				return 'Expire'
			}
			else if (this.orderType == 2) {
				return 'Paid'
			}
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
						url : '{{ url("datagen/4") }}/',
						type: "GET",
						dataType: "JSON",
				},
				columns: [
							{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
							{ data: 'idx0', name: 'idx0' },
							{ data: 'idx1', name: 'idx1' },
							{ data: 'idx2', name: 'idx2' },
							{ data: 'idx3', name: 'idx3' },
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