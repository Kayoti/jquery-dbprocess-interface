<?php include('includes/header.php');?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Requests <small>New requests List</small>
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
                            <table id="service_table" class="table table-bordered table-hover table-striped">
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
                            </table>
						
                    </div>
                </div>
                <!-- /.row -->
				 
				 <?php include ('includes/info_form.php'); ?>
				
                

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
		this.request = "list";
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
									{ data: 'firstname' },  
									{ data: 'lastname' },
									{ data: 'email' },  
									{ data: 'psw' },  
									{ data: 'initloadamount' },  
									{ data: 'button1' } 
								]
						  });

	
	$(".lock_item").live('click', function(event){
		//get the ID
			 cust_id=$(this).attr('id');
			 locked = 1;
			//make sure no white space is before or after id value
			  $.trim(cust_id);
			var request="review";
			//Status=NEW APP 
			var action=0;
			  
			  	$.ajax({
					url:'../controller/page_request.php?request='+request+'&action='+action+'&cust_id='+cust_id,
					
					success:function(result){
						var obj1 = $.parseJSON(result);
						//Load Dropdown Options
						var options = '<option title="" value="0">--EMT STATUS--</option>';
							
						for (var i = 1; i < obj1.EAL.length; i++) {
								options += '<option value="' + obj1.EAL[i].ps_id + '">' + obj1.EAL[i].display + '</option>';
							}
								$("#audit_emt").html(options); 
						var options = '<option title="" value="0">--INFO STATUS--</option>';
							
						for (var i = 1; i < obj1.IAL.length; i++) {
								options += '<option value="' + obj1.IAL[i].ps_id + '">' + obj1.IAL[i].display + '</option>';
							}
								$("#audit_info").html(options); 
						var options = '<option title="" value="0">--CONTRACT STATUS--</option>';
						for (var i = 1; i < obj1.CAL.length; i++) {
								options += '<option value="' + obj1.CAL[i].ps_id + '">' + obj1.CAL[i].display + '</option>';
							}
						$("#audit_contract").html(options); 
						//alert(obj1.islocked);
						if(obj1.islocked == 0)
						{
								//alert(result);
							 
								//alert(obj1.firstname);
							//Populate fields
							//banking
							$("#emt").val(obj1.initloadamount); 
							$("#emt_pass").val(obj1.psw);
							//info
							$("#firstname").val(obj1.firstname);
							$("#middleName").val(obj1.midname);
							$("#lastname").val(obj1.lastname);
							$("#hphone").val(obj1.homephone);
							$("#phone").val(obj1.cellphone);
							$("#email").val(obj1.email);
							$("#gender").val(obj1.gender);
							$("#DOB").val(obj1.dob);
							$("#SIN").val(obj1.sin);
							$("#secret").val(obj1.secret);
							$("#occupation").val(obj1.occupation);
							$("#mmn").val(obj1.motherInfo);
							//address
							$("#lane").val(obj1.line1);
							$("#laneTwo").val(obj1.line2);
							$("#city").val(obj1.city);
							$("#province").val(obj1.StateProvName);
							$("#code").val(obj1.PostalCode);
							//ID
							//PID
							
							$("#pid_type").val(obj1.ptype);
							$("#pid_num").val(obj1.pnumber);
							$("#pid_place").val(obj1.pplace);
							$("#pid_expire").val(obj1.pexpire);
							
							//SID
							$("#sid_type").val(obj1.stype);
							$("#sid_num").val(obj1.snumber);
							$("#sid_place").val(obj1.splace);
							$("#sid_expire").val(obj1.sexpire);
							//status dropdowns 
							$("#audit_emt").val(obj1.emt_id);
							$("#audit_info").val(obj1.info_id);
							$("#audit_contract").val(obj1.contract_id);
							//status checkbox this.prop('checked')
							table.ajax.reload();
						}
						else
						{
							alert("sorry this record is locked");
							$( ".lockedbtn" ).trigger( "click" );
							table.ajax.reload();
							
							//
						}
					}
				}); 
			
			
			event.preventDefault();	
	});
		$(".lockedbtn").live('click', function(event){
		//Status=NEW APP must be used but has no effect here
		
			var action=0;
			var request="list";
			$.ajax({
					url:'../controller/page_request.php?request='+request+'&action='+action+'&cust_id='+cust_id,
					success:function(result){table.ajax.reload();}
					
				}); 
	});	
	$(".exit").live('click', function(event){
		//Status=NEW APP must be used but has no effect here
		
		var action=0;
		var request="unlock_app";
		$.ajax({
					url:'../controller/page_request.php?request='+request+'&action='+action+'&cust_id='+cust_id,
					success:function(result){table.ajax.reload();}
					
				});
	});	
	$(window).bind('beforeunload',function(locked){
		//do something
   		if(locked)
		{		
			
			$( ".exit" ).trigger( "click" );
			return 'are you sure you want to leave?';
		}
	});	
});
 
</script>

</html>
