

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dnes Tu Zajtra Tam</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
 <script> 
i.fb,       span.fb{     color: green; }
</script> 

   <link rel="stylesheet" href="css/my.css">
 
 
</head>
<body>

<?php
session_start();
include_once 'menu.php';
include_once 'class.php';
include_once 'jumbo.php';
?>

  <!-- KONIEC MENU --> 

<div class="row">
    <div class="col-md-12">
      <?php
      $v = new Download();
      if($_GET['p']=="d"){
        $v->ZobrazSubory();
        if(isset($_GET['df'])){
           $df=$_GET['df'];
           $v->StiahniDoc($df);
        }
        }
        elseif ($_GET['p']=="v") {
            $v->ZobrazVidea();
          
        }
       elseif($_GET['p']=="f"){
           $v->ZobrazFotky();
           if(isset($_GET['df'])){
           $df=$_GET['df'];
           $v->StiahniFoto($df);
        }
       }
       else{
           $v->ZobrazSubory();
           if(isset($_GET['df'])){
           $df=$_GET['df'];
            $v->StiahniDoc($df);
        }
       }
        
   ?>
     
    </div>
</div>
    <!-- FOOOTER start -->
 <?php
 
 include 'footer.php';
   ?>
</body>


</html>

