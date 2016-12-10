<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author nikSek
 * 
 */
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting( error_reporting() & ~E_NOTICE );

include'dbconn.php';

class Uzivatel {
    private
            $meno , $priezvisko, $mail, $mobil;  
    
    public function getMeno(){
        return $this->meno;
    }
    public function getPriezvisko(){
        return $this->priezvisko;    
    }
    
     public function getMail(){
        return $this->mail;
    }
    public function getMobil(){
        return $this->mobil;
    }
            
      public function __construct($meno, $priezvisko,$login, $mail, $mobil){
        $this->meno=$meno;
        $this->priezvisko=$priezvisko;
        $this->mail=$mail;
        $this->rocnik=$mobil;
        $this->login=$login;
    }
}

class Dbs {
    /*private $host="localhost"; // Host name 
    private $db_user="root"; // Mysql username 
    private $db_heslo="root"; // Mysql password 
    private $db="wawd"; // Database name */
    private $db_link;
     
    public function Dbs (){ 
        $link=mysql_connect('localhost','root','root')or
                die("Nie je mozne pripojit na server SQL"); 
        mysql_select_db('wawd')or die("Nie je mozne najst spravnu databazu");
        $this->db_link = $link;
    }
    
    public function Select ($co, $tabulka, $podmienky){
        $sql="SELECT $co FROM $tabulka WHERE $podmienky";
        $res = mysql_query($sql);
        return $res;
    }
    public function SelectLeftJoinAndSort($co, $tabulka, $podmienky, $spoj, 
            $spoj_podmienky, $zoraditPodla, $ako ){
        $sql="SELECT $co FROM $tabulka LEFT JOIN $spoj ON $spoj_podmienky"
                . " WHERE $podmienky ORDER BY $zoraditPodla $ako";
        $res = mysql_query($sql);
        return $res; 
    }
    public function SelectAllAndSort ($co, $tabulka, $zoraditPodla, $ako){
        $sql="SELECT $co FROM $tabulka ORDER BY $zoraditPodla $ako";
        $res = mysql_query($sql);
        return $res;
    }
    public function SelectAllLeftJoinAndSort($co, $tabulka,$spoj, $spoj_podmienky,
            $zoraditPodla, $ako ){
        $sql="SELECT $co FROM $tabulka LEFT JOIN $spoj ON $spoj_podmienky "
                . "ORDER BY $zoraditPodla $ako";
        $res = mysql_query($sql);
        return $res; 
    }
    public function SelectAllAndSortWithLimit ($co, $tabulka, $zoraditPodla, $ako, $limit){
        $sql="SELECT $co FROM $tabulka ORDER BY $zoraditPodla $ako LIMIT $limit";
        $res = mysql_query($sql);
        return $res;
    }
    public function SelectAndSort ($co, $tabulka,$podmienky, $zoraditPodla, $ako){
        $sql="SELECT $co FROM $tabulka WHERE $podmienky ORDER BY $zoraditPodla $ako";
        $res = mysql_query($sql);
        return $res;
    }
    public function SelectAndSortWithLimit ($co, $tabulka,$podmienky,
            $zoraditPodla, $ako, $limit){
        $sql="SELECT $co FROM $tabulka WHERE $podmienky ORDER BY"
                . " $zoraditPodla $ako LIMIT $limit";
        $res = mysql_query($sql);
        return $res;
       
    }
    public function Update($tabulka, $co, $podmienky){
    $sql="UPDATE $tabulka SET $co WHERE $podmienky";
     mysql_query($sql);
    
    }
    public function Insert($tabulka, $atributy, $hodnoty) {
        $sql = "INSERT INTO $tabulka ($atributy) VALUES ($hodnoty)";
        mysql_query($sql);
         
    }
    
    public function Delete($tabulka, $podmienky){
        $sql = "DELETE FROM $tabulka WHERE $podmienky";
        mysql_query($sql);
    }
    
    public function Close(){
        mysql_close($this->db_link);   
    }
}

class Spravy{
    private 
            $nasMail = "dnestuzajtratam@gmail.com";
    
    public function Spravy(){
        
    }
    public function VypisVsetkySpravy(){
        $db = new Dbs();
       $res = $db->SelectAllLeftJoinAndSort("spravy.*, uzivatel.Meno, uzivatel.Priezvisko", 
               "spravy" , "uzivatel",
               "spravy.ID_uzivatel=uzivatel.ID_uzivatel",
               "spravy.Prijate", "DESC");
        
      
       echo '
  <h2 class="text-zeleny text-center">Všetky prijaté správy</h2>
  </br>
                                                                                     
  <div class="table ">          
  <table class="table table-striped table-collapse">
    <thead>
      <tr class="text-zeleny">
        <th>Od</th>
        <th>Mail</th>
        <th>Prijaté dňa</th>
        <th>Text správy</th>
        <th>Akcia</th>
        <th>Odpovedané dňa</th>
		<th>Odpovedal</th>
        </tr>
    </thead>
    <tbody>';
	$r['Od']="";
	
       while ( $r = mysql_fetch_array($res)) {
      echo '<tr>
        <td>'; echo $r['Od']; echo '</td>
        <td>'; echo $r['Mail']; echo'</td>
        <td>'; echo $r['Prijate']; echo '</td>
        <td>'; echo $r['Text']; echo '</td>
        <td>'; 
        if($r['Precitane']==0){
            echo'<a href="zmeny.php?dovod=387632&id_spravy='.$r['ID_spravy'].'"'
                    . ' data-toggle="popover" data-trigger="hover" data-content="Označiť ako prečítané"><span class="glyphicon glyphicon-ok"></span> </a>';
        }
            echo'<a href="zmeny.php?dovod=132492&id_spravy='.$r['ID_spravy'].'"'
                    . ' data-toggle="popover" data-trigger="hover" data-content="Vymazať správu"><span class="glyphicon glyphicon-remove"></span> </a>';
        echo'<a href="zmeny.php?dovod=948273&id_spravy='.$r['ID_spravy'].'&mail'
                . '='.$r['Mail'] . '" data-toggle="popover" data-trigger="hover" data-content="Odpovedať"><span class="glyphicon glyphicon-send"></span> </a>';
        echo '</td>
        <td>'; echo $r['Odpovedane']; echo'</td>
        <td>'; 
            echo $r['Meno']; echo " ";
            echo $r['Priezvisko'];
            echo'</td>
      </tr>';
       }
    echo '</tbody>
            </table>
            </div>
            ';
    $db->Close();   
   }
   
    
    public function VypisPrecitaneSpravy(){
        
    }
    public function VypisNeprecitaneSpravy(){
        
    }
    
    public function OznacZaPrecitanu($id_spravy){
        $db = new Dbs();
        $db->Update("spravy", "Precitane=1", "ID_spravy = $id_spravy");
        $db->Close();
        
    }
    public function Odpovedat($id_spravy, $id_uzivatel, $mail){
        $datum = date();
        $db = new Dbs();
        $db->Update("spravy", "ID_uzivatel=$id_uzivatel, Precitane=1,"
                . " Odpovedane = CURDATE()", "ID_spravy = $id_spravy");
        $db->Close();
        header("location: mailto:".$mail);
        
    }
   
    public function Vymaz($id_spravy){
        $db = new Dbs();
        $db->Delete("spravy", "ID_spravy = $id_spravy");
        $db->Close();
    }
}
    
    class Akcie{
        public function Akcie(){
            
    }
	
	
	  
    public function VypisVsetkyZazite(){
       $db = new Dbs;
	   $sql="SELECT * FROM akcia WHERE Ukoncena=1 ORDER BY Datum_konania DESC";
	   $res = mysql_query($sql);
	
       while ($row = mysql_fetch_array($res,MYSQL_ASSOC)) {
               $id=$row['ID_akcia'];
			   $link=$row['Obrazok'];
			   $obr=new Obrazok();
               echo '<li><h3><a href="akcie.php?p=z&id='.$id.'"';
               echo '">'; 
			   echo $row['Nazov']. " ".$obr->Ukaz($link);
			   echo '</a></h3></li>';
           }
        $db->Close();
    }
    
	public function VypisVsetkyNasledujuce(){
       $db = new Dbs;
	   $sql="SELECT * FROM akcia WHERE Ukoncena=0 ORDER BY Datum_konania DESC";
	   $res = mysql_query($sql);	   
       while ($row = mysql_fetch_array($res,MYSQL_ASSOC)) {
               $id=$row['ID_akcia'];
			   $link=$row['Obrazok'];
			   $obr=new Obrazok();
               echo '<li><h3><a href="akcie.php?p=z&id='.$id.'"';
               echo '">'; 
			   echo $row['Nazov']. " ".$obr->Ukaz($link);
			   echo '</a></h3></li>';
           }
        $db->Close();
    }
	
	   
    public function ZobrazAkciu($id){
        $db = new Dbs();
        $r = $db->Select("*", "akcia", "ID_akcia=$id");
        $row=  mysql_fetch_assoc($r);
        $link=$row['Obrazok'];
        echo '<div class="text-center text-zeleny"><h1>';
        echo $row['Nazov'];
        echo '</h1></div>';
        $obr=new Obrazok();
        $obr->Ukaz($link);
		echo $row['Datum_konania']. " </br>  " .$row['Text'];
            
    }
    
}

class Obrazok{
    public function Obrazok(){
     }
    
    public function Ukaz($link){
        echo'<div class="col-md-12">';
                    echo '<img class="img-responsive center-block img-max-h" '
     . 'src="gal/foto/' .$link. '" alt= "Foto">' ;
        echo'</div>';
    }
    
    
}

class Download{
    public function Download(){
        
    }
    public function ZobrazSubory(){
    $l=new Loader();
    $subor=$l->Nacitaj("download/doc");
    $p= count($subor);
    $i=0;
    echo '
  <div class="text-center"><div class="text-zlty"><h1>Dokumenty na stiahnutie</h1></div>
  <p>V tabuľke nájdete dokumenty na stiahnutie, ktoré sa sem pokúsime pravideľne
  pridávať. </p></div>                                                                                      
  <div class="table ">          
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Názov súboru</th>
        <th>Veľkosť</th>
        <th>Stiahnúť</th>
      </tr>
    </thead>
    <tbody>';
       while($i < $p){
           if($subor[$i]===".DS_Store" OR $subor[$i]==="." OR $subor[$i]===".."){
               echo " ";
           }
           else{
        echo '<tr>
        <td>'; echo $subor[$i]; echo '</td>
        <td>'; echo round(filesize("download/doc/".$subor[$i])/1048576, 2); echo " MB";echo'</td>
        <td>'; echo '<a href="df.php?p=d&df='.$subor[$i].'" title="Download File">stiahnúť</a>'; echo '</td>
      </tr>';
       }
       
       $i++;
       }
    echo '</tbody>
            </table>
            </div>
            ';
    
    }
    public function ZobrazVidea(){
    $l=new Loader();
    $subor=$l->Nacitaj("download/video");
    $p= count($subor);
    $i=0;
    echo '
  <div class="text-center">div class="text-zlty"><h1>Zazipovane videá na stiahnute</h1></div>
  <p>V tabuľke nájdete videá, ktoré sú kvoli veľkosti zazipované, a teda pre ich
  zobrazenie je potrebné si ich samozrejme stiahnúť a následne rozbaliť pomocou
  nejakého odzipovacieho programu. </p></div>                                                                                      
  <div class="table ">          
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Názov súboru</th>
        <th>Veľkosť</th>
        <th>Stiahnúť</th>
      </tr>
    </thead>
    <tbody>';
       while($i < $p){
           if($subor[$i]===".DS_Store" OR $subor[$i]==="." OR $subor[$i]===".."){
               echo " ";
           }
           else{
        echo '<tr>
        <td>'; echo $subor[$i]; echo '</td>
        <td>'; echo round(filesize("download/video/".$subor[$i])/1048576, 2); echo " MB"; echo'</td>
        <td>'; echo '<a href="df.php?p=v&df='.$subor[$i].'" title="Download File">stiahnúť</a>'; echo '</td>
      </tr>';
       }
       $i++;
       }
    echo '</tbody>
            </table>
            </div>
            ';
    
    }
    public function ZobrazFotky(){
    $l=new Loader();
    $subor=$l->Nacitaj("download/foto");
    $p= count($subor);
    $i=0;
    echo '
  <div class="text-center">div class="text-zlty"><h1>Zazipované fotografie na stiahnutie</h1></div>
  <p>V tabuľke nájdete zazipované fotografie, a teda pre ich
  zobrazenie je potrebné si ich samozrejme stiahnúť a následne rozbaliť pomocou
  nejakého odzipovacieho programu. </p></div>                                                                                      
  <div class="table ">          
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Názov súboru</th>
        <th>Veľkosť</th>
        <th>Stiahnúť</th>
      </tr>
    </thead>
    <tbody>';
    
       while($i < $p){
           if($subor[$i]===".DS_Store" OR $subor[$i]==="." OR $subor[$i]===".."){
               echo " ";
           }
           else{
        echo '<tr>
        <td>'; echo $subor[$i]; echo '</td>
        <td>'; echo round(filesize("download/foto/".$subor[$i])/1048576, 2); echo " MB"; echo'</td>
        <td>'; echo '<a href="df.php?p=f&df='.$subor[$i].'" title="Download File">stiahnúť</a>'; echo '</td>
      </tr>';
       }
       $i++;
       }
    echo '</tbody>
            </table>
            </div>
            ';
    
    }
    public function StiahniDoc($filename){
        if(!empty($filename)){
              // Specify file path.
              $path = 'download/doc/'; // '/uplods/'
              $download_file =  $path.$filename;
              // Check file is exists on given path.
              if(file_exists($download_file))
              {
                // Getting file extension.
                $extension = explode('.',$filename);
                $extension = $extension[count($extension)-1]; 
                // For Gecko browsers
                header('Content-Transfer-Encoding: binary');  
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
                // Supports for download resume
                header('Accept-Ranges: bytes');  
                // Calculate File size
                header('Content-Length: ' . filesize($download_file));  
                header('Content-Encoding: none');
                // Change the mime type if the file is not PDF
                header('Content-Type: application/'.$extension);  
                // Make the browser display the Save As dialog
                header('Content-Disposition: attachment; filename=' . $filename);  
                readfile($download_file); 
                exit;
              }
              else
              {
                echo 'File does not exists on given path';
              }

           }

    }
     public function StiahniFoto($filename){
         if(!empty($filename)){
              // Specify file path.
              $path = 'download/foto/'; // '/uplods/'
              $download_file =  $path.$filename;
              // Check file is exists on given path.
              if(file_exists($download_file))
              {
                // Getting file extension.
                $extension = explode('.',$filename);
                $extension = $extension[count($extension)-1]; 
                // For Gecko browsers
                header('Content-Transfer-Encoding: binary');  
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
                // Supports for download resume
                header('Accept-Ranges: bytes');  
                // Calculate File size
                header('Content-Length: ' . filesize($download_file));  
                header('Content-Encoding: none');
                // Change the mime type if the file is not PDF
                header('Content-Type: application/'.$extension);  
                // Make the browser display the Save As dialog
                header('Content-Disposition: attachment; filename=' . $filename);  
                readfile($download_file); 
                exit;
              }
              else
              {
                echo 'File does not exists on given path';
              }

           }

    }
     public function StiahniVideo(
             $filename){if(!empty($filename)){
              // Specify file path.
              $path = 'download/video/'; // '/uplods/'
              $download_file =  $path.$filename;
              // Check file is exists on given path.
              if(file_exists($download_file))
              {
                // Getting file extension.
                $extension = explode('.',$filename);
                $extension = $extension[count($extension)-1]; 
                // For Gecko browsers
                header('Content-Transfer-Encoding: binary');  
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
                // Supports for download resume
                header('Accept-Ranges: bytes');  
                // Calculate File size
                header('Content-Length: ' . filesize($download_file));  
                header('Content-Encoding: none');
                // Change the mime type if the file is not PDF
                header('Content-Type: application/'.$extension);  
                // Make the browser display the Save As dialog
                header('Content-Disposition: attachment; filename=' . $filename);  
                readfile($download_file); 
                exit;
              }
              else
              {
                echo 'File does not exists on given path';
              }

           }

    }
}

class Loader{
    public function Loader(){
        
    }
    public function Nacitaj($umietnenie){
        $images = scandir($umietnenie);
        return $images;
    }
}

class Galeria{
    public function Galeria(){
    }
    public function UkazObrazky(){
        $l = new Loader();
        $subor = $l->Nacitaj("gal/foto");
        $p= count($subor);
        $i=0;
        echo '<div class="row"><div id="links">';
        while($i < $p){
            if($subor[$i]===".DS_Store"){
                echo"";
                 
            }
           else {
            if($subor[$i] != '.' && $subor[$i] != '..'){
            echo ' <div class="col-md-2"><a href="gal/foto/'.$subor[$i].'" title="'.$subor[$i].'" data-gallery>
                        <img src="gal/foto/'.$subor[$i].'"  class="img-thumbnail" alt="'.$subor[$i].'">
                   </a></div>';
                            }
           }
           $i++; 
        }
        echo '</div></div>';
     
    }
    public function UkazVidea(){
          $l = new Loader();
        $subor = $l->Nacitaj("gal/video");
        $p= count($subor);
        $i=0;
        echo '<div class="row"><div id="links">';
        while($i < $p){
            if($subor[$i]===".DS_Store"){
                echo"";
            }
            else {
                if($subor[$i] != '.' && $subor[$i] != '..'){
                       echo ' <div class="col-md-6"><a href="gal/video/'.$subor[$i].'" title="'.$subor[$i].'"   type="video/mp4" data-gallery>
                            <video src="gal/video/'.$subor[$i].'" data-poster="'.$subor[$i].'">
                       </a></div>';
                                }
            }
                $i++;
        }
        echo '</div>';
    
    }   
}

