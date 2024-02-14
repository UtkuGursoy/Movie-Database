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
        <a class="btn btn-primary" href="insert.php" role="button">Add Actor Awards</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Movie ID</th>    
                    <th>Award ID</th>
                    <th>Award Name</th>
                    <th>Award Year</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    include "config.php"; // Makes mysql connection
                    
                    if(isset($_POST['save_date']))
                    {
                        if(!empty($_POST['date'])){
                            $date = $_POST['date'];
                            $sql_statement = "SELECT * FROM actor_awards_table WHERE year = $date" ; 

                            $result = mysqli_query($connection, $sql_statement); // Executing query
                            
                            if(mysqli_num_rows($result) == 0){
                                echo "Database does not contain such an award";
                            }
                            else{
                                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                                    $movie_id = $row['movie_id'];
                                    $aaward_id = $row['aaward_id']; 
                                    $aaward_name = $row['aaward_name'];
                                    $year = $row['year'];
                                    echo "
                                    <tr>
                                        <td>$movie_id</td>
                                        <td>$aaward_id</td>
                                        <td>$aaward_name</td>
                                        <td>$year</td>
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
                            echo "Please enter a year.";
                        }
                    }

                    ?>
            
                    <form action="select_actor_awards_by_year.php" method="POST">
                        <div class="container my-5">
                            Enter the year:
                                <input type="number" name="date"/>
                            <button type="submit" name="save_date" >Show</button>
                        </div>
                    </form>
                    <form action="select_actor_awards_by_name.php" method="POST">
                        <div class="container my-5">
                            Enter the award name:
                                <input type="text" name="name"/>
                            <button type="submit" name="save_name" >Show</button>
                        </div>
                    </form>
            </tbody>
        </table>
    </div>    
</body>
</html>