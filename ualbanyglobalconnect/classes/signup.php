<?php

class SignUp
{
    private $error = ""; // Declare $error as a class property

    public function evaluate($data)
    {
        foreach ($data as $key => $value){
            if(empty($value))
            {
                $this->error = $this->error . $key. "is empty!<br>";

            }
            if($key == "Email")
            {
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value)){
                    
                    $this->error = $this->error . "invalid Email address!<br>";

                    
                }
               

            }
            if($key == "first_name")
            {
                if (is_numeric($value)) {
                    
                    $this->error = $this->error . "first name cannot be a number<br>";

                    
                }
                if (strstr($value, "")) {
                    
                    $this->error . "first name cannot have spaces<br>";

                    
                }
               

            }
            if($key == "last_name")
            {
                if (is_numeric($value)){
                    
                    $this->error = $this->error . "last name cannot be a number<br>";


                    
                }
                if (strstr($value, "")) {
                    
                    $this->error . "last name cannot have spaces<br>";

                    
                }
               

            }


        }

        if ($this->error == "") {
            // no error
            $this->create_user($data);
        } else {
            return $this->error;
        }
    }

    public function create_user($data)
    {
        // Check for required keys and handle missing or empty values
        $first_name = ucfirst($data['first_name']);
        $last_name = ucfirst($data['last_name']);
        $gender = $data['gender'];
        $email = $data['email'] ?? '';
        $password = $data['password'];
        
        // Create these
        $url_address = strtolower($first_name) . "." . strtolower($last_name);
        $userid = $this->create_userid();

        $query = "insert into users 
        (userid, First_name, Last_name, gender, email, password, url_address) 
        values 
        ('$userid', '$first_name', '$last_name', '$gender', '$email', '$password', '$url_address')";
        
        
        
        $DB = new Database();
        $DB->save($query);
    }

    private function create_userid()
    {
        $length = rand(4,19);
        $number = "";
        for ($i = 0; $i < $length; $i++){
            $new_rand = rand(0,9);
            $number = $number . $new_rand;
        }
        
        return $number;
    }
}
