<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->boolean('needs_transcription')->default(false);
            $table->text('description')->nullable();
            $table->json('ingredients')->nullable();
            $table->json('steps')->nullable();
            $table->json('attachments')->nullable();
            $table->foreignId('author_id')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('team_id');
            // $table->enum('privacy', ['private', 'public'])->default('private'); 
            // $table->integer('likes')->default('0');   
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
        Schema::dropIfExists('recipes');
    }
}