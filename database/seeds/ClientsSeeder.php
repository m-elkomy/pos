<?php

use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['client one','client two','client three'];
        foreach ($clients as $client){
            \App\Client::create([
                'name'=>$client,
                'phone'=>'00000000',
                'address'=>'haram',
            ]);
        }
    }
}
