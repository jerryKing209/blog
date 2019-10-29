<?php
/**
 * Created by PhpStorm.
 * User: Jerry
 * Date: 2019/10/29
 * Time: 2:42 PM
 */
defined("BASEPATH") OR exit("No direct script access allowed");
ini_set("date.timezone", "Asia/Shanghai");

class Comment extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model(array('Login_model','Article_model', 'Comment_model'));
        if(!$this->Login_model->is_logged_in()){

        }
    }

    public function addcomment() {
        $aid = $this->input->post('articleid');
        $comment = $this->input->post('comment');
        $data['route'] = '/Comment/addcomment/'.$aid;
        $data['status'] = false;
        if (empty($comment)) {
            $data['msg'] = '不能发表空评论';
            goto END;
        }
        $article = $this->Article_model->get_art_info($aid);
        if (empty($article)) {
            $data['msg'] = "该篇blog已下架!";
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
                $data['status'] = true;
                $data['msg'] = "留言成功！";
            } else {
                $data['msg'] = "留言失败请重试一次！";
            }

        }
        //获取分类信息
        $data['comment'] = $this->Comment_model->get_comment_list(1, 10, $aid);
        //加载视图分配变量
        END:
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

}