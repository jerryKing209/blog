<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-top: 60px;" >
            <div class="box_style">
                <!--标题开始-->
                <div class="content_title">
                    <?php echo $content['title'];?>
                </div>
                <!--标题结束-->

                <!--作者开始-->
                <div class="list_bottom">
                    <div class="content_aut" >
						<span style="float: left;">
							<i style="color: #009688" class="layui-icon" >&#xe612;</i>&nbsp;作者:
                            <?php echo $content['author'];?>
						</span>
                        <span style="float: right;">
							<i style="color: #ff7600;font-weight: bold;" class="layui-icon" >&#xe60e;</i>&nbsp;发布时间：<?php echo date("Y-m-d H:i:s",$content['createtime']);?>
						</span>
                    </div>
                </div>
                <!--作者结束-->

                <!--内容开始-->
                <div class="content_style">
					<span class="index_description">
						<?php echo $content['content'];?>
					</span>
                </div>
                <!--内容结束-->
            </div>
        </div>

        <!--留言-->
        <!-- <div class="col-md-12 message_box">
            <div class="message_style" >留言区</div>

        </div> -->
        <div class="col-md-12 message_box">
            <div class="message_style" style="background-color: #31cebf">留言区</div>
            <form id = "form1" class="form-horizontal"  action="">
                <div class="form-group">
                    <div class="col-sm-8">
                        <input  type="hidden" class="pull-left form-control" rows="1" name="articleid" style="" value = "<?php echo $content['id'];?>">
                        <input  class="pull-left form-control" rows="1" name="comment" style="margin: 0px 4px 0px 0px; width: 70%; height: 100px;">
                        <div class="col-sm-2" style="position:absolute;right:10%;bottom:0">
                            <button type="button" onclick="addcomment()" class="btn btn-default">发表留言</button>
                        </div>
                    </div>
                </div>
            </form>
            <h1 style="border:black solid 1px"></h1>
            <?php if(empty($comments)) { ?>
                <div class="media" style="text-align:center" >

                    <?php echo "空空如也，来抢沙发吧。。。";?>
                </div>
            <?php } else {?>
                <?php foreach($comments as $comment){ ?>
                    <?php if (empty($comment)) continue; ?>
                    <div class="media">
                        <a href="#" class="pull-left">
                            <img src="<?php if(empty($comment['head_img'])) {echo 'https://www.runoob.com/try/bootstrap/layoutit/v3/default8.jpg';} else { echo $comment['head_img'];}?>" class="media-object" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php if (empty($comment['username'])) { echo '匿名';} else { echo $comment['username'];} ?></h4>
                            <?php if (empty($comment['comment'])) { echo '网络异常，请刷新页面！';} else { echo $comment['comment'];} ?>
                        </div>
                    </div>
                <?php } }?>
        </div>
    </div>
</div>
</<div>

    <!--百度UEditor代码高亮编辑器-->
    <script type="text/javascript" src="/public/ueditor2/third-party/SyntaxHighlighter/shCore.js"></script>
    <link rel="stylesheet" href="/public/ueditor2/third-party/SyntaxHighlighter/shCoreDefault.css">
    <script type="text/javascript">SyntaxHighlighter.all(); </script>
    <script type="text/javascript" charset="utf-8" >
        function addcomment() {
            $.ajax({
                //几个参数需要注意一下
                type: "POST",//方法类型
                dataType: "text",//预期服务器返回的数据类型
                url: "/Comment/addcomment" ,//url
                data: $('#form1').serialize(),
                success: function (result) {
                    console.log(result);//打印服务端返回的数据(调试用)
                    if (result.resultCode == 200) {
                        alert(result.msg);
                    }
                    ;
                },
                error : function(result) {
                    console.log(result);//打印服务端返回的数据(调试用)
                    alert(result.msg);
                }
            });
        }
    </script>
