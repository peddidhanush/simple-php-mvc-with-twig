<?php
    class posts extends BaseModel {
        public function getPosts() {
            $sql = "SELECT * FROM posts";
            $this->query($sql);
            return $this->resultSet();
        }
    }