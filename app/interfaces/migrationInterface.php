<?php


namespace App\interfaces;



interface migrationInterface
{
    public function up();
    public function down();
}