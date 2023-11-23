<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->binary('forename_aes', 255)->nullable()->default(null); // Encrypted
            $table->binary('midname_aes', 255)->nullable()->default(null); // Encrypted
            $table->binary('surname_aes', 255)->nullable()->default(null); // Encrypted
            $table->binary('suffix_aes', 255)->nullable()->default(null); // Encrypted
            $table->date('birthdate')->nullable()->default(null);
            $table->unsignedSmallInteger('gender_id')->nullable()->default(null); $table->foreign('gender_id')->references('id')->on('genders');
            $table->string('vicinity', 70)->nullable()->default(null)->comment('Purok/Street/Unit #/Bldg #');
            $table->string('barangay', 40)->nullable()->default(null);
            $table->binary('mobile_no_aes', 255)->nullable()->default(null); // Encrypted
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
