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
        <a class="btn btn-primary" href="insert.php" role="button">Add Monetary</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Movie ID</th>    
                    <th>Critics ID</th>
                    <th>Platform Name</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "config.php";
                     
                    $sql_statement = "SELECT * FROM monetary_table"; 
                    $result = mysqli_query($connection, $sql_statement); // Executing query
                    
                    if(!$result){
                        die("Invalid query: " . $connection->error );
                    }
                    
                    while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                        $movie_id = $row['movie_id'];
                        $studio_id = $row['studio_id']; 
                        $budget = $row['budget'];
                        $production_cost = $row['production_cost'];
                        echo "
                        <tr>
                            <td>$studio_id</td>
                            <td>$movie_id</td>
                            <td>$budget</td>
                            <td>$production_cost</td>
                            <td>
                                <a class='btn btn-danger btn-sm' href='delete.php?id=$studio_id'>Delete</a>
                            </td>
                            </tr>
                            "; 
                    } 
                    ?>
            </tbody>
        </table>
    </div>    
</body>
</html>