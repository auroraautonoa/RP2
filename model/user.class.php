<?php
    class User{
        protected  $id, $name, $surname, $username, $email, $password;

        public function __construct($id, $name, $surname, $username, $email, $password){
            $this->id = $id;
            $this->username = $username;
            $this->name = $name;
            $this->surname = $surname;
            $this->email = $email;
            $this->password= $password;
        }

        public function __get( $property ){
            if( property_exists( $this, $property ) )
                return $this->$property; 
        }

        public function __set( $property, $value ){
            if( property_exists( $this, $property ) )
                $this->$property = $value;
            
            return $this;
        }
    }

?>