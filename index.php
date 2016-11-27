<!DOCTYPE html>
<html lang="en">

<head>
  <title>DnesTuZajtraTam</title>
  <meta charset="UTF-8">
<meta name="description" content="Dnes Tu Zajtra Tam">
<meta name="keywords" content="trab=vel, blog, DnesTuZajtraTam, fhihackers">
<meta name="author" content="Nikola Sekerakova">
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

	<!--<div class="row white">
		<div class="col-md-6">
		<p>
        
        <p><strong><div class="text-zlty">#DnesTuZajtraTam</strong></div>
		Je blog o cestovaní, ktoý poskytuje jednoduchý prehľad precestovaných krajín s užitočnými informáciami.		
			</p>
			
		</div>
        
		<div class="col-md-6">      
		<p><div class="text-zlty"><strong>Kto sme? </strong></div>Sme partia mladých ľudi, ktorí radi cestuju a chcú 
		sa podeliť so zaujímavými zážitkami z rôzných kútov sveta. 
         </p>               
     
		</div>
	</div>-->
	
	
	
  <div class="row">
	<div class="col-md-12" >
      <a href="galeria.php?p=f">
       <img src="img/a.jpg" class="img-responsive img-rounded" alt="obrázok">
       <div class="text-nad-obrazkami">
            <h1>Nezabudnite očekovať  
        <strong>Galériu</strong> <br>sú tu fajn fotky a videa.</h1>
       </div>
       </a>
	</div>
  </div>
       <div class="row">   
      <!-- KONIEC STPLPCA 1 -->
    <div class="col-md-6"> 
        <a href="akcie.php?p=z">
       <img src="img/b.jpg" class="img-responsive img-rounded" alt="obrázok">
       <div class="text-nad-obrazkami">
           <h1>Zažili sme</h1>
       </div>
       </a>
      </div> 
    
      <!-- KONIEC STPLPCA 2.1 -->
    <div class="col-md-6"> 
        <a href="akcie.php?p=c">
      <img src="img/c.jpg" class="img-responsive img-rounded" alt="obrázok">
      <div class="text-nad-obrazkami center-block">
           <h1>Čaká nás</h1>
       </div>
      </a>
       </div>
 </div>
    <!-- KONIEC STPLPCA 2.2 -->
    
    
  </div>
    <!-- KONIEC RIADKU -->

</div>
    <!-- FOOOTER start -->
 <?php
 
 include 'footer.php';
   ?>
</body>


</html>

