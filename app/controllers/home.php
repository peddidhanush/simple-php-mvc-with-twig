<?php
    class home extends BaseController {
        public function index()
        {
            # code...
            $this->posts = $this->model('posts');
            $post = $this->posts->getPosts();
            // print_r($post);
            $this->view('home/index.html.twig', ["posts"=>$post, "title" => "Dhanush"]);
        }
    }