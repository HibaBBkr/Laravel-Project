<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('phone_number')->nullable();
        $table->enum('role', ['customer', 'owner'])->default('customer');
        $table->string('id_card_number')->nullable();
        $table->string('license_file_path')->nullable();
        $table->string('profile_photo_path')->nullable();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'phone_number',
            'role',
            'id_card_number',
            'license_file_path',
            'profile_photo_path',
        ]);
    });
}

};
