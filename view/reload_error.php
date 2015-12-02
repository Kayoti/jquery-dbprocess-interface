<?php include('includes/header.php');?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Reload <small>Requests</small>
                </h1>
                
            </div>
        </div>
        <!-- /.row -->

        
        <div class="row">
            
            <div class="col-lg-12">
                
                <div class="table-responsive">
                    <ol class="breadcrumb">
                        
                    </ol>
                </div>
                <table id="service_table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Error Message</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Amount</th>
                            <th>Password</th>
                            <th>Card Number</th>
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
            this.request = "reloads";
            this.action = 2;
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
    { data: 'loaddate' },  
    { data: 'button2' },
    { data: 'firstname' },  
    
    { data: 'lastname' },
    { data: 'loadamount' },
    { data: 'secret' }, 
    { data: 'cardnums' },
	{ data: 'button1' }	
    ]
});

    /***
        Event triggers customer information display
        updates DB with locked flag ->limits view to current user
        ***/
        
$('.submit_info').live('click', function(event){
    //get the reload
        var reload_id=$(this).attr('id');
        var cust_id=-1;
    notie.confirm('Confirm?', 'Yes', 'Cancel', function() {
    
	 
         
            //make sure no white space is before or after id value
            $.trim(reload_id);
     var action=reload_id;
     var request="reload_web";
            //alert($('#info_form').serialize());
            $.ajax({
                url:'../controller/dc_request.php?request='+request+'&action='+action+'&cust_id='+cust_id,
               
                success:function(result){ 
                    BootstrapDialog.show({
                        size: BootstrapDialog.SIZE_LARGE,
                        message: result,
                        buttons: [ {
                            label: 'Close',
                            action: function(dialogItself){
                                dialogItself.close();
                            }
                        }]
                    });
                    
                    table.ajax.reload();
                    
                }
                
            });
        });
    event.preventDefault();
}); 
$('.err_msg').live('click', function(event){
    //get the reload
        var msg=$(this).attr('id');
         BootstrapDialog.show({
                        size: BootstrapDialog.SIZE_LARGE,
                        message: msg,
                        buttons: [ {
                            label: 'Close',
                            action: function(dialogItself){
                                dialogItself.close();
                            }
                        }]
                    });
          });

$(window).bind('beforeunload',function(locked){
        //do something
        if(locked )
        {       
            
            $( ".exit" ).trigger( "click" );
            return 'are you sure you want to leave?';
        }
    });         
}); 
</script>

</html>
