<?php
// database/migrations/xxxx_create_content_ideas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentIdeasTable extends Migration
{
    public function up()
    {
        Schema::create('content_ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('theme');
            $table->text('idea')->nullable();
            $table->text('caption')->nullable();
            $table->string('platform')->nullable();
            $table->enum('status', ['draft','approved','scheduled'])->default('draft');
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('content_ideas');
    }
}

