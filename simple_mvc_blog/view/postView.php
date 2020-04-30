<?php
    class postView{
        public function showAllPost($posts, $pages){
            require_once('templates/posts.php');
        }
        public function addPost(){

            require_once('templates/add-post.php');
        }
        public function editPost($post){

            require_once('templates/edit-post.php');
        }
    }
    class mainView{
        public function showMainPage($posts, $pages){
            require_once('templates/index.php');
        }

        public function showDetailPost($post){
            require_once('templates/post-detail.php');
        }
    }
?>