<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //création des rôles
        Schema::create('roles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 45);
            $table->timestamps();
        });

        //création des users
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('firstname', 32);
            $table->string('lastname', 32);
            $table->string('username', 32);
            $table->string('email', 255);
            $table->string('password', 64);
            $table->string('remember_token', 100)->nullable();
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');

            $table->timestamps();
        });

        //création des cursus
        Schema::create('curriculums', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('code', 32)->unique();
            $table->string('libelle', 64);
            $table->string('time', 64);

            $table->timestamps();
        });

        //création des cours
        Schema::create('classrooms', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('code', 64);
            $table->string('libelle', 64);
            $table->integer('curriculum_id')->unsigned();
            $table->foreign('curriculum_id')->references('id')->on('curriculums');

            $table->timestamps();
        });

        Schema::create('students', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('firstname', 64);
            $table->string('lastname', 64);
            $table->integer('classroom_id')->unsigned();
            $table->foreign('classroom_id')->references('id')->on('classrooms');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('formateurs', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('firstname', 64);
            $table->string('lastname', 64);
            $table->string('address', 255);
            $table->string('cp', 5);
            $table->string('email', 255);
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('cours', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('libelle', 64);
            $table->string('time');

            $table->timestamps();
        });

        Schema::create('notes', function(Blueprint $table)
        {
            $table->increments('id');

            $table->dateTime('date');
            $table->float('note');
            $table->string('appreciation', 255);
            $table->integer('cours_id')->unsigned();
            $table->foreign('cours_id')->references('id')->on('cours');
            $table->integer('formateur_id')->unsigned();
            $table->foreign('formateur_id')->references('id')->on('formateurs');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');

            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');

            $table->date('date');
            $table->integer('cours_id')->unsigned();
            $table->foreign('cours_id')->references('id')->on('cours');
            $table->integer('formateur_id')->unsigned();
            $table->foreign('formateur_id')->references('id')->on('formateurs');

        });

        Schema::create('sessions_student', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sessions_id')->unsigned();
            $table->foreign('sessions_id')->references('id')->on('sessions');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');

        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
