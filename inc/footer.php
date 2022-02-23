<?php
/**
 * 底部文件
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-09 17:47:00
 */
require_once __DIR__ . '/../bin/Dotenv.php';
Dotenv::load(__DIR__ . "/../");
$domain = getenv("domain");
?>
<footer class="text-muted py-4 lh-1 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md">最新题库版本：<a href="http://www.crac.org.cn/News/Detail?ID=3dbd1bc7f36443958e1872234f42464f" target="_blank">v20211022</a></div>
            <div class="col-md text-md-right">
                业余无线电台操作技术能力模拟考试平台
            </div>
        </div>
        <div class="text-center mt-3 mb-5">©2019-<?php echo date("Y") ?> <a href="https://www.cqid.cn/">业余无线电模拟考试平台</a> <br>
            <a href="https://www.cqid.cn/news/ask" target="_blank" class="ml-3">
                <small>意见/反馈</small>
            </a> <br>
            <small>
                <a href="http://www.beian.miit.gov.cn/" target="_blank" class="text">京ICP备13024502号-7</a></small>
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
<style type="text/css">
    @media (min-width: 768px){

    }
    .tnvk_footer {
        display: none;
        height: 58px;
        line-height: 10px;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 100);
        background: #fff;
        position: fixed;
        bottom: 0px;
        left: 0px;
        right: 0px;
        z-index: 3;
        border-top: solid 1px #f5f5f5;
    }

    .tnvk_footer .tnvk_f_item {
        flex: 1;
        padding-top: 10px;
        box-sizing: border-box;
    }

    .tnvk_footer .tnvk_f_item span {
        font-family: SourceHanSansSC;
        font-weight: 400;
        font-size: 12px;
        color: rgb(16, 16, 16);
        font-style: normal;
        letter-spacing: 0px;
        line-height: 18px;
        text-decoration: none;
        display: block;
    }

    .tnvk_footer .active span {
        font-family: SourceHanSansSC;
        font-weight: 400;
        font-size: 12px;
        color: rgba(0, 132, 255, 1);
        font-style: normal;
        letter-spacing: 0px;
        line-height: 18px;
        text-decoration: none;
        display: block;
    }

    .tnvk_footer .tnvk_icon {
        width: 24px;
        height: 24px;
    }

    .tnvk_footer .addplus {
        width: 26px;
        height: 32px;
        line-height: 36px;
        border-radius: 5px;
        background-color: rgba(0, 132, 255, 100);
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 100);
        margin: 0 auto;
    }

    @media (max-width:768px) {
        .tnvk_footer {
            display: flex;
        }
    }
    #to_top {
        display: none;
        position: fixed;
        width: 3rem;
        height: 3rem;
        right: 1rem;
        bottom: 8rem;
        background: url(https://static.cqid.cn/css/fronze/css/images/backtop.png) no-repeat top center;
        background-size: 3rem;
        z-index: 89;
    }
</style>
<div class="tnvk_footer">
    <div
        class="tnvk_f_item<?php echo $title == "" ? " active" : ""; ?>">
        <a href="https://www.cqid.cn/"><img class="tnvk_icon" src="https://static.cqid.cn/css/fronze/css/svg/home<?php echo $title == "" ? "_active" : ""; ?>.svg"><span>首页</span>
        </a>
    </div>
    <div
        class="tnvk_f_item<?php echo $title == "刷题" ? " active" : ""; ?>">
        <a href="https://www.cqid.cn/exercise/"><img class="tnvk_icon" src="https://static.cqid.cn/css/fronze/css/svg/shuati<?php echo $title == "刷题" ? "_active" : ""; ?>.svg"><span>刷题</span>
        </a>
    </div>
    <div class="tnvk_f_item<?php echo $title == "模拟考试" ? " active" : ""; ?>">
        <a href="https://www.cqid.cn/exam/"><img class="tnvk_icon" src="https://static.cqid.cn/css/fronze/css/svg/kaoshi<?php echo $title == "模拟考试" ? "_active" : ""; ?>.svg">
            <span>模拟考试</span>
        </a>
    </div>
    <div
        class="tnvk_f_item">
        <a href="https://www.cqid.cn/news/article"><img class="tnvk_icon" src="https://static.cqid.cn/css/fronze/css/svg/zixun.svg"><span>资讯</span>
        </a>
    </div>
    <div class="tnvk_f_item">
        <a href="https://www.cqid.cn/news/user/score.html"><img class="tnvk_icon" src="https://static.cqid.cn/css/fronze/css/svg/my.svg"><span>我的</span>
        </a>
    </div>
</div>

<div id="to_top"></div>
<script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    function logout() {
        var user = Cookies.getJSON("cqid");
        if (user && user.name) {
            user["act"] = "logout";
                Cookies.remove('cqid', {path: '/', domain: "<?php echo $domain; ?>"})
            $.ajax({
                type: "post",
                dataType: "json",
                url: "/api/user/",
                data: user,
                async: false,
                success: function () {
                  $.ajax({
                    type:"GET",
                    url:"https://www.cqid.cn/news/?api_user/loginoutapi",
                    async: false,
                    xhrFields: {
                      withCredentials: true //跨域携带cookies
                    },
                    crossDomain: true,
                    datatype: "text",
                    success:function(data){
                      $("#msg-body").addClass("alert-info").text('已退出，即将跳转到首页');
                      $("#msg").modal('show');
                      location.href = "/";
                    },
                    error: function(){
                    }
                  });
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
                        $("#user-center").html('<a class="nav-link" href="/login/" title="登录">登录</a> <a class="nav-link" href="https://www.cqid.cn/news/user/register.html" title="注册">注册</a>');
                    }
                },
                error: function () {
                    $("#user-center").html('<a class="nav-link" href="/login/" title="登录">登录</a> <a class="nav-link" href="https://www.cqid.cn/news/user/register.html" title="注册">注册</a>');
                }
            })
        } else {
          var user = Cookies.getJSON("whatsnsauth");
          if (user) {
              $("#user-center").html('<a class="nav-link" href="https://www.cqid.cn/news/user/default.html" title="用户中心">用户中心</a>');
          }else{
            $("#user-center").html('<a class="nav-link" href="/login/" title="登录">登录</a> <a class="nav-link" href="https://www.cqid.cn/news/user/register.html" title="注册">注册</a>');
          }
        }
        var p=0,t=0;
        var oTop = document.getElementById("to_top");
        var screenw = document.documentElement.clientWidth || document.body.clientWidth;
        var screenh = document.documentElement.clientHeight || document.body.clientHeight;
        $(window).scroll(function(e){
            p = $(this).scrollTop();
            var scrolltop = document.documentElement.scrollTop || document.body.scrollTop;
            if(scrolltop<=screenh){
                oTop.style.display="none";
            }else{
                oTop.style.display="block";
            }
            if(t<=p){//下滚
                if(scrolltop>50){
                    $(".nav_top").hide();
                }

            }

            else{//上滚
                $(".nav_top").show();

            }
            setTimeout(function(){t = p;},0);
        });
        oTop.onclick = function(){
            document.documentElement.scrollTop = document.body.scrollTop =0;
        }

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
