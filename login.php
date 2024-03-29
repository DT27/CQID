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
      var _uname=$("#username").val();
      var _upwd=$("#password").val();
        var crypt = new JSEncrypt();
        crypt.setPublicKey(PUBLIC_KEY);
        var cry_pass = crypt.encrypt($("#password").val());
        //console.log(cry_pass);
        $("#password").val(cry_pass);


      /**
       * 判断是否新系统用户
       */
      $.ajax({
        type: "post",
        dataType: "json",
        async: false,
        url: "https://www.cqid.cn/news/user/ajaxusername.html",
        data: {username: _uname},
        success: function (flag) {
          if (-1 == flag) {
            //此用户名已经存在，直接新系统登录
            $.ajax({
              type:"POST",
              async: false,
              xhrFields: {
                withCredentials: true //跨域携带cookies
              },
              crossDomain: true,
              url:"https://www.cqid.cn/news/?api_user/loginapi",
              data:{uname:_uname,upwd:_upwd,apikey:0},
              datatype: "text",//"xml", "html", "script", "json", "jsonp", "text".
              success:function(data){
                data=$.trim(data);
                console.log(data)
                if(data.indexOf('ok|')>=0){
                  var datastrs=data.split('|');
                  $("body").append(datastrs);
                  data='login_ok';
                }
                if(data=='login_ok'){
                  window.location.href="https://www.cqid.cn/";
                }else{
                  switch(data){
                    case 'login_null':
                      alert("用户名或者密码为空");
                      break;
                    case 'login_user_or_pwd_error':
                      alert("用户名或者密码错误");
                      break;
                    default:
                      alert(data);
                      break;
                  }
                }
              }   ,
              complete: function () {
              },
              error: function (msg) {
                console.log(msg);
                $("#msg-body").addClass("alert-error").text(msg);
                $("#msg").modal('show');
              }
            });


          } else if (-2 == flag) {
            //用户名含有禁用字符
          } else {
            /**
             * 原登录方法
             */
            $.ajax({
              type: "post",
              dataType: "json",
              async: false,
              url: "/api/user/",
              data: $('#loginForm').serialize(),
              success: function (result) {
                if (result.status == 1) {
                  //console.log(Cookies.getJSON("cqid"));
                  //console.log(PHPCookies.read());

                  /**
                   * 判断是否新系统用户
                   */
                  $.ajax({
                    type: "post",
                    dataType: "json",
                    async: false,
                    url: "https://www.cqid.cn/news/user/ajaxusername.html",
                    data: {username: _uname},
                    success: function (flag) {
                      if (-1 == flag) {
                        //此用户名已经存在，直接新系统登录
                        $.ajax({
                          type:"POST",
                          async: false,
                          xhrFields: {
                            withCredentials: true //跨域携带cookies
                          },
                          crossDomain: true,
                          url:"https://www.cqid.cn/news/?api_user/loginapi",
                          data:{uname:_uname,upwd:_upwd,apikey:0},
                          datatype: "text",//"xml", "html", "script", "json", "jsonp", "text".
                          success:function(data){
                            data=$.trim(data);
                            console.log(data)
                            if(data.indexOf('ok|')>=0){
                              var datastrs=data.split('|');
                              $("body").append(datastrs);
                              data='login_ok';
                            }
                            if(data=='login_ok'){
                              window.location.href="https://www.cqid.cn/";
                            }else{
                              switch(data){
                                case 'login_null':
                                  alert("用户名或者密码为空");
                                  break;
                                case 'login_user_or_pwd_error':
                                  alert("用户名或者密码错误");
                                  break;
                                default:
                                  alert(data);
                                  break;
                              }
                            }
                          },
                          error: function (msg) {
                            console.log(msg);
                            $("#msg-body").addClass("alert-error").text(msg);
                            $("#msg").modal('show');
                          }
                        });


                      } else if (-2 == flag) {
                        //用户名含有禁用字符
                      } else {
                        //用户名可以使用，在新系统中注册用户
                        /**
                         * 注册开始 登录时直接在新系统中注册
                         */
                        var _code="noCode";
                        var _email=result.data.email;
                        var _data={uname:_uname,upwd:_upwd,rupwd:_upwd,email:_email,frominvatecode:"",apikey:"",seccode_verify:_code};
                        $.ajax({
                          type:"POST",
                          async: false,
                          xhrFields: {
                            withCredentials: true //跨域携带cookies
                          },
                          crossDomain: true,
                          url:"https://www.cqid.cn/news/api_user/registerapi.html",
                          data:_data,
                          datatype: "text",//"xml", "html", "script", "json", "jsonp", "text".
                          beforeSend: function () {
                            $("#msg-body").addClass("alert-info").text('用户授权中……');
                            $("#msg").modal('show');
                          },
                          //成功返回之后调用的函数
                          success:function(data){
                            data=$.trim(data);
                            if(data=='reguser_ok'){
                              $("#msg-body").addClass("alert-info").text('授权成功，即将跳转到首页');
                              $("#msg").modal('show');
                              setTimeout(function () {
                                location.href = "https://www.cqid.cn/"
                              }, 3000);
                            }
                          },
                          error: function (msg) {
                            console.log(msg);
                            $("#msg-body").addClass("alert-error").text(msg);
                            $("#msg").modal('show');
                          }
                        });
                        /**
                         * 注册结束
                         */
                      }
                    },
                    error: function (msg) {
                      console.log(msg);
                    }
                  });

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
        },
        error: function (msg) {
          console.log(msg);
          $("#msg-body").addClass("alert-error").text(msg);
          $("#msg").modal('show');
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
