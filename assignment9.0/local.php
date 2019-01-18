<?php
include "top.php";
include "header.php";
include "nav.php";
?>

<h3>Local Events </h3>

<p>The location of GroovyUv in Burlington, a city among America’s best college towns provides students
    access to first class quality entertainment when the school is not providing it. There are restaurants, 
    bars, malls and cinemas. This section of our website is dedicated to providing a listings of what always going the city.</p>

<h4> Events listings</h4>

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
print"<caption> Local Events Listings in Burlington</caption>";

foreach ($records as $oneRecord) {
    if ($oneRecord[0] != "") {  //the eof would be a "" 
        print "<tr><td>" . $oneRecord[0] . "</td> <td>" . $oneRecord[1] . "</td></tr>\n";
    }
}
print"</table>";

if ($debug)
    print "<p>End of processing.</p>\n";
?>

<figure> 
    <img src="photos/zen.jpg" alt="Zen lounge">
    <figcaption>Students at Zen Lounge</figcaption>
</figure>







<?php
include "footer.php";
?>

</body>
</html>

