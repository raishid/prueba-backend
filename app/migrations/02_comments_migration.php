<?php


use App\interfaces\migrationInterface;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;


class comments_migration implements migrationInterface
{
    function up()
    {
        if (!Manager::schema()->hasTable('user_comments')) {
            Manager::schema()->create('user_comments', function (Blueprint $table) {
                $table->id();
                $table->text('coment_text');
                $table->integer('likes')->default(0);
                $table->unsignedBigInteger('user');

                $table->foreign('user')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
                $table->timestamps();
            });
        }
    }

    function down()
    {
        if (Manager::schema()->hasTable('user_comments')) {
            Manager::schema()->drop('user_comments');
        }
    }
}
