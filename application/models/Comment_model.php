<?php
class Comment_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}

/*获取文章列表*/
	function get_comment_list($perPage = 1,$offset = 10,$articleId = 0){
		$table = "comment";
		$this->db->order_by('id','DESC');//降序排序，id越大最新发布的在前
		$query = $this->db->get_where($table,array("article_id"=>$articleId),$perPage,$offset);
		$result = $query->result_array();
		return $result;		
	}

/*插入文章*/
	function add_comment($comment){
		$table = "comment";
		$this->db->insert($table,$comment);
		return $this->db->affected_rows();
	}

/*删除文章*/
	function del_comment($id){
		$table = "comment";
		$this->db->delete($table,array("id"=>$id));
		$result = $this->db->affected_rows();
		return $result;
	}
}

?>