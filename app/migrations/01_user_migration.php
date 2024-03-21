<?php


use App\interfaces\migrationInterface;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;


class user_migration implements migrationInterface
{
    function up()
    {
        if (!Manager::schema()->hasTable('users')) {
            Manager::schema()->create('users', function (Blueprint $table) {
                $table->id();
                $table->string('fullname', 100);
                $table->string('email', 100)->undique();
                $table->string('pass', 100);
                $table->string('openid', 100)->unique();
                $table->timestamps();
            });
        }
    }

    function down()
    {
        if (Manager::schema()->hasTable('user_comments')) {
            Manager::schema()->table('user_comments', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }

        if (Manager::schema()->hasTable('users')) {
            Manager::schema()->drop('users');
        }
    }
}
