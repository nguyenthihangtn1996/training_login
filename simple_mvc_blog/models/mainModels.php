<?php
require_once('models/db.php');

class mainModels extends dbmodel{
    
    public function getPost ($no_page){

        $conn = $this -> connect();
        $limit = 5;
        $current_page = ($no_page - 1) * $limit;
        $all_posts = $conn->query("SELECT * FROM  posts where status='enable' ORDER BY create_at desc LIMIT $current_page , $limit");
        $posts = array();

        if($all_posts ->num_rows> 0){
            while($post = mysqli_fetch_assoc($all_posts)){
                $posts[] = $post;
            }
        }

        return $posts;

    }

    public function paging(){
        $conn = $this->connect();

        $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        $perPage = (isset($_GET['per-page']) && ($_GET['per-page']) <= 100 ? $_GET['per-page'] : 5);
        $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
        
        $total = $conn->query("select * from posts where status='enable' ")->num_rows;
        $pages = ceil($total / $perPage);
        

        return $pages;

    }
    public function getDetailPost($id){
        $conn = $this->connect();

        $sql = "SELECT * FROM  posts WHERE `posts`.`id` = ".$id."";
        $result = $conn->query($sql);

        if($result ->num_rows!= 0){
            $post = mysqli_fetch_array($result);
        }
        else{
            $post = 0;
        }
        return $post;

    }
}
?>