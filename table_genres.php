<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieBox</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

</head>
<body>
<div class="container my-5">
        <h2>MovieBox</h2>
        <a class="btn btn-primary" href="insert.php" role="button">Add Genres</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Movie ID</th>
                    <th>Genre ID</th>
                    <th>Genre Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "config.php";
                     
                    $sql_statement = "SELECT * FROM genres_table"; 
                    $result = mysqli_query($connection, $sql_statement); // Executing query
                    
                    if(!$result){
                        die("Invalid query: " . $connection->error );
                    }
                    
                    while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                        $movie_id = $row['movie_id'];
                        $genre_id = $row['genre_id']; 
                        $genre_name = $row['genre_name'];
                        echo "
                        <tr>
                            <td>$movie_id</td>
                            <td>$genre_id</td>
                            <td>$genre_name</td>
                            <td>
                                <a class='btn btn-danger btn-sm' href='delete.php?id=$movie_id'>Delete</a>
                            </td>
                            </tr>
                            "; 
                    } 
                    ?>

                    <form action="select_genres_by_name.php" method="POST">
                        <div class="container my-5">
                            Enter the genre name:
                                <input type="text" name="name"/>
                            <button type="submit" name="save_name" >Show</button>
                        </div>
                    </form>
            </tbody>
        </table>
    </div>    
</body>
</html>