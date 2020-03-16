@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Setting
				<small>Optional description</small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Setting</h3>
			</div>
			<div class="box-body">
					<button class="btn btn-success" @click=";$('#modal-default').modal('show')"><i class="fa fa-plus"></i> Add New setting</button>
						<br><br>
				<div class="row">
					<div class="col-md-12">
							<div v-if="tableLoading" class="fa-5x text-center">
									<i class="fa fa-spinner fa-spin"></i>
							</div>
						<table  v-if="!tableLoading" id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Setting Name</th>
									<th>Value</th>
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
			</div>
			<!-- /.box-body -->

			<div class="modal fade in" id="modal-default">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span></button>
							<h4 class="modal-title">Add new setting</h4>
						</div>
						<div class="modal-body">
							<div :class="Boolean(errors.name)? 'form-group has-error' : 'form-group'">
								<label for="">Setting Name</label>
								<input type="text"  class="error form-control" id="" v-model="input.name" placeholder="Setting Name">
								<span v-if="Boolean(errors.name)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.name">@{{ item }}</li>
									</ul>
								</span>
							</div>
							<div :class="Boolean(errors.domain)? 'form-group has-error' : 'form-group'">
								<label for="">Type</label>
								<select v-model="inputType" class="form-control">
									<option value="0">Text</option>
									<option value="1">HTML</option>
								</select>
								<span v-if="Boolean(errors.domain)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.domain">@{{ item }}</li>
									</ul>
								</span>
							</div>
							<div :class="Boolean(errors.val)? 'form-group has-error' : 'form-group'">
								<label for="">Value</label>
								<input type="text" v-model="input.val" class=" form-control" v-if="inputType == 0" placeholder="Value">
								<textarea id="texta" style="visibility: hidden" v-if="inputType == 1"></textarea>
								<span v-if="Boolean(errors.val)"class="help-block">
									<ul>
										<li v-for="(item,index) in errors.val">@{{ item }}</li>
									</ul>
								</span>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" @click="saveHandler">Save</button>
						</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
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
function reloadTable(id){
	app.reloadTable(id);
}

var app = new Vue({
	el: '#app',
	data: {
		orderType : 0,
		dt : 0,
		inputType : 0,
		tableLoading : false,
		errors : {},
		input : {
			name : '',
			val : '',
		}
	},
	methods: {
		reloadTable : async function (id) {
			swal({
				title: "Confirm Delete?",
				text: "",
				icon: "warning",
				buttons: true,
			})
			.then(async (confirmed) => {
				if (confirmed) {
					await $.ajax({
						url : "{{ url('/settingDelete') }}",
						method : "POST",
						dataType : "JSON",
						data : {"id" : id},
						success : function (data){
							console.log(data)
						}

					})

					swal("Setting Deleted", {
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
						url : '{{ url("/settingList") }}/',
						type: "GET",
						dataType: "JSON",
				},
				columns: [
							{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
							{ data: 'name', name: 'name' },
							{ data: 'value', name: 'value' },
							{ data: 'action', name: 'updated_at' },
				]
				});
			});
		},
		saveHandler : function(){
			if(this.inputType == 1){
				this.input.val = $('#texta').summernote('code');
			}
			axios.post('{{ route("addSetting") }}', this.input)
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
		}
	},
	mounted() {
		this.createDataTable();
	},
	watch : {
		inputType : async function(){
			if(this.inputType == 1){
				setTimeout(() => {
					$('#texta').summernote();
				},
				200)
			}else{
				$('#texta').summernote('destroy');
			}
		}
	}
})
</script>
@endsection