<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'phone_number')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('phone_number')->unique()->nullable();
            });
        }

        if (!Schema::hasColumn('users', 'phone_number_verified_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('phone_number_verified_at')->nullable()->after('phone_number');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('users', 'phone_number')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('phone_number');
            });
        }

        if (!Schema::hasColumn('users', 'phone_number_verified_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('phone_number_verified_at');
            });
        }
    }
}
