<!DOCTYPE html>
<html lang="en">

<head>
  <title>Zoznam krajin</title>
  <meta charset="UTF-8">
<meta name="description" content="Precestovane krajiny">
<meta name="keywords" content="travel, dnestuzajtratam, fhihackers">
<meta name="author" content="Nikola Sekerakova">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="css/my.css">
 
 
</head>
<body>

<?php
session_start();
include_once 'menu.php';
include_once 'class.php';
?>
<!-- KONIEC MENU --> 
   <!-- Zactiatok Jumbotron -->  
<?php
include_once 'jumbo.php';
?>
  <!-- Koniec jumbotron --> 

<!-- ZACIATOK OBSAHU-->
    <div class="row">   
 <?php
       $akcie = new Akcie();
      if(isset($_GET['id'])){
          $id_akcie= $_GET['id'];
          echo '<div class="col-md-12 text-center white"> ';
          $akcie->ZobrazAkciu($id_akcie);
          echo '</div>';
      }
      else {
          if($_GET['p']==="z"){
		  
		    echo '<div class="col-md-12 text-center">
						<div class="text-zeleny">
							<h2>Toto všetko sme spolu zažili.  </h2>
						</div>
						<br>
						<p class="white">Zaujimavé postrehy z našich tripov, čomu sa treba vyvarovať,
						čo sme zažili.. </p>
				</div>';
			
            echo '<div class="col-md-12 text-center text-zeleny" style="height:30%; width:30%" > ';
            
					$akcie->VypisVsetkyZazite();
			echo '</div>';
        
        
        
    }
    else {	
		echo '<div class="col-md-12 text-center">
				<div class="text-zeleny">
					<h2>Nezabudame na buducnosť a planujeme.. </h2>
				</div>
				<br>
				<p class="white">
				Krajiny kam sa určite chystame.. :)        </p>
                </div>';
        echo '<div class="col-md-3 text-center text-zeleny" style="height:30%; width:30%"> ';
				$akcie->VypisVsetkyNasledujuce();
        echo '</div>';
       
        
     }
       
      }
      ?>
      
     </div>
 </div>
    <!-- KONIEC STPLPCA 2.2 -->
    
    
  </div>
 <!-- KONIEC OBSAHU OBSAHU-->

</div>
    <!-- FOOOTER start -->
   <?php
   include 'footer.php';
   ?>
</body>
</html>

