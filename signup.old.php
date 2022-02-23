<?php
/**
 * 注册
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-09-12 14:15:58
 */
//require_once('import.php');
$title = "注册";
include("inc/header.php");
?>

<div class="intro py-5 py-lg-5 position-relative text-white">
    <div class="bg-overlay-primary">
        <img src="/images/W2COS.jpg" class="img-fluid img-cover" alt="W2COS">
    </div>
    <div class="intro-content py-5">
        <div class="container">

          <div class="alert text-center">
            用户系统维护中，登录注册暂不可用，请耐心等待通知。
            <!--
                <div class="col-md-6 align-self-center">
                    <h1 class="display-2 text-center pb-5 d-md-none">CQID</h1>
                    <h2 class="display-4 text-center">CQ CQ CQ</h2>
                    <p class="info">这里是业余无线电台操作技术能力模拟考试平台。专为无线电爱好者提供法规学习、考前自测、政策查询等服务。努力为大家普及业余无线电政策及法规，希望人人"持证上岗"，拒绝违法违规操作。</p>
                </div>
                <div class="col-md-5 ml-auto">
                    <div class="card">
                        <div class="card-body text-dark">
                            <form id="regForm" onsubmit="return false;" action="#" method="post" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <label for="email">邮箱</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="请输入邮箱地址" required pattern="\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*">
                                    <div class="invalid-feedback">请输入正确的邮箱地址！</div>
                                </div>
                                <div class="form-group">
                                    <label for="username">用户名</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名" required pattern="\w{3,16}">
                                    <div class="invalid-feedback">3-16位字母数字或下划线！</div>
                                </div>
                                <div class="form-group">
                                    <label for="password">密码</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码" required pattern=".{6,}">
                                    <div class="invalid-feedback">密码长度至少为六位！</div>
                                </div>
                                <div class="form-group">
                                    <label for="password-repeat">确认密码</label>
                                    <input type="password" class="form-control" id="password-repeat" placeholder="请再次输入密码" required>
                                    <div class="invalid-feedback">请确认两次密码输入一致!</div>
                                </div>
                                <input type="hidden" name="act" value="signup">
                                <button type="submit" class="btn btn-success btn-block btn-lg mb-2">注册</button>
                                <div class="text-center">
                                    已有账户? <a href="/login/">登录</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdn.staticfile.org/jsencrypt/3.0.0-rc.1/jsencrypt.min.js"></script>
<script>
    var PUBLIC_KEY="";
    $.get('/api/key/',function (result) {
        PUBLIC_KEY = JSON.parse(result).data.public_key;
    });

    function reg() {
        var crypt = new JSEncrypt();
        crypt.setPublicKey(PUBLIC_KEY);
        var cry_pass = crypt.encrypt($("#password").val());
        //console.log(cry_pass);
        $("#password").val(cry_pass);
        $.ajax({
            type: "post",
            dataType: "json",
            url: "/api/user/",
            data: $('#regForm').serialize(),
            success: function (result) {
                if(result.status==1){

                    $("#msg-body").removeClass("alert alert-danger").addClass("alert alert-info").text('注册成功，即将跳转到登录页面...');
                    $("#msg").modal('show');
                    setTimeout(function () {
                        location.href="/"
                    }, 3000);
                }else{
                    $("#msg-body").addClass("alert alert-danger").text(result.msg);
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
                    }else{reg();}

                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
        $("#password-repeat").on("input", function () {
            if ($(this).val() != document.getElementById("password").value) {
                this.setCustomValidity('请确认两次密码输入一致!');
            } else {
               this.setCustomValidity('');
            }
        })
        $("#password").on("input", function () {
            if ($(this).val() != document.getElementById("password-repeat").value) {
                document.getElementById("password-repeat").setCustomValidity('请确认两次密码输入一致!');
            } else {
                document.getElementById("password-repeat").setCustomValidity('');
            }
        })
    })
</script>

<?php include("inc/footer.php"); ?>
