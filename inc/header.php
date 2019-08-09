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
    <title><?php echo $title?$title." - ":""; ?>业余无线电|业余电台操作证书模拟考试</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .list-group-item {
            padding: 0.2rem 2.5rem;
        }

        .form-check label {
            margin-bottom: 0;
        }
    </style>
    <script src="https://cdn.staticfile.org/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdn.staticfile.org/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>
</head>
<body>
<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <img src="images/logo.svg" width="30" height="30" class="d-inline-block align-top" alt=""> CQExam</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item<?php echo $title==""?" active":"";?>">
                        <a class="nav-link" href="/">首页</a>
                    </li>
                    <li class="nav-item<?php echo $title=="刷题"?" active":"";?>">
                        <a class="nav-link" href="/all.php">刷题</a>
                    </li>
                    <li class="nav-item<?php echo $title=="模拟考试"?" active":"";?>">
                        <a class="nav-link" href="/exam.php">模拟考试</a>
                    </li>
                </ul>
                <span class="navbar-text">
      业余无线电台操作技术能力模拟考试
    </span>
            </div>
        </nav>
    </div>
</header>