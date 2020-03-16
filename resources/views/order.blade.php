@extends('layouts.home')

@section("content-header")
<div id="app">
	<section class="content-header">
			<h1>
				Order
				<small>Optional description</small>
			</h1>
	</section>

	<section class="content">
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">@{{ order() }} Order </h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-2">
						<label>Order Type :</label>
						<select v-model="orderType" class="form-control">
							<option value="0">Pending</option>
							<option value="1">Expire</option>
							<option value="2">Paid</option>
						</select>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-md-12">
							<div v-if="tableLoading" class="fa-5x text-center">
									<i class="fa fa-spinner fa-spin"></i>
							</div>
						<table  v-if="!tableLoading" id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>User Email</th>
									<th>App Name</th>
									<th>Package</th>
									<th>Package Expire</th>
									<th>Payment Date</th>
									<th>Order Expired</th>
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
						url : "{{ url('/confirmPayment') }}",
						method : "POST",
						dataType : "JSON",
						data : {"id" : id},
						success : function (data){
							console.log(data)
						}

					})

					swal("Payment Confirmed", {
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
						url : '{{ url("/orderList") }}/'+app.orderType,
						type: "GET",
						dataType: "JSON",
				},
				columns: [
							{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
							{ data: 'user.email', name: 'user.email' },
							{ data: 'app.name', name: 'app.name' },
							{ data: 'packageDetail', name: 'packageDetail' },
							{ data: 'expired_at', name: 'expired_at' },
							{ data: 'payment_date', name: 'payment_date' },
							{ data: 'orderExpire', name: 'orderExpire' },
							{ data: 'action', name: 'updated_at' },
				]
				});
			});
		}
	},
	mounted() {
		this.createDataTable();
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