<?php
    class home extends BaseController {
        public function index()
        {
            # code...
            // print_r($post);
            $this->view('home/index.html.twig', ["title" => "Dhanush"]);
        }
    }
