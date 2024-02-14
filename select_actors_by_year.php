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
        <a class="btn btn-primary" href="insert.php" role="button">Add Actors</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Movie ID</th>
                    <th>Actor ID</th>
                    <th>Actor Name</th>
                    <th>Birth Year</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    include "config.php"; // Makes mysql connection
                    
                    if(isset($_POST['save_birthdate']))
                    {
                        if(!empty($_POST['birthdate'])){
                            $birthdate = $_POST['birthdate'];
                            $sql_statement = "SELECT * FROM actors_table WHERE birthdate = $birthdate" ; 

                            $result = mysqli_query($connection, $sql_statement); // Executing query
                            
                            if(mysqli_num_rows($result) == 0){
                                echo "Database does not contain such a movie";
                            }
                            else{
                                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                                    $movie_id = $row['movie_id'];
                                    $actor_id = $row['actor_id']; 
                                    $a_name = $row['actor_name'];
                                    $birthdate = $row['birthdate'];
                                    echo "
                                    <tr>
                                        <td>$movie_id</td>
                                        <td>$actor_id</td>
                                        <td>$a_name</td>
                                        <td>$birthdate</td>
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
            
                    <form action="select_actors_by_year.php" method="POST">
                        <div class="container my-5">
                            Enter the birthdate:
                                <input type="number" name="birthdate"/>
                            <button type="submit" name="save_birthdate" >Show</button>
                        </div>
                    </form>
                    <form action="select_actors_by_name.php" method="POST">
                        <div class="container my-5">
                            Enter the actor name:
                                <input type="text" name="name"/>
                            <button type="submit" name="save_name" >Show</button>
                        </div>
                    </form>
            </tbody>
        </table>
    </div>    
</body>
</html>