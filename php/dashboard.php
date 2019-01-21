<!doctype html>
<html lang="en">
  <head>
    <title>Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="http://localhost:8080/matcha/css/dashboard.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
      

        <!-- templete -->
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">MATCHA</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a   class="fas fa-power-off" class="nav-link" href="sign_out.php"> Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a  class="fas fa-home" class="nav-link active" href="#">
              <span data-feather="home"></span>
              Home <span class="sr-only">(current)</span>
            </a>

          </li>
          <li class="nav-item">
            <a  class="fas fa-search" class="nav-link" href="search.php">
              <span data-feather="file"></span>
              Search
            </a>
          </li>
          <li class="nav-item">
            <a  class="fas fa-user-circle" class="nav-link" href="profile.php">
              <span data-feather="shopping-cart"></span>
              Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="fas fa-comment-dots" class="nav-link" href="chat.php">
              <span data-feather="users"></span>
              chats
            </a>
          </li>
          <li class="nav-item">
            <a  class="fas fa-comments" class="nav-link" href="notifications.php">
              <span data-feather="bar-chart-2"></span>
              Notifications
            </a>
          </li>
         
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span><b>MORE</b></span>
          <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="fas fa-fire" class="nav-link" href="fame_rating.php">
              <span data-feather="file-text"></span>
              Fame-Ratings
            </a>
          </li>
          <li class="nav-item">
            <a   class="fas fa-address-book" class="nav-link" href="suggestions.php">
              <span data-feather="file-text"></span>
              Suggestions
            </a>
          </li>
          <li class="nav-item">
            <a  class="fas fa-user-alt-slash" class="nav-link" href="blocked.php">
              <span data-feather="file-text"></span>
              Blocked_Users
            </a>
          </li>
        
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> -->
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

     


    </main>
  </div>
</div>

  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>