<?php include('includes/header.php');?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Disabled <small>Apps List</small>
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
            this.action = 5;
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
        "type" : "GET",
        "url": "../controller/page_request.php?request="+param.request+"&action="+param.action,
    },
    "fnDrawCallback" : function( oSettings ) {
        $(".lock_item").removeClass("btn-primary");
        $(".lock_item").addClass("btn-success");
        $(".lock_item").val("Enable");
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
          notie.confirm('Confirm?', 'Yes', 'Cancel', function() {
             notie.alert(1, 'Done!', 2);
        

        //make sure no white space is before or after id value
        $.trim(cust_id);
        var request="change_flag";
        //Status=QUE
        var action=9;
        $.ajax({
            url:'../controller/page_request.php?request='+request+'&action='+action+'&cust_id='+cust_id,
            success:function(result){

                BootstrapDialog.show({
                    size: BootstrapDialog.SIZE_LARGE,
                    message: 'Processed!',
                    buttons: [ {
                        label: 'Close',
                        action: function(dialogItself){
                            dialogItself.close();
                        }
                    }]
                });
                table.ajax.reload(); }

            });
    });

      });
});
</script>

</html>
