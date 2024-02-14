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
        <a class="btn btn-primary" href="insert.php" role="button">New Movie</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Movie Name</th>
                    <th>Release Year</th>
                    <th>Sold Ticket Number</th>
                    <th>Duration (min)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include "config.php"; // Makes mysql connection
                    
                    if(isset($_POST['save_year']))
                    {
                        if(!empty($_POST['years'])){
                            $release_year = $_POST['years'];
                            $sql_statement = "SELECT * FROM movies_table WHERE release_date = $release_year" ; 

                            $result = mysqli_query($connection, $sql_statement); // Executing query
                            
                            if(mysqli_num_rows($result) == 0){
                                echo "Database does not contain such a movie";
                            }
                            else{
                                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                                    $movie_id = $row['movie_id']; 
                                    $m_name = $row['movie_name']; 
                                    $m_year = $row['release_date'];
                                    $m_ticket = $row['tickets_sold'];
                                    $m_duration = $row['duration'];
                                    echo "
                                    <tr>
                                        <td>$movie_id</td>
                                        <td>$m_name</td>
                                        <td>$m_year</td>
                                        <td>$m_ticket</td>
                                        <td>$m_duration</td>
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
            
                                   
                    <form action="select_by_ticket.php" method="POST">

                        <div class="container my-5">
                            <head>
                            <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
                            <link rel="stylesheet" href="/resources/demos/style.css">
                            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                            <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
                            <script>
                                $( function() {
                                    $( "#slider-range" ).slider({
                                    range: true,
                                    min: 0,
                                    max: 1000000000,
                                    values: [ 1000000, 5000000 ],
                                    slide: function( event, ui ) {
                                        $( "#amount1" ).val( ui.values[ 0 ]);
                                        $( "#amount2" ).val( ui.values[ 1 ]);
                                    }
                                    });
                                    $( "#amount1" ).val( $( "#slider-range" ).slider( "values", 0 ));
                                    $( "#amount2" ).val( $( "#slider-range" ).slider( "values", 1 ));

                                } );
                            </script>
                            </head>

                            <body>
                                <p>
                                <label for="amount">Sold tickets range:</label>
                                <input type="text" name="tickets1" id="amount1" style="border:0; color:#f6931f; font-weight:bold;">
                                <input type="text" name="tickets2" id="amount2" style="border:0; color:#f6931f; font-weight:bold;">
                                </p>
                                
                                <div id="slider-range"></div>
                                <br>
                                <button type="submit" name="save_ticket">SELECT</button>
                                <br>
                            </body>
                        </div>
                    </form>

                    <form action="select_by_duration.php" method="POST">
                                    
                        <div class="container my-5">
                            <p>
                            Select Duration Range
                            <br>
                            Min:
                            <input type="number" name="duration_min">
                            Max:
                            <input type="number" name="duration_max">
                            <button type="submit" name="save_duration">SELECT</button>
                            </p>
                            
                            <div id="slider-range"></div>
                        </div>
                    </form>


                    <form action="select_by_year.php" method="POST">
                        <div class="container my-5">
                            Enter the year:
                                <input type="number" name="years"/>
                            <button type="submit" name="save_year" >Show</button>
                        </div>
                    </form>
            </tbody>
        </table>
    </div>    
</body>
</html>