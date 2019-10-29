<?php
class Home_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	/*获取用户信息*/
	function getuserinfo(){
		$table = "user";
		$query = $this->db->get_where($table,array('uid'=>1));
		$result = $query->row_array();
		if (isset($result['password'])) unset($result['password']);
		return $result;
	}
	
	/*获取分类信息*/
	function getcategory(){
		$table = "category";
		$query = $this->db->get($table);
		$result = $query->result_array();
		return $result;
	}
	
	/*热门文章浏览量排序*/
	function getorderart(){
		$table = "article";
		$this->db->order_by('id','ASC');
		$this->db->limit(8);//限制查询结果的返回数量
		$query = $this->db->get($table);
		$result = $query->result_array();
		return $result;
	}


/*获取首页 和列表文章列表*/
	function getarticle($perPage,$offset,$cid = 0){
		$table = "article";
		if($cid == 0){
			//首页
			$this->db->order_by('id','DESC');//降序排序，id越大最新发布的在前
			$query = $this->db->get($table,$perPage,$offset);
			$result = $query->result_array();
			return $result;
		}else{
			//列表页
			$this->db->order_by('id','DESC');//降序排序，id越大最新发布的在前
			$query = $this->db->get_where($table,array("cid"=>$cid),$perPage,$offset);
			$result = $query->result_array();
			return $result;
		}		
	}
	
	function getcontent($aid){
		$table = "article";
		$query = $this->db->get_where($table,array('id'=>$aid));
		$result = $query->row_array();
		return $result;
	}

	function get_article_comment($aid){
		$this->db->select('comment.*, user.username,user.head_img');
		$this->db->from('comment');
		$this->db->join('user', 'comment.user_id = user.uid');
		$this->db->where('comment.article_id', $aid);
        $this->db->order_by('comment.id', 'DESC');
        $this->db->limit(10);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;		
	}
}
?>