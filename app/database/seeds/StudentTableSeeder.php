<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 02/02/2015
 * Time: 14:20
 */

class StudentTableSeeder extends Seeder{

    public function run()
    {

        $cdpn03 = DB::table('classrooms')
            ->select('id')
            ->where('code', 'CDPN03')
            ->first()
            ->id;

        DB::table('students')->insert(
            array(
                array('firstname' => 'Perroin', 'lastname' => 'Thibault', 'classroom_id' => $cdpn03),
                array('firstname' => 'Martin', 'lastname' => 'Philippe', 'classroom_id' => $cdpn03),
                array('firstname' => 'Terrieur', 'lastname' => 'Florian', 'classroom_id' => $cdpn03),
                array('firstname' => 'Roul', 'lastname' => 'Damien', 'classroom_id' => $cdpn03)
            ));
    }

    public function dow()
    {
        DB::table('curriculums')->delete();
    }

} 