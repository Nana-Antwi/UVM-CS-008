<!-- ######################     Main Navigation   ########################## -->
<nav>
    <ol>
        <?php
        /* This sets the current page to not be a link. Repeat this if block for
         *  each menu item */
        if ($path_parts['filename'] == "home") {
            print '<li class="activePage">Home</li>';
        } else {
            print '<li><a href="index.php">Home</a></li>';
        }
        
        /* example of repeating */ 
        if ($path_parts['filename'] == "introduction") {
            print '<li class="activePage">Introduction</li>';
        } else {
            print '<li><a href="intro.php">Introduction</a></li>';
        }
        
        if ($path_parts['filename'] == "global") {
            print '<li class="activePage">global</li>';
        } else {
            print '<li><a href="global.php">Global</a></li>';
        }
        
        if ($path_parts['filename'] == "political") {
            print '<li class="activePage">Political</li>';
        } else {
            print '<li><a href="political.php">Political</a></li>';
        }
        
        if ($path_parts['filename'] == "image") {
            print '<li class="activePage">Image</li>';
        } else {
            print '<li><a href="image.php">Image</a></li>';
        }
        
        if ($path_parts['filename'] == "form") {
            print '<li class="activePage">Make A Change</li>';
        } else {
            print '<li><a href="form.php">Make A Change</a></li>';
        }
        ?>
    </ol>
</nav>