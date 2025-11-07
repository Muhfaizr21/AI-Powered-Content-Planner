<?php
// database/migrations/xxxx_create_schedules_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_idea_id')->constrained('content_ideas')->cascadeOnDelete();
            $table->timestamp('scheduled_at')->nullable();
            $table->enum('status',['pending','posted','canceled'])->default('pending');
            $table->string('platform');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
