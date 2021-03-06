<?php include('includes/header.php');?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Active Clients <small>List</small>
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
                            <th>Balance</th>
                            <th>Retrieve Current Balance</th>
                            <th>EDIT INFO</th>
                            <th>RELOAD CARD</th>
                            <th>DISABLE CLIENT</th>

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
            this.action = 9;
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
    { data: 'Balance' },
    { data: 'button4' },
    { data: 'button1' },
    { data: 'button2' },
    { data: 'button3' }
    ]
});

    /***
        Event triggers customer information display
        updates DB with locked flag ->limits view to current user
        ***/
        $(".lock_item").live('click', function(event){
        //get the ID
        cust_id=$(this).attr('id');
        locked = 1;
            //make sure no white space is before or after id value
            $.trim(cust_id);
            var request="review";
            //Status=active APP
            var action=9;

            $.ajax({
                url:'../controller/page_request.php?request='+request+'&action='+action+'&cust_id='+cust_id,

                success:function(result){
                    var obj1 = $.parseJSON(result);
                        //Load Dropdown Options
                        var options = '<option title="" value="0">--EMT STATUS--</option>';

                        for (var i = 0; i < obj1.EAL.length; i++) {
                            options += '<option value="' + obj1.EAL[i].ps_id + '">' + obj1.EAL[i].display + '</option>';
                        }
                        $("#audit_emt").html(options);
                        var options = '<option title="" value="0">--INFO STATUS--</option>';

                        for (var i = 0; i < obj1.IAL.length; i++) {
                            options += '<option value="' + obj1.IAL[i].ps_id + '">' + obj1.IAL[i].display + '</option>';
                        }
                        $("#audit_info").html(options);
                        var options = '<option title="" value="0">--CONTRACT STATUS--</option>';
                        for (var i = 0; i < obj1.CAL.length; i++) {
                            options += '<option value="' + obj1.CAL[i].ps_id + '">' + obj1.CAL[i].display + '</option>';
                        }
                        $("#audit_contract").html(options);

                        if(obj1.islocked == 0)
                        {
                            //Populate fields
                            //CUSTOMER ID

                            //banking
                            $("#emt").val(obj1.initloadamount);
                            $("#emt_pass").val(obj1.psw);

                            //info
                            $("#createdDate").html(obj1.createdOn);
                            $("#tag").val(obj1.cust_id);
                            $("#firstname").val(obj1.firstname);
                            //$("#middleName").val(obj1.midname);
                            $("#lastname").val(obj1.lastname);
                            $("#hphone").val(obj1.homephone);
                            $("#phone").val(obj1.cellphone);
                            $("#email").val(obj1.email);
                            $("#gender").val(obj1.sex);
                            $("#DOB").val(obj1.dob);
                            $("#SIN").val(obj1.sin);
                            $("#secret").val(obj1.secret);
                            $("#occupation").val(obj1.occupationID);
                            $("#mmn").val(obj1.motherInfo);
                            $("#agent").val(obj1.agent);
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


                            //contract
  							var filepath="http://canadacreditcard.ca/docs/pdfs/";
  							var ccpdfname=obj1.lastname+"_"+obj1.firstname;
  							var ccagreementfile=filepath+ccpdfname+"/"+ccpdfname+"_CC_Agreement.pdf";
  							$("#ccagreement").html('<a href="'+ccagreementfile+'" target="_blank">CC Agreement</a>');

  							var ilockagreementfile=filepath+ccpdfname+"/"+ccpdfname+"_iLock_Agreement.pdf";
  							$("#ilockagreement").html('<a href="'+ilockagreementfile+'" target="_blank">Identity Lock Agreement</a>');



                            //if(obj1.contract_id==18){$('#contract_checkbox').bootstrapToggle('on')}else{$('#contract_checkbox').bootstrapToggle('off')}
                            $("#audit_emt").val(obj1.emt_id);
                            if(obj1.emt_id==12){$('#emt_checkbox').bootstrapToggle('on')}else{$('#emt_checkbox').bootstrapToggle('off')}
                            $("#audit_info").val(obj1.info_id);
                            if(obj1.info_id==6){$('#info_checkbox').bootstrapToggle('on')}else{$('#info_checkbox').bootstrapToggle('off')}
                            $("#audit_contract").val(obj1.contract_id);
                            //status checkbox this.prop('checked')

                        if(obj1.contract_id==18){$('#contract_checkbox').bootstrapToggle('on')}else{$('#contract_checkbox').bootstrapToggle('off')}
                        $("#comments_area").html(obj1.COMMENT);
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
$('#audit_emt').change(function(){
    if($('#audit_emt').val() == 12) {
        $('#emt_checkbox').bootstrapToggle('on')
    } else {
        $('#emt_checkbox').bootstrapToggle('off')
    }
});
$('#audit_info').change(function(){
    if($('#audit_info').val() == 6) {
        $('#info_checkbox').bootstrapToggle('on')
    } else {
        $('#info_checkbox').bootstrapToggle('off')
    }
});

$('#audit_contract').change(function(){
    if($('#audit_contract').val() == 18) {
        $('#contract_checkbox').bootstrapToggle('on')
    } else {
        $('#contract_checkbox').bootstrapToggle('off')
    }
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
$('.submit_info').live('click', function(event){
    var action=9;
     var request="change_flag";
    notie.confirm('Confirm?', 'Yes', 'Cancel', function() {
     notie.alert(1, 'Done!', 2);

            //alert($('#info_form').serialize());
            $.ajax({
                url:'../controller/page_request.php?request='+request+'&action='+action,
                data:$('#info_form').serialize(),
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
$(".disable").live('click', function(event){
     var action=5;
         var request="change_flag";
        //Status=unlocked=0 must be used but has no effect here
        notie.confirm('Confirm?', 'Yes', 'Cancel', function() {
         notie.alert(1, 'Done!', 2);

         //get the ID
         cust_id=$(this).attr('id');

            //make sure no white space is before or after id value
            $.trim(cust_id);
            $.ajax({
                url:'../controller/page_request.php?request='+request+'&action='+action+'&cust_id='+cust_id,
                success:function(result){table.ajax.reload();}

            });
        });
    });
$(".reload").live('click', function(event){
        //get the ID
        var cust_id=$(this).attr('id');
        //action has no function here
        var action=0;
        var request="reload_man";
        var loadamount=0.00;
        notie.input('Please Enter Amount (CAD):', 'Submit', 'Cancel', 'text', 'Example 5.00 or 89.99:', function(loadamount) {


        //Status=unlocked=0 must be used but has no effect here
        notie.confirm('Confirm Amount: '+loadamount, 'Yes', 'Cancel', function() {

        //make sure no white space is before or after id value
            $.trim(cust_id);
            $.ajax({
                url:'../controller/dc_request.php?request='+request+'&action='+action+'&cust_id='+cust_id+'&loadamount='+loadamount,
                success:function(result){
                    notie.alert(1, 'Done!', 2);
                    table.ajax.reload();
                }

            });
        });
     });
    });

$(".Availbalance").live('click', function(event){
    //get the ID
    var cust_id=$(this).attr('id');
    //action has no function here
    var action=0;
    var request="availbalance";
    //alert(cust_id)
    $.trim(cust_id);
    $.ajax({
        url:'../controller/dc_request.php?request='+request+'&action='+action+'&cust_id='+cust_id,
        success:function(result){
            console.log(result);
             $("#"+cust_id).hide();
             $("#client"+cust_id).html(result);
            /*notie.alert(1, 'Done!', 2);
            table.ajax.reload();*/
        }

    });


    /*notie.input('Please Enter Amount (CAD):', 'Submit', 'Cancel', 'text', 'Example 5.00 or 89.99:', function(loadamount) {


    //Status=unlocked=0 must be used but has no effect here
    notie.confirm('Confirm Amount: '+loadamount, 'Yes', 'Cancel', function() {

    //make sure no white space is before or after id value
        $.trim(cust_id);
        $.ajax({
            url:'../controller/dc_request.php?request='+request+'&action='+action+'&cust_id='+cust_id+'&loadamount='+loadamount,
            success:function(result){
                notie.alert(1, 'Done!', 2);
                table.ajax.reload();
            }

        });
    });
}); */
});


$(".exit").live('click', function(event){
        //Status=unlocked=0 must be used but has no effect here

        var action=0;
        var request="unlock_app";
        $.ajax({
            url:'../controller/page_request.php?request='+request+'&action='+action+'&cust_id='+cust_id,
            success:function(result){table.ajax.reload();}

        });
    });
$("#add_comment").live('click', function(event){
        //Status=NEW APP must be used but has no effect here
        var action=0;
        var request="add_comment";
        $.ajax({
            url:'../controller/page_request.php?request='+request+'&action='+action+'&cust_id='+cust_id+'&info_comment='+$('#info_comment').val(),
            success:function(result){
                $("#comments_area").html(result);
                table.ajax.reload();

            }

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
