<?php
/**
 * 模拟考试
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-07 09:33:30
 */

require_once __DIR__ . '/api/import.php';
require_once __DIR__ . '/bin/Dotenv.php';
Dotenv::load(__DIR__ . "/");
$domain = getenv("domain");
if (empty($_REQUEST['type'])) {
    setcookie("cqid_type", "", time() - 3600, "/", $domain);
} else {
    $type = $_REQUEST['type'];
    $expire = time() + 3600 * 24 * 60;
    setcookie("cqid_type", $type, $expire, "/", $domain);
}


$title = "模拟考试";
include("inc/header.php");
?>
    <main class="jumbotron">
        <div class="container d-none mb-5" id="examMain">
            <div class="text-center" id="loading">
                <div class="spinner-border" role="status">
                    <span class="sr-only">正在加载题库...</span>
                </div>
            </div>
            <div class="row">
                <div class="text-center w-100 mb-2">
                <p class="h2">业余电台操作证书</br>模拟考试 <span id="examType"></span>类</p>


                </div>
            </div>

            <div class="row">
                <div class="mb-2">
                    <button data-toggle="collapse" data-target="#reGAlert" aria-expanded="false" class="btn btn-link mr-n5">
                        <img class="tnvk_icon" src="https://static.cqid.cn/css/fronze/css/svg/setting.svg">
                    </button></div>
            </div>
            <div class="form-group alert-danger collapse p-1 m-0 mb-2" id="reGAlert">
                <button class="btn btn-sm btn-primary" id="reG">重新生成试卷</button>
                <small class="text-muted">
                    重新生成会清空已做试题。
                </small>
            </div>
            <div class="row">
                <div class="card mb-4 d-none w-100">
                    <div class="card-body">
                        <p class="card-text" id="q"></p>
                    </div>
                    <div class="list-group list-group-flush" id="a-list">


                    </div>
                    <div class="d-flex justify-content-between align-items-center m-3">
                        <div class="btn-group">
                            <button type="button" class="prev btn btn-sm btn-outline-primary">上一题</button>
                            <button type="button" class="next btn btn-sm btn-outline-primary">下一题</button>
                        </div>
                        <small class="text-muted">
                            <a class="" data-toggle="collapse" href="#colA" role="button" aria-expanded="false"
                               aria-controls="collapse"> 查看答案 </a>
                        </small>

                    </div>

                    <div class="collapse m-3 alert alert-success" id="colA">

                    </div>

                </div>
            </div>
            <div class="row d-flex">
                <button type="button" class="btn btn-info" id="submit">提交</button>
                <div class="text-right ml-auto" style="font-size:20px;font-weight:800;color:#FF9900">剩余时间：<span
                            id="remainTime"></span>
                </div>
            </div>
        </div>

        <div class="bg">

            <div class="container">
                <div class="d-lg-flex flex-lg-equal mt-3 py-3">


                    <div class="card bg-success text-white mr-lg-3 mb-3 overflow-hidden shadow">
                        <div class="card-body">
                            <h4 class="card-title text-center">A类
                                <small><?php echo " " . count($aQNum) . "题"; ?></small>
                            </h4>
                            <p style="text-indent: 2em;">申请人初次申请业余无线电台操作技术能力考核，须首先参加 A 类业余无线电台操作技术能力考试。</p>
                            <p style="text-indent: 2em;">A类操作技术能力考试试卷共30题，答题时间不超过40分钟，答对25题（含）以上为合格。</p>
                            <div class="mt-auto text-center">
                                <a href="?type=A" class="btn btn-lg btn-light">开始考试</a>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-info text-white mr-lg-3 mb-3 overflow-hidden shadow">
                        <div class="card-body">
                            <h4 class="card-title text-center">B类
                                <small><?php echo " " . count($bQNum) . "题"; ?></small>
                            </h4>
                            <p style="text-indent: 2em;">取得 A 类《操作证书》六个月后可以申请参加 B 类操作技术能力考试。</p>
                            <p style="text-indent: 2em;">B类操作技术能力考试试卷共50题，答题时间不超过60分钟，答对40题（含）以上为合格。</p>
                            <div class="text-center" style="margin-top:2.5rem;">
                                <a href="?type=B" class="btn btn-lg btn-light">开始考试</a>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-danger text-white mb-3 overflow-hidden shadow">
                        <div class="card-body">
                            <h4 class="card-title text-center">C类
                                <small><?php echo " " . count($cQNum) . "题"; ?></small>
                            </h4>
                            <p style="text-indent: 2em;">取得 B 类《操作证书》并且设置 B 类业余无线电台二年后，可以申请参加 C 类操作技术能力考试。</p>
                            <p style="text-indent: 2em;">C类操作技术能力考试试卷共80题，答题时间不超过90分钟，答对60题（含）以上为合格。</p>
                            <div class="mt-auto text-center">
                                <a href="?type=C" class="btn btn-lg btn-light">开始考试</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <script>
        var SysSecond;
        var InterValObj;

        //将时间减去1秒，计算天、时、分、秒
        function SetRemainTime() {
            if (SysSecond > 0) {
                SysSecond = SysSecond - 1;
                var second = Math.floor(SysSecond % 60);            // 计算秒
                var minite = Math.floor((SysSecond / 60) % 60);      //计算分
                var hour = Math.floor((SysSecond / 3600) % 24);      //计算小时
                var day = Math.floor((SysSecond / 3600) / 24);       //计算天

                var hourDiv = "<span id='hourSpan'>" + hour + "小时" + "</span>";
                var dayDiv = "<span id='daySpan'>" + day + "天" + "</span>";

                $("#remainTime").html(dayDiv + hourDiv + minite + "分" + second + "秒");

                if (hour === 0) {//当不足1小时时隐藏小时
                    $('#hourSpan').css('display', 'none');
                }
                if (day === 0) {//当不足1天时隐藏天
                    $('#daySpan').css('display', 'none');
                }

            } else {//剩余时间小于或等于0的时候，就停止间隔函数
                window.clearInterval(InterValObj);
                //这里可以添加倒计时时间为0后需要执行的事件
                alert("时间为0");
            }
        }

        $(function () {
            var qIndex = 0;
            if (Cookies.getJSON("cqid_type")) {
                var type = Cookies.getJSON("cqid_type");
                $("#examType").text(type);
                switch (type) {
                    case "A":
                        SysSecond = 2400; //倒计时的起始时间
                        break;
                    case "B":
                        SysSecond = 3600; //倒计时的起始时间
                        break;
                    case "C":
                        SysSecond = 5400; //倒计时的起始时间
                        break;
                }

                $("#examMain").removeClass("d-none");
                $(".prev").attr("disabled", "disabled")
                var qs = localStorage.getItem("qs" + type);
                if (qs == null) {
                    $.ajax({
                        type: "POST",
                        contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                        url: "/api/getExam/",
                        data: {type: type},
                        success: function (result) {
                            qs = JSON.parse(result);
                            localStorage.setItem("qs" + type, result);
                            generateAList(qs[0]);

                            $('#loading').hide();
                            $('.card').removeClass("d-none")
                        },
                        error: function (e) {
                            console.log(e.status);
                            console.log(e.responseText);
                        }
                    });
                } else {
                    qs = JSON.parse(qs);

                    generateAList(qs[0]);
                    $('#loading').hide();
                    $('.card').removeClass("d-none");
                }

                InterValObj = window.setInterval(SetRemainTime, 1000); //间隔函数，1秒执行
            }
            /**
             * 切换分类
             */
            $('#qType').change(function () {
                localStorage.removeItem('qsA');
                localStorage.removeItem('qsB');
                localStorage.removeItem('qsC');
                location.href = "?type=" + $(this).val();
            })
            $('.next').click(function () {
                $("#colA").collapse('hide');
                $("#colA").addClass("d-none");
                var qs = localStorage.getItem("qs" + type);
                var qsArray = JSON.parse(qs);

                generateAList(qsArray[qIndex + 1]);


                qIndex++;
                if (qIndex > 0 && qIndex < count(qsArray) - 1) {
                    $(".prev").removeAttr("disabled");
                    $(".next").removeAttr("disabled");
                } else if (qIndex == 0) {
                    $(".prev").attr("disabled", "disabled");
                    $(".next").removeAttr("disabled");
                } else if (qIndex == count(qsArray) - 1) {
                    $(".next").attr("disabled", "disabled");
                    $(".prev").removeAttr("disabled");
                }


            })

            $('.prev').click(function () {

                $("#colA").collapse('hide');
                $("#colA").addClass("d-none");
                var qs = localStorage.getItem("qs" + type);
                var qsArray = JSON.parse(qs);

                generateAList(qsArray[qIndex - 1]);


                qIndex--;
                if (qIndex > 0 && qIndex < count(qsArray)) {
                    $(".prev").removeAttr("disabled");
                    $(".next").removeAttr("disabled");
                } else if (qIndex == 0) {
                    $(".prev").attr("disabled", "disabled");
                    $(".next").removeAttr("disabled");
                } else if (qIndex == count(qsArray) - 1) {
                    $(".next").attr("disabled", "disabled");
                    $(".prev").removeAttr("disabled");
                }

            })
            $("#reG").click(function () {
                localStorage.removeItem('qs' + type);
                window.location.reload();
            })

            function count(o) {
                var t = typeof o;
                if (t == 'string') {
                    return o.length;
                } else if (t == 'object') {
                    var n = 0;
                    for (var i in o) {
                        n++;
                    }
                    return n;
                }
                return false;
            }

            function generateAList(as) {
                var qs = JSON.parse(localStorage.getItem("qs" + type));
                var qHtml = '<span class="text-success mr-1">' + (as["index"] + 1) + '/' + count(qs) + '</span>' + as.Q;
                if (as.P) {
                    qHtml += "<div><img class='img-thumbnail' style='max-width:20rem;' src='/source/TXT题库包(v20211022)/总题库附图(v20211022)/" + as.P + "'></div>";
                }

                $("#q").html(qHtml);

                $('#a-list').empty();
                var y = 0;
                var x = ["A", "B", "C", "D"];

                for (var key in as["answer"]) {
                    var answer = as["answer"][key];
                    var userA = as["userA"];

                    var html = '<div class="list-group-item list-group-item-action form-check"><input class="form-check-input" type="radio" id="' + answer["k"] + '" name="' + as.I + '" value="' + answer["k"] + '"';
                    if (userA == answer["k"]) {
                        html += " checked";
                    }
                    html += '><label class="w-100" for="' + answer["k"] + '"><span class="badge badge-light">' + x[y] + "</span> " + answer["v"] + '</label></div>';

                    $('#a-list').append(html);

                    if (answer["k"] == "A") {
                        as["answer"]["right"] = x[y];
                    }
                    y++;
                }

                $("#colA").html('<span class="badge badge-light">' + as["answer"]["right"] + "</span> " + as["A"]);
            }

            $(".card").on("click", ".form-check-input", function () {
                console.log($("input:radio:checked").val());
                var qs = localStorage.getItem("qs" + type);
                var qsArr = JSON.parse(qs);
                qsArr[qIndex]["userA"] = $("input:radio:checked").val();
                localStorage.setItem("qs" + type, JSON.stringify(qsArr));

            })

            $("#submit").click(function () {

                var qs = localStorage.getItem("qs" + type);
                var qsArr = JSON.parse(qs);
                var y = 0;
                for (var i = 0; i < qsArr.length; i++) {
                    if (qsArr[i].userA == "A") {
                        y++;
                    }
                }
                var aQNum = 0;
                switch (type) {
                    case "A":
                        aQNum = 25;
                        break;
                    case "B":
                        aQNum = 40;
                        break;
                    case "C":
                        aQNum = 60;
                        break;
                }
                if (y < aQNum) {
                    alert("答对题目数：" + y + "\n本次考试不合格，请继续努力！");
                } else {
                    alert("恭喜！\n答对题目数：" + y + "\n本次考试成绩合格！");
                }
            })

            $("[data-toggle=collapse]").click(function () {
                $("#colA").removeClass("d-none");
            })


        })
    </script>
<?php require_once("inc/footer.php"); ?>
