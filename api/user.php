<?php
/**
 * 用户操作
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-09 18:07:00
 */
require_once __DIR__ . '/../bin/Server.php';
require_once __DIR__ . '/../bin/Dotenv.php';
Dotenv::load(__DIR__ . "/../");
$domain = getenv("domain");

$response = array('status' => '0', 'msg' => 'failed', 'data' => '');

if (!empty($_POST['act']) && $_POST['act'] == 'signup') {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
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
    $result = $storage->checkUserCredentials($username, $password);
    if ($result) {
        $user = $storage->getUserDetails($username);
        $slat = substr($user["password"], -8);
        $pub_key = getenv("pub_key");
        $pubPem = chunk_split($pub_key, 64, "\n");
        $pubPem = "-----BEGIN PUBLIC KEY-----\n" . $pubPem . "-----END PUBLIC KEY-----\n";
        openssl_public_encrypt($username . $slat, $token, openssl_pkey_get_public($pubPem));
        if ($storage->userLogin($username, base64_encode($token))) {
            $expire = time() + 3600 * 24 * 60;
            setcookie("cqid", '{"id":"' . $user["id"] . '","name":"' . $username . '","token":"' . base64_encode($token) . '"}', $expire, "/", $domain);//,"expire":"'.$expire.'","domain":".cqid.cn","secure":"TRUE"}
            //var_dump($_COOKIE["cqid"]);
        } else {
            $response['msg'] = '登录失败，请点击页面底部的"意见/反馈"进行反馈。';
            goto E;
        }
        $response['status'] = '1';
        $response['msg'] = 'success';
        $response['data'] = array("username" => $username);
    } else {
        $response['msg'] = '用户名或密码错误！';
    }
} else if (!empty($_POST['act']) && $_POST['act'] == 'chkUser') {
    $username = $_POST["name"];
    $token = $_POST["token"];
    $user = $storage->getUserDetails($username);
    if ($token == $user["token"]) {
        $response['status'] = '1';
        $response['msg'] = 'success';
        $response['data'] = array("username" => $username);
    } else {
        $response['msg'] = '请登录';
    }
} else if (!empty($_POST['act']) && $_POST['act'] == 'logout') {
    $username = $_POST["name"];
    $token = $_POST["token"];
    $user = $storage->getUserDetails($username);
    if ($token == $user["token"]) {
        if ($storage->logout($username)) {
            $response['status'] = '1';
            $response['msg'] = 'success';
            $response['data'] = array("username" => "");
        }
    } else {
        $response['msg'] = '未登录';
    }
} else if (!empty($_POST['act']) && $_POST['act'] == 'userInfo') {
    if ($storage->checkUser($_POST["name"], $_POST["token"], $storage)) {
        $username = $_POST["name"];
        $user = $storage->getUserDetails($username);
        unset($user["password"]);
        unset($user["token"]);
        unset($user["id"]);
        unset($user["user_id"]);
        unset($user["scope"]);
        unset($user["email_verified"]);

        $response['status'] = '1';
        $response['msg'] = 'success';
        $response['data'] = $user;
    } else {
        $response['msg'] = '请登录';
    }
}
E:
header("Content-type:text/html;charset=utf-8");
echo json_encode($response);
