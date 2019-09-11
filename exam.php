<?php
/**
 * 模拟考试
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-07 09:33:30
 */

require_once('import.php');
$type = empty($_REQUEST['type']) ? "A" : $_REQUEST['type'];

switch ($type) {
    case "A":
        $allQ = getAQ();
        break;
    case "B":
        $allQ = getBQ();
        break;
    case "C":
        $allQ = getCQ();
        break;
    default:
        $type = "A";
        $allQ = getAQ();
        break;
}
$qs = getExam($type);

$title = "模拟考试";
include("inc/header.php");
?>
    <main class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="input-group mb-4">
                    <div class="form-inline input-group-prepend">
                        <label class="input-group-text" for="qType">业余电台操作证书分类</label>
                    </div>
                    <select class="custom-select" id="qType" name="qType" style="max-width: 25rem;">
                        <option>请选择...</option>
                        <option value="A"<?php echo $type == "A" ? " selected" : ""; ?>>A类<?php echo " " . count($aQNum) . "题"; ?></option>
                        <option value="B"<?php echo $type == "B" ? " selected" : ""; ?>>B类<?php echo " " . count($bQNum) . "题"; ?></option>
                        <option value="C"<?php echo $type == "C" ? " selected" : ""; ?>>C类<?php echo " " . count($cQNum) . "题"; ?></option>
                    </select>
                    <button data-toggle="collapse" data-target="#reGAlert" aria-expanded="false" class="btn btn-link">+
                    </button>
                </div>
            </div>
            <div class="form-group alert-danger p-2 collapse" id="reGAlert">

                <button class="btn btn-sm btn-primary" id="reG">重新生成试卷</button>
                <small class="text-muted">
                    重新生成会清空已做试题。
                </small>

            </div>

            <div class="text-center" id="loading">
                <div class="spinner-border" role="status">
                    <span class="sr-only">正在加载题库...</span>
                </div>
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
                            <a class="" data-toggle="collapse" href="#colA" role="button" aria-expanded="false" aria-controls="collapse"> 查看答案 </a>
                        </small>

                    </div>

                    <div class="collapse m-3 alert alert-success" id="colA">

                    </div>

                </div>
            </div>
            <div class="row">
                <button type="button" class="btn btn-info" id="submit">提交</button>
            </div>
        </div>
    </main>
    <script>

        $(function () {

            var qIndex = 0;
            $(".prev").attr("disabled", "disabled")
            var type = $("#qType").val();
            var qs = localStorage.getItem("qs" + type);
            if (qs == null) {
                $.ajax({
                    type: "POST",
                    contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                    url: "getExam.php",
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
                    qHtml += "<div><img class='img-thumbnail' style='max-width:20rem;' src='./source/总题库附图(v140331)/" + as.P + "'></div>";
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
                switch($('#qType').val()){
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
                if(y<aQNum){
                    alert("答对题目数：" + y + "\n本次考试不合格。");
                }else{
                    alert("恭喜！\n答对题目数：" + y + "\n本次考试成绩合格。");
                }
            })

            $("[data-toggle=collapse]").click(function () {
                $("#colA").removeClass("d-none");
            })

        })
    </script>
<?php require_once("inc/footer.php"); ?>