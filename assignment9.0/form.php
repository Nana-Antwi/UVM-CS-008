<?php
include "top.php";
include "header.php";
include "nav.php";


//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// variables for the classroom purposes to help find errors.

$debug = false;

if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
    $debug = true;
}

if ($debug)
    print "<p>DEBUG MODE IS ON</p>";

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.
$yourURL = $domain . $phpSelf;


//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1c form variables
//
// Initialize variables one for each form element
// in the order they appear on the form
$firstName = "";
$lastName = "";
$email = "lbrown20@uvm.edu";
$comments = "";
$gender = "Female";
$class = "Freshman";
$bigsean = true;    // checked
$cleanbandit = false; // not checked
$samsmith = false;
$vancejoy = false;
$emotion = "Pumped";    // pick the option
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$firstNameERROR = false;
$lastNameERROR = false;
$emailERROR = false;

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();

// array used to hold form values that will be written to a CSV file
$dataRecord = array();

$mailed = false; // have we mailed the information to the user?
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
    // SECTION: 2a Security
// 
    if (!securityCheck(true)) {
        $msg = "<p>Sorry you cannot access this page. ";
        $msg.= "Security breach detected and reported</p>";
        die($msg);
    }

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
    // SECTION: 2b Sanitize (clean) data 
// remove any potential JavaScript or html code from users input on the
// form. Note it is best to follow the same order as declared in section 1c.

    /* $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
      $dataRecord[] = $firstName;
     * 
     */
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;

    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lastName;

    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;

    $comments = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $comments;

    $gender = htmlentities($_POST["radGender"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $gender;

    $class = htmlentities($_POST["radClass"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $class;

    if (isset($_POST["chkBigSean"])) {
        $bigsean = true;
    } else {
        $bigsean = false;
    }
    $dataRecord[] = $bigsean;

    if (isset($_POST["chkCleanBandit"])) {
        $cleanbandit = true;
    } else {
        $cleanbandit = false;
    }
    $dataRecord[] = $cleanbandit;

    if (isset($_POST["chkSamSmith"])) {
        $samsmith = true;
    } else {
        $samsmith = false;
    }
    $dataRecord[] = $samsmith;

    if (isset($_POST["chkVanceJoy"])) {
        $vancejoy = true;
    } else {
        $vancejoy = false;
    }
    $dataRecord[] = $vancejoy;

    $emotion = htmlentities($_POST["lstEmotions"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $emotion;



//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
    // SECTION: 2c Validation
//
    // Validation section. Check each value for possible errors, empty or
// not what we expect. You will need an IF block for each element you will
// check (see above section 1c and 1d). The if blocks should also be in the
// order that the elements appear on your form so that the error messages
// will be in the order they appear. errorMsg will be displayed on the form
// see section 3b. The error flag ($emailERROR) will be used in section 3c.


    if ($firstName == "") {
        $errorMsg[] = "Please enter your first name";
        $firstNameERROR = true;
    } elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = "Your first name appears to have extra character.";
        $firstNameERROR = true;
    }

    if ($lastName == "") {
        $errorMsg[] = "Please enter your last name";
        $lastNameERROR = true;
    } elseif (!verifyAlphaNum($lastName)) {
        $errorMsg[] = "Your last name appears to have extra character.";
        $lastNameERROR = true;
    }

    if ($email == "") {
        $errorMsg[] = "Please enter your email address";
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = "Your email address appears to be incorrect.";
        $emailERROR = true;
    }

    if ($comments == "") {
        $errorMsg[] = "Please submit your comments";
        $commentsERROR = true;
    } elseif (!verifyAlphaNum($comments)) {
        $errorMsg[] = "Your comment seems to have an error.";
        $commentsERROR = true;
    }

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
    // SECTION: 2d Process Form - Passed Validation
//
    // Process for when the form passes validation (the errorMsg array is empty)
//
    if (!$errorMsg) {
        if ($debug)
            print "<p>Form is valid</p>";

//#############################################################################
////@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2e Save Data
//
// This block saves the data to a CSV file.

        $fileExt = ".csv";

        $myFileName = "data/registration";

        $filename = $myFileName . $fileExt;


        if ($debug)
            print "\n\n<p>filename is " . $filename;

// now we just open the file for append
        $file = fopen($filename, 'a');

// write the forms information
        fputcsv($file, $dataRecord);

// close the file
        fclose($file);
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
        // SECTION: 2f Create message
//
        // build a message to display on the screen in section 3a and to mail
// to the person filling out the form (section 2g).

        $message = '<h2>Your information.</h2>';

        foreach ($_POST as $key => $value) {

            $message .= "<p>";

            $camelCase = preg_split('/(?=[A-Z])/', substr($key, 3));

            foreach ($camelCase as $one) {
                $message .= $one . " ";
            }
            $message .= " = " . htmlentities($value, ENT_QUOTES, "UTF-8") . "</p>";
        }


//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
        // SECTION: 2g Mail to user
//
        // Process for mailing a message which contains the forms data
// the message was built in section 2f.
        $to = $email; // the person who filled out the form
        $cc = "";
        $bcc = "";
        $from = "GroovyUV Concerts <noreply@groovyuvconcerts.com>";

// subject of mail should make sense to your form
        $todaysDate = strftime("%x");
        $subject = "Research Study: " . $todaysDate;

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
    }
}// end form is valid
// ends if form was submitted.
//
// SECTION 3 Display Form
//
?>

<article id="main">

    <?php
// SECTION 3a.
//
// 
// 
// 
// If its the first time coming to the form or there are errors we are going
// to display the form.
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
        print "<h1>Your Request has ";

        if (!$mailed) {
            print "not ";
        }

        print "been processed</h1>";

        print "<p>A copy of this message has ";
        if (!$mailed) {
            print "not ";
        }
        print "been sent</p>";
        print "<p>To: " . $email . "</p>";
        print "<p>Mail Message:</p>";

        print $message;
    } else {


        //####################################
        //
        // SECTION 3b Error Messages
        //
        // display any error messages before we print out the form

        if ($errorMsg) {
            print '<div id="errors">';
            print "<ol>\n";
            foreach ($errorMsg as $err) {
                print "<li>" . $err . "</li>\n";
            }
            print "</ol>\n";
            print '</div>';
        }


        //####################################
        //
        // SECTION 3c html Form
        //
        /* Display the HTML form. note that the action is to this same page. $phpSelf
          is defined in top.php
          NOTE the line:

          value="<?php print $email; ?>

          this makes the form sticky by displaying either the initial default value (line 35)
          or the value they typed in (line 84)

          NOTE this line:

          <?php if($emailERROR) print 'class="mistake"'; ?>

          this prints out a css class so that we can highlight the background etc. to
          make it stand out that a mistake happened here.

         */
        ?>

        <p>Here at <i>Groovy UV Concerts,</i> your request, comments, and feedback 
            are very important to us. In fact, your voice is the reason we made this site.
            If you have a moment, please take the time to fill out the form below. 
            In order to make your college experience the very best it can be, it is
            important to us that you have the opportunity to make your voice heard. 
            Take a minute, let yourself take a stand! Thank you very much and have a 
            wonderful day!</p>
        <form action="<?php print $phpSelf; ?>"
              method="post"
              id="frmRegister">

            <fieldset class="wrapper">
                <legend>Contact Information</legend>
                <p>Tell us a little about how to get in contact with you<span 
                        class="required"> </span></p>

                <fieldset class="wrapperTwo">
                    <legend>Please complete the following form</legend>

                    <fieldset class="contact">
                        <legend>Contact Information</legend>
                        <label for="txtFirstName" class="required">First Name
                            <input type="text" id="txtFirstName" name="txtFirstName"
                                   value="<?php print $firstName; ?>"
                                   tabindex="100" maxlength="45" placeholder="Enter your first name"
                                   <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                                   onfocus="this.select()"
                                   autofocus>
                        </label>
                        <label for="txtLastName" class="required">Last Name
                            <input type="text" id="txtLastName" name="txtLastName"
                                   value="<?php print $lastName; ?>"
                                   tabindex="100" maxlength="45" placeholder="Enter your last name"
                                   <?php if ($lastNameERROR) print 'class="mistake"'; ?>
                                   onfocus="this.select()"
                                   autofocus>
                        </label>

                        <label for="txtEmail" class="required">Email
                            <input type="text" id="txtEmail" name="txtEmail"
                                   value="<?php print $email; ?>"
                                   tabindex="120" maxlength="45" placeholder="Enter a valid email address"
                                   <?php if ($emailERROR) print 'class="mistake"'; ?>
                                   onfocus="this.select()" 
                                   >
                        </label>

                    </fieldset>
                    </fieldset> <!-- ends contact -->

                    <fieldset class="radio">
                      
                        
                        <legend>What is your gender?</legend>
                        <label><input type="radio" 
                                      id="radGenderMale" 
                                      name="radGender" 
                                      value="Male"
                                      <?php if ($gender == "Male") print 'checked' ?>
                                      tabindex="330">Male</label>
                        <label><input type="radio" 
                                      id="radGenderFemale" 
                                      name="radGender" 
                                      value="Female"
                                      <?php if ($gender == "Female") print 'checked' ?>
                                      tabindex="340">Female</label>
                        <label><input type="radio" 
                                      id="radGenderOther" 
                                      name="radGender" 
                                      value="Other"
                                      <?php if ($gender == "Other") print 'checked' ?>
                                      tabindex="340">Other</label>
                    </fieldset>
                    <fieldset class="radio">
                        <legend>What is your class?</legend>
                        <label><input type="radio" 
                                      id="radClassFreshman" 
                                      name="radClass" 
                                      value="Freshman"
                                      <?php if ($class == "Freshman") print 'checked' ?>
                                      tabindex="330">Freshman</label>
                        <label><input type="radio" 
                                      id="radClassSophomore" 
                                      name="radClass" 
                                      value="Sophomore"
                                      <?php if ($class == "Sophomore") print 'checked' ?>
                                      tabindex="340">Sophomore</label>
                        <label><input type="radio" 
                                      id="radClassJunior" 
                                      name="radClass" 
                                      value="Junior"
                                      <?php if ($class == "Junior") print 'checked' ?>
                                      tabindex="340">Junior</label>
                        <label><input type="radio" 
                                      id="radClassSenior" 
                                      name="radClass" 
                                      value="Senior"
                                      <?php if ($class == "Senior") print 'checked' ?>
                                      tabindex="340">Senior</label>
                    </fieldset>
                    <fieldset class="checkbox">
                        <legend>Who would you like to see at UVM (check all that apply):</legend>
                        <label><input type="checkbox" 
                                      id="chkBigSean" 
                                      name="chkBigSean" 
                                      value="BigSean"
                                      <?php if ($bigsean) print ' checked '; ?>
                                      tabindex="420">Big Sean</label>

                        <label><input type="checkbox" 
                                      id="chkCleanBandit" 
                                      name="chkCleanBandit" 
                                      value="CleanBanit"
                                      <?php if ($cleanbandit) print ' checked '; ?>
                                      tabindex="430">Clean Bandit</label>

                        <label><input type="checkbox" 
                                      id="chkSamSmith" 
                                      name="chkSamSmith" 
                                      value="SamSmith"
                                      <?php if ($samsmith) print ' checked '; ?>
                                      tabindex="430">Sam Smith</label>

                        <label><input type="checkbox" 
                                      id="chkVanceJoy" 
                                      name="chkvanceJoy" 
                                      value="VanceJoy"
                                      <?php if ($vancejoy) print ' checked '; ?>
                                      tabindex="430">Vance Joy</label>
                    </fieldset>
                    <fieldset  class="listbox">	
                        <label for="lstEmotions">How Excited Are You?</label>
                        <p> 
                        <select id="lstEmotions" 
                                name="lstEmotions" 
                                tabindex="520" >
                            <option <?php if ($emotion == "Meh") print " selected "; ?>
                                value="Meh" >Meh...</option>

                            <option <?php if ($emotion == "Excited") print " selected "; ?>
                                value="Excited">Excited</option>

                            <option <?php if ($emotion == "STOKED") print " selected "; ?>
                                value="STOKED">STOKED!!!</option>

                        </select>
                        </p>
                    </fieldset>
                    <fieldset  class="textarea">
                        <legend>Please leave any additional comments</legend>
                        <label for="txtComments" class="required">Comments</label>
                        <textarea id="txtComments" 
                                  name="txtComments" 
                                  tabindex="200"
                                  <?php if ($commentsERROR) print 'class="mistake"'; ?>
                                  onfocus="this.select()" 
                                  style="width: 25em; height: 4em;" ><?php print $comments; ?></textarea>
                    </fieldset>


                </fieldset> <!-- ends wrapper Two -->

                <fieldset class="buttons">
                    <legend></legend>
                    <input type="submit" id="btnSubmit" name="btnSubmit" value="Register" tabindex="900" class="button">
                </fieldset> <!-- ends buttons -->

           <!-- Ends Wrapper -->
        </form>

        <?php
    } // end body submit
    ?>

</article>

<?php include "footer.php"; ?>

</body>
</html>
