<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 02/02/2015
 * Time: 14:20
 */

class RoleTableSeeder extends Seeder{

    public function run()
    {

        DB::table('roles')->insert(
            array(
                array('name' => 'admin'),
                array('name' => 'formateur'),
                array('name' => 'utilisateur'),
            ));
    }

    public function dow()
    {
        DB::table('roles')->delete();
    }

} 