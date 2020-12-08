<?php
/**
 * 各地区考试报名
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-11-08 22:12:12
 */
require_once('api/import.php');
$title = "业余无线电考试报名";
require_once __DIR__ . '/bin/Server.php';
$city_id = !empty($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
if ($city_id) {
    $city = $storage->getCity($city_id);
    if ($city) {
        if ($city['update_date'] == "0000-00-00 00:00:00") {
            $city['update_date'] = $city['create_date'];
        }
        $title = $city["name"] . "业余无线电考试报名";
        $description = $city["name"];
        $keywords = $city["name"];
        include("inc/header.php");

        ?>
        <main class="main">
            <div class="container">
                <div class="m-auto py-5" style="max-width: 800px">

                    <form id="frmCity" onsubmit="return false;" action="#" method="post" class="needs-validation"
                          novalidate>
                        <div class="text-center mb-4">
                            <h1 class="h3 mb-3 font-weight-normal"><?php echo $city["name"] ?>业余无线电考试报名</h1>
                            <p>《业余无线电台管理办法》规定："各省、 自治区、直辖市无线电管理机构或其委托的机构负责组织对A类和B类业余无线电台所需操作技术能力进验证，以及核发验证合格证明等工作。" </p>
                        </div>
                        <div class="input-group mb-3">

                        </div>
                        <div id="info">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-4">报名网址：</div>
                                        <div class="col-8 text-break"><a href="<?php echo $city["website"] ?>"
                                                                         target="_blank"><?php echo $city["website"] ?></a>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-4">咨询电话：</div>
                                        <div class="col-8 text-break"><?php echo $city["phone"] ?></div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-4">微信：</div>
                                        <div class="col-8 text-break"><?php echo $city["wx"] ?></div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-4">备注：</div>
                                        <pre class="col-8"
                                             style="white-space: pre-wrap;"><?php echo $city["ps"] ?></pre>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-4">更新时间：</div>
                                        <div class="col-8 text-break"><?php echo $city["update_date"] ?></div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </form>
                </div>
            </div>
        </main>
        <script>

        </script>
        <?php include("inc/footer.php"); ?>
        <?php
    } else {
        header("Location: https://www.cqid.cn/city/");
        exit;
    }
} else {
    header("Location: https://www.cqid.cn/city/");
    exit;
}
?>
