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
    <h2>MovieBox Initial Page</h2>
    <br>
    <h5>ADMIN MENU:</h5>
    <br>
    <form method="POST">  
        <div class="row mb-2">
            <div class="offset-sm-2 col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_movies.php" role="button">Movies Table</a>
            </div>
            <div class="col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_actor.php" role="button">Actor Table</a>
            </div>
            <div class="col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_audience.php" role="button">Audience Table</a>
            </div>
            <div class="col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_country.php" role="button">Country Table</a>
            </div>
        </div>
        <div class="row mb-2">
            <div class="offset-sm-2 col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_directors.php" role="button">Directors Table</a>
            </div>
            <div class="col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_genres.php" role="button">Genres Table</a>
            </div>
            <div class="col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_movie_awards.php" role="button">Movie Awards Table</a>
            </div>
            <div class="col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_soundtrack.php" role="button">Soundtrack Table</a>
            </div>       
        </div>
        <div class="row mb-2">
            <div class="offset-sm-2 col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_studios.php" role="button">Studios Table</a>
            </div>
            <div class="col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_director_awards.php" role="button">Director Awards Table</a>
            </div>
            <div class="col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_actor_awards.php" role="button">Actor Awards Table</a>
            </div>
            <div class="col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_monetary.php" role="button">Monetary Table</a>
            </div>
        </div>
        <div class="row mb-2">
            <div class="offset-sm-2 col-sm-2 d-grid">
                <a class="btn btn-outline-primary" href="table_critics.php" role="button">Critics Table</a>
            </div>
        </div>
    </form>
    <br>
    <h5>RELATION MENU:</h5>
    <br>
    <form method="POST">
        <div class="row mb-2">
            <a class="btn btn-outline-primary" href="directs.php" role="button">Show all direcors with their directed movies</a>
        </div>
        <div class="row mb-2">
            <a class="btn btn-outline-primary" href="origin.php" role="button">Show all movies with their origin country</a>
        </div>
        <div class="row mb-2">
            <a class="btn btn-outline-primary" href="belong.php" role="button">Show all movies with their genre</a>
        </div>
        <div class="row mb-2">
            <a class="btn btn-outline-primary" href="plays.php" role="button">Show all songs played on movies</a>
        </div>
    </form>
    <br>
    <h5>SUPPORT PAGE:</h5>
    <br>
    <form method="POST">
        <div class="row mb-2">
            <div class="col-sm-1 d-grid">
                <a class="btn btn-outline-primary" href="php-firebase/admin_chat.php" role="button">ADMIN</a>
            </div>
            <div class=" col-sm-1 d-grid">
                <a class="btn btn-outline-primary" href="php-firebase/client_chat.php" role="button">CLIENT</a>
            </div>         
        </div>
    </form>
</div>
</body>
</html>
