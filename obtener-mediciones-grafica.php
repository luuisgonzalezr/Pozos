<?php 
include ('db.php');

$pozo = $_GET['pozo'];


$query = "SELECT * FROM (SELECT * FROM mediciones ORDER BY fecha DESC LIMIT 10 ) mediciones WHERE pozo = $pozo ORDER BY fecha";

$stmt = $conn->prepare($query);
if($stmt->execute()){
    $result = $stmt->get_result(); 
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