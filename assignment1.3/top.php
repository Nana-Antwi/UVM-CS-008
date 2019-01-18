<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Making The World A Better Place</title>
        <meta charset="utf-8">
        <meta name="author" content="Nana Antwi">
        <meta name="description" content="mainindex">
        
         <link rel="stylesheet"
             href="style.css"
             type="text/css"
             media="screen">
         
         <?php
// parse the url into htmlentites to remove any suspicous vales that someone
// may try to pass in. htmlentites helps avoid security issues.

        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

// break the url up into an array, then pull out just the filename
        $path_parts = pathinfo($phpSelf);
        ?>	


        
    </head>
    
    <?php
// giving each body tag an id really helps with css later on
            print '<body id="' . $path_parts['filename'] . '">';
    ?>