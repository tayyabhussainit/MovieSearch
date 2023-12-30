<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Movie Search</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                </ul>
            </div>
        </div>
    </nav>

    <div id="container" class="container">
        <form action="" method="get" class="mb-4">
            <div class="input-group">
                <input type="text" id="query" placeholder="Type here" name="query" class="form-control" required>
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <?php
        require_once 'MovieController.php';

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["query"])) {
            $controller = new MovieController();
            $movies = $controller->searchMovies($_GET["query"]);

            if (!empty($movies)) {
                echo '<div class="card-body">';
                echo '<div class="row">';
                foreach ($movies as $movie) {
                    echo '<div class="col-md-12 mb-4">';
                    echo '<div class="card p-3 movie-card">';
                    echo '<img src="' . 'https://image.tmdb.org/t/p/w185' . $movie['poster_path'] . '" class="card-img-top movie-img hover-zoom" alt="' . $movie['title'] . '" >';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title custom-title">' . $movie['title'] . '</h5>';
                    echo '<p class="card-text text-justify custom-text">' . $movie['overview'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            } else {
                echo '<p>No results found</p>';
            }
        }
        ?>
    </div>

</body>

</html>