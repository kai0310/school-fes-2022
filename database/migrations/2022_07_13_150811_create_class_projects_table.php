<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_projects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('school_class_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('name');
            $table->text('detail');
            $table->string('place')->nullable();

            $table->string('type');

            $table->boolean('provide_meals')
                ->default(false);

            $table->boolean('paid_planning')
                ->default(false);

            $table->text('infection_control');

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
        Schema::dropIfExists('class_projects');
    }
};
