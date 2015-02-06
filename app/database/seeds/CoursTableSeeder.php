<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 02/02/2015
 * Time: 14:20
 */

class CoursTableSeeder extends Seeder{

    public function run()
    {
        DB::table('cours')->insert(
            array(
                array('libelle' => 'CMMI', 'time' => '4 jours'),
                array('libelle' => 'JDBC', 'time' => '5 jours')
            ));
    }

    public function dow()
    {
        DB::table('courses')->delete();
    }

} 