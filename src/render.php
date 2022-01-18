<?php

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();

function printHeader() {
    # READ AND ECHO HEADER
    $header = fopen("hypertext/header.html", "r") or die("unable to open file");
    echo fread($header, filesize("hypertext/header.html"));
    fclose($header);
}

function printFooter() {
    # READ AND ECHO FOOTER
    $footer = fopen("hypertext/footer.html", "r") or die("unable to open file");
    echo fread($footer, filesize("hypertext/footer.html"));
    fclose($footer);
}

function printLogout() {
    echo '
    <br>
    <br>
    <form action="redirects/log_out_redirect.php" method="post">
    <Button type="submit" name="Log Out" />Log Out</Button>
    </form>
    <hr>

    ';
}

function printSignUp() {
    echo '
    <form action="redirects/log_in_guest_redirect.php" method="post">
    Sign in as Guest : <Button type="submit" name="Sign In" />Guest Sign In</Button>
    </form>
    <form action="redirects/log_out_redirect.php" method="post">
    Existing User : <Button type="submit" name="Sign In" />Existing User (Sign In)</Button>
    </form>
    <form action="sign_up.php" method="post">
    <p>Sign Up (with a new username and password) :</p>
    <p>Your username: <input type="text" name="username" /></p>
    <p>Your password: <input type="text" name="password" /></p>
    <p><input type="submit" name="Sign In" /></p>
    </form>

    <hr>

    ';
}

function printSignIn() {
    echo '
    <form action="redirects/sign_up_redirect.php" method="post">
    Sign Up : <Button type="submit" name="Sign In" />New User (Sign Up)</Button>
    </form>
    <form action="handle_login_form.php" method="post">
    <p>Sign In</p>
    <p>Your username: <input type="text" name="username" /></p>
    <p>Your password: <input type="text" name="password" /></p>
    <p><input type="submit" name="Sign In" /></p>
    </form>

    <hr>
    ';
}


/*
    prints some of the imformation about the user
*/
function printInfo() {
    
    if ($_SESSION['username'] === "guest") { // just guest info
        echo "<br>You are a Guest, please take off your shoes before entering the house. <br> Thanks ";
    }   
    else { // user logged in, display full info
        echo "<br>Specific, relevant and in-depth user info";
    }   

    // also add abbility for user to upload images
    echo "<p> Images must one of the following formates: jpeg, jpg, png, or gif </p>";
    echo "<p> Likewise the max filesize of an image is 500kb currently";
    echo '
    <form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
    </form>
    ';

    echo "<hr>";

}

function printRefreshButton() {
    echo '
    <form action="redirects/refresh.php" method="post">
    <Button type="submit" name="Sign In" />Take Me Back</Button>
    </form>
    ';
}

/*
    lil option for user to view only their pictures or all images.
*/
function printFilter() {

}

/*
    prints html + images for all images in $arr_dir array
*/
function printImages($arr_of_dir) {
    // echo "Pictures are of the following Dir";
    // print_r($arr_of_dir);
}

?>