<?php
/* php code can go anywhere but we will be starting almost all our documents
 * with php code There is no code here at the moment */
?>
<!DOCTYPE HTML>
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

    </head>

    <body>
        <h1>Assignment1.2</h1>
        <h2>Making The World A Better Place</h2>
        <h3> Political Unrest / Natural Disaster / Economic Downturn </h3>


        <nav>
            <ol>
                <li><a href="index.php"> Home</a></li>
                <li><a href="page1.php">Introduction</a></li>
                <li><a href="page2.php">Global Warming / Hunger</a></li>
                <li><a href="page3.php">Political Unrest / Natural Disaster / Economic Downturn</a></li>
                <li><a href="page4.php">Image Map of World Problems</a></li>
                <li><a href="specsdc1.2.pdf">Specification Document</a></li>
            </ol>


        </nav>



        <p> Political Unrest / Natural Disaster / Economic Downturn </p>

        <p> Political Unrest is the significant level of dissatisfaction among the citizens of a Country or State. When people often think poorly of their leadership and they start seriously considering the removal of their leaders with or without regard to the established political process than a country is said to be in some dangerous amount of political unrest.
            It cause a state of disruption in the country, where citizens fall panic, law and order is jeopardized. Also organized groups in the country contest for power to rule which often results in the use of military force. Always the conclusion of this type of problem leads to the installation of a new government. </p>

        <figure>
            <img src="pic4.jpg" alt=" This is a political picture showing unrest in a country">
            <figcaption>Fig1. Struggles during Political Unrest.</figcaption>
        </figure>

        <p>Natural Disasters are a major adverse event resulting from natural processes of the Earth; examples include floods, volcanic eruptions, earthquakes, tsunamis, and other geologic processes. A natural disaster can cause loss of life or property damage, 
            and typically leaves some economic damage in its wake, the severity of which depends on the affected population's resilience, or ability to recover</p>

        <figure>
            <img src="pic5.jpg" alt=" This is an image of a natural diaster">
            <figcaption>Fig2. A picture of a Natural Disaster. </figcaption>
        </figure>


        <?php
        /* Sample code to open a plain text file */

        $debug = false;

        if (isset($_GET["debug"])) {
            $debug = true;
        }

        $myFileName = "book";

        $fileExt = ".csv";

        $filename = $myFileName . $fileExt;

        if ($debug)
            print "\n\n<p>filename is " . $filename;

        $file = fopen($filename, "r");

        /* the variable $file will be empty or false if the file does not open */
        if ($file) {
            if ($debug)
                print "<p>File Opened</p>\n";
        }



        /* the variable $file will be empty or false if the file does not open */
        if ($file) {

            if ($debug)
                print "<p>Begin reading data into an array.</p>\n";

            /* This reads the first row, which in our case is the column headers */
            $headers = fgetcsv($file);

            if ($debug) {
                print "<p>Finished reading headers.</p>\n";
                print "<p>My header array<p><pre> ";
                print_r($headers);
                print "</pre></p>";
            }
            /* the while (similar to a for loop) loop keeps executing until we reach 
             * the end of the file at which point it stops. the resulting variable 
             * $records is an array with all our data.
             */
            while (!feof($file)) {
                $records[] = fgetcsv($file);
            }

            //closes the file
            fclose($file);

            if ($debug) {
                print "<p>Finished reading data. File closed.</p>\n";
                print "<p>My data array<p><pre> ";
                print_r($records);
                print "</pre></p>";
            }
        } // ends if file was opened

        /* display the data */
        print"<table>";
        print"<caption> The Number of tornadoes in the US </caption>";

        foreach ($records as $oneRecord) {
            if ($oneRecord[0] != "") {  //the eof would be a "" 
                print "<tr><td>" . $oneRecord[0] . "</td> <td>" . $oneRecord[1] . "</td></tr>\n";
            }
        }
print"</table>";

        if ($debug)
            print "<p>End of processing.</p>\n";
        ?>



        <p> Economic Downturn is the slow rate of economic growth which usually lead to recession in the economy of countries. </p>

        <figure>
            <img src="pic6.jpg" alt=" This is an image from the great depression">
            <figcaption>Fig3. Image of the hardship during depression. </figcaption>
        </figure>






    </body>
</html>
