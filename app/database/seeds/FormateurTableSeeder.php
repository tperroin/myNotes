<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 02/02/2015
 * Time: 14:20
 */

class FormateurTableSeeder extends Seeder{

    public function run()
    {

        DB::table('formateurs')->insert(
            array(
                array('firstname' => 'Durand', 'lastname' => 'Simon', 'address' => 'Nantes', 'cp' => '44440', 'email' => 'durand.simon@mynotes.fr'),
                array('firstname' => 'Jacques', 'lastname' => 'Catherine', 'address' => 'Nantes', 'cp' => '44440', 'email' => 'jacuqyes.catherine@mynotes.fr')
            ));
    }

    public function dow()
    {
        DB::table('formateurs')->delete();
    }

} 