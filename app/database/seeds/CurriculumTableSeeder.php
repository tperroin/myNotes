<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 02/02/2015
 * Time: 14:20
 */

class CurriculumTableSeeder extends Seeder{

    public function run()
    {

        DB::table('curriculums')->insert(
            array(
                array('code' => 'CDPN', 'libelle' => 'Concepteur développeur en projets numériques', 'time' => '2 ans'),
                array('code' => 'CDI', 'libelle' => 'Concepteur développeur informatique', 'time' => '6 mois')
            ));
    }

    public function dow()
    {
        DB::table('curriculums')->delete();
    }

} 