<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
return array(
    "email"=>array(
        "sendErrorEmails"=>false
    ),
    "view_manager"=>array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
    )
)
?>
