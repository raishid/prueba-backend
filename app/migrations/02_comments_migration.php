<?php


use App\interfaces\migrationInterface;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;


class comments_migration implements migrationInterface
{
    function up()
    {
        if(!Manager::schema()->hasTable('comments')){
            Manager::schema()->create('comments', function(Blueprint $table){
                $table->id();
                $table->text('comment');
                $table->unsignedBigInteger('user_id');

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    function down()
    {
        if(Manager::schema()->hasTable('comments')){
            Manager::schema()->drop('comments');
        }
    }
}