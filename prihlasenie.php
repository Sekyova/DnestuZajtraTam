<?php
session_start();
include 'class.php';
error_reporting(E_ALL);
error_reporting(E_ALL ^ E_DEPRECATED);
?>
<!DOCTYPE html>
<?php
////Ak zvolil zapamatat, automaticky prihlasi
/*
if(($_COOKIE['uzivatel'])){
    $_SESSION['uzivatel'] = $_COOKIE['uzivatel'];
*/
 
////nalogovanie
if(isset($_POST['login']) and isset($_POST['heslo'])){
   $login =$_POST['login']; 
   $heslo =$_POST['heslo'];  
   
   /////kontrola pred zadanim nechcenych znakov
   $login= stripslashes($login);
   $heslo=  stripslashes($heslo);
   
   $login = mysql_real_escape_string($login);
   $heslo = mysql_real_escape_string($heslo);
   
   $dbs = new Dbs();
   $result = $dbs->Select("*", "uzivatel", "Login='$login'");
    $row = mysql_fetch_array($result);
    if($row !=null){
     if($row['Login']==$login and $row['Heslo']== $heslo){
       
            $_SESSION['uzivatel']['ID']=$row['ID_uzivatel'];
            $_SESSION['uzivatel']['Meno']=$row['Meno'];
            $_SESSION['uzivatel']['Priezvisko']=$row['Priezvisko'];
            $_SESSION['uzivatel']['Login']=$row['Login'];
          if($_POST['zapamatat']){
             $cookie_name = "uzivatel";
              $cookie_value = $_SESSION['uzivatel'];
               $time = time()+3600*24*30;
               setcookie($cookie_name, $cookie_value, $time);
                  header("Refresh:0");
                }
              
          }   
        else {
             echo '<script language="javascript">';
           echo 'alert("Nesprávne meno alebo heslo")';
           echo '</script>'; 
     }
    }
  }
?>
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

/*session_start();*/
include_once 'menu.php';
include_once 'class.php';
include_once 'jumbo.php';
?>

  <!-- KONIEC MENU --> 


  <div class="row">
     <div class="col-md-12">
    <?php
    if(!isset($_SESSION['uzivatel'])){
    echo ' 
   <!-- ZACIATOK formulara-->
  <form class="form-horizontal col-md-4 col-md-offset-4" method="POST" role="form">
    <div class="form-group">
      <label class="control-label col-sm-2" for="login">Login:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="login" id="login" placeholder="Zadajte svoje prihlasovacie meno" value="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="heslo">Heslo:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control"  name="heslo" id="heslo" placeholder="Zadajte heslo" value="">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" name="zapamatat" value="1" > Zapamätať prihlásenie </label>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-md-3">
        <button type="submit" name="prihlas" class="btn btn-primary btn-large">Prihlás ma</button>
      </div>
   
       
  </form>
 <!-- KONIEC formulara-->
   ';}
   else {
       $spravy = new Spravy();
       $spravy->VypisVsetkySpravy();
   } 
   ?>
      </div>  
    <!--KONIEC obsahovej sekcie -->
     
    
</div>
 <!--KONIEC OBSAHU->

    <!-- KONIEC STPLPCA 2.2 -->
    
    
  </div>
    <!-- KONIEC RIADKU -->

</div>
    <!-- FOOOTER start -->
<?php
   include_once 'footer.php';
?>
</body>


</html>