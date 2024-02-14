<?php 

include "config.php"; 

if (!empty($_POST['movie_name'])){ 
    $movie_name = $_POST['movie_name']; 
    $release_date = $_POST['release_date']; 
    $sql_statement = "INSERT INTO movies_table(movie_name, release_date) VALUES ('$movie_name',$release_date)"; 

    $result = mysqli_query($db, $sql_statement);
    echo "Your result is: " . $result;
} 
else 
{
    echo "You did not enter your name.";
}

?>
