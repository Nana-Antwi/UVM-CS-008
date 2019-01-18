<!DOCTYPE html>
<html lang="en">
    <head>
        <title> GroovyUV Concerts</title>
        <meta charset="utf-8">
        <meta name="author" content="Nana Antwi/Lilly Brown">
        <meta name="description" content="mainindex">

        <link rel="stylesheet"
              href="style.css"
              type="text/css"
              media="screen">

        <?php
        $debug = false;

        $domain = "http://";
        if (isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS']) {
                $domain = "https://";
            }
        }
//       
        ?>

        <?php
// parse the url into htmlentites to remove any suspicous vales that someone
// may try to pass in. htmlentites helps avoid security issues.
        
         $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");

        $domain .= $server;

        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

// break the url up into an array, then pull out just the filename
        $path_parts = pathinfo($phpSelf);

       
        ?>	


        <?php
        if ($debug) {
            print "<p>Domain" . $domain;
            print "<p>php Self" . $phpSelf;
            print "<p>Path Parts<pre>";
            print_r($path_parts);
            print "</pre>";
        }

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// inlcude all libraries
//

        require_once('lib/security.php');

        if ($path_parts['filename'] == "form") {
            include "lib/validation-functions.php";
            include "lib/mail-message.php";
        }
        ?>	



    </head>

    <?php
// giving each body tag an id really helps with css later on
    print '<body id="' . $path_parts['filename'] . '">';

    
    ?>

