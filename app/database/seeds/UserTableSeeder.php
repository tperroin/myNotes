<?php
/**
 * Created by PhpStorm.
 * User: Thibault
 * Date: 02/02/2015
 * Time: 14:20
 */

class UserTableSeeder extends Seeder{

    public function run()
    {

        DB::table('users')->delete();

        $adminRole = DB::table('roles')
            ->select('id')
            ->where('name', 'admin')
            ->first()
            ->id;

        $userRole = DB::table('roles')
            ->select('id')
            ->where('name', 'utilisateur')
            ->first()
            ->id;

        $formateurRole  = DB::table('roles')
            ->select('id')
            ->where('name', 'formateur')
            ->first()
            ->id;

        User::create(array(
            'firstname' => 'Thibault',
            'lastname' => 'Perroin',
            'username' => 't.perroin',
            'email' => 'thibault.perroin@gmail.com',
            'password' => Hash::make('password'),
            'role_id'  => $adminRole
        ));

        User::create(array(
            'firstname' => 'user',
            'lastname' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user'),
            'role_id'  => $userRole
        ));

        User::create(array(
            'firstname' => 'formateur',
            'lastname' => 'formateur',
            'username' => 'formateur',
            'email' => 'formateur@gmail.com',
            'password' => Hash::make('formateur'),
            'role_id'  => $formateurRole
        ));
    }

} 