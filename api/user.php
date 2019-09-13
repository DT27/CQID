<?php
/**
 * 用户操作
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-09 18:07:00
 */
require_once __DIR__ . '/../bin/Server.php';

$response = array('status' => '0', 'msg' => 'failed', 'data' => '');
if (!empty($_POST['act']) && $_POST['act'] == 'signup') {
    $email = $_POST["email"];
    $username = $_POST["username"];
    if (empty($email) || empty($username) || empty($password)) {
        $response['msg'] = '请填写完整！';
        goto E;
    }
    $userByEmail = $storage->getUserDetailsByEmail($email);
    if (!empty($userByEmail) && $userByEmail['password'] != "") {
        $response['msg'] = '该邮箱已注册';
    } else {
        $userByName = $storage->getUserDetails($username);
        if (empty($userByName) && $userByName['password'] != "") {
            $response['msg'] = '用户名已存在';
            goto E;
        }
        $password = $_POST["password"];

        //openssl_private_decrypt(base64_decode($password),$d_pass,$pri_key);//私钥解密

        $result = $storage->setUser($username, $password, $email);
        if ($result) {
            $response['status'] = '1';
            $response['msg'] = 'success';
            $response['data'] = '';
        }

    }
} else if (!empty($_POST['act']) && $_POST['act'] == 'login') {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = $storage->checkUserCredentials($username,$password);
    if ($result) {
        $response['status'] = '1';
        $response['msg'] = 'success';
        $response['data'] = array("username"=>$username);
    }else{
        $response['msg'] = '用户名或密码错误！';
    }
}
E:
header("Content-type:text/html;charset=utf-8");
echo json_encode($response);
