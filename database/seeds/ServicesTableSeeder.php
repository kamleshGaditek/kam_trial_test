<?php

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = array(
            array('name' => 'Service A', 'price' => 10),
            array('name' => 'Service B', 'price' => 15),
            array('name' => 'Service C', 'price' => 20),
        );

        foreach($services as $service){
            Service::create($service);
        }
    }
}
