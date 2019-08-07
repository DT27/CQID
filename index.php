<?php
/**
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * Date: 2019/8/6
 * Time: 18:27
 */

include ('import.php');

$aQ = getAQ();

?>
<!doctype html>
<html lang="zh">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .list-group-item {
            padding: 0.2rem 2.5rem;
        }

        .form-check label {
            margin-bottom: 0;
        }
    </style>
    <title>业余无线电|业余无线电台操作技术能力模拟考试</title>
</head>
<body>
<header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" stroke="currentColor" class="mr-2" viewBox="0 0 24 24" focusable="false" xml:space="preserve">
                    <path d="m2.687589,7.719133c0,2.061908 0.761384,4.000873 2.144643,5.459716l-1.193195,1.259418c-1.701862,-1.795203 -2.639036,-4.181781 -2.639036,-6.719134s0.936084,-4.923968 2.636857,-6.716796l1.193195,1.259381c-1.38217,1.456543 -2.142464,3.395507 -2.142464,5.457415zm4.726583,-2.729877l-1.193195,-1.259418c-1.008615,1.066894 -1.564535,2.484027 -1.564535,3.989257c0,1.507568 0.555955,2.924701 1.56675,3.989257l1.193195,-1.259418c-0.692192,-0.728271 -1.072322,-1.697754 -1.072322,-2.729877c-0.000035,-1.029711 0.380129,-1.999193 1.070107,-2.729802zm8.947733,-3.989257l-1.193195,1.259418c1.38326,1.458881 2.144643,3.397845 2.144643,5.459716s-0.760294,4.000873 -2.141338,5.459716l1.193195,1.259418c1.699683,-1.795166 2.635767,-4.181781 2.635767,-6.719134c-0.000035,-2.539691 -0.937209,-4.926269 -2.639071,-6.719134zm-6.361434,4.937884c-0.931689,0 -1.687588,0.797851 -1.687588,1.78125c0,0.658691 0.341701,1.226947 0.843794,1.53425l0,10.746614l1.687588,0l0,-10.745463c0.502093,-0.30849 0.843794,-0.876709 0.843794,-1.5354c0,-0.983398 -0.754809,-1.78125 -1.687588,-1.78125zm3.777315,-2.208008l-1.193195,1.259381c0.691067,0.730609 1.072322,1.700092 1.072322,2.729877c0,1.032123 -0.380164,2.001605 -1.070142,2.729877l1.193195,1.259418c1.008615,-1.064594 1.564535,-2.481689 1.564535,-3.989257s-0.55592,-2.9224 -1.566715,-3.989294z"/>
                </svg>
                <strong>业余无线电台操作技术能力模拟考试</strong> </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
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
                    <option selected>请选择...</option>
                    <option value="A">A类<?php echo " ".count($aQNum)."题"; ?></option>
                    <option value="B">B类<?php echo " ".count($bQNum)."题"; ?></option>
                    <option value="C">C类<?php echo " ".count($cQNum)."题"; ?></option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="card mb-4">
                <div class="card-body">
                    <p class="card-text"><span class="text-success mr-1">1/30</span>我国现行法律体系中专门针对无线电管理的最高法律文件及其立法机关是：
                    </p>
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item list-group-item-action form-check">
                        <input class="form-check-input" type="radio" name="a" id="a1" value="option1"><label for="a1">中华人民共和国无线电管理条例，国务院和中央军委</label>
                    </div>

                    <div class="list-group-item list-group-item-action form-check">
                        <input class="form-check-input" type="radio" name="a" id="a2" value="option1"><label for="a2">中华人民共和国无线电管理办法，工业和信息化部</label>
                    </div>

                    <div class="list-group-item list-group-item-action form-check">
                        <input class="form-check-input" type="radio" name="a" id="a3" value="option1"><label for="a3">中华人民共和国电信条例，国务院</label>
                    </div>

                    <div class="list-group-item list-group-item-action form-check">
                        <input class="form-check-input" type="radio" name="a" id="a4" value="option1"><label for="a4">中华人民共和国电信条例，国务院</label>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center m-3">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-primary">下一题</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">上一题</button>
                    </div>
                    <small class="text-muted">
                        <a class="" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"> 查看答案 </a>
                    </small>

                </div>

                <div class="collapse m-3" id="collapseExample">
                    A
                </div>

            </div>


        </div>
    </div>
</main>
<footer class="text-muted">
    <div class="container">

        <p class="float-right text-right">
            © <a href="https://dt27.org" target="_blank">DT27</a><br>
            <small>已运行：<span id="runTime"></span></small>
        </p>
        <p>最新题库版本：v171031</p>
        <p>程序更新日期：2019-08-06</p>
    </div>

</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.staticfile.org/jquery/3.3.1/jquery.slim.min.js"></script>
<script src="https://cdn.staticfile.org/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.js"></script>
<script>
    $(function () {
        var date1 = '2019-08-06 18:27:00';  //开始时间
        var date2 = new Date(); //结束时间
        var date3 = date2.getTime() - new Date(date1).getTime();    //时间差的毫秒数
        //计算出相差天数
        var days = Math.floor(date3 / (24 * 3600 * 1000))
        //计算出小时数
        var leave1 = date3 % (24 * 3600 * 1000)    //计算天数后剩余的毫秒数
        var hours = Math.floor(leave1 / (3600 * 1000))
        //计算相差分钟数
        var leave2 = leave1 % (3600 * 1000)        //计算小时数后剩余的毫秒数
        var minutes = Math.floor(leave2 / (60 * 1000))
        $("#runTime").text(days + "天 " + hours + "小时 " + minutes + " 分钟");
    })
</script>
</body>
</html>