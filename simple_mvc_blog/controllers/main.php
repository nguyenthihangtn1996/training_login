<?php
class mainControllers{
    public function mainpage($no_page){

        require_once('models/mainModels.php');
        $mainModels = new mainModels();

        $posts = $mainModels -> getPost($no_page);
        $pages = $mainModels -> paging();

        require_once('view/postView.php');
        $pageView = new mainView();
        $pageView-> showMainPage($posts, $pages);
    }

    public function detailPost($id){
        require_once('models/mainModels.php');
        $mainModels = new mainModels();
        $post = $mainModels -> getDetailPost($id);

        require_once('view/postView.php');
        $postView = new mainView();
        $postView-> showDetailPost($post);

    }
}
?>