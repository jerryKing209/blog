<!-- 文件名：前台文章页 作者：HXC 时间：20170802 -->
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
			<form class="form-horizontal" method="post" action="<?php echo site_url('Comment/add');?>/<?php echo $content['id']; ?>">
				<div class="form-group">
					<div class="col-sm-8">
						<div class="pull-left form-control" rows="1" name="comment" style="margin: 0px 4px 0px 0px; width: 70%; height: 100px;"><?php echo $comment['content']; ?>
						</div>
     					<div class="col-sm-2" style="position:absolute;right:10%;bottom:0">
     						<button type="submit" class="btn btn-default">发表留言</button>
     					</div>
					</div>
				</div>
			</form>
			<h1 style="border:black solid 1px"></h1>
				<div class="media">
				 	<a href="#" class="pull-left">
				 		<img src="https://www.runoob.com/try/bootstrap/layoutit/v3/default8.jpg" class="media-object" alt="">
					 </a>
					<div class="media-body">
						<h4 class="media-heading">Nested media heading</h4>
						 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
					</div>
				</div>
				<div class="media">
					<a href="#" class="pull-left">
						<img src="https://www.runoob.com/try/bootstrap/layoutit/v3/default8.jpg" class="media-object" alt="">
					</a>
					<div class="media-body">
						<h4 class="media-heading">Nested media heading</h4>
						 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
					</div>
				</div>
			</div>
		</div>
	</div>
</<div>

<!--百度UEditor代码高亮编辑器-->
<script type="text/javascript" src="/public/ueditor2/third-party/SyntaxHighlighter/shCore.js"></script>
<link rel="stylesheet" href="/public/ueditor2/third-party/SyntaxHighlighter/shCoreDefault.css">
<script type="text/javascript">SyntaxHighlighter.all(); </script>
