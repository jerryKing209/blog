﻿<div class="banner blog_banner" style="">
	<div class="banner_text blog_banner_text">人生苦短，Just for fun !</div>
</div>
<!--首页banner结束-->

<div class="container">
<div class="row">
	<!--所在位置栏-->
	<div class="col-md-12">
		<div class="wh_place">主页</div>
	</div>

	<!--左侧-->
	<div class="col-md-4">
		<div class="hot_art" >
			<!--热门文章开始-->
				<div class="index_left_list index_left_list2" >
					热门博主
				</div>
				<?php $var = 1; foreach($order as $val){ 
					$segments = array('Home','home',$val['uid']);
					$url = site_url($segments);
				?>
				<a style="text-decoration: none" href = "<?php echo $url;?>">
				<div class="index_left_list" >
				<?php echo $var++;?>、<?php echo $val['username'];?>
				</div></a>
				<?php }?>
			<!--热门文章结束-->
		</div>

		<div class="fir_link left_hide" >
			<!--友情链接开始-->
			<div class="index_left_list index_left_list2" >友情链接</div>

			<div class="index_left_list" >
				<a style="text-decoration: none" href = "https://github.com/github">GitHub官方网站</a>
			</div>
			<div class="index_left_list" >
				<a style="text-decoration: none" href = "http://www.csdn.net/">CSDN官方论坛</a>
			</div>

			<div class="index_left_list" >
				<a style="text-decoration: none" href = "http://www.oschina.net/">开源中国官网</a>
			</div>

			<div class="index_left_list" >
				<a style="text-decoration: none" href = "http://www.php1.cn/">中国第一PHP社区</a>
			</div>
			<!--友情链接结束-->
		</div>

	</div>

	<!--右侧开始-->
	<div class="col-md-8 pad-left">
		<div style="width: 100%;">
			<?php foreach($article as $val){   
				$segments = array('Home','content',$val['id']);
				$url = site_url($segments);
			?> 
			    <div class="right_div_li" style="margin-bottom:15px;background: #fff;">
					<a class="a_style" href = "<?php echo $url;?>"  name = "<?php echo $val['id']; ?>">
						<!--标题开始-->
						<div class="index_list_right_title" >
							<?php echo $val['title'];?>
						</div>
						<!--标题结束-->

						<!--内容开始-->		
						<div class="index_description_box" >
							<span style = "font-size:16px;color:#009688">摘要内容:</span>
							<span class="index_description">
							<?php echo $val['description'];?></span>	
						</div>
						<!--内容结束-->
					</a>
					<div class="list_bottom">
						<div class="list_bottom_aut">
						<span style="float: left;">
							<i style="color: #009688" class="layui-icon" >&#xe612;</i>&nbsp;作者:
							<?php echo $val['author'];?>
						</span>
						<span style="float: right;">
							<i style="color: #ff7600;font-weight: bold;" class="layui-icon" >&#xe60e;</i>&nbsp;发布时间：<?php echo  date("Y-m-d H:i:s",$val['createtime']); ?>
						</span>
						</div>
					</div>
				</div>
			<?php }?>

		</div>
	</div>
	<!--右边结束-->
	
	<!--分页开始-->
	<div class="col-md-12">
		<div class="btn_next" >
				<div class="btn_next2"><?php echo $links;?></div>
		</div>
	</div>
	<!--分页结束-->

</div>
</div>






		
	
