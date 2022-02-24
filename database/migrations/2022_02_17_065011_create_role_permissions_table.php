<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->enum('module',['u','c','h','l','f','r','s'])->comment('u=>Users,c=>Courses,h=>Homeworks,l=>Lessons,f=>financial,r=>Role,s=>Shop');
            $table->enum('type',['f','e','g','n'])->comment('f=>Full Access,e=>Editor,g=>Guest,n=>No Access');
            $table->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
}
