<?php class_exists('ViewManager') or exit; ?>
<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Slam-Security - Homepage</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light my-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Slam-Security</a>

        <ul class="nav justify-content-end">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/comment">Commentaires</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="auth/logout">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container-lg">

    <div class="row mt-12" style="display: flex;justify-content: center;min-height: calc(100vh - 75px);align-items: center;">
        <div class="card" style="width: 32rem;">
            <div class="card-body">
                <h3 class="card-title text-center">Bravo</h3>
                <p class="card-text text-center">Première étape réussie.</p>
                <p class="card-text text-center"><a href="auth" class="btn btn-warning">Etape 2</a></p>
            </div>
        </div>

    </div>
</div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>
</body>
</html>