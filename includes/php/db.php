<?php
//Load the settings
require_once('settings.php');
//Make da db conn fam
$db = new PDO(DB_CONN);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>