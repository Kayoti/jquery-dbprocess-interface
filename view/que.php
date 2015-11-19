<?php include('includes/header.php');?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            QUE <small>List</small>
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
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>EMT Status</th>
                                        <th>INFO Status</th>
                                        <th>CONTRACT Status</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
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
        this.action = 3;
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
                                    { data: 'emt' },  
                                    { data: 'personal' },  
                                    { data: 'contract' },  
                                    { data: 'button1' } 
                                ]
    });

    /***
        Event triggers customer information display
        updates DB with locked flag ->limits view to current user
    ***/
    $(".lock_item").live('click', function(event){
        //get the ID
        cust_id=$(this).attr('id');
        
        //make sure no white space is before or after id value
        $.trim(cust_id);
        var request="process";
        //Status=NEW APP 
        var action=3;
        $.ajax({
                    url:'../controller/dc_request.php?request='+request+'&action='+action+'&cust_id='+cust_id,
                    success:function(result){table.ajax.reload();}
                    
                }); 
              
      });         
}); 
</script>

</html>
