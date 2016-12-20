<?php include ('includes/header.php');


?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Dashboard <small>Services Overview</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->


        <!-- /.row -->

        <div class="row">
         <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="newRequests"></div>
                            <div>New Requests !</div>
                        </div>
                    </div>
                </div>
                <a href="request.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <?php if($_SESSION['user']['level'] == 1){ ?>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-indego">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="queue"></div>
                            <div>QUEUE</div>
                        </div>
                    </div>
                </div>
                <a href="que.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="followups"></div>
                            <div>Follow-ups</div>
                        </div>
                    </div>
                </div>
                <a href="followup.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="active"></div>
                            <div>Active Clients</div>
                        </div>
                    </div>
                </div>
                <a href="client.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <?php } ?>
        <!-- Admin Have access to User List  -->
        <?php if($_SESSION['user']['username'] == 'admin'){ ?>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-purple">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-fw fa-user"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge" id="userCnt"></div>
                    <div>Users</div>
                </div>
              </div>

            </div>
            <a href="userList.php">
              <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
              </div>
            </a>
          </div>

        </div>
        <?php } ?>
        <!-- Admin Have access to User List End  -->
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
       var action=0;
       var request="get_totals";
       $.ajax({
           url:'../controller/page_request.php?request='+request+'&action='+action,
           success:function(result){
              var obj1 = $.parseJSON(result);

              $("#newRequests").html(obj1.NA);
						//followups
						var followups = obj1.ERR + obj1.IP + obj1.DA;
						$("#followups").html(followups);
						//active
						$("#active").html(obj1.AC);
						//queue
						$("#queue").html(obj1.QUE);
            //user count
						$("#userCnt").html(obj1.USER_COUNT);

					}

				});
   });

</script>


</html>
