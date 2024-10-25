<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Multiple entries by reading json file
        $json = File::get(path:'database/json/locations.json') ;
        $locations = json_decode($json);
        foreach($locations as $location){
            Location::create([
                'name' => $location->name,
                'postal_code' => $location->postal_code
            ]);
        }

        //Multiple Entries
        // $locations = [
        //     [
        //         'name' =>'BALDIA TOWN',
        //         'postal_code' => '75760'
        //     ],
        //     [
        //         'name' =>'BAHRIA TOWN',
        //         'postal_code' => '75340'
        //     ],
        //     [
        //         'name' =>'CANTT.',
        //         'postal_code' => '75530'
        //     ],
        // ];

        // foreach($locations as $location){
        //     Location::create($location);
        // }

        //Single Entry
        // Location::create([
        //     'name' => 'Airport',
        //     'postal_code' => '72500'
        // ]);
    }
}
