<?php
/**
 * 首页
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-06 18:27:00
 */
require_once('import.php');
$title = "";
include("inc/header.php");
?>
    <div class="intro py-5 py-lg-5 position-relative text-white">
        <div class="bg-overlay-primary">
            <img src="./images/W2COS.jpg" class="img-fluid img-cover" alt="Robust UI Kit">
        </div>
        <div class="intro-content py-5">
            <div class="container">
                <h1 class="display-3 text-center">CQ CQ CQ</h1>
                <p style="text-indent: 2em;">这里是业余无线电台操作技术能力模拟考试平台。专为无线电爱好者提供法规学习、考前自测、政策查询等服务。努力为大家普及业余无线电政策及法规，希望人人"持证上岗"，拒绝违法违规操作。</p>
                <p style="text-indent: 2em;">业余无线电台操作技术能力的验证考核通过闭卷考试等形式进行。验证合格证明为《中国无线电协会业余电台操作证书》，由中国无线电协会统一印制和编号。</p>
                <p class="text-center"><a class="btn btn-primary btn-lg" href="./exam.php" role="button">模拟考试 »</a>
                </p>
            </div>
        </div>
    </div>
    <main class="main">
        <div class="container">
            <!-- Example row of columns -->
            <div class="d-lg-flex flex-lg-equal mt-3">
                <div class="card bg-light mr-lg-3 mb-3 p-3 overflow-hidden">
                    <h3 class="text-center">A类
                        <small><?php echo " " . count($aQNum) . "题"; ?></small>
                    </h3>
                    <p style="text-indent: 2em;">申请人初次申请业余无线电台操作技术能力考核，须首先参加 A 类业余无线电台操作技术能力考试。</p>
                    <div class="text-right"><a class="" href="./all.php?type=A">刷题 »</a></div>
                </div>
                <div class="card bg-light mr-lg-3 mb-3 p-3 overflow-hidden">
                    <h3 class="text-center">B类
                        <small><?php echo " " . count($bQNum) . "题"; ?></small>
                    </h3>
                    <p style="text-indent: 2em;">取得 A 类《操作证书》六个月后可以申请参加 B 类操作技术能力考试。</p>
                    <div class="text-right"><a class="" href="./all.php?type=B">刷题 »</a></div>
                </div>
                <div class="card bg-light mb-3 p-3 overflow-hidden">
                    <h3 class="text-center">C类
                        <small><?php echo " " . count($cQNum) . "题"; ?></small>
                    </h3>
                    <p style="text-indent: 2em;">取得 B 类《操作证书》并且设置 B 类业余无线电台二年后，可以申请参加 C 类操作技术能力考试。</p>
                    <div class="text-right"><a class="" href="./all.php?type=C">刷题 »</a></div>
                </div>
            </div>


        </div>
    </main>
<?php include("inc/footer.php"); ?>