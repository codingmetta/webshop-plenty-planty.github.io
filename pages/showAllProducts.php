<!DOCTYPE HTML>
<html>  
<head>
 <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

<!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar fixed-top navbar-expand-lg bg-light navbar-light">
  <a class="navbar-brand" href="../index.html">Plenty</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Links -->
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../index.html">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Plants
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item active" href="pages/showAllProducts.php">All Plants</a>
          <a class="dropdown-item" href="#">Easygoing</a>
          <a class="dropdown-item" href="#">Big Plants</a>
          <a class="dropdown-item" href="#">Air Cleaner</a>
        </div>
    <li class="nav-item">
      <a class="nav-link" href="#">About</a>
    </li>
     <li class="nav-item">
      <a class="nav-link" href="#">Contact</a>
    </li>
  </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>

        <ul class="navbar-nav navbar-right">
        <li class = "nav-item">
        <a  class="nav-link" href="../pages/loginUser.php">Log in</a>
        </li>
        <li class="nav-item">
        <a class="nav-link text-success" href="../pages/registration.php"> Sign up </a></li>
    </ul>
</nav>
<br> <br><br> 
<!--Products listed as responsive Cards retrieved from table "Products"  -->
<div class="container">
<div class="card-columns">
<?php
require '../scripts/login.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT product_id, name, price, description, amount, img_path FROM Products";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
while( $record = mysqli_fetch_assoc($resultset) ) {
?>
<div class="card hovercard">
    <div class="cardheader">
        <div class="avatar">
        <img class="img-fluid" alt="plant" src="<?php echo $record['img_path']; ?>" style="width:100%; height:17vw; object-fit:cover"> 
        <!--<img alt="test" src="../img/fiddle_fig00_570x570.jpg" > --> 
        </div>
    </div>
    
    
    <div class="card-body ">
        <div class="card-title">
            <h4><?php echo $record['name']; ?></h4>
        </div>
        <div class="card-text"> 
            <h6><?php echo $record['price']; ?> €</h6>
        </div>
        <hr>
        <div class="desc">
            <?php echo $record['description']; ?>
        </div>
        <!-- Placeholder only! Implementation for rating system not done yet -->
        <div class="rating d-flex justify-content-end">
            <ul class="row rating" style="list-style-type:none; margin-right:2%">
                <li><i class="far fa-star"></i></li>
                <li><i class="far fa-star"></i></li>
                <li><i class="far fa-star"></i></li>
                <li><i class="far fa-star"></i></li>
                <li><i class="far fa-star"></i></li>
            </ul> 
        </div>
    </div>
    
    <div class="card-footer">
        <div class="d-flex justify-content-between" style="display:flex">
            <div class="desc" id="btn-buy">
                <form> 
                <button type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Buy</button>
                </form>
            </div>
            <div class="desc" id="lbl-stock" style="margin-top:3%; font-size:14px">
                 <?php echo $record['amount']; ?> left in Stock 
            </div>
        </div>
    </div>
    
</div>

<?php } ?>
</div>
</div>
</body>
</html>