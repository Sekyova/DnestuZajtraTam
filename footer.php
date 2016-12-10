   <footer class="footer text-zeleny">
       <div class="row text-center">
           <!--PRVY STLPEC PATY start-->
           <div class="col-md-4">
               <h2>Napíšte nám</h2>
                
    <div class="form-group">
                <form role="form" method="POST" >
                 <div class="form-group">
                  <label for="form_meno">Vaše meno:</label>
                    <input type="text" class="form-control" name ="form_meno" 
                           id="form_meno" placeholder="Napíšte nám Vaše meno">
                 
                 </div>
                  <div class="form-group">
                  <label for="form_mail">Váš e-mail:</label>
                    <input type="text" class="form-control" name="form_mail"
                           id="form_mail" placeholder="Váš e-mail, na ktorý budeme odpovedať">
                 </div>
                    <div class="form-group">
                  <label for="form_text">Správa pre nás:</label>
                    <textarea type="text" class="form-control" 
                              name="form_text" id="form_text" rows="5" placeholder="Ako Vám pomôžeme?"></textarea>
                 </div>
                    <br>
                <button type="submit" name="submit" class="btn btn-success center-block">Poslať</button>
             </form><br>     
           </div>
           </div>
           <!-- PRVY STLPEC PATY end-->
           
           <!-- druhy STLPEC PATY start-->
            <div class="col-md-4 text-center">
                <h2>Kontakt </h2>
               
                <address>
                    <strong>DnesTu</strong><br>
                    0908 XXX XXX
                    <br>
                  <a href="mailto:#">dnestu@dnestu.com</a>
                <br><br>
              <address>
                    <strong>ZajtraTam</strong><br>
                    0948 XXX XXX
                    <br>            
              
                 <a href="mailto:#">zajtratam@zajtratam.com</a>
                    </address>
					<br>
				<div class="btn-group">
					<button class="btn btn-default disabled">
						Zdieľajte:
					</button>

					<a
					class="btn btn-default"
					target="_blank"
					title="Like On Facebook"
					href="https://www.facebook.com/kamdnescestujem/?fref=ts"
				  >
					<i class="fa fa-thumbs-o-up fa-lg fb"></i>
				  </a>

				  <a
					class="btn btn-default"
					target="_blank"
					title="On Facebook"
					href="https://www.facebook.com/kamdnescestujem/?fref=ts"
				  >
					<i class="fa fa-facebook fa-lg fb"></i>
				  </a>




           </div>	
                
           </div>
          
           <!-- druhy STLPEC PATY end-->
           <!-- Treti STLPEC PATY start-->
            <div class="col-md-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d52568404.543650106!2d-27.53083998492805!3d36.4691357414528!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ssk!2ssk!4v1478807105960" 
				width="100%" height="100%" frameborder="0" style="border-radius:5%; margin-top:7%"  allowfullscreen></iframe>
                
                <br>
           <!-- treti STLPEC PATY end-->
       </div>
      

   </footer>
<!-- FOOOTER end --> 
 
    <script>
    $('.carousel').carousel({
        interval: 20000 //changes the speed
    })
    </script>
    
    <script>
$(document).ready(function () {
    $("input#submit").click(function(){
        $.ajax({
            type: "POST",
            url: "index.php", //process to mail
            data: $('form.contact').serialize(),
            success: function(msg){
                $("#thanks").html(msg) //hide button and show thank you
                $("#form-content").modal('hide'); //hide popup  
            },
            error: function(){
                alert("failure");
            }
        });
    });
});
</script>

<?php

// najprv kontrolujem ci sa vobec formular odoslal
if(isset($_POST['submit'])) {
	// potom kontrolujem ci obsahuje vsetky udaje
	if(strlen($_POST['form_meno']) > 0 && strlen($_POST['form_mail']) > 0 && strlen($_POST['form_text']) > 0){
		$meno = stripslashes($_POST['form_meno']);
		$meno = mysql_real_escape_string($meno);
		$mail = stripslashes($_POST['form_mail']);
		$mail = mysql_real_escape_string($mail);
		$text = stripslashes($_POST['form_text']);
		$text = mysql_real_escape_string($text);
		$db=new Dbs();
		$date=date("Ymd"); 
		//echo $date;
		$sql = "INSERT INTO spravy (Od, Mail, Text,Prijate) VALUES ('". $meno . "' , '". $mail . "','" . $text . "','". $date ."')";
		//echo $sql;
		mysql_query($sql);		
		$db->Close();
		echo "<script type='text/javascript'>"
					 . "alert('Ďakujeme za Vášu správu, odpoveď Vám bude doručná "
				. "na e-mail');"
					 . "</script>";
		exit;
    } else {
		 echo "<script type='text/javascript'>",
		 "alert('Je potrebné vypniť všetky údaje');",
		 "</script>";        
    }
}
?>

<body>
<html lang='en'>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>';

</body>
</html>

