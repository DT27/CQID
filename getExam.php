<?php
/**
 * Created by PhpStorm.
 * User: DT27
 * Date: 2019/8/12
 * Time: 22:24
 */
require_once('import.php');

$type = empty($_REQUEST['type']) ? "A" : $_REQUEST['type'];

$qs = getExam($type);
switch ($type) {
    case "A":
        $allQ = getAQ();
        break;
    case "B":
        $allQ = getBQ();
        break;
    case "C":
        $allQ = getCQ();
        break;
    default:
        $allQ = getAQ();
        break;
}
$q = array();
$i = 0;
foreach ($qs as $k => $v){
    $q[$i] = $allQ[$v];
    $q[$i]["index"] = $i;
    $i++;
}
echo json_encode($q);