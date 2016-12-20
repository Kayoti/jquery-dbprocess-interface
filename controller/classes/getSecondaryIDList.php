
<?php
include("../../model/config.php");


    $sql = "SELECT id_val,id_name FROM id_list WHERE secondarylist='yes' order by FIELD (id_val,1,7,2,14,30,52,31,37,38,35,45,46,36,32,47,34,33,51,8,9,11,3,4,5,6,21,39,40,42,41,43,44,16,17,18)";
    //$sql = "SELECT id_val,id_name FROM id_list WHERE secondarylist='yes'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo '<option value='.$row["id_val"].'>'.$row["id_name"].'</option>';
        }
    } else {
        //echo "0 results";
    }


?>
