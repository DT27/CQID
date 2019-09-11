<?php
/**
 * 刷题
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-07 08:13:50
 */
$isAll = 1;
$pageSize = 10;
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
require_once('import.php');
$type = empty($_REQUEST['type']) ? "A" : $_REQUEST['type'];
switch ($type) {
    case "A":
        $aQS = getAQ();
        $qs = getQSP($aQS, $pageSize, $page);
        $qsNum = count($aQNum);
        break;
    case "B":
        $bQS = getBQ();
        $qs = getQSP($bQS, $pageSize, $page);
        $qsNum = count($bQNum);
        break;
    case "C":
        $cQS = getCQ();
        $qs = getQSP($cQS, $pageSize, $page);
        $qsNum = count($cQNum);
        break;
    default:
        $aQS = getAQ();
        $qs = getQSP($aQS, $pageSize, $page);
        $qsNum = count($aQNum);
        break;
}
$title = "刷题";
include("inc/header.php");
?>
    <main class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="input-group mb-4" style="max-width: 25rem;">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="qType">业余电台操作证书分类</label>
                    </div>
                    <select class="custom-select" id="qType" name="qType">
                        <option>请选择...</option>
                        <option value="A"<?php echo $type == "A" ? " selected" : ""; ?>>A类<?php echo " " . count($aQNum) . "题"; ?></option>
                        <option value="B"<?php echo $type == "B" ? " selected" : ""; ?>>B类<?php echo " " . count($bQNum) . "题"; ?></option>
                        <option value="C"<?php echo $type == "C" ? " selected" : ""; ?>>C类<?php echo " " . count($cQNum) . "题"; ?></option>
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
                for ($i = 0; $i < count($qs); $i++) {
                    $q = $qs[$i];
                    ?>
                    <div class="card mb-4 d-none" data-num="<?php echo $q['I'] ?>" style="min-width: 90%;">
                        <div class="card-body">
                            <p class="card-text">
                                <span class="text-success mr-1"><?php echo $q['index'] + 1 . '/' . $qsNum; ?></span><?php
                                echo $q['Q'];
                                if (isset($q["P"])) {
                                    echo "<div><img class='img-thumbnail' style='max-width:20rem;' src='./source/总题库附图(v140331)/" . $q["P"] . "'></div>";
                                }
                                ?>
                            </p>
                        </div>
                        <div class="list-group list-group-flush">
                            <?php

                            $x = ["A", "B", "C", "D"];
                            $y = 0;
                            foreach ($q["answer"] as $a) {
                                //print_r($a);
                                ?>
                                <div class="list-group-item list-group-item-action form-check btn-group-toggle">
                                    <label for="a-<?php echo $q['I'] ?>-<?php echo $a["k"] ?>" class="btn w-100 text-left"><input class="form-check-input" type="radio" name="a-<?php echo $q['I'] ?>" id="a-<?php echo $q['I'] ?>-<?php echo $a["k"] ?>" value="<?php echo $a["k"];?>" data-check="<?php echo $a["k"] == "A" ? "1" : "0"; ?>"><?php echo '<span class="badge badge-light">'.$x[$y] . "</span> " . $a['v'] ?></label>
                                </div>
                                <?php
                                $y++;
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <ul id="pagination-demo" class="pagination-sm"></ul>
            </div>
        </div>
    </main>
    <script>
        var pageNum = Math.ceil(<?php echo $qsNum;?> / 10);
        /**
         * 分页加载数据
         */
        $(function () {
            $('#loading').hide();
            $(".card[data-num]").removeClass("d-none");
            $('#pagination-demo').twbsPagination({
                initiateStartPageClick: false,
                totalPages: pageNum,
                visiblePages: 5,
                startPage: <?php echo $page;?>,
                first: '<span aria-hidden="true">&laquo;</span>',
                last: '<span aria-hidden="true">&raquo;</span>',
                prev: '<span aria-hidden="true">&lt;</span>',
                next: '<span aria-hidden="true">&gt;</span>',
                onPageClick: function (event, page) {
                    location.href = "/all.php?type=<?php echo $type;?>&page=" + page;
                }
            });
        })

        /**
         * 切换分类
         */
        $(function () {
            $('#qType').change(function () {
                location.href = "/all.php?type=" + $(this).val();
            })
        })

        $(function () {
            $(".form-check-input").on("click", function () {
                var a = $(this).val();
                console.log(a);
                if(a=="A"){
                    $(this).parent("label").addClass("text-success");
                    $(this).parent("label").children("span").addClass("wrong");
                    console.log($(this).attr("name"));
                }else{
                    $(this).parent("label").addClass("text-danger");
                    $("[for='"+$(this).attr("name")+"-A']").addClass("text-success");
                    $("[for='"+$(this).attr("name")+"-A']").children("span").addClass("right");
                }
                $("[name='"+$(this).attr("name")+"']").attr("disabled",true);
                //var qs = localStorage.getItem("qs" + type);
                //var qsArr = JSON.parse(qs);
                //qsArr[qIndex]["userA"] = $("input:radio:checked").val();
                //localStorage.setItem("qs" + type, JSON.stringify(qsArr));

            })

        })
    </script>
<?php require_once('inc/footer.php'); ?>