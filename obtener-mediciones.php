<?php 
include ('db.php');

$pozo = $_GET['pozo'];


$query = "SELECT * FROM mediciones WHERE pozo = $pozo";
$stmt = $conn->prepare($query);
if($stmt->execute()){
    $result = $stmt->get_result(); // get the mysqli result
    if(!mysqli_num_rows($result) == 0){
        while($row = $result->fetch_array()){
            $json[] = array(
                'fecha' => $row['fecha'],
                'hora' => $row['hora'],
                'medicion' => $row['medicion']
            );
        }
        $jsonString = json_encode($json);
        echo $jsonString;
     exit();
    }else{
        die();
    }
    
}else{
 die ('Error recuperando mediciones ' . mysqli_error($connection));
}
?>