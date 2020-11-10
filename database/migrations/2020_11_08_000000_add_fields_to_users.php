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
        $usersTable = config('phone_number_verification.users_table');

        $phoneNumberColumn = config('phone_number_verification.phone_number_column');

        if (!Schema::hasColumn($usersTable, $phoneNumberColumn)) {
            Schema::table($usersTable, function (Blueprint $table) use ($phoneNumberColumn) {
                $table->string($phoneNumberColumn)->unique()->nullable();
            });
        }

        $phoneNumberVerifiedAtColumn = config('phone_number_verification.phone_number_verified_at_column');

        if (!Schema::hasColumn($usersTable, $phoneNumberVerifiedAtColumn)) {
            Schema::table($usersTable, function (Blueprint $table) use ($phoneNumberVerifiedAtColumn, $phoneNumberColumn) {
                $table->timestamp($phoneNumberVerifiedAtColumn)->nullable()->after($phoneNumberColumn);
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
        $usersTable = config('phone_number_verification.users_table');

        $phoneNumberColumn = config('phone_number_verification.phone_number_column');

        if (!Schema::hasColumn($usersTable, $phoneNumberColumn)) {
            Schema::table($usersTable, function (Blueprint $table) use ($phoneNumberColumn) {
                $table->dropColumn($phoneNumberColumn);
            });
        }

        $phoneNumberVerifiedAtColumn = config('phone_number_verification.phone_number_verified_at_column');

        if (!Schema::hasColumn($usersTable, $phoneNumberVerifiedAtColumn)) {
            Schema::table($usersTable, function (Blueprint $table) use ($phoneNumberVerifiedAtColumn) {
                $table->dropColumn($phoneNumberVerifiedAtColumn);
            });
        }
    }
}
