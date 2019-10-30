<!-- 文章列表页 时间：20170726 作者:HXC -->
<div class="art_list">
<div class="layui-tab layui-tab-card admin_bg">
  <ul class="layui-tab-title">
    <li class="layui-this">评论管理</li>
  </ul>
  <div class="layui-tab-content" >
    <div class="layui-tab-item layui-show">
		<!--栏目列表-->
		<div style="display: inline-block;">
		  <div class="layui-form" style="padding-left: 20px;" >

		    <table class="layui-table">
				<colgroup>
					<col width="50">
                    <col width="50">
					<col width="300">
					<col width="80">
					<col width="200">
					<col width="180">
					<col width="60">
				</colgroup>
				<thead>
				<tr>
				  <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose">序号</th>
				  <th>评论id</th>
                    <th>评论内容</th>
				  <th>作者</th>
				  <th>文章标题</th>
				  <th>创建时间</th>
				  <th>操作选项</th>
				</tr> 
				</thead>

			    <tbody>
			     	<?php 
					  $var = 1;
					  foreach($comments as $val){
					?>
			        <tr>
				        <td><?php echo $var++; ?>.</td>
                        <td><?php echo $val['id']; ?></td>
                        <td><?php echo $val['comment']; ?></td>
                        <td><?php echo $val['username']; ?></td>
                        <td><?php echo $val['title']; ?></td>
							<td><?php echo $val['create_time']; ?></td>
							<td><a href = "<?php echo site_url('Admin/delcomment')?>/<?php echo $val['id']; ?>" onclick = "javascript:return del()">删除</a>
						</td>
			        </tr>
			        <?php } ?>
			    </tbody>
		    </table>
		  </div>
		<!--分页开始-->
		<div  style="margin-left: 20px;"><?php echo $links; ?></div>
		<!--分页结束-->
		</div>
    </div>
  </div>
</div>
</div>

<!--文章分页字体色-->
<style type="text/css">
.layui-btn a{color: #fff;}
.layui-btn-primary a{color: #000;}
</style>


