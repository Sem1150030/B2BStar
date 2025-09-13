<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add polymorphic relation columns for 'role'
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('role_type')->nullable();
            $table->index(['role_id', 'role_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role_id', 'role_type']);
            $table->dropColumn(['role_id', 'role_type']);
        });
    }
};
