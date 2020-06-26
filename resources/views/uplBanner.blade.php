@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Upload Banner
				<small></small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-success" @click=";$('#modal-default').modal('show')"><i class="fa fa-plus"></i> Upload Banner</button>
							<h3>  </h3>
							<div v-if="tableLoading" class="fa-5x text-center">
									<i class="fa fa-spinner fa-spin"></i>
							</div>
							<div class="row">
								<div class="col-md-12 text-center">
									<h2> Priview Banner </h2>
									@if(!empty($prop->banner))
									<img src="{{asset("$prop->banner")}}" style="width:300px;">
									@else
									<h3 style="text-align: center;">Belum Upload Banner</h3>
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
							<h4 class="modal-title">Upload Banner</h4>
						</div>
						<div class="modal-body">
							<div :class="Boolean(errors.file)? 'form-group has-error' : 'form-group'">
								<label >File</label>
								<input type="file"  class="error form-control" ref="file" @change="fileHandler()" placeholder="file" accept=".png,jpg,jpeg">
								<span v-if="Boolean(errors.file)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.file">@{{ item }}</li>
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
		file : undefined,
		errors: {},
		orderId : 1,
		modal1 : false,
		tableLoading : false
	},
	methods: {
		saveHandler : function (){
			
			let formData = new FormData()
			formData.append('file', this.file);
			formData.append('id', '{{ $prop->id }}');

			axios.post( '/uploadBanner',
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
		
	},
	async mounted() {
		
	},
	watch : {
		
	}
})
</script>
@endsection