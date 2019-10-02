<?php
include 'includes/travel-config.inc.php';
include 'includes/ContinentDB.class.php';
include 'includes/CountryDB.class.php';
include 'includes/ImageDB.class.php';
include 'includes/DatabaseHelper.class.php';
  // $travelConfig= travel-config;

  // travel-config.spl_autoload_register('ContinentDB');
  $continentdb = new ContinentDB($pdo);
  $continents = $continentdb->getAll();

  $countrydb = new CountryDB($pdo);
  $countries = $countrydb->getAll();

  $imagedb = new ImageDB($pdo);

  $images = null;
// see if we should filter by continent
  if (isset($_GET['continent']) && ! empty($_GET['continent']) ) {
    $images = ($imagedb->findByContinent($_GET['continent']));
  }
  // see if we should filter by a country
  else if (isset($_GET['country']) && ! empty($_GET['country'])){
  $images= $imagedb->findByCountry($_GET['country']);
  }
  // see if we should filter by a title
  else if(isset($_GET['title']) && ! empty($_GET['title'])){
    $images= $imagedb->findLikeTitle($_GET['title']);
  }

  else {
    $images = $imagedb->getAll(); //....
  }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Chapter 14</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    

</head>

<body>
    <?php include 'includes/header.inc.php'; ?>
    


    <!-- Page Content -->
    <main class="container">
    <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="chapter14-project2.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select name="continent" class="form-control">
                <option value="0">Select Continent</option>
                <?php 
                  $continents = (new ContinentDB($pdo))->getAll();

                foreach ($continents as $con) //not sure
                 { 
                  echo '<option value=' . $con['ContinentCode'] . '>' . $con['ContinentName'] . '</option>';
                } ?>
              </select>     
              
              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                
                <?php $countries = (new CountryDB($pdo))->getAll();
                  foreach ($countries as $country) { 
                  echo '<option value=' . $country['ISO'] . '>' . $country['CountryName'] . '</option>'; //...
                } ?>
              </select>    
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </form>

          </div>
        </div>       
                                    

		<ul class="caption-style-2">
    <?php
     foreach($images as $img) {   ?>
			   <li>
            <a href="detail.php?id=<?php echo $img['ImageID']; ?>" class="img-responsive">
    				<img src="images/square-medium/<?php echo $img['Path']; ?>" alt="<?php echo $img['Description']; ?>">
    				<div class="caption">
    					<div class="blur"></div>
    					<div class="caption-text">
    						<p><?php echo  $img['Description']; //not sure ?></p> 
    					</div>
    				</div>
            </a>
			  </li>        
          <?php } ?>
       </ul> 
       
    </main>
    
    <footer>
        <div class="container-fluid">
                    <div class="row final">
                <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
                <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
            </div>            
        </div>
        

    </footer>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>