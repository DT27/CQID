<?php
/**
 * 头部文件
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-09 17:47:00
 */
?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#1283DA">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" sizes="192x192" href="/images/logo_192.png">
    <title><?php isset($title) ? ($title . " - ") : ""; ?>业余无线电考试|业余电台操作证书模拟考试</title>
    <meta name="description" content="<?php isset($description) ? $description : ""; ?>业余无线电台操作证书模拟考试"/>
    <meta name="keywords" content="<?php isset($keywords) ? $keywords: ""; ?>业余无线电考试,业余无线电,业余电台,业余无线电模拟考试,业余无线电证书,业余无线电台操作证书,无线电题库"/>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/js-cookie/2.2.1/js.cookie.min.js"></script>
    <script src="https://cdn.staticfile.org/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
    <script data-ad-client="ca-pub-6756415375138735" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head>
<body>
<header>
    <nav class="navbar navbar-md navbar-expand-md navbar-dark<?php echo $title == "" || $title == "注册" || $title == "登录" ? " navbar-absolute navbar-transparant w-100" : " bg-primary"; ?><?php if ($title == "") echo " d-md-block"; ?>">
        <div class="container">
            <a href="/" class="navbar-brand d-flex align-items-center" title="业余无线电台操作技术能力模拟考试平台"> 业余无线电模拟考试平台</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item<?php echo $title == "" ? " active" : ""; ?>">
                        <a class="nav-link" title="首页" href="/">首页</a>
                    </li>
                    <li class="nav-item<?php echo $title == "浏览题库" ? " active" : ""; ?>">
                        <a class="nav-link" title="业余无线电题库" href="/all/">浏览题库</a>
                    </li>
                    <li class="nav-item<?php echo $title == "刷题" ? " active" : ""; ?>">
                        <a class="nav-link font-weight-bold" title="刷题" href="/exercise/">刷 题<small class="text-danger">推荐</small></a>
                    </li>
                    <li class="nav-item<?php echo $title == "模拟考试" ? " active" : ""; ?>">
                        <a class="nav-link" title="业余无线电模拟考试" href="/exam/">模拟考试</a>
                    </li>
                  <li class="nav-item">
                  <a class="nav-link" href="https://www.cqid.cn/news/article">各地考试信息</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="https://www.cqid.cn/news/ask">提问</a>
                  </li>
                </ul>
                <div class="navbar-nav" id="user-center"></div>
            </div>
        </div>
    </nav>
</header>