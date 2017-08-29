<?php

use Illuminate\Database\Seeder;

class RegistrationDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('registration_details')->delete();
        
        \DB::table('registration_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'registration_header_id' => 10,
                'building_type_id' => 1,
                'size_from' => 100,
                'size_to' => 200,
                'unit_type' => 0,
                'floor' => 1,
                'tenant_remarks' => 'I want good units.',
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'registration_header_id' => 10,
                'building_type_id' => 1,
                'size_from' => 100,
                'size_to' => 200,
                'unit_type' => 1,
                'floor' => 1,
                'tenant_remarks' => 'I want something.',
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'registration_header_id' => 10,
                'building_type_id' => 1,
                'size_from' => 100,
                'size_to' => 200,
                'unit_type' => 0,
                'floor' => 1,
                'tenant_remarks' => 'Surprise me',
                'admin_remarks' => NULL,
                'is_rejected' => 0,
                'is_forfeited' => 0,
                'is_reserved' => 0,
            ),
        ));
        
        
    }
}