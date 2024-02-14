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
        <a class="btn btn-primary" href="insert.php" role="button">Add Audience</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Movie ID</th>
                    <th>Audience ID</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    include "config.php"; // Makes mysql connection
                    
                    if(isset($_POST['save_name']))
                    {
                        if(!empty($_POST['name'])){
                            $audience_category = $_POST['name'];
                            $sql_statement = "SELECT * FROM audiences_table WHERE audience_category = '$audience_category'" ; 

                            $result = mysqli_query($connection, $sql_statement); // Executing query
                            
                            if(mysqli_num_rows($result) == 0){
                                echo "Database does not contain such a category";
                            }
                            else{
                                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                                    $movie_id = $row['movie_id']; 
                                    $audi_cat_id = $row['audi_cat_id'];
                                    $audience_category = $row['audience_category'];
                                    echo "
                                    <tr>
                                        <td>$movie_id</td>
                                        <td>$audi_cat_id</td>
                                        <td>$audience_category</td>
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
                            echo "Please enter a category.";
                        }
                    }

                    ?>
            
                    
                    <form action="select_audiences_by_catergory.php" method="POST">
                        <div class="container my-5">
                            Enter the category:
                                <input type="text" name="name"/>
                            <button type="submit" name="save_name" >Show</button>
                        </div>
                    </form>
            </tbody>
        </table>
    </div>    
</body>
</html>