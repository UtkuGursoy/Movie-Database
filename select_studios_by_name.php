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
        <a class="btn btn-primary" href="insert.php" role="button">Add Studios</a>
        <br>
        <table class="table">
        <thead>
                <tr>
                    <th>Movie ID</th>
                    <th>Studio ID</th>
                    <th>Studio Name</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    include "config.php"; // Makes mysql connection
                    
                    if(isset($_POST['save_name']))
                    {
                        if(!empty($_POST['name'])){
                            $name = $_POST['name'];
                            $sql_statement = "SELECT * FROM studios_table WHERE studio_name = '$name'" ; 

                            $result = mysqli_query($connection, $sql_statement); // Executing query
                            
                            if(mysqli_num_rows($result) == 0){
                                echo "Database does not contain such a studio";
                            }
                            else{
                                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                                    $movie_id = $row['movie_id'];
                                    $studio_id = $row['studio_id']; 
                                    $studio_name = $row['studio_name'];
                                    echo "
                                    <tr>
                                        <td>$movie_id</td>
                                        <td>$studio_id</td>
                                        <td>$studio_name</td>
                                        <td>
                                            <a class='btn btn-danger btn-sm' href='delete.php?id=$movie_id'>Delete</a>
                                        </td>
                                        </tr>
                                        "; 
                                } 
                            } 

                        }
                        else
                        {
                            echo "Please enter a name.";
                        }
                    }

                    ?>
            
                    
                    <form action="select_studios_by_name.php" method="POST">
                        <div class="container my-5">
                            Enter the studio name:
                                <input type="text" name="name"/>
                            <button type="submit" name="save_name" >Show</button>
                        </div>
                    </form>
            </tbody>
        </table>
    </div>    
</body>
</html>