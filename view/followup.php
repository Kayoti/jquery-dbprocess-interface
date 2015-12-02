<?php include ('includes/header.php');?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Follow-up <small>Follow-ups Overview</small>
                </h1>
                <ol class="breadcrumb">
                 
                 <li class="active">
                    <i class="fa fa-phone"></i> Follow-Up
                </li>
                
            </ol>
        </div>
    </div>
    <!-- /.row -->

    
    <!-- /.row -->

    <div class="row">
       <div class="col-lg-6 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div >DCBANK ERRORS</div>
                        <div class="huge" id="DC_ERROR" ></div>
                    </div>
                </div>
            </div>
            <a href="dc_error.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div >Disabled Clients</div>
                        <div id="Disabled" class="huge"></div>
                    </div>
                </div>
            </div>
            <a href="disabled.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
        
    </div>

					 <!--<div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Contract Errors</div>
                                        <div>30</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>    
                    </div>
					
					<div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Dead Apps</div>
                                        <div>30</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                  
                   
                    
                    </div>-->
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
                    
                    
                    var followups = obj1.ERR;
                    var disabled = obj1.DCA;
                    $("#DC_ERROR").html(followups);
                    $("#Disabled").html(disabled);
                    
                }
                
            });
        });
        
    </script>

    </html>
