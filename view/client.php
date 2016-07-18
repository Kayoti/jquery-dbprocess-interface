<?php include ('includes/header.php');


?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Clients<small>  Overview</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-user"></i> Clients
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->

        <div class="row">



            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id="active"></div>
                                <div>Clients</div>
                            </div>
                        </div>
                    </div>
                    <a href="active.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id="newRequests"></div>
                                <div>Reload Requests !</div>
                            </div>
                        </div>
                    </div>
                    <a href="reload.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id="reload_err"></div>
                                <div>Reload Follow-ups</div>
                            </div>
                        </div>
                    </div>
                    <a href="reload_error.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
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
    var action=0;
    var request="get_totals";
    $.ajax({
        url:'../controller/page_request.php?request='+request+'&action='+action,
        success:function(result){
            var obj1 = $.parseJSON(result);
            //new reload requests count
            $("#newRequests").html(obj1.RELOAD_NEW);
            //reload requests errors count
            $("#reload_err").html(obj1.RELOAD_ERR);
            //active clients count
            var active = obj1.AC;
            $("#active").html(active);

        }

    });
});

</script>


</html>
