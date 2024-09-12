<?php

use App\Models\Project;
use App\Priority;
use App\State;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->enum('state', [State::PENDIENTE->value, State::PROGRESO->value, State::COMPLETADA->value])
                    ->default(State::PENDIENTE);
            $table->enum('priority', [Priority::BAJA->value, Priority::MEDIA->value, Priority::ALTA->value])
                    ->default(Priority::MEDIA);         
            $table->timestamps();
            $table->foreignId('project_id')
            ->references('id')
            ->on('projects')
            ->onDelete('cascade');                 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
