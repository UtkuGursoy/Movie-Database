<?php 

include "config.php";

?>
Select a movie to delete from database:
<form action="delete.php" method="POST">
<select name="ids">

<?php

$sql_command = "SELECT movie_name FROM movies_table";

$myresult = mysqli_query($db, $sql_command);

    while($id_rows = mysqli_fetch_assoc($myresult))
    {
        $mid = $id_rows['movie_id'];
        $movie_name = $id_rows['movie_name'];
        $release_year = $id_rows['release_date'];
        echo "<option value=$mid>" . $movie_name . "</option>";
    }

?>

</select>
<button>DELETE</button>
</form>

 
<form action="select_by_ticket.php" method="POST">

    <div class="container">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Range slider</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
    $( function() {
        $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 10000,
        values: [ 1000, 5000 ],
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

    </body>
    </div>


<button type="submit" name="save_ticket">SELECT</button>
</form>

<form action="select_by_duration.php" method="POST">

    <body>
    
    <p>
    Duration Range: Min:
    <input type="number" name="duration_min">
    Max:
    <input type="number" name="duration_max">
    </p>
    
    <div id="slider-range"></div>

    </body>
    </div>


<button type="submit" name="save_duration">SELECT</button>
</form>


<form action="select_by_year.php" method="POST">
    Enter the year:
    <input type="number" name="years"/>

<button type="submit" name="save_year" >Show</button>


