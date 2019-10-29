<!--脚部开始-->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-2" ></div>
            <div class="col-md-8 foot_r">©copyringht 2019 版权所有 </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<!--脚部结束-->

<!--引入layui-->
<script src="/public/theme/layui/layui.js" charset="utf-8"></script>
<script src="/public/theme/js/layuimod.js" charset="utf-8"></script>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="/public/theme/bootstrap/js/bootstrap.min.js"></script>
<script type = "text/javascript">
    $(function(){
        $("#art_title").click(function(){
            var aid = $(this).attr('name');
            $.post("<?php echo site_url('Home/viewnum');?>",
                {
                    id:aid
                });
        });
    });
</script>
</body>
</html>