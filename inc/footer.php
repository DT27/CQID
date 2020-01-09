<?php
/**
 * 底部文件
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-09 17:47:00
 */
?>
<footer class="text-muted py-4 lh-1 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md">最新题库版本：<a href="http://www.crac.org.cn/?page_id=4274" target="_blank">v171031</a></div>
            <div class="col-md text-md-right">
                业余无线电台操作技术能力模拟考试平台
            </div>
        </div>
        <div class="text-center mt-3">© 2019 - <a href="https://dt27.org" target="_blank">DT27</a> <br>
            <a href="https://github.com/DT27/CQID/issues" target="_blank" class="ml-3">
                <small>意见/反馈</small>
            </a> <br>
            <small>
                <a href="http://www.beian.miit.gov.cn/" target="_blank" class="text">京ICP备13024502号-7</a></small>
            <br>
            <small>已运行：<span id="runTime"></span></small>
        </div>
    </div>
</footer><!-- Modal -->
<div class="modal fade" id="msg" tabindex="-1" role="dialog" aria-labelledby="message" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="msg-body" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    function logout() {
        var user = Cookies.getJSON("cqid");
        if (user && user.name) {
            user["act"] = "logout";
                Cookies.remove('cqid', {path: '/', domain: '.cqid.cn'})
            $.ajax({
                type: "post",
                dataType: "json",
                url: "/api/user/",
                data: user,
                success: function () {
                    $("#msg-body").addClass("alert-info").text('已退出，即将跳转到首页');
                    $("#msg").modal('show');
                    setTimeout(function () {
                        location.href = "/"
                    }, 3000);
                }
            });
        }
    }
    $(function () {
        var user = Cookies.getJSON("cqid");
        if (user && user.name) {
            user["act"] = "chkUser";
            $.ajax({
                type: "post",
                dataType: "json",
                url: "/api/user/",
                data: user,
                success: function (result) {
                    if (result.status) {
                        $("#user-center").html('<a href="/user/" class="nav-link">' + user.name + '</a> <a href="javascript:logout();"  class="nav-link">退出</a>');
                    } else {
                        $("#user-center").html('<a class="nav-link" href="/login/" title="登录">登录</a> <a class="nav-link" href="/signup/" title="注册">注册</a>');
                    }
                },
                error: function () {
                    $("#user-center").html('<a class="nav-link" href="/login/" title="登录">登录</a> <a class="nav-link" href="/signup/" title="注册">注册</a>');
                }
            })
        } else {
            $("#user-center").html('<a class="nav-link" href="/login/" title="登录">登录</a> <a class="nav-link" href="/signup/" title="注册">注册</a>');
        }


        //计算网站运行时间
        var date1 = '2019-08-06 18:27:00';  //开始时间
        var date2 = new Date(); //结束时间
        var date3 = date2.getTime() - new Date(date1).getTime();    //时间差的毫秒数
        //计算出相差天数
        var days = Math.floor(date3 / (24 * 3600 * 1000))
        //计算出小时数
        var leave1 = date3 % (24 * 3600 * 1000)    //计算天数后剩余的毫秒数
        var hours = Math.floor(leave1 / (3600 * 1000))
        //计算相差分钟数
        var leave2 = leave1 % (3600 * 1000)        //计算小时数后剩余的毫秒数
        var minutes = Math.floor(leave2 / (60 * 1000))
        $("#runTime").text(days + "天 " + hours + "小时 " + minutes + " 分钟");
    })
</script>
<script>
    //百度统计代码
    var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?27be6da16dc60408e058a828f67ef85b";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script></body></html>