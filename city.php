<?php
/**
 * 各地区考试报名 汇总
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-11-08 22:12:12
 */
require_once('api/import.php');
$title = "业余无线电考试报名";
include("inc/header.php");
?>
<main class="main">
    <div class="container">
        <div class="m-auto py-5" style="max-width: 800px">

            <form id="frmCity" onsubmit="return false;" action="#" method="post" class="needs-validation"
                  novalidate>
                <div class="text-center mb-4">
                    <h1 class="h3 mb-3 font-weight-normal">各地区业余无线电考试报名途径</h1>
                    <p>《业余无线电台管理办法》规定："各省、 自治区、直辖市无线电管理机构或其委托的机构负责组织对A类和B类业余无线电台所需操作技术能力进验证，以及核发验证合格证明等工作。" </p>
                    <p>请选择您所在地区查看或更新当地报名考试信息。</p>
                </div>
                <div class="input-group mb-3">
                    <select class="custom-select" id="selProvince">
                        <option>请选择地区</option>
                    </select>
                    <select class="custom-select" id="selCity" name="selCity">
                    </select>
                </div>
                <div id="noneInfo" class="d-none">
                    <div class="text-center form-group"><code>暂无记录，欢迎补充！</code></div>
                    <div class="form-group row">
                        <label for="website" class="col-sm-3 col-form-label">报名网址：</label>
                        <div class="col-sm-9"><input class="form-control" name="website">
                            <div class="invalid-feedback">请至少输入一项内容!</div>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">咨询电话：</label>
                        <div class="col-sm-9"><input class="form-control" name="phone"></div>
                    </div>
                    <div class="form-group row">
                        <label for="wx" class="col-sm-3 col-form-label">微信：</label>
                        <div class="col-sm-9"><input class="form-control" name="wx"></div>
                    </div>
                    <div class="form-group row">
                        <label for="ps" class="col-sm-3 col-form-label">备注：</label>
                        <div class="col-sm-9"><textarea class="form-control" name="ps" rows="5"></textarea></div>
                    </div>
                    <input type="hidden" name="act" value="updateCity">
                    <input type="hidden" name="name" id="name" value="">
                    <button class="btn btn-lg btn-primary btn-block" type="submit" id="citySubmit">提交</button>

                </div>
                <div id="cityInfo" class="d-none">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">
                            <div class="row">
                                <div class="col-4">报名网址：</div>
                                <div class="col-8 text-break" id="website"></div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row">
                                <div class="col-4">咨询电话：</div>
                                <div class="col-8 text-break" id="phone"></div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row">
                                <div class="col-4">微信：</div>
                                <div class="col-8 text-break" id="wx"></div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row">
                                <div class="col-4">备注：</div>
                                <pre class="col-8" id="ps" style="white-space: pre-wrap;"></pre>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row">
                                <div class="col-4">状态：</div>
                                <div class="col-8 text-break" id="checked"></div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row">
                                <div class="col-4">更新时间：</div>
                                <div class="col-8 text-break" id="update_date"></div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row">
                                <div class="col-4">分享连接(长按复制后分享)：</div>
                                <div class="col-8 text-break" id="share_url"></div>
                            </div>
                        </li>


                    </ul>
                    <div class="row mt-3 text-center">
                        <button class="btn btn-primary m-auto" type="button" id="cityUpdate">更新</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
<script>
    var cityArr = new Array();
    $("#selProvince").on('change', function () {
        $('#frmCity').removeClass("was-validated");
        //console.log(cityArr);
        code = $(this).val();
        $('#selCity').html('<option value="' + code + '">' + $("#selProvince").find("option:selected").text()
            + '</option>');

        $('#name').val($("#selCity").find("option:selected").text());
        getCityInfo(code, 1);
        for (var i = 0, l = cityArr.length; i < l; i++) {
            if (cityArr[i]["code"] == code) {
                for (var y = 0, l1 = cityArr[i]["cityList"].length; y < l1; y++) {
                    $('#selCity').append('<option value="' + cityArr[i]["cityList"][y]["code"] + '">' + cityArr[i]["cityList"][y]["name"] + '</option>')
                }
            }
        }
    });
    $("#selCity").on('change', function () {

        $('#name').val($("#selCity").find("option:selected").text());
        code = $(this).val();
        if (code == "") {
            return;
        }
        getCityInfo(code, 2);
    });

    function getCityInfo(code, level) {
        var res = "";

        $("#noneInfo code").removeClass("d-none");
        $("#noneInfo input[name='website']").val("");
        $("#noneInfo input[name='phone']").val("");
        $("#noneInfo input[name='wx']").val("");
        $("#noneInfo textarea[name='ps']").val("");
        $.ajax({
            type: "post",
            dataType: "json",
            async: false,
            url: "/api/city/",
            data: {"act": "getCity", "code": code},
            success: function (result2) {
                if (result2.status) {
                    res = result2
                }
            }
        })
        if (res) {
            //console.log(result.status);
            $("#noneInfo").addClass("d-none");
            $("#cityInfo").removeClass("d-none");
            $("#website").html('<a href="' + res.data.website + '" target="_blank">' + res.data.website + '</a>');
            $("#phone").text(res.data.phone);
            $("#wx").text(res.data.wx);
            $("#ps").html(res.data.ps);
            if (res.data.checked == 0) {
                $("#checked").html("<div class='text-danger'>待验证</div>");
            } else {
                $("#checked").html("<div class='text-success'>已验证</div>");
            }
            $("#update_date").text(res.data.update_date);
            $("#share_url").html("<a href='https://www.cqid.cn/cityInfo/"+code+"' target='_blank'>https://www.cqid.cn/cityInfo/"+code+"</a>")
        } else {
            $("#cityInfo").addClass("d-none");
            $("#noneInfo").removeClass("d-none");
        }

    }

    $(function () {
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                        form.classList.add('was-validated');
                    } else {
                        console.log("提交");
                        updateCity();
                        $('#frmCity').removeClass("was-validated");
                    }
                }, false);
            });
        }, false);
    });

    $.get('/source/city.json', function (result) {
        //console.log(result);
        for (var i = 0, l = result.length; i < l; i++) {
            //console.log(result[i]["name"]);
            cityArr[i] = {"name": result[i]["name"], "code": result[i]["code"], "cityList": []};

            $('#selProvince').append('<option value="' + result[i]["code"] + '">' + result[i]["name"] + '</option>');
            for (var y = 0, l1 = result[i].cityList.length; y < l1; y++) {
                cityArr[i]["cityList"][y] = {
                    "name": result[i].cityList[y]["name"],
                    "code": result[i].cityList[y]["code"]
                };
                //$('.custom-select').append('<option value="' + result[i].cityList[y]["code"] + '">' + result[i].cityList[y]["name"] + '</option>');
            }
        }
    });


    $("#citySubmit").on("click", function () {
        if (frmCity.website.value == "" && frmCity.phone.value == "" && frmCity.wx.value == "" && frmCity.ps.value == "") {
            frmCity.website.setCustomValidity('请至少输入一项内容!');
        } else {
            frmCity.website.setCustomValidity('');
            $('#frmCity').removeClass("was-validated");
        }
    });


    $("#cityUpdate").on("click", function () {
        $("#cityInfo").addClass("d-none");
        $("#noneInfo code").addClass("d-none");
        $("#noneInfo").removeClass("d-none");
        $("#noneInfo input[name='website']").val($("#website").text());
        $("#noneInfo input[name='phone']").val($("#phone").text());
        $("#noneInfo input[name='wx']").val($("#wx").text());
        $("#noneInfo textarea[name='ps']").val($("#ps").html());
    });

    function updateCity() {
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/api/city/",
            data: $('#frmCity').serialize(),
            success: function (result) {
                if (result.status) {
                    console.log(result.status);
                    $("#noneInfo").addClass("d-none");
                    $("#cityInfo").removeClass("d-none");
                    $("#website").html('<a href="' + frmCity.website.value + '" target="_blank">' + frmCity.website.value + '</a>');
                    $("#phone").text(frmCity.phone.value);
                    $("#wx").text(frmCity.wx.value);
                    $("#ps").html(frmCity.ps.value);
                    //console.log(result);
                } else {
                    $("#cityInfo").addClass("d-none");
                    $("#noneInfo").removeClass("d-none");
                }
            }
        })
    }
</script>
<?php include("inc/footer.php"); ?>
