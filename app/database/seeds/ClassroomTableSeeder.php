<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 02/02/2015
 * Time: 14:20
 */

class ClassroomTableSeeder extends Seeder{

    public function run()
    {

        $cdpn = DB::table('curriculums')
            ->select('id')
            ->where('code', 'CDPN')
            ->first()
            ->id;

        $cdi = DB::table('curriculums')
            ->select('id')
            ->where('code', 'CDI')
            ->first()
            ->id;

        DB::table('classrooms')->insert(
            array(
                array('code' => 'CDPN03', 'libelle' => 'Concepteur développeur en projets numériques section 3', 'curriculum_id' => $cdpn),
                array('code' => 'CDI02', 'libelle' => 'Concepteur développeur informatique section 2', 'curriculum_id' => $cdi)
            ));
    }

    public function dow()
    {
        DB::table('curriculums')->delete();
    }

} 