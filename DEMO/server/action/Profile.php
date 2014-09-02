<?php

    class Profile {
		private $id;  
		private $name;  
		
		public function __construct(){  
			$this->id          = '';  
			$this->name   = '';  
		}  
		
        public function get() {
            echo "get";
        }
		
        public function getById($id) {
            echo "getById";
        }
		
        public function add() {
            echo "add";
        }
		
        public function update() {
            echo "update";
        }
		
		
        public function delete($id) {
            echo "delete";
        }
		
		
		
    }
	
?>