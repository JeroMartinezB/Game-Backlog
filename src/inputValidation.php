<?php
function validate($data){
    $data = trim($data);          // remove spaces and newlines
    $data = stripslashes($data);  // remove backslashes
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // escape output
    return $data;
}
?>