<?php
include ("top.php");
?>


    <body id="image">
        
        <?php
        include ("header.php");
        ?>
        
        <h3> Image Map Of The Worlds Problems</h3>

        <nav>
            <ol>
                <li><a href="index.php"> Home</a></li>
                <li><a href="intro.php">Introduction</a></li>
                <li><a href="global.php">Global Warming / Hunger</a></li>
                <li><a href="political.php">Political Unrest / Natural Disaster / Economic Downturn</a></li>
                <li id="activePage">Image Map of World Problems</li>
                <li><a href="specs.pdf">Specification Document</a></li>
            </ol>

        </nav>
        
        <img src="Map.png" id="map" alt="World Map" usemap="#WorldMap">
        <map name="WorldMap">
            <area shape="rect" coords="3,4,363,173" href="http://www.climatehotmap.org/global-warming-solutions/north-america.html" target="_blank" alt="North America">
            <area shape="rect" coords="4,176,365,355" href="http://www.mapreport.com/subtopics/l/d.html" target="_blank" alt="South America">
            <area shape="circle" coords="463,212,92" href="http://www.savethechildren.org/site/c.8rKLIXMGIpI4E/b.8197811/k.616B/Fighting_Hunger_in_Africa.htm" target="_blank" alt="Africa">
            <area shape="rect" coords="428,20,574,132" href="http://topics.nytimes.com/top/reference/timestopics/subjects/e/european_sovereign_debt_crisis/index.html" target="_blank" alt="Europe">
            <area shape="rect" coords="557,8,683,279" href="http://articles.latimes.com/2000/aug/11/news/mn-2739" target="_blank" alt="Asia">
            
        </map>
        

           



           
    </body>
    <?php
    include ("footer.php");
    ?>
</html>
