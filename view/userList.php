<?php include('includes/header.php');?>
<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					User <small>New User List</small>
				</h1>

			</div>
		</div>
		<!-- /.row -->


		<div class="row">

			<div class="col-lg-12">

				<div class="table-responsive">
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-bell"></i>
						</li>
						<li class="active">
						<i class="fa fa-fw fa-user" ></i>
						<a href="http://184.68.121.126/admin/view/login/register.php" target="_blank">
              Add New User
            </a>
						</li>
					</ol>
				</div>
				<table id="service_table" class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>First Name</th>
							<th>Email</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody id="tbody">
					</tbody>
				</table>

			</div>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->



</body>


<?php include('includes/footer.php');?>
<script>
	$(document).ready(function(){
	/***
		Returns static vars to only be used in table
		list ajax call
		!!!change var action according to page
		***/
		function tablerequest(){
			this.request = "userlist";
			this.action = 0;
		}
	//table request object
	var param= new tablerequest();

	//GLOBAL
	var result;
	var table;
	var cust_id;
	var locked = 0;


	table=$('#service_table').DataTable({

		"processing": true,
		"ajax": {
			"url": "../controller/page_request.php?request="+param.request+"&action="+param.action,
		},
		columns: [
		{ data: 'username' },
		{ data: 'email' },
		{ data: 'status' }
		]
	});

});

</script>

</html>
