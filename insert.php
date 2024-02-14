<?php
include "config.php";

$movie_name = "";
$release_date = "";
$tickets_sold = "";
$duration = "";
$maward = "";
$actor = "";
$actor_birth = "";
$aaward = "";
$director = "";
$daward = "";
$audience = "";
$soundtrack_name = "";
$artist = "";
$country = "";
$genre = "";
$studio = "";
$monetary = "";
$language = "";


$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $movie_name = $_POST['name'];
    $release_date = (int)$_POST['year'];
    $tickets_sold = (int)$_POST['ticket'];
    $duration = (int)$_POST['duration'];
    $director = $_POST['director'];
    $daward = $_POST['daward'];
    $maward = $_POST['maward'];
    $actor = $_POST['actor'];
    $actor_birth = (int)$_POST['actor_birth'];
    $aaward = $_POST['aaward'];
    $audience = $_POST['audience'];
    $soundtrack_name = $_POST['soundtrack_name'];
    $artist = $_POST['artist'];
    $country = $_POST['country'];
    $genre = $_POST['genre'];
    $studio = $_POST['studio'];
    //$monetary = (int)$_POST['monetary'];
    $language = $_POST['language'];
    
    do{
        
        if(empty($movie_name) || empty($release_date) || empty($tickets_sold) || empty($duration)/*|| empty($director) || 
           empty($actor) || empty($actor_birth) || empty($aaward) || empty($language) || empty($daward) || empty($audience) || 
           empty($soundtrack_name) || empty($artist) || empty($country) || empty($genre) ||  empty($studio) || empty($monetary) || 
           empty($maward)*/){
            $errorMessage = "All fields are required, except monetary!";
            break;
           }
        
        $sql_array = [
            "INSERT INTO movies_table(movie_name, release_date, tickets_sold, duration) VALUES ".
                "('$movie_name',$release_date, $tickets_sold, $duration);",
            
              
            "INSERT INTO movie_awards_table(movie_id, year, maward_id, maward_name)".
                "SELECT (SELECT MAX(movie_id) FROM movies_table),".
                "'$release_date',".
                "(CASE WHEN EXISTS ".
                    "(SELECT 1 FROM movie_awards_table WHERE maward_name = '$maward') THEN" .
                        "(SELECT MAX(maward_id) FROM movie_awards_table WHERE maward_name = '$maward') ELSE" . 
                            "(SELECT MAX(maward_id)+1 FROM movie_awards_table) END),'$maward';",
            
            "INSERT INTO directors_table (movie_id, director_id, director_name)".
                "SELECT (SELECT MAX(movie_id) FROM movies_table),".
                "(CASE WHEN EXISTS (SELECT 1 FROM directors_table WHERE director_name = '$director') THEN ".
                    "(SELECT MAX(director_id) FROM directors_table WHERE director_name = '$director') ELSE ".
                        "(SELECT MAX(director_id)+1 FROM directors_table) END),'$director';",
            
            "INSERT INTO director_awards_table(movie_id, director_id, year, daward_id, daward_name)".
                "SELECT (SELECT MAX(movie_id) FROM movies_table),".
                "(SELECT MAX(director_id) FROM directors_table),".
                "'$release_date',".
                "(CASE WHEN EXISTS (SELECT 1 FROM director_awards_table WHERE daward_name = '$daward') THEN ".
                    "(SELECT MAX(daward_id) FROM director_awards_table WHERE daward_name = '$daward') ELSE ".
                        "(SELECT MAX(daward_id)+1 FROM director_awards_table) END),".
                "'$daward';",

            "INSERT INTO actors_table(movie_id, actor_id, actor_name, birthdate) ".
                "SELECT (SELECT MAX(movie_id) FROM movies_table),".
                "(CASE WHEN EXISTS (SELECT 1 FROM actors_table WHERE actor_name = '$actor') THEN ".
                    "(SELECT MAX(actor_id) FROM actors_table WHERE actor_name = '$actor') ELSE ".
                        "(SELECT MAX(actor_id)+1 FROM actors_table) END),".
                "'$actor', '$actor_birth';",

            "INSERT INTO actor_awards_table(movie_id, actor_id, year, aaward_id, aaward_name) ".
                "SELECT (SELECT MAX(movie_id) FROM movies_table),"."(SELECT MAX(actor_id) FROM actors_table),".
                "'$release_date',".
                "(CASE WHEN EXISTS (SELECT 1 FROM actor_awards_table WHERE aaward_name = '$aaward') THEN ".
                    "(SELECT MAX(aaward_id) FROM actor_awards_table WHERE aaward_name = '$aaward') ELSE ".
                    "(SELECT MAX(aaward_id)+1 FROM actor_awards_table) END),".
                "'$aaward';",
        
            "INSERT INTO audiences_table(movie_id, audi_cat_id, audience_category) ".
                "SELECT (SELECT MAX(movie_id) FROM movies_table),".
                "(CASE WHEN EXISTS (SELECT 1 FROM audiences_table WHERE audience_category = '$audience') THEN ".
                    "(SELECT MAX(audi_cat_id) FROM audiences_table WHERE audience_category = '$audience') ELSE ".
                    "(SELECT MAX(audi_cat_id)+1 FROM audiences_table) END),".
                "'$audience';",
                
            
            "INSERT INTO country_table(movie_id, country_id, country_name, language) ".
                "SELECT (SELECT MAX(movie_id) FROM movies_table),".
                "(CASE WHEN EXISTS (SELECT 1 FROM country_table WHERE country_name = '$country') THEN ".
                    "(SELECT MAX(country_id) FROM country_table WHERE country_name = '$country') ELSE ".
                        "(SELECT MAX(country_id)+1 FROM country_table) END),".
                "'$country', '$language';",  
              
            "INSERT INTO genres_table(movie_id, genre_id, genre_name) ".
                "SELECT (SELECT MAX(movie_id) FROM movies_table),".
                "(CASE WHEN EXISTS (SELECT 1 FROM genres_table WHERE genre_name = '$genre') THEN ".
                    "(SELECT MAX(genre_id) FROM genres_table WHERE genre_name = '$genre') ELSE ".
                        "(SELECT MAX(genre_id)+1 FROM genres_table) END),".
                "'$genre';",
             
            "INSERT INTO studios_table(movie_id, studio_id, studio_name) ".
                "SELECT (SELECT MAX(movie_id) FROM movies_table),".
                "(CASE WHEN EXISTS (SELECT 1 FROM studios_table WHERE studio_name = '$studio') THEN ".
                    "(SELECT MAX(studio_id) FROM studios_table WHERE studio_name = '$studio') ELSE ".
                        "(SELECT MAX(studio_id)+1 FROM studios_table) END),".
                "'$studio';",        
                
            "INSERT INTO soundtracks_table(movie_id, soundtrack_id, artist, song) ".
                "SELECT (SELECT MAX(movie_id) FROM movies_table),".
                "(CASE WHEN EXISTS (SELECT 1 FROM soundtracks_table WHERE song = '$soundtrack_name') THEN ".
                    "(SELECT soundtrack_id FROM soundtracks_table WHERE song = '$soundtrack_name') ELSE ".
                        "(SELECT MAX(soundtrack_id)+1 FROM soundtracks_table) END),".
                "'$artist', '$soundtrack_name';"
            
            
             /*
            "INSERT INTO critics_table(platforms, ratings) VALUES ('$audience','$language')",
            "INSERT INTO monetary_table(budget) VALUES ('$monetary')",
            */
        ];

    
        foreach($sql_array as $sql_statement){
            if (mysqli_multi_query($connection, $sql_statement)) {
                do {
                    if ($result = mysqli_store_result($connection)) {
                        mysqli_free_result($result);
                    }
                } while (mysqli_more_results($connection) && mysqli_next_result($connection));
            } else {
                $errorMessage = "Invalid query: " . $connection->error;
                break;
            }
        }
        
            if($director != ""){

            $statement = "INSERT INTO DIRECTS(director_id, movie_id, director_name, movie_name) ".    
                "SELECT (SELECT MAX(director_id) FROM directors_table),".
                "(SELECT MAX(movie_id) FROM movies_table),".
                "'$director', '$movie_name';";
            
            $result = mysqli_query($connection, $statement);
            if(!$result){
                $errorMessage = "Invalid 'DIRECTS' query: " . $connection->error;
                break;
                }
            }
            if($country != ""){
                
                $statement = "INSERT INTO ORIGIN(movie_id, country_id, country_name, movie_name) ".    
                    "SELECT (SELECT MAX(movie_id) FROM movies_table),".
                    "(SELECT MAX(country_id) FROM country_table),".
                    "'$country', '$movie_name';";
                
                $result = mysqli_query($connection, $statement);
                if(!$result){
                    $errorMessage = "Invalid 'ORIGIN' query: " . $connection->error;
                    break;
                }
            }
            
            if($genre != ""){
                
                $statement = "INSERT INTO BELONG(movie_id, genre_id,  genre_name, movie_name) ".    
                    "SELECT (SELECT MAX(movie_id) FROM movies_table),".
                    "(SELECT MAX(genre_id) FROM genres_table),".
                    "'$genre', '$movie_name';";
                
                $result = mysqli_query($connection, $statement);
                if(!$result){
                    $errorMessage = "Invalid 'BELONG' query: " . $connection->error;
                    break;
                }
            }
            
            if($soundtrack_name != ""){
                
                $statement = "INSERT INTO PLAYS(movie_id,soundtrack_id, soundtrack_name, movie_name) ".    
                    "SELECT (SELECT MAX(movie_id) FROM movies_table),".
                    "(SELECT MAX(soundtrack_id) FROM soundtracks_table),".
                    "'$soundtrack_name', '$movie_name';";
                
                $result = mysqli_query($connection, $statement);
                if(!$result){
                    $errorMessage = "Invalid 'PLAYS' query: " . $connection->error;
                    break;
                }
            }
             
            
        $movie_name = "";
        $release_date = "";
        $tickets_sold = "";
        $duration = "";
        $maward = "";
        $actor = "";
        $actor_birth = "";
        $aaward = "";
        $director = "";
        $daward = "";
        $audience = "";
        $soundtrack_name = "";
        $artist = "";
        $country = "";
        $genre = "";
        $studio = "";
        $monetary = "";
        $language = "";

        $successMessage = "Movie inserted correctly";

        header("location: /movies_step5/index.php");
        exit;

    } while(false);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieBox</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Insert New Movie</h2>

        <?php
            if(!empty($errorMessage)){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        
        ?>



        <form method="post">
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Movie Name</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $movie_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Release Date</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="year" value="<?php echo $release_date; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Sold Ticket Number</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="ticket" value="<?php echo $tickets_sold; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Duration (min)</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="duration" value="<?php echo $duration; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Movie Awards</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="maward" value="<?php echo $maward; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Actors</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="actor" value="<?php echo $actor; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Actor Birth Date</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="actor_birth" value="<?php echo $actor_birth; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Actor Award</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="aaward" value="<?php echo $aaward; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Director</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="director" value="<?php echo $director; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Director Award</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="daward" value="<?php echo $daward; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Audience</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="audience" value="<?php echo $audience; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Soundtrack Name</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="soundtrack_name" value="<?php echo $soundtrack_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Soundtrack Artist</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="artist" value="<?php echo $artist; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Country</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="country" value="<?php echo $country; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Genre</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="genre" value="<?php echo $genre; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Studio</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="studio" value="<?php echo $studio; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Monetary (million)</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="monetary" value="<?php echo $monetary; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col sm-3 col-form-label">Language</label>
                <div class="col sm-6">
                    <input type="text" class="form-control" name="language" value="<?php echo $language; ?>">
                </div>
            </div>
                      
                       

            <?php
                if(!empty($successMessage)){
                    echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
                }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary"> Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>


