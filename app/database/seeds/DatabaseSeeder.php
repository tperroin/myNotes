<?php

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('RoleTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('CurriculumTableSeeder');
        $this->call('ClassroomTableSeeder');
        $this->call('StudentTableSeeder');
        $this->call('FormateurTableSeeder');
        $this->call('CoursTableSeeder');
        $this->call('SessionTableSeeder');
    }

}
