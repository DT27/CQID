<?php
/**
 * 刷题
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-07 08:13:50
 */

include('import.php');
$type = empty($_REQUEST['type']) ? "A" : $_REQUEST['type'];
switch ($type) {
    case "A":
        $qs = getAQ();
        $qsNum = count($aQNum);
        break;
    case "B":
        $qs = getBQ();
        $qsNum = count($bQNum);
        break;
    case "C":
        $qs = getCQ();
        $qsNum = count($cQNum);
        break;
    default:
        $qs = getAQ();
        $qsNum = count($aQNum);
        break;
}
?>
<!doctype html>
<html lang="zh">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .list-group-item {
            padding: 0.2rem 2.5rem;
        }

        .form-check label {
            margin-bottom: 0;
        }
    </style>
    <title>刷题 - 业余无线电|业余无线电台操作技术能力模拟考试</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="/">首页</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/all.php">刷题</a>
                    </li>
                    <li class="nav-item">
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
<main class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="input-group mb-4" style="max-width: 25rem;">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="qType">业余电台操作证书分类</label>
                </div>
                <select class="custom-select" id="qType" name="qType">
                    <option>请选择...</option>
                    <option value="A"<?php echo $type=="A"?" selected":"";?>>A类<?php echo " " . count($aQNum) . "题"; ?></option>
                    <option value="B"<?php echo $type=="B"?" selected":"";?>>B类<?php echo " " . count($bQNum) . "题"; ?></option>
                    <option value="C"<?php echo $type=="C"?" selected":"";?>>C类<?php echo " " . count($cQNum) . "题"; ?></option>
                </select>
            </div>
        </div>

        <div class="text-center" id="loading">
            <div class="spinner-border" role="status">
                <span class="sr-only">正在加载题库...</span>
            </div>
        </div>
        <div class="row">
            <?php

            for ($i = 0; $i < $qsNum; $i++) {
                $q = $qs[$i];
                ?>
                <div class="card mb-4 d-none" data-num="<?php echo $q['I'] ?>" style="min-width: 90%;">
                    <div class="card-body">
                        <p class="card-text">
                            <span class="text-success mr-1"><?php echo $i + 1 . '/' . $qsNum; ?></span><?php
                            echo $q['Q']
                            ?>
                        </p>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item list-group-item-action form-check">
                            <input class="form-check-input" type="radio" name="a-<?php echo $q['I'] ?>" id="a1-<?php echo $q['I'] ?>" value="option1" checked disabled><label for="a1-<?php echo $q['I'] ?>"><?php echo $q['A'] ?></label>
                        </div>

                        <div class="list-group-item list-group-item-action form-check">
                            <input class="form-check-input" type="radio" name="a-<?php echo $q['I'] ?>" id="a2-<?php echo $q['I'] ?>" value="option1" disabled><label for="a2-<?php echo $q['I'] ?>"><?php echo $q['B'] ?></label>
                        </div>

                        <div class="list-group-item list-group-item-action form-check">
                            <input class="form-check-input" type="radio" name="a-<?php echo $q['I'] ?>" id="a3-<?php echo $q['I'] ?>" value="option1" disabled><label for="a3-<?php echo $q['I'] ?>"><?php echo $q['C'] ?></label>
                        </div>

                        <div class="list-group-item list-group-item-action form-check">
                            <input class="form-check-input" type="radio" name="a-<?php echo $q['I'] ?>" id="a4-<?php echo $q['I'] ?>" value="option1" disabled><label for="a4-<?php echo $q['I'] ?>"><?php echo $q['D'] ?></label>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <ul id="pagination-demo" class="pagination-sm"></ul>
        </div>
    </div>
</main>
<footer class="text-muted">
    <div class="container">
        <p class="float-right text-right">
            © <a href="https://dt27.org" target="_blank">DT27</a><br>
        </p>
        <p>最新题库版本：<a href="http://www.crac.org.cn/" target="_blank">v171031</a></p>
        <div class="text-center">
            <small>已运行：<span id="runTime"></span></small>
        </div>
    </div>
</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.slim.min.js"></script>
<script src="js/jquery.cookie.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.twbsPagination.min.js"></script>
<script>
    $(function () {
        var date1 = '2019-08-06 18:27:00';      //开始时间
        var date2 = new Date(); //结束时间
        var date3 = date2.getTime() - new Date(date1).getTime();    //时间差的毫秒数
        //计算出相差天数
        var days = Math.floor(date3 / (24 * 3600 * 1000));
        //计算出小时数
        var leave1 = date3 % (24 * 3600 * 1000); //计算天数后剩余的毫秒数
        var hours = Math.floor(leave1 / (3600 * 1000))
        //计算相差分钟数
        var leave2 = leave1 % (3600 * 1000); //计算小时数后剩余的毫秒数
        var minutes = Math.floor(leave2 / (60 * 1000));
        $("#runTime").text(days + "天 " + hours + "小时 " + minutes + " 分钟");
    })


    var pageNum = Math.ceil(<?php echo $qsNum;?> / 10
    )
    ;
    /**
     * 分页加载数据
     */
    $(function () {
        $('#loading').hide();
        $(".card[data-num]:lt(10)").removeClass("d-none");
        $('#pagination-demo').twbsPagination({
            totalPages: pageNum,
            visiblePages: 5,
            first:'<span aria-hidden="true">&laquo;</span>',
            last:'<span aria-hidden="true">&raquo;</span>',
            prev: '<span aria-hidden="true">&lt;</span>',
            next: '<span aria-hidden="true">&gt;</span>',
            onPageClick: function (event, page) {
                $(".card[data-num]").addClass("d-none");
                $(".card[data-num]:lt(" + page * 10 + ")" + (page == 1 ? "" : ":gt(" + (page * 10 - 10 - 1) + ")")).removeClass("d-none");
            }
        });
    })

    /**
     * 切换分类
     */
    $(function () {
        $('#qType').change(function () {
            location.href="/all.php?type="+$(this).val();
        })
    })
</script>
</body>
</html>