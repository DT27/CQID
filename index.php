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
            <img src="./images/W2COS.jpg" class="img-fluid img-cover" alt="W2COS">
        </div>
        <div class="intro-content py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-6 mx-auto">
                    <h1 class="display-2 text-center pb-5 d-md-none">CQID</h1>
                    <h2 class="display-4 text-center">CQ CQ CQ</h2>
                    <p class="info">这里是业余无线电台操作技术能力模拟考试平台。专为无线电爱好者提供法规学习、考前自测、政策查询等服务。努力为大家普及业余无线电政策及法规，希望人人"持证上岗"，拒绝违法违规操作。</p>
                    <p class="text-center mt-5">
                        <a class="btn btn-success btn-lg" href="/exam/" role="button">模拟考试 »</a>
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="main">
        <div class="container bg-white p-3">
            <p style="text-indent: 2em;margin-top:2rem;">业余无线电台操作技术能力的验证考核通过闭卷考试等形式进行。验证合格证明为《中国无线电协会业余电台操作证书》，由中国无线电协会统一印制和编号。</p>
        </div>
        <div class="bg-light">

            <div class="container">
                <div class="d-lg-flex flex-lg-equal mt-3 py-3">


                    <div class="card bg-primary text-white mr-lg-3 mb-3 overflow-hidden shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">A类
                                <small><?php echo " " . count($aQNum) . "题"; ?></small>
                            </h5>
                            <p style="text-indent: 2em;">申请人初次申请业余无线电台操作技术能力考核，须首先参加 A 类业余无线电台操作技术能力考试。</p>
                            <p style="text-indent: 2em;">A类操作技术能力考试试卷共30题，答题时间不超过40分钟，答对25题（含）以上为合格。</p>
                            <div class="text-right"><a class="" href="./all/?type=A">查看题库 »</a></div>
                        </div>
                    </div>
                    <div class="card bg-info text-white mr-lg-3 mb-3 overflow-hidden shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">B类
                                <small><?php echo " " . count($bQNum) . "题"; ?></small>
                            </h5>
                            <p style="text-indent: 2em;">取得 A 类《操作证书》六个月后可以申请参加 B 类操作技术能力考试。</p>
                            <p style="text-indent: 2em;">B类操作技术能力考试试卷共50题，答题时间不超过60分钟，答对40题（含）以上为合格。</p>
                            <div class="text-right"><a class="" href="./all/?type=B">查看题库 »</a></div>
                        </div>
                    </div>
                    <div class="card bg-warning text-white mb-3 overflow-hidden shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">C类
                                <small><?php echo " " . count($cQNum) . "题"; ?></small>
                            </h5>
                            <p style="text-indent: 2em;">取得 B 类《操作证书》并且设置 B 类业余无线电台二年后，可以申请参加 C 类操作技术能力考试。</p>
                            <p style="text-indent: 2em;">C类操作技术能力考试试卷共80题，答题时间不超过90分钟，答对60题（含）以上为合格。</p>
                            <div class="text-right"><a class="" href="./all/?type=C">查看题库 »</a></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
<?php include("inc/footer.php"); ?>