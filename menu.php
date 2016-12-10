<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">DnesTuZajtraTam</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
          <li><a href="index.php">O nás</a></li>
       <!-- <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="download.php">XXXXX <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="download.php?p=d">Dokumenty</a></li>
            <li><a href="download.php?p=f">Fotky</a></li>
            <li><a href="download.php?p=v">Videa</a></li>
          </ul>
        </li> -->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="download.php">Galéria <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="galeria.php?p=f">Fotky</a></li>
            <li><a href="galeria.php?p=v">Videá</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="akcie.php">Krajiny <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="akcie.php?p=z">Zažili sme</a></li>
            <li><a href="akcie.php?p=c">Čaka nás</a></li>
          </ul>
        </li>
        <li>
                 <?php
                if(isset($_SESSION['uzivatel'])){
                echo'<a href="prihlasenie.php"><span class="glyphicon glyphicon-envelope"></span> </a>';
                }
                ?>
          </li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
     
       
          <li>
              <?php
                if(!isset($_SESSION['uzivatel'])){
                echo '<a href="prihlasenie.php"><span class="glyphicon glyphicon-log-in"></span> Prihlásiť</a>';}
                else {echo'<a href="odhlasenie.php"><span class="glyphicon glyphicon-log-out"></span> ';
                     echo $_SESSION['uzivatel']['Meno'];
                     echo '</a>';
                }
                
            ?>
          </li>
      </ul>
    </div>
  </div>
</nav>