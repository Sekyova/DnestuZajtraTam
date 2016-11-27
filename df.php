<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'class.php';

    if($_GET['p']=="d"){
    if(isset($_GET['df'])){
           $df=$_GET['df'];
           $v=new Download;
            $v->StiahniDoc($df);
        }
    }
    elseif($_GET['p']=="v"){
    if(isset($_GET['df'])){
           $df=$_GET['df'];
           $v=new Download;
            $v->StiahniVideo($df);
        }
    }
    elseif($_GET['p']=="f"){
    if(isset($_GET['df'])){
           $df=$_GET['df'];
           $v=new Download;
            $v->StiahniFoto($df);
        }
    }

        ?>
