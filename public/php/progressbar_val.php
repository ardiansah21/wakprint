<?php
// set session
session_start();
// code for progress bar using PHP
// max execution time
ini_set('max_execution_time', 0);
// we to get unlimited php script for execution time

// check session
if (empty($_SESSION['ind'])) {
    $_SESSION['ind'] = 0;
}

// check session
$set_total = 100;
for ($ind = $_SESSION['ind']; $ind < $set_total; $ind++) {
    $_SESSION['ind'] = $ind;
    $percent_val = intval($ind / $set_total * 100) . "%";

    sleep(1);
    // Here call over time taking function like sending bulk sms etc.

    echo '<script>
    parent.document.getElementById("progressbar").innerHTML="<div style=\"width:' . $percent_val . ';background:linear-gradient(to bottom, rgba(126,126,126,1) 0%,rgba(15,15,15,1) 100%); ;height:36px;\">&nbsp;</div>";
    parent.document.getElementById("informations").innerHTML="<div style=\"text-align:center; font-weight:bold\">' . $percent_val . ' is processed.</div>";</script>';

    // ob_flush and flush process
    ob_flush();
    flush();
}
echo '<script>parent.document.getElementById("informations").innerHTML="<div style=\"text-align:center; font-weight:bold\">Process completed.</div>"</script>';

// session destroy
session_destroy();
