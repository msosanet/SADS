<?php

/*
 * The trigger library (Please, don't change anything in this file)
 *
 */

include ('config.inc.php');
include ('cookie.inc.php');
include ('theme.inc.php');
include ('db.inc.php');
include ('functions.inc.php');
include ('form.inc.php');

$theme['form_class'] = 'Sylex PHP forms';
$theme['form_class_version'] = '1.0.0';

$cookie = new cookie();

if (isset($_GET['action']) && $_GET['action'] == 'error') return false; else $db = new db();

?>
