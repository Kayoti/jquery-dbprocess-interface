<?php include ('includes/header.php');?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Support <small>Unresolved List</small>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->

                
				<div class="row">
                    
                    <div class="col-lg-12">
                        
                        <div class="table-responsive">
						<ol class="breadcrumb">
											<li class="active">
												<i class="fa fa-table"></i> OCT/30/2015
											</li>
										</ol>
                        </div>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>EMT Code</th>
                                        <th>EMT Amount</th>
                                        <th></th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Test</td>
                                        <td>Tester</td>
                                        <td>test@creditslab.com</td>
                                        <td>apples</td>
                                        <td>$321.33</td>
                                        <td><button data-toggle="modal" href="#form-content" id="edit-btn" href="#" class="btn btn-lg btn-primary">Edit</button></td>
                                        <td><button id="process-btn" href="#" class="btn btn-lg btn-success">Process</button></td>
										
                                     </tr>
									
                                </tbody>
                            </table>
							
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
                    
                    <div class="col-lg-12">
						
							
							<div id="form-content" class="well modal  fade in" style="display: none;">
								<div class="modal-header">
									<a class="close" data-dismiss="modal">×</a>
									<h3>Review Client</h3>
								</div>
								<div class="modal-body">
									<form class="contact" name="contact">
										<label class="label" for="firstname">First Name</label><br>
										<input type="text" name="firstname" class="input-xlarge"><br>
										<label class="label" for="lastname">Last Name</label><br>
										<input type="text" name="lastname" class="input-xlarge"><br>
										<label class="label" for="email">Email</label><br>
										<input type="email" name="email" class="input-xlarge"><br>
										<label class="label" for="phone">Phone</label><br>
										<input type="text" name="phone" class="input-xlarge"><br>
										
										
									</form>
								</div>
								<div class="modal-footer">
									<input class="btn btn-success" type="submit" value="Confirm" id="submit">
									<a href="#" class="btn btn-primary" data-dismiss="modal">Exit.</a>
								</div>
							</div>
				
						
					</div>
				</div>
                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

  
</body>
<?php include('includes/header.php');?>
</html>
