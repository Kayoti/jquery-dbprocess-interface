
<?php
include("../../model/config.php");

    $sql = "SELECT occupation_id,occupation_name FROM occupation_list order by occupation_name";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo '<option value='.$row["occupation_id"].'>'.$row["occupation_name"].'</option>';
        }
    } else {
        //echo "0 results";
    }


?>
