<?php
include ('../model/config.php');

//protected $url = "http://192.168.0.16/CardAPI/1.11/SOAPService/CashSlab.asmx?WSDL";
 $url = "http://192.168.70.9/Integration/1.11/SOAPService/CashSlab.asmx?WSDL";
//  $UserName = "cashslab";
//  $psw = "CashSlab15";
  $UserName = "CashSlab2";
  $psw = "APIOnly00";
  $SessionCode;
  $istest = 0;
  $BINID = 81;

  $BINIDtest = 7;
  $BINIDlive = 81;
  $PANHash = '' ;
  $WalletNumber = '';
  $PartialPAN = 'PERSONALIZE' ;
  $AccountClassID = 40;
  $eatit = "40";

  $_soap_data=array();

  //if($islve)
   //$this->BINID = $this->BINIDlive;


   $soapClient = new SoapClient($url, array('trace' => 1));


  // Setup the RemoteFunction parameters
  $ap_param = array('UserName'=>$UserName,
            'UserPassword'=>$psw);
  // Call RemoteFunction ()
  $Sessioninfo = $soapClient->GetUserSession($ap_param);
  $SessionCode =  $Sessioninfo->GetUserSessionResult->SessionCode;




  $sql="SELECT `cardinfo`.`card_id`,`cardinfo`.`cust_id`,`cardinfo`.`PANHash`,`cardinfo`.`WalletNumber`,`cardinfo`.`CreatedCardnumber`,
`cardinfo`.`ReferenceNumber`,`cardinfo`.`Balance`,`cardinfo`.`createdon`,`cardinfo`.`lastmodified` FROM `DCBank`.`cardinfo`
WHERE `cardinfo`.`cust_id` = 127";

$sqlQuery=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($sqlQuery);




$PANHash=$row['PANHash'];
$WalletNumber=$row['WalletNumber'];

            $cardAccount = array('PANHash' => $PANHash,
                    'BINID' => $BINID,
                    'PartialPAN' => $PartialPAN,
                    'WalletNumber' => $WalletNumber
                    );
            $ap_param = array('UserSession' =>array('UserName'=>$UserName,'SessionCode'=>$SessionCode),
                      'CardAccountID' => $cardAccount,
                      );

                      echo "<br />";
                      print_r($ap_param);
                      echo "<br />";


            $NProductinfo = $soapClient->GetProductReloadOptions($ap_param);
            //$ReloadOptions = $NProductinfo->GetProductReloadOptionsResult;

            echo "<pre>";
            print_r($NProductinfo);

            echo "</pre>";

            $ReloadOptions = $NProductinfo->GetProductReloadOptionsResult;

            $availBalance=$ReloadOptions->AvailBalance;

            echo "availBalance - ".$availBalance;
?>
