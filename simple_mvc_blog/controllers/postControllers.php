<?php
class PostControllers{
    public function getPost($no_page){
        require_once('models/adminModels.php');
        $adminModels = new adminModels();
        
        $pages = $adminModels -> paging();
        $posts = $adminModels -> getPost($no_page);

        require_once('view/postView.php');
        $postView = new postView();
        
        $postView-> showAllPost($posts, $pages);

    }

    public function addPost(){
        require_once('view/postView.php');
        $postView = new postView();
        $postView-> addPost();
    }

    public function editPost($id){
        require_once('models/adminModels.php');
        $adminModels = new adminModels();
        $post = $adminModels -> getDetailPost($id);
        
        require_once('view/postView.php');
        $postView = new postView();

        $postView-> editPost($post);
    }

    public function deletePost($id){
        require_once('models/adminModels.php');
        $adminModels = new adminModels();
        $adminModels -> deletePost($id);
    }
}
?>