<?php
namespace App\Tables; 

use Illuminate\Database\Capsule\Manager as Capsule;

class UserTable
{

    public function up()
    {
        if(!Capsule::schema()->hasTable('users')) 
        {
            Capsule::schema()->create('users', function ($table) {
                $table->string('id')->primary();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('password');
                $table->string('email')->unique();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('users');
    }
}