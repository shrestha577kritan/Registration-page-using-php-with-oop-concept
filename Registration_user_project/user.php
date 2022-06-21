<?php

class user{
    private $errors = array();

    public function signup($POST){
        // validation of the form 
        foreach($POST as $key=>$value){
            // validation of name
            if($key == 'name'){
                if(trim($value) ==''){
                    $this->errors[] = 'Please enter a valid name';
                }
                if(is_numeric($value)){
                    $this->errors[] = 'Name cannot be number';
                }

                if(preg_match("/[0-9]+/", $value)){
                    $this->errors[] = 'name cannot contain number';

                }

            }

                // validation of email
            if($key == 'email'){
                if(trim($value) ==''){
                    $this->errors[] = 'Please enter a valid email';
                }

                if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                    $this->errors[] = 'Email is not valid';

                }
            }

            // validation of password
            if($key == 'password'){
                // check if its empty
                if(trim($value) ==''){
                    $this->errors[] = 'Please enter a valid password';
                }
                // password length
                if(strlen($value) < 5){
                    $this->errors[] = 'Password must be at least 5 charaters long ';
                }

            }

        }

    // checking if the email is already exists
        $db = new Database();
        $data = array();
        $data['email'] = $POST['email'];
        $query = " select * from users where email=:email limit 1 ";
        $result = $db->read($query,$data); 
        if($result){
            $this->errors[] = "This email is already exists!!";
        }


        // saving to database
        if(count($this->errors) == 0){

            $query= "insert into users(name,email,password) values (:name,:email,:password)";
            $db = new Database();
            $data = array();
            $data['name'] = $POST['name'];
            $data['email'] = $POST['email'];
            $data['password'] = $POST['password'];

            $result = $db->write($query, $data);
            if(!$result){
                $this->errors[] = 'Your data is not saved';

            }

        }
        return $this->errors;

    }

}

?>