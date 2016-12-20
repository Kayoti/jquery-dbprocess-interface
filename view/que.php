<?php include('includes/header.php');?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    QUEUE <small>List</small>
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
                <?php if($_SESSION['user']['username'] == 'admin'){ ?>
                <div class="col-xs-9 text-right">
                      <input data-toggle='modal' href='#form-content' value='Process All' class='btn btn-lg btn-primary' id="lockAllItem" type='button' />
                </div>
                <?php } ?>
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
          notie.confirm('Confirm?', 'Yes', 'Cancel', function() {
             notie.alert(1, 'Done!', 2);


        //make sure no white space is before or after id value
        $.trim(cust_id);
        //Status=QUE
        var action=3;

        //reassign request to handle que processing
        var request="process";
        $.ajax({
            url:'../controller/dc_request.php?request='+request+'&action='+action+'&cust_id='+cust_id,
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

    // Process All Button Click Function Start
    $( "#lockAllItem" ).click(function() {

      var action = 3;
      var request="processAll";
      $.ajax({
          url:'../controller/dc_request.php?request='+request+'&action='+action+'&cust_id=',
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
              table.ajax.reload();
            }

          });


  });
  // Process All Button Click Function End



});
</script>

</html>
