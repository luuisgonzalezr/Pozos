<?php
include ('db.php');


$query = 'SELECT COUNT(id) FROM pozos';
$result =  mysqli_query($conn,$query);
$stmt = $conn->prepare($query);
if($stmt->execute()){
    $result = $stmt->get_result(); // get the mysqli result
    if(!mysqli_num_rows($result) == 0){
        
        $row = $result->fetch_array();
        $numPozos = $row['COUNT(id)'];
        echo $numPozos;
        exit();
    }else{
        echo false;
        exit();
    }
    
}else{
 die ('Error recuperando pozos ' . mysqli_error($conn));
}

?>