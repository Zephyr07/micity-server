<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Clients::class,2)->create();
//        factory(\App\Category::class,20)->create();
        /*$path =base_path("database/seeds/json/categories.json");
        $items = json_decode(file_get_contents($path),true);
        foreach ($items as $item){
            \App\Category::create($item);

        }*/
    }
}
