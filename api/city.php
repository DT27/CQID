<?php
/**
 * 各地考试报名
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-11-09 11:09:54
 */
require_once __DIR__ . '/../bin/Server.php';

$response = array('status' => 0, 'msg' => 'failed', 'data' => '');

if (!empty($_POST['act']) && $_POST['act'] == 'getCity') {
    $code = $_POST["code"];
    $city = $storage->getCity($code);
    if ($city) {
        if ($city['update_date'] == "0000-00-00 00:00:00") {
            $city['update_date'] = $city['create_date'];
        }
        $response['status'] = 1;
        $response['msg'] = 'success';
        $response['data'] = $city;
    } else {
        $response['msg'] = "暂无记录，欢迎补充！";
    }
} else if (!empty($_POST['act']) && $_POST['act'] == 'updateCity') {
    $code = $_POST["selCity"];
    $website = $_POST["website"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $wx = $_POST["wx"];
    $ps = $_POST["ps"];

    if (!empty($_COOKIE["cqid"])) {
        $cook = json_decode($_COOKIE["cqid"]);
        $username = $cook->name;
        $token = $cook->token;
        $user = $storage->getUserDetails($username);
    }
    $result = 0;
    if (!empty($_COOKIE["cqid"]) && !empty($user["token"]) && $token == $user["token"]) {
        $result = $storage->updateCity($code, $website, $name, $phone, $wx, $ps, 1);
    } else {
        $result = $storage->updateCity($code, $website, $name, $phone, $wx, $ps, 0);
    }
    if ($result) {
        $response['status'] = '1';
        $response['msg'] = 'success';
        $response['data'] = '';
    } else {
        $response['msg'] = '更新失败';
    }
}
E:
header("Content-type:text/html;charset=utf-8");
echo json_encode($response);
