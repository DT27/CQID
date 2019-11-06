<?php
/**
 * 用户中心
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-07 08:13:50
 */
$title = "用户中心";
include("inc/header.php");
?>
    <div class="intro py-4 bg-primary text-white">
        <div class="intro-content">
            <div class="container">
                <h1>会员中心</h1>
                <p class="lead mb-4">模拟考试成绩 &amp; 错题集 &amp; 收藏 &amp; 设置</p>
            </div>
        </div>
    </div>
    <main class="main">
        <div class="py-5 bg-light">
            <div class="container" id="user-main">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills">
                            <a class="nav-link" data-toggle="pill" href="#">模拟考试成绩</a>
                            <a class="nav-link" data-toggle="pill" href="#">题库收藏</a>
                            <a class="nav-link" data-toggle="pill" href="#">错题集</a>
                            <hr>
                            <a class="nav-link active" data-toggle="pill" href="#account">个人信息</a>
                            <a class="nav-link" data-toggle="pill" href="#password">安全</a>
                            <a class="nav-link" data-toggle="pill" href="#">删除账户</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="account" role="tabpanel">

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">个人信息</h5>
                                        <form>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group mt-2">
                                                        <label for="inputUsername">用户名</label>
                                                        <input type="text" class="form-control" name="inputUsername" id="inputUsername" autocomplete="off" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail">邮箱</label>
                                                        <input type="text" class="form-control" name="inputEmail" id="inputEmail" autocomplete="off" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <span>注册时间：</span>
                                                        <span id="inputRegTime"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="text-center">
                                                        <svg class="bd-placeholder-img rounded-circle" width="127" height="128" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Completely round image: 75x75"><title>头像</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">128x128</text></svg>
                                                        <div class="mt-2">
                                                            <span class="btn btn-secondary"><i class="fas fa-upload"></i> 上传</span>
                                                        </div>
                                                        <small>推荐头像图片尺寸大于128x128px，.jpg格式。</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-info">Save changes</button>
                                        </form>

                                    </div>
                                </div><!-- /.card -->

                            </div>
                            <div class="tab-pane fade" id="password" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">修改密码</h5>

                                        <form>
                                            <div class="form-group">
                                                <label for="inputPasswordCurrent">当前密码</label>
                                                <input type="password" class="form-control" id="inputPasswordCurrent" autocomplete="off">
                                                <small><a href="#">忘记密码？</a></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPasswordNew">新密码</label>
                                                <input type="password" class="form-control" id="inputPasswordNew">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPasswordNew2">确认新密码</label>
                                                <input type="password" class="form-control" id="inputPasswordNew2">
                                            </div>
                                            <button type="submit" class="btn btn-info">保存</button>
                                        </form>

                                    </div>
                                </div><!-- /.card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(function () {
            var user = Cookies.getJSON("cqid");
            if (user && user.name) {
                user["act"] = "userInfo";
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "/api/user/",
                    data: user,
                    success: function (result) {
                        if (result.status) {
                            $("#inputUsername").val(result.data.username);
                            $("#inputEmail").val(result.data.email);
                            $("#inputRegTime").text(result.data.create_date);
                            //console.log(result);
                        } else {
                        }
                    }
                })
            } else {
                $("#user-main").html('<div class="alert alert-danger">请先<a href="/login/"> 登录</a>，即将调转到登录页面...</div>');
                setTimeout(function () {
                    location.href = "/login/"
                }, 3000);
            }
        })

    </script>
<?php require_once('inc/footer.php'); ?>