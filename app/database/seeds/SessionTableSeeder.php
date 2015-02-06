<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 02/02/2015
 * Time: 14:20
 */

class SessionTableSeeder extends Seeder{

    public function run()
    {

        $cmmi = DB::table('cours')
            ->select('id')
            ->where('libelle', 'CMMI')
            ->first()
            ->id;

        $jdbc =  DB::table('cours')
            ->select('id')
            ->where('libelle', 'JDBC')
            ->first()
            ->id;

        $simon =  DB::table('formateurs')
            ->select('id')
            ->where('firstname', 'Durand')
            ->first()
            ->id;

        $cath =  DB::table('formateurs')
            ->select('id')
            ->where('firstname', 'Jacques')
            ->first()
            ->id;

        DB::table('sessions')->insert(
            array(
                array('date' => new DateTime('now'), 'cours_id' => $cmmi, 'formateur_id' => $cath),
                array('date' => new DateTime('now'), 'cours_id' => $jdbc, 'formateur_id' => $simon)
            ));

        DB::table('sessions_student')->insert(
            array(
                array('sessions_id' => 1, 'student_id' => 1),
                array('sessions_id' => 1, 'student_id' => 2)
            ));
    }

    public function dow()
    {
        DB::table('sessions')->delete();
    }

} 