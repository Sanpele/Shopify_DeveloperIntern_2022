<?php

function printHeader() {
    # READ AND ECHO HEADER
    $header = fopen("hypertext/header.html", "r") or die("unable to open file D");
    echo fread($header, filesize("hypertext/header.html"));
    fclose($header);
}

function printFooter() {
    # READ AND ECHO FOOTER
    $footer = fopen("hypertext/footer.html", "r") or die("unable to open file you absolute human");
    echo fread($footer, filesize("hypertext/footer.html"));
    fclose($footer);
}

function printSignIn() {
    echo '
    <form action="handle_form.php" method="post">
    <p>Sign In OR Sign Up</p>
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

}

/*
    lil option for user to view only their pictures or all images.
*/
function printFilter() {

}

/*
    prints html + images for all images in $arr_dir array
*/
function printImages($arr_dir) {

}

?>