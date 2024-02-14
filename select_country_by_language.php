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
        <a class="btn btn-primary" href="insert.php" role="button">Add Country</a>
        <br>
        <table class="table">
        <thead>
                <tr>
                    <th>Movie ID</th>    
                    <th>Country ID</th>
                    <th>Country Name</th>
                    <th>Language</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    include "config.php"; // Makes mysql connection
                    
                    if(isset($_POST['save_name']))
                    {
                        if(!empty($_POST['name'])){
                            $name = $_POST['name'];
                            $sql_statement = "SELECT * FROM country_table WHERE language = '$name'" ; 

                            $result = mysqli_query($connection, $sql_statement); // Executing query
                            
                            if(mysqli_num_rows($result) == 0){
                                echo "Database does not contain such a language";
                            }
                            else{
                                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                                    $movie_id = $row['movie_id'];
                                    $country_id = $row['country_id']; 
                                    $country_name = $row['country_name'];
                                    $language = $row['language'];
                                    echo "
                                    <tr>
                                        <td>$movie_id</td>
                                        <td>$country_id</td>
                                        <td>$country_name</td>
                                        <td>$language</td>
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
                            echo "Please enter a language.";
                        }
                    }

                    ?>
                    <form action="select_country_by_name.php" method="POST">
                        <div class="container my-5">
                            Enter the country name:
                                <input type="text" name="name"/>
                            <button type="submit" name="save_name" >Show</button>
                        </div>
                    </form>
                    <form action="select_country_by_language.php" method="POST">
                        <div class="container my-5">
                            Enter the language:
                                <input type="text" name="name"/>
                            <button type="submit" name="save_name" >Show</button>
                        </div>
                    </form>

            </tbody>
        </table>
    </div>    
</body>
</html>