<?php
include ('functions/config.php');
require_once('functions/functions.php');
if (!check_session()){
    header ("Location: $serviceurl/?error=1");
    exit;
}
slash_vars();
$vm=$_POST['vm'];
$hypervisor=$_POST['hypervisor'];
$snapshot=$_POST['snapshot'];
$snapshot=str_replace("on","true",$snapshot);
$shapshot=str_replace("off","false",$snapshot);
if (empty ($snapshot))
    $snapshot="false";
$source_volume=$_POST['source_volume'];
$machine_type=$_POST['machine_type'];
if ($machine_type=="simplemachine"||$machine_type=="sourcemachine")
    $source_volume="";
if (empty($vm)&&empty($hypervisor)){
    header("Location: $serviceurl/dashboard.php");
    exit;
}
add_SQL_line("UPDATE vms SET snapshot='$snapshot',source_volume='$source_volume',machine_type='$machine_type' WHERE id='$vm'");
header("Location: $serviceurl/dashboard.php");
exit;
?>