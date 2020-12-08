<?php
/**
 * 题库
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-10-30 10:00:03
 */

require_once __DIR__ . '/../bin/Server.php';
require_once('import.php');

$response = array('status' => '0', 'msg' => 'failed', 'data' => '');

$type = !empty($_REQUEST['type']) ? $_REQUEST['type'] : "A";
if (!empty($_REQUEST['act']) && $_REQUEST['act'] == 'getErrorQ') {
    if (empty($_COOKIE["cqid"])) {
        $response['msg'] = "未登录";
        header("Content-type:text/html;charset=utf-8");
        echo json_encode($response);
        exit;
    }
    $uid = json_decode($_COOKIE["cqid"], true)["id"];
    if ($errorQ = $storage->getErrorQ($uid, $type)) {
        echo $errorQ["errorQ"];
        exit;
    } else {
        $response['msg'] = "无记录";
        header("Content-type:text/html;charset=utf-8");
        echo json_encode($response);
        exit;
    }
}else if(!empty($_REQUEST['act']) && $_REQUEST['act'] == 'setErrorQ') {
    if (empty($_COOKIE["cqid"])) {
        $response['msg'] = "未登录";
        header("Content-type:text/html;charset=utf-8");
        echo json_encode($response);
        exit;
    }
    $uid = json_decode($_COOKIE["cqid"], true)["id"];
    if($storage->setErrorQ($uid,$type,$_REQUEST["errorQ"])){
        $response['msg'] = "未登录";
    }
    exit;
}

switch ($type) {
    case "A":
        $allQ = getAQ(false);
        break;
    case "B":
        $allQ = getBQ(false);
        break;
    case "C":
        $allQ = getCQ(false);
        break;
}

$q = array();
$i = 0;
foreach ($allQ as $k => $v) {
    $q[$i] = $v;
    $q[$i]["index"] = $i;
    $i++;
}
echo json_encode($q);