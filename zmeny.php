<?php
session_start();
include 'class.php';

$s = new Spravy();
$id_uzivatel =$_SESSION['uzivatel']['ID'];
$id_spravy = $_GET['id_spravy'];
$mail = $_GET['mail'];
if(isset($_SESSION['uzivatel'])){
    if($_GET['dovod']==387632){////oznacim spravu za precitanu
      $s->OznacZaPrecitanu($id_spravy);
      header('Location: prihlasenie.php');  
    }
    if($_GET['dovod']==132492){/////vymazem vybranu odpoved
    $s->Vymaz($id_spravy);
    header('Location: prihlasenie.php');
    }
    if($_GET['dovod']==948273){/////odpovedanie na spravu
      $s->Odpovedat($id_spravy, $id_uzivatel, $mail);
    }
    else {
       /// header('Location: index.php'); ///inac odidem naspat na home page
    } 
}
else{
    header('Location: index.php');  ////ak neni prihlaseny, presmeruje naspat na home page
}

?>


