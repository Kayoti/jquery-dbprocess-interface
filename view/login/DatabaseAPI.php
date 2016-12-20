<?php
require("../../model/login_config.php");



 $url = "http://192.168.0.16/CardAPI/1.11/SOAPService/CashSlab.asmx?WSDL";
 $UserName = "cashslab";
 $psw = "CashSlab15";
 $SessionCode;
 $istest = 0;
 $BINID = 7;
 $BINIDtest = 7;
 $BINIDlive = 81;
 $PANHash = '' ;
 $WalletNumber = '';
 $PartialPAN = 'PERSONALIZE' ;
 $AccountClassID = 40;
 $_soap_data="";

 $BINID = $BINIDtest;

$cardDetails = array('BINID'=>$BINID,
     'PartialPAN' => $PartialPAN);
$soapClient = new SoapClient($url, array('trace' => 1));

$ap_param = array('UserName'=>$UserName,
          'UserPassword'=>$psw);
// Call RemoteFunction ()
$Sessioninfo = $soapClient->GetUserSession($ap_param);

echo "<br> GetUserSession : <br>";
echo "<pre>";
print_r($Sessioninfo);

$SessionCode =  $Sessioninfo->GetUserSessionResult->SessionCode;
//return $this->SessionCode;
echo $ResponseCode=$Sessioninfo->GetUserSessionResult->ResponseCode;

if($ResponseCode == 0){

$ap_param = array('UserSession' => array('UserName'=>$UserName,'SessionCode'=>$SessionCode),
          'NewCardAccountID' => $cardDetails,
          'AccountClassID' => $AccountClassID
          );
  // Call RemoteFunction ()
  $Productinfo = $soapClient->GetNewProductOptions($ap_param);




echo "<br> GetNewProductOptions : <br>";
echo "<pre>";
print_r($Productinfo);

$provinceList=$Productinfo->GetNewProductOptionsResult->StateProvinceList->StateProvince;
echo "<br>****************Province List ********************<br>";
foreach($provinceList as $key => $value){
  $StateProvID=$provinceList[$key]->StateProvID;
  $StateProvShortName=$provinceList[$key]->StateProvShortName;
  $StateProvName=$provinceList[$key]->StateProvName;

  echo $StateProvID."  -  ".$StateProvShortName."  -  ".$StateProvName;
  echo "<br>";

}
echo "<br><br><br>**************** PrimaryID List ********************<br>";

$PrimaryIDList=$Productinfo->GetNewProductOptionsResult->PrimaryIDList->IDTypes;

foreach($PrimaryIDList as $key => $value){
$IDType=$PrimaryIDList[$key]->IDType;
$IDDesc=$PrimaryIDList[$key]->IDDesc;
$IssueLocationRequired=$PrimaryIDList[$key]->IssueLocationRequired;

echo $IDType."  -  ".$IDDesc."  -  ".$IssueLocationRequired;
echo "<br>";

}

echo "<br><br><br>**************** SecondaryID List ********************<br>";

$SecondaryIDList=$Productinfo->GetNewProductOptionsResult->SecondaryIDList->IDTypes;

foreach($SecondaryIDList as $key => $value){
$IDType=$SecondaryIDList[$key]->IDType;
$IDDesc=$SecondaryIDList[$key]->IDDesc;
$IssueLocationRequired=$SecondaryIDList[$key]->IssueLocationRequired;

echo $IDType."  -  ".$IDDesc."  -  ".$IssueLocationRequired;
echo "<br>";

}


echo "<br><br><br>**************** Account Purpose List ********************<br>";

$AccountPurposeList=$Productinfo->GetNewProductOptionsResult->AccountPurposeList->AccountPurposes;
foreach($AccountPurposeList as $key => $value){
$AccountPurpose=$AccountPurposeList[$key]->AccountPurpose;
$AccountPurposeDesc=$AccountPurposeList[$key]->AccountPurposeDesc;

echo $AccountPurpose."  -  ".$AccountPurposeDesc;
echo "<br>";

}
echo "<br><br><br>**************** Occupation List ********************<br>";

$OccupationList=$Productinfo->GetNewProductOptionsResult->OccupationList->Occupation;
foreach($OccupationList as $key => $value){
$OccupationID=$OccupationList[$key]->OccupationID;
$OccupationDesc=$OccupationList[$key]->OccupationDesc;

echo $OccupationID."  -  ".$OccupationDesc;
echo "<br>";

}

echo "<br><br><br>**************** SourceFunds List ********************<br>";

$SourceFundsList=$Productinfo->GetNewProductOptionsResult->SourceFundsList->SourceFunds;
foreach($SourceFundsList as $key => $value){
$SourceCode=$SourceFundsList[$key]->SourceCode;
$SourceDesc=$SourceFundsList[$key]->SourceDesc;

echo $SourceCode."  -  ".$SourceDesc;
echo "<br>";

}
}
exit;


/*$productOptions = json_decode(json_encode($Productinfo->GetNewProductOptionsResult), true);
echo "<br> GetNewProductOptions : <br>";
//print_r($productOptions);

$_soap_data_Tot=array();
$_soap_data1=array();


$query="SELECT  `customer`.`cust_id`, `customer`.`firstname`, `customer`.`lastname`, `customer`.`homephone`,  `customer`.`cellphone`,
`customer`.`status`,  `customer`.`msg`,  `customer`.`secret`,  `customer`.`psw`,  `customer`.`motherInfo`,  `customer`.`occupationID`,
`customer`.`dob`,  `customer`.`sex`,  `customer`.`agent`,  `customer`.`initloadamount`,  `customer`.`email`,  `customer`.`islocked`,
`banking`.`banking_id`,  `banking`.`institute`,  `banking`.`transit`,  `banking`.`account`,  `address`.`address_id` ,  `address`.`level` ,
`address`.`line1` ,  `address`.`line2` ,  `address`.`city` ,  `address`.`stateprovID` ,  `address`.`StateProvName` ,  `address`.`PostalCode` ,
`address`.`StartDate` ,  `address`.`EndDate` ,  `prevAdd`.`address_id` prev_address_id,  `prevAdd`.`level` prev_level,  `prevAdd`.`line1` prev_line1,
`prevAdd`.`line2` prev_line2,  `prevAdd`.`city` prev_city,  `prevAdd`.`stateprovID` prev_stateprovID,  `prevAdd`.`StateProvName` prev_StateProvName,
`prevAdd`.`PostalCode` prev_PostalCode,  `prevAdd`.`StartDate` prev_StartDate,  `prevAdd`.`EndDate` prev_EndDate,  `ID`.`id_id` as pid,
`ID`.`type` as ptype,  `ID`.`number` as pnumber,  `ID`.`expire` as pexpire,  `ID`.`place` as pplace,  sec.`id_id` as sid,  sec.`type` as stype,
sec.`number` as snumber,  sec.`expire` as sexpire,  sec.`place` as splace,  `app_process`.`CP_id`,  `app_process`.`emt`,  `app_process`.`bank`,
`app_process`.`contract`,  `app_process`.`info`,  `app_process`.`emt_id`,  `app_process`.`bank_id`,  `app_process`.`contract_id`,
`app_process`.`info_id`  FROM `TestDC`.`customer`
  inner join `TestDC`.`address` on `address`.`cust_id` = `customer`.`cust_id` and `address`.`level` = 0
  inner join `TestDC`.`address` prevAdd on (`prevAdd`.`cust_id` = `customer`.`cust_id` and `prevAdd`.`level` = 1)
  inner Join `TestDC`.`banking` on `banking`.`cust_id` = `customer`.`cust_id`
  inner join `TestDC`.`ID` on (`ID`.`cust_id` = `customer`.`cust_id` and `ID`.`primary` = 0)
  inner join `TestDC`.`ID` sec on (sec.`cust_id` = `customer`.`cust_id` and sec.`primary` = 1)
  inner join `TestDC`.`app_process` on `app_process`.`cust_id` = `customer`.`cust_id`
WHERE  `customer`.`status` = 3 ";

$stmt = $db->prepare($query);
$result = $stmt->execute();
while($data = $stmt->fetch()){

$CustomerIDSet=array();
//array('UserName'=>$this->UserName,'SessionCode'=>$this->SessionCode);
$_soap_data['UserSession'] = array('UserName'=>$UserName,'SessionCode'=>$SessionCode);
$_soap_data['NewCardAccountID'] = $cardDetails;

$options = $productOptions;
$primary = $options['PrimaryIDList']['IDTypes'][$data["ptype"]];
$secondary = $options['SecondaryIDList']['IDTypes'][$data["stype"]];
//if($primary['IssueLocationRequired'])

$provlist = $options['StateProvinceList']['StateProvince'];

foreach($provlist as $key => $value)
{
  if ($value['StateProvShortName'] == $data["pplace"])
    $StateProvID=$value['StateProvID'];
}

$primaryid['StateProvID'] = $StateProvID;

//if($primary['ExpiryDateRequired'])
$primaryid['ExpiryDate'] = date("Ymd",strtotime($data["pexpire"]));
$primaryid['Type'] = $data["ptype"];
$primaryid['Number'] = $data["pnumber"];


$provlist1 = $options['StateProvinceList']['StateProvince'];
foreach($provlist1 as $key => $value)
{
  if ($value['StateProvShortName'] == $data["splace"])
    $StateProvID1=$value['StateProvID'];
}
//if($secondary['IssueLocationRequired'])
$secondaryid['IssueStateProvName'] = $StateProvID1;
//if($secondary['ExpiryDateRequired'])
$secondaryid['ExpiryDate'] = date("Ymd",strtotime($data["sexpire"]));
$secondaryid['Type'] = $data["stype"];
$secondaryid['Number'] = $data["snumber"];


$CustomerIDSet[] = $primaryid;
$CustomerIDSet[] = $secondaryid;



$_soap_data['CustomerIDSet'] = $CustomerIDSet;
$_soap_data['CustomerAddressSet'][0] = array("Type" => 0,
                    "Line1" => $data["line1"],
                  //"Line2" => $data["line2"],
                  "City" => $data["city"],
                  "StateProvName" => $data["StateProvName"],
                  "PostalCode" => preg_replace('/\s+/', '', $data["PostalCode"])
                  );
$_soap_data['AccountClassID'] = 40;
$_soap_data['LoadAmount'] = money_format('%i', $data["initloadamount"]);
$_soap_data['AccountPurpose'] = 3;

 $_soap_data['FirstName'] = $data["firstname"];
 $_soap_data['LastName'] = $data["lastname"];
 $_soap_data['DOB'] = date("Ymd",strtotime($data["dob"]));
 $_soap_data['Sex'] = $data["sex"];
 $_soap_data['EmailAddress'] = $data["email"];
 $_soap_data['HomePhone'] = $data["homephone"];
 $_soap_data['CellPhone'] = $data["cellphone"];

 $_soap_data['OccupationID'] = $data["occupationID"];
 $_soap_data['KYCCheckCode'] = 3;


$_soap_data1[]=$_soap_data;
}

echo "<br>INPUT<br>";
print_r($_soap_data1);
$NProductinfo = $soapClient->CreateNewProduct($_soap_data1);

echo "<br>OUTPUT<br>";
print_r($NProductinfo); */


?>
