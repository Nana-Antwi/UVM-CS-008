<?php
 include "top.php";
 include "header.php"

 


 ?>

 <article id="main">
    <h1>Form</h1>

    <?php

       ?>

        <form action="<?php print $phpSelf; ?>"
              method="post"
              id="frmRegister">

            <fieldset class="wrapper">
               <legend>Register Today</legend>
                <p>You information will greatly help us with our research.</p>

                <fieldset class="wrapperTwo">
                    <legend>Please complete the following form</legend>

                    <fieldset class="contact">
                        <legend>Contact Information</legend>
                        
                            
                                   
                                   
                                   
                                   
                                   
                        
                        
                        <label for="txtEmail" class="required">Email
                            <input type="text" id="txtEmail" name="txtEmail"
                                   value=""
                                   tabindex="120" maxlength="45" placeholder="Enter a valid email address"
                                   
                                   onfocus="this.select()" 
                                   autofocus>
                       </label>
                    </fieldset> <!-- ends contact -->
                   
                </fieldset> <!-- ends wrapper Two -->
                
                <fieldset class="buttons">
                    <legend></legend>
                    <input type="submit" id="btnSubmit" name="btnSubmit" value="Register" tabindex="900" class="button">
                </fieldset> <!-- ends buttons -->
                
            </fieldset> <!-- Ends Wrapper -->
        </form>

    <?php
     
    ?>

 </article>
 
 <?php include "footer.php"; ?>