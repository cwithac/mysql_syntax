<?php

// clean the form data to prevent injections

/*  Built in functions used:
    trim()
    stripslashes()
    htmlspecialchars()
     > ENT_QUOTES
    strip_tags()
    str_replace()
      > https://www.w3schools.com/php/func_string_str_replace.asp
*/

function validateFormData($formData) {
    $formData = trim( stripslashes( htmlspecialchars( strip_tags( str_replace( array( '(', ')' ), '', $formData ) ), ENT_QUOTES ) ) );
    return $formData;
}

 ?>
