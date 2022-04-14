<?php
include ('db.php');


$query = 'SELECT id FROM pozos';
$result =  mysqli_query($conn,$query);
$stmt = $conn->prepare($query);
if($stmt->execute()){
    $result = $stmt->get_result(); // get the mysqli result
    if(!mysqli_num_rows($result) == 0){
        
        while($row = $result->fetch_array()){
            $json[] = array(
                'id' => $row['id'],
            );
        }
        $jsonString = json_encode($json);
        echo $jsonString;
        exit();
    }else{
        echo false;
        exit();
    }
    
}else{
 die ('Error recuperando pozos ' . mysqli_error($conn));
}

?>