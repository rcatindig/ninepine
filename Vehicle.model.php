<?php

class Vehicle {

    private $servername = "localhost";
    private $username   = "reynard";
    private $password   = "password";
    private $database   = "ninepine";
    public  $con;

    // Database Connection 
    public function __construct()
    {
        $this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
        if(mysqli_connect_error()) {
            trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
        }else{
            return $this->con;
        }
    }

    
    // Fetch vehcile records for show listing
    public function list()
    {
        $query = "SELECT * FROM vehicles";
        $result = $this->con->query($query);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
            }
                return $data;
        }else{
                return [];
        }
    }

    // insert data
    public function insert_data($post) {

        $success = false;

        $msg = "";

        $name = $this->con->real_escape_string($post['name']);
        $engine_displacement = $post['engine_displacement'];
        $engine_disp_unit = $post['engine_disp_unit'];
        $engine_power = $post['engine_power'];
        $price = $post['price'];
        $location = $post['location'];
        $query="INSERT INTO vehicles(`name`,`engine_displacement`,`engine_disp_unit`,`engine_power`,`price`,`location`) VALUES('$name','$engine_displacement','$engine_disp_unit','$engine_power','$price','$location')";
        $sql = $this->con->query($query);

        if ($sql==true) {
            $success = true;
            $msg = "Successful!";
            
        }else{
            $success = false;
            $msg = "Failed!";
        }

        
        return array(
            "success" => $success,
            "msg" => $msg
        );

    }

    // get data from specific id (edit)
    public function get_data($id)
    {
        $query = "SELECT * FROM vehicles WHERE id='$id'";
        $result = $this->con->query($query);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
            }
                return $data;
        }else{
                return [];
        }
    }

    public function update_data($id, $post){
        $name = $this->con->real_escape_string($post['name']);
        $engine_displacement = $post['engine_displacement'];
        $engine_disp_unit = $post['engine_disp_unit'];
        $engine_power = $post['engine_power'];
        $price = $post['price'];
        $location = $post['location'];

        

        $query="UPDATE vehicles SET name='".$name."', engine_displacement='".$engine_displacement."', engine_disp_unit='".$engine_disp_unit."', engine_power='".$engine_power."', price='".$price."', location='".$location."' WHERE id=".$id;
        if($this->con->query($query))
        {
            $response=array(
            'status' => true,
            'msg' =>'Vehicle Updated Successfully.'
            );
        }
        else
        {
            $response=array(
            'status' => false,
            'msg' =>'Vehicle Updation Failed.'
            );
        }

        return $response;
    }
    
}


?>