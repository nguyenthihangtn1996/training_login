<?php
require_once('models/db.php');

class AdminModels extends dbmodel{
    
    public function getPost ($no_page){

        $conn = $this -> connect();
        $limit = 5;
        $current_page = ($no_page - 1) * $limit;
        $all_posts = $conn->query("SELECT * FROM  posts  ORDER BY create_at desc LIMIT $current_page , $limit");
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
        
        $total = $conn->query("select * from posts")->num_rows;
        $pages = ceil($total / $perPage);
        

        return $pages;

    }
    public function addPost($post){

        $conn = $this->connect();

        $sql = "INSERT INTO `posts` (`id`, `title`, `description`, `image`, `status`, `create_at`, `updated_at`) VALUES (NULL, '".$post['title']."', '".$post['description']."', '".$post['image']."', '".$post['status']."',  now(), now()); ";

        $result = $conn->query($sql);

        return $result;

    
    }

    public function deletePost($id){
        $conn = $this->connect();

        $sql = "DELETE FROM `posts` WHERE `posts`.`id` =  ".$id." ";

        $conn->query($sql);
    }

    public function editPost($id, $post){
        $conn = $this->connect();
        $sql = "UPDATE `posts` SET `title` = '".$post['title']."', `description` = '".$post['description']."', `status` = '".$post['status']."' , `image` = '".$post['image']."' ,`updated_at`= now() WHERE `posts`.`id` = ".$id."";
        $result = $conn->query($sql);
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