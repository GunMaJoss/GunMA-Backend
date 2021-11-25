<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained('locations')
            ->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')
            ->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tags')
            ->onDelete('cascade');
            $table->string('programName');
            $table->string('isPaid')->nullable()->default('false');
            $table->string('isWfh')->nullable()->default('false');
            $table->string('imageUrl')->nullable()->default(('url'));
            $table->string('description')->nullable();
            $table->string('benefit')->nullable();
            $table->string('requirement')->nullable();
            $table->string('registrationLink')->nullable();
            $table->string('isOpen')->nullable()->default('true');
            $table->integer('duration')->nullable();
            $table->timestamp('closeRegistration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internships');
    }
}
