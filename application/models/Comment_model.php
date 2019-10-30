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

/*获取评论数*/
	function getcommentnum($uid){
        $this->db->select('count(comment.id)');
        $this->db->from('comment');
        $this->db->join('article', 'comment.article_id = article.id');
        $this->db->where('article.author_id', $uid);
        $query = $this->db->get();
        $commentnums = $query->result();
        log_message('info', " commentnums:".json_encode($commentnums));
        return $commentnums ?: 0;
    }

    /*获取后台评论列表*/
    function get_admin_comments($perPage = 1,$offset = 10,$uid = 0){
	    $perPage = ($perPage < 1) ? 1 : $perPage;
        $this->db->select('comment.*, article.title,user.username,user.head_img');
        $this->db->from('comment');
        $this->db->join('article', 'comment.article_id = article.id');
        $this->db->join('user', 'comment.user_id = user.uid');
        $this->db->where('article.author_id', $uid);
        $this->db->order_by('comment.id', 'DESC');
        $this->db->limit($offset, ($perPage-1) * $offset);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
}

