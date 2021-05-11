<!doctype html>
<html lang="en" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <link rel="stylesheet" href="http://localhost/twitter_clone/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Hello, world!</title>
  </head>
  <body class="d-flex flex-column h-100">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">Twitter</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" href="?page=timeline">Your Timeline</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="?page=yourtweets">Your Tweets</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="?page=publicprofiles">Public Profiles</a>
            </li>
        </ul>
        <div class="d-flex">
            <?php if(isset($_SESSION['id'])) {?>
              <a class="btn btn-outline-success" href="?function=logout">Logout</a>
            <?php } else { ?>
              <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Login/Signup</button>
            <?php } ?>
          </div>
        </div>
    </div>
    </nav>