<?php

declare(strict_types=1);


include './Vehicle.model.php';


use PHPUnit\Framework\TestCase;

class VehicleTest extends TestCase
{
    /**
     * @test
     */
    public function testGetAllData()
    {

        

        $vehicle = new Vehicle();

        $result = $vehicle->list();

        var_dump($result);
        
        $this->assertIsArray($result);
    }

    public function testInsertData() {

        $data['name'] = "Toyota Test " . date("YmdHis");
        $data['engine_displacement'] = rand(99 , 1000);
        $data['engine_disp_unit'] = "cc";
        $data['engine_power'] = rand(50 , 100);
        $data['price'] = rand(200000, 1000000);
        $data['location'] = "Santa Rosa City";

        $vehicle = new Vehicle();

        $result = $vehicle->insert_data($data);

        $this->assertSame(true,$result["success"]);

    }

    public function testGetDataById() {
        $vehicle = new Vehicle();

        $result = $vehicle->get_data(1);

        var_dump($result);
        
        $this->assertIsArray($result);
    }

    public function testUpdateData() {

        $data['name'] = "Toyota Wigo";
        $data['engine_displacement'] = 999;
        $data['engine_disp_unit'] = "cc";
        $data['engine_power'] = 66;
        $data['price'] = rand(200000, 1000000);
        $data['location'] = "Santa Rosa City";

        $vehicle = new Vehicle();

        $result = $vehicle->update_data(1, $data);

        $this->assertSame(true,$result["status"]);

    }


    
}
