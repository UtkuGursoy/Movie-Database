<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
        
    include "config.php";

    $sql_statement = "DELETE FROM movies_table
     WHERE movie_id = $id";
    $result = mysqli_query($connection, $sql_statement);
    
}


header("location: /movies_step5/index.php");
exit;
?>