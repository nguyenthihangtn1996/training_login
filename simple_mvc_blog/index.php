<?php 
    require_once('controllers/postControllers.php');
    $postControllers = new postControllers();
    $no_page = 1;

    if (isset($_GET['page'])){
        $no_page = $_GET['page'];
    }

    if (isset($_GET['admin'])){

        $action = $_GET['admin'];

        if($action == 'list'){
            $posts = $postControllers -> getPost($no_page);
        }
        elseif($action == 'addpost'){
            $posts = $postControllers -> addPost();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $status = $_POST['status'];

                
                $image = $_FILES['image']['name'];
                
                $filetmpname = $_FILES['image']['tmp_name'];
                
                $folder = 'assets/upload/';

                move_uploaded_file($filetmpname, $folder.$image);
            

                require_once('models/adminModels.php');

                $post = array(
                    'title' => $title ,
                    'description' => $description,
                    'status' => $status,
                    'image' => $image,
                );

                $adminModels = new adminModels();
        
                $adminModels ->addPost($post);

            }
        }
        elseif($action == 'delete'){
            $id = $_GET['id'];
            $postControllers -> deletePost($id);
            header("Location: http://localhost:8080/hang/?admin=list");
        }
    

        elseif($action == 'editpost'){
            $id = $_GET['id'];
            $postControllers -> editPost($id);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $status = $_POST['status'];
                $image = $_FILES['image']['name'];
                $filetmpname = $_FILES['image']['tmp_name'];
                $folder = 'assets/upload/';
                move_uploaded_file($filetmpname, $folder.$image);
            
    
                require_once('models/adminModels.php');
    
                $post = array(
                    'id' => $id,
                    'title' => $title ,
                    'description' => $description,
                    'status' => $status,
                    'image' => $image,
                );
    
                $adminModels = new adminModels();
                $adminModels ->editPost($id, $post);
            }
        }
    }
    elseif(isset($_GET['main'])){
        require_once('controllers/main.php');
        $mainControllers = new mainControllers();
        $action = $_GET['main'];
            if($action == ''){
                $main = $mainControllers -> mainpage($no_page);
            }
            if($action == 'detail'){
                $id = $_GET['id'];
                $mainControllers -> detailPost($id);
            }

        
    }
?>