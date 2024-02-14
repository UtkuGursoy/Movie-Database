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
        <a class="btn btn-primary" href="index.php" role="button">Go Back <</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Director Name</th>
                    <th>Movie Name</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    include "config.php";
                    
                    $sql_statement = "SELECT * FROM directs;"; 
                    $result = mysqli_query($connection, $sql_statement); // Executing query
                    
                    if(!$result){
                        die("Invalid query: " . $connection->error );
                    }
                    
                    while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                        $d_name = $row['director_name']; 
                        $m_name = $row['movie_name']; 
                        echo "
                        <tr>
                            <td>$d_name</td>
                            <td>$m_name</td>
                            
                        </tr>
                            "; 
                    } 
                    ?>
                    
                    
            </tbody>
        </table>
    </div>    
</body>
</html>