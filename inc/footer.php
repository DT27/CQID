<?php
/**
 * 底部文件
 * 业余无线电台操作技术能力模拟考试系统
 * Author: DT27 <https://dt27.org>
 * @2019-08-09 17:47:00
 */
?>
<footer class="text-muted">
    <div class="container">
        <p class="float-right text-right">
            © <a href="https://dt27.org" target="_blank">DT27</a><br>
        </p>
        <p>最新题库版本：<a href="http://www.crac.org.cn/?page_id=4274" target="_blank">v171031</a></p>
        <div class="text-center mb-1">
            <small>已运行：<span id="runTime"></span></small>
        </div>
    </div>
</footer>
<script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script>
    $(function () {

        $('#loading').hide();

        $("div[data-num='<?php echo $aQ[$a[0]]["I"];?>']").removeClass("d-none");
        $(".next").click(function () {
            $(this).parents(".card").addClass("d-none").next(".card").removeClass("d-none");
        })
        $(".prev").click(function () {
            $(this).parents(".card").addClass("d-none").prev(".card").removeClass("d-none");
        })





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
</script></body></html>