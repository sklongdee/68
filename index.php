<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        .my-navbar {
            background-color: #194f28;
            }
            .my-navbar a,
            .my-navbar .nav-link,
            .my-navbar .navbar-brand {
            color: #fff !important;
        }
        .my-navbar .dropdown-item {
            color: #000 !important;
        }
        .my-navbar .dropdown-item:hover {
            background-color: #f1f1f1;
        }
        </style>

  </head>
  <body>
    <!--เมนู -->
    <nav class="navbar navbar-expand-lg my-navbar" >
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./">หน้าแรก</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="?page=about">เกี่ยวกับเรา</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="?page=contact">ติดต่อเรา</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item text-dark" href="#">Action</a></li>
                    <li><a class="dropdown-item text-dark" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-dark" href="#">Something else here</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>
    <!--ปิดเมนู-->

    <?php
    $page=$_GET["page"]??"";
    if($page=="about"){
        include "about.php";
    }elseif($page=="contact"){
        include "contact.php";
    }else{
        include "home.php";
    }
    
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>