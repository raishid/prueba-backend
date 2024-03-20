<?php


use App\interfaces\migrationInterface;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;


class user_migration implements migrationInterface
{
    function up()
    {
        if(!Manager::schema()->hasTable('users')){
            Manager::schema()->create('users', function(Blueprint $table){
                $table->id();
                $table->string('username')->unique();
                $table->string('password');
                $table->string('email')->undique();
                $table->timestamps();
            });
        }
    }

    function down()
    {
        if(Manager::schema()->hasTable('comments')){
            Manager::schema()->table('comments', function(Blueprint $table){
                $table->dropForeign(['user_id']);
            });
        }

        if(Manager::schema()->hasTable('users')){
            Manager::schema()->drop('users');
        }
    }
}