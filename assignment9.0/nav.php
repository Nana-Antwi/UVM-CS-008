<nav>
    <ol>
        <?php
        /* This sets the current page to not be a link. Repeat this if block for
         *  each menu item */
        if ($path_parts['filename'] == "index") {
            print '<li class="activePage">Home</li>';
        } else {
            print '<li><a href="index.php">Home</a></li>';
        }
        
        if ($path_parts['filename'] == "Artist") {
            print '<li class="activePage">Artist</li>';
        } else {
            print '<li><a href="artist.php">Artist</a></li>';
        }
     
         if ($path_parts['filename'] == "Local Events") {
            print '<li class="activePage">Local Events </li>';
        } else {
            print '<li><a href="local.php">Local Events</a></li>';
        }
        
        
        if ($path_parts['filename'] == "Poll") {
            print '<li class="activePage">Poll</li>';
        } else {
            print '<li><a href="form.php">Poll</a></li>';
        }
        
        if ($path_parts['filename'] == "GroovyUV Concerts History") {
            print '<li class="activePage">GroovyUV Concerts History</li>';
        } else {
            print '<li><a href="history.php">GroovyUV Concerts History</a></li>';
        }
        
         if ($path_parts['filename'] == "Safety Tips") {
            print '<li class="activePage">Safety Tips</li>';
        } else {
            print '<li><a href="safety.php">Safety Tips</a></li>';
        }
        
        
        if ($path_parts['filename'] == "specs") {
            print '<li class="activePage"> Specification Document</li>';
        } else {
            print '<li><a href="specs.pdf">Specification Document</a></li>';
        }
        
        ?>
    </ol>
</nav>