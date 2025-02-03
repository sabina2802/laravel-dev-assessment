<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) { // Table name is 'job_posts'
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('experience');
            $table->string('salary');
            $table->string('location');
            $table->string('extraInfo')->nullable();
            $table->string('companyName');
            $table->string('logo')->nullable();
            $table->json('skills')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_posts');
    }
};
