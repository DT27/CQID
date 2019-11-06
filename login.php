<?php
/**
 * 登录
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-09-12 16:23
 */
//require_once('import.php');
$title = "登录";
include("inc/header.php");
?>

<div class="intro py-5 py-lg-5 position-relative text-white">
    <div class="bg-overlay-primary">
        <img src="/images/W2COS.jpg" class="img-fluid img-cover" alt="W2COS">
    </div>
    <div class="intro-content py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <h1 class="display-2 text-center pb-5 d-md-none">CQID</h1>
                    <h2 class="display-4 text-center">CQ CQ CQ</h2>
                    <p class="info">这里是业余无线电台操作技术能力模拟考试平台。专为无线电爱好者提供法规学习、考前自测、政策查询等服务。努力为大家普及业余无线电政策及法规，希望人人"持证上岗"，拒绝违法违规操作。</p>
                </div>
                <div class="col-md-5 ml-auto">
                    <div class="card">
                        <div class="card-body text-dark">
                            <form id="loginForm" onsubmit="return false;" action="#" method="post" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <label for="username">用户名</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">密码</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码" required>
                                </div>
                                <input type="hidden" name="act" value="login">
                                <button type="submit" class="btn btn-success btn-block btn-lg mb-2">登录</button>
                                <div class="text-center">
                                    还没有账户? <a href="/signup/">注册</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdn.staticfile.org/jsencrypt/3.0.0-rc.1/jsencrypt.min.js"></script>
<script>
    var PUBLIC_KEY = "";
    $.get('/api/key/', function (result) {
        PUBLIC_KEY = JSON.parse(result).data.public_key;
    });
    function login() {
        var crypt = new JSEncrypt();
        crypt.setPublicKey(PUBLIC_KEY);
        var cry_pass = crypt.encrypt($("#password").val());
        //console.log(cry_pass);
        $("#password").val(cry_pass);
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/api/user/",
            data: $('#loginForm').serialize(),
            success: function (result) {
                if (result.status == 1) {
                    //console.log(Cookies.getJSON("cqid"));
                    //console.log(PHPCookies.read());
                    $("#msg-body").addClass("alert-info").text('登录成功，即将跳转到首页');
                    $("#msg").modal('show');
                    setTimeout(function () {
                        location.href = "/"
                    }, 3000);
                } else {
                    $("#msg-body").addClass("alert-danger").text(result.msg);
                    $("#msg").modal('show');
                }
            },
            error: function (msg) {
                console.log(msg);
            }
        });
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
                    } else {
                        login();
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })
</script>

<?php include("inc/footer.php"); ?>
