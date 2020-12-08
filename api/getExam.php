<?php
/**
 *
 * User: DT27
 * Date: 2019/8/12
 * Time: 22:24
 */
require_once('import.php');

$type = !empty($_REQUEST['type']) ? $_REQUEST['type'] : "A";

$qs = getExam($type);
switch ($type) {
    case "A":
        $allQ = getAQ(true);
        break;
    case "B":
        $allQ = getBQ(true);
        break;
    case "C":
        $allQ = getCQ(true);
        break;
}
$q = array();
$i = 0;
foreach ($qs as $k => $v) {
    $q[$i] = $allQ[$v];
    $q[$i]["index"] = $i;
    $i++;
}
echo json_encode($q);