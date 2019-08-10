<?php
/**
 * 头部文件
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-09 17:47:00
 */
$aQ = getAQ();
$a = getExam("A");
?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title ? $title . " - " : ""; ?>业余无线电|业余电台操作证书模拟考试</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://cdn.staticfile.org/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdn.staticfile.org/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-md navbar-expand-md navbar-dark<?php echo $title=="" ? " navbar-absolute navbar-transparant w-100" : " bg-primary"; ?>">
        <div class="container">
            <a href="/" class="navbar-brand d-flex align-items-center"> CQID</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item<?php echo $title == "" ? " active" : ""; ?>">
                        <a class="nav-link" href="/">首页</a>
                    </li>
                    <li class="nav-item<?php echo $title == "刷题" ? " active" : ""; ?>">
                        <a class="nav-link" href="/all.php">刷题</a>
                    </li>
                    <li class="nav-item<?php echo $title == "模拟考试" ? " active" : ""; ?>">
                        <a class="nav-link" href="/exam.php">模拟考试</a>
                    </li>
                </ul>
                <span class="navbar-text"><small>业余无线电台操作技术能力模拟考试平台</small></span>
            </div>
        </div>
    </nav>
</header>