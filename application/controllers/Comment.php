<!--
*文件名：后台文章模块
*时间：20170815
*作者：HXC
-->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('date.timezone','Asia/Shanghai');//时区设置
class Comment extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model(array('Login_model','Article_model', 'Comment_model'));
		if(!$this->Login_model->is_logged_in()){
			//redirect('Login/index');
		}
	}

/*后台文章列表页分页*/
	public function index() {	
		//加载分页类
		$this->load->library('pagination');                                              
		//配置分页类
		$perPage = 12;//分页数量
		$config['base_url'] = site_url('Article/index');//分页所在模板
		$config['total_rows'] = $this->db->count_all_results('article');//需要处理分页数据的总量
		$config['per_page'] = $perPage;//每页展现的数量
		$config['uri_segment'] = 3;//自动检测你 URI 的哪一段包含页数
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['prev_link'] = '上一页';
		$config['next_link'] = '下一页';
		$config['first_tag_open'] = '<span class="layui-btn" role = "button">';//第一个链接的起始标签。
		$config['first_tag_close'] = '</span>&nbsp;&nbsp;';//第一个链接的结束标签
		$config['last_tag_open'] = '<span class="layui-btn" role = "button">';//最后一个链接的起始标签
		$config['last_tag_close'] = '</span>&nbsp;&nbsp;';//最后一个链接的结束标签
		$config['num_tag_open'] = '<span class="layui-btn layui-btn-primary" role = "button">';//数字链接的起始标签
		$config['num_tag_close'] = '</span>&nbsp;&nbsp;';
		$config['cur_tag_open'] = '<span class="layui-btn layui-btn-primary" role = "button">';//当前页链接的起始标签
		$config['cur_tag_close'] = '</span>&nbsp;&nbsp;';
		$config['prev_tag_open'] = '<span class="layui-btn" role = "button">';
		$config['prev_tag_close'] = '</span>&nbsp;&nbsp;';
		$config['next_tag_open'] = '<span class="layui-btn" role = "button">';
		$config['next_tag_close'] = '</span>&nbsp;&nbsp;';
		$this->pagination->initialize($config);
		//生成分页
		$data['links'] = $this->pagination->create_links();
		//获取数据
		$offset = $this->uri->segment(3);
		$article = $this->Article_model->get_article($perPage, $offset);
		//获取分类
		$category = $this->Article_model->get_category();
		//将分类id替换为分类名
		foreach($article as &$val) {
			foreach($category as $var) {
				if($val['cid'] == $var['cid']) {
					$val['cid'] = $var['catename'];
				}
			}
		}
		$data['article'] = $article;
		//加载视图分配变量
		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/article');
		$this->load->view('Admin/footer');
	}


/*添加评论列表*/
	public function addcomment() {
		$aid = $this->uri->segment(3);
		$comment = $this->input->post('comment');
		if (empty($comment)) {
			$data['tips'] = '不能发表空评论';
			goto END;
		}
		$article = $this->Article_model->get_art_info($aid);
		if (empty($article)) {
			$data['tips'] = "该篇blog已下架!";
		} else {
			
			$uid = $this->Login_model->get_user_id();
			$data = [
				'comment' 	 => $comment,
				'user_id' 	 => $uid,
				'article_id' => $aid,
				'create_time' => date('Y-m-d H:i:s', time())
			];
			$ret = $this->Comment_model->add_comment($data);
			if ($ret > 0) {
				$data['tips'] = "留言成功！";
			} else {
				$data['tips'] = "留言失败请重试一次！";
			}
			
		}
		//获取分类信息
		$data['comment'] = $this->Comment_model->get_comment_list(1, 10, $aid);
		//加载视图分配变量
		END:
		$this->load->view('tips', $data);
	}

/*添加新文章*/
	public function insertart() {
		//获取文章信息
		$category = $this->input->post('category');
		$title = $this->input->post('title');
		$author = $this->input->post('author');
		$description = $this->input->post('description');
		$content = $this->input->post('content');
		$createtime = time();
		$info = array("cid"=>$category,"title"=>$title,"author"=>$author,"description"=>$description,"content"=>$content,"createtime"=>$createtime);
		//插入文章并更新分类
		if($this->Article_model->insert_article($info) && $this->Article_model->update_cate($category,1)){
			redirect('Article/index');
		}
	}

/*删除文章*/
	public function delarticle() {
		//获取文章id和分类信息
		$aid = $this->uri->segment(3);
		$cid = $this->Article_model->get_artcid($aid);
		//执行删除操作		
		if($this->Article_model->del_article($aid) && $this->Article_model->update_cate($cid,0)){
			$data['tips'] = "删除成功!";
		} else {
			$data['tips'] = "删除失败!";
		}
		$data['route'] = site_url('Article/index');
		//输出信息并跳转
		$this->load->view('tips',$data);
	}
	
}

?>
