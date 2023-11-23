<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 30);
            // ADMINISTRATOR, STAFF
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email', 191)->unique();
            $table->string('password', 191);
            $table->unsignedSmallInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('genders', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 30);
            // MALE, FEMALE, LGBT, UNKNOWN, NOT APPLICABLE
        });

        Schema::create('livelihood_statuses', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 70);
            // BELOW MINIMUM/NOT SELF-SUFFICIENT, ALMOST NONE
        });

        Schema::create('family_income_ranges', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 70);
            // ABOVE PT BUT LESS THAN 25K, BELOW PT (14,498)
            // NOTE: PT stands for Poverty Threshold
        });

        Schema::create('tenurial_statuses', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 70);
            // SHARER, RENT/RENT TO OWN, INFORMAL SETTLER
        });

        Schema::create('kayabe_kard_types', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 30);
            // RED, BLUE, WHITE
        });

        Schema::create('dependent_ranges', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 30);
            // TWO OR THREE, MORE THAN 3
        });

        Schema::create('health_conditions', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 70);
            // WITH ILLNESS NEEDS REGULAR MEDICATION, BEDRIDDEN
        });

        Schema::create('flood_exposures', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 70);
            // FLASH FOOD, WEEK-LONG FLOODING, PRONE TO EXPERIENCE DISPLACEMENT
        });

        Schema::create('sectors', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('code', 30);
            // DIALYSIS, PWD, SC, SP
            $table->string('name', 50);
            // DIALYSIS/CHEMO PATIENT, PERSONS WITH DISABILITIES, SENIOR CITIZEN, SOLO PARENT
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            // One to One
            $table->unsignedSmallInteger('livelihood_status_id')->nullable()->default(null)->comment('Employment, Livelihood & Income');
            $table->foreign('livelihood_status_id')->references('id')->on('livelihood_statuses');
            // One to One
            $table->unsignedSmallInteger('family_income_range_id')->nullable()->default(null)->comment('Family/Household Income');
            $table->foreign('family_income_range_id')->references('id')->on('family_income_ranges');
            // One to One
            $table->unsignedSmallInteger('tenurial_status_id')->nullable()->default(null);
            $table->foreign('tenurial_status_id')->references('id')->on('tenurial_statuses');
            // One to One
            $table->unsignedSmallInteger('kayabe_kard_type_id')->nullable()->default(null);
            $table->foreign('kayabe_kard_type_id')->references('id')->on('kayabe_kard_types');
            // One to One
            $table->unsignedSmallInteger('dependent_range_id')->nullable()->default(null)->comment('No. of Dependents');
            $table->foreign('dependent_range_id')->references('id')->on('dependent_ranges');

            $table->unsignedSmallInteger('total_dependents')->nullable()->default(null);
            $table->boolean('family_vulnerability')->nullable()->default(null)->comment('Is there other vulnerable family member? [1 = Yes, 0 = No]');
            $table->string('identity_card_no', 100)->nullable()->default(null);
            $table->text('medication')->nullable()->default(null);
            $table->text('remarks')->nullable()->default(null);
        });

        Schema::create('citizens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pin', 20)->nullable()->default(null)->comment('Personal Identification Number');
            $table->smallInteger('pin_year')->nullable()->default(null);
            $table->mediumInteger('pin_series')->nullable()->default(null);
            $table->string('forename', 50)->nullable()->default(null);
            $table->string('midname', 50)->nullable()->default(null);
            $table->string('surname', 50)->nullable()->default(null);
            $table->string('suffix', 15)->nullable()->default(null);
            $table->date('birthdate')->nullable()->default(null);
            $table->unsignedSmallInteger('gender_id')->nullable()->default(null);
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->string('vicinity', 70)->nullable()->default(null)->comment('Purok/Street/Unit #/Bldg #');
            $table->string('barangay', 40)->nullable()->default(null);
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->string('info_status', 20)->nullable()->default(null)->comment('[COMPLETE, INCOMPLETE]');
            $table->timestamps();
            $table->softDeletes();
        });

        // Pivot Table
        Schema::create('profile_sector', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->unsignedSmallInteger('sector_id');
            $table->foreign('sector_id')->references('id')->on('sectors');
        });

        // Pivot Table
        Schema::create('profile_health_condition', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->unsignedSmallInteger('health_condition_id');
            $table->foreign('health_condition_id')->references('id')->on('health_conditions');
        });

        // Pivot Table
        Schema::create('profile_flood_exposure', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->unsignedSmallInteger('flood_exposure_id');
            $table->foreign('flood_exposure_id')->references('id')->on('flood_exposures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_flood_exposure');
        Schema::dropIfExists('profile_health_condition');
        Schema::dropIfExists('profile_sector');
        Schema::dropIfExists('citizens');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('sectors');
        Schema::dropIfExists('flood_exposures');
        Schema::dropIfExists('health_conditions');
        Schema::dropIfExists('dependent_ranges');
        Schema::dropIfExists('tenurial_statuses');
        Schema::dropIfExists('family_income_ranges');
        Schema::dropIfExists('livelihood_statuses');
        Schema::dropIfExists('genders');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
}
