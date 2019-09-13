<?php
/**
 * 获取公钥
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-09-13 13:52
 */

$response = array('status' => '0', 'msg' => 'success', 'data' => '');
require_once __DIR__ . '/../bin/Dotenv.php';
try {

    Dotenv::load(__DIR__ . "/../");
    $public_key = getenv("pub_key");

    $response["status"] = '1';
    $response["msg"] = "success";
    $response["data"] = array("public_key" => $public_key);
} catch (Exception $e) {
    $response["msg"] = $e->getMessage();
}

header("Content-type:text/html;charset=utf-8");
echo json_encode($response);