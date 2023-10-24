<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('level')->default('user');
            $table->boolean('is_active')->default(true);
            $table->string('level')->default('Admin'); // Définir une valeur par défaut
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->dropColumn('level');

        
            $table->dropColumn('is_active');
        });
}

}