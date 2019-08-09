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
    <main class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="input-group mb-4" style="max-width: 25rem;">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="qType">业余电台操作证书分类</label>
                    </div>
                    <select class="custom-select" id="qType" name="qType">
                        <option selected>请选择...</option>
                        <option value="A">A类<?php echo " " . count($aQNum) . "题"; ?></option>
                        <option value="B">B类<?php echo " " . count($bQNum) . "题"; ?></option>
                        <option value="C">C类<?php echo " " . count($cQNum) . "题"; ?></option>
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
                foreach ($a as $k => $v) {
                    $q = $aQ[$v];
                    ?>
                    <div class="card mb-4 d-none" data-num="<?php echo $q['I'] ?>">
                        <div class="card-body">
                            <p class="card-text">
                                <span class="text-success mr-1"><?php echo $k + 1 . '/' . count($a); ?></span><?php
                                echo $q['Q']
                                ?>
                            </p>
                        </div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item list-group-item-action form-check">
                                <input class="form-check-input" type="radio" name="a-<?php echo $q['I'] ?>" id="a1-<?php echo $q['I'] ?>" value="option1"><label for="a1-<?php echo $q['I'] ?>"><?php echo $q['A'] ?></label>
                            </div>

                            <div class="list-group-item list-group-item-action form-check">
                                <input class="form-check-input" type="radio" name="a-<?php echo $q['I'] ?>" id="a2-<?php echo $q['I'] ?>" value="option1"><label for="a2-<?php echo $q['I'] ?>"><?php echo $q['B'] ?></label>
                            </div>

                            <div class="list-group-item list-group-item-action form-check">
                                <input class="form-check-input" type="radio" name="a-<?php echo $q['I'] ?>" id="a3-<?php echo $q['I'] ?>" value="option1"><label for="a3-<?php echo $q['I'] ?>"><?php echo $q['C'] ?></label>
                            </div>

                            <div class="list-group-item list-group-item-action form-check">
                                <input class="form-check-input" type="radio" name="a-<?php echo $q['I'] ?>" id="a4-<?php echo $q['I'] ?>" value="option1"><label for="a4-<?php echo $q['I'] ?>"><?php echo $q['D'] ?></label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center m-3">
                            <div class="btn-group">
                                <button type="button" class="next btn btn-sm btn-outline-primary"<?php echo $k == 29 ? ' disabled' : ''; ?>>下一题</button>
                                <button type="button" class="prev btn btn-sm btn-outline-primary"<?php echo $k == 0 ? ' disabled' : ''; ?>>上一题</button>
                            </div>
                            <small class="text-muted">
                                <a class="" data-toggle="collapse" href="#collapse<?php echo $q['I']; ?>" role="button" aria-expanded="false" aria-controls="collapse<?php echo $q['I']; ?>"> 查看答案 </a>
                            </small>

                        </div>

                        <div class="collapse m-3" id="collapse<?php echo $q['I']; ?>">
                            A
                        </div>

                    </div>
                    <?php
                }
                ?>


            </div>
        </div>
    </main>
<?php include("inc/footer.php"); ?>