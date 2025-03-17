<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    * @return void
    */
   public function up(): void
   {
       Schema::create('reservations', function (Blueprint $table) {
           $table->id();
           $table->integer('user_id');
           $table->integer('place_id')->nullable();
           $table->date('dateDeb')->nullable();
           $table->date('dateExpiration')->nullable();
           $table->date('dateDemande');
           $table->integer('status');
           $table->timestamps();
           $table->integer('reservation_number')->nullable()->unique(); // Colonne pour numéro de réservation
       });

       // Crée un trigger pour l'auto-incrémentation de 'reservation_number'
       DB::unprepared('
           CREATE TRIGGER reservation_number_trigger
           BEFORE INSERT ON reservations
           FOR EACH ROW
           BEGIN
               IF NEW.reservation_number IS NULL THEN
                   SET NEW.reservation_number = (SELECT IFNULL(MAX(reservation_number), 0) + 1 FROM reservations);
               END IF;
           END
       ');
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down(): void
   {
       // Supprimer le trigger à l'annulation de la migration
       DB::unprepared('DROP TRIGGER IF EXISTS reservation_number_trigger');
       
       Schema::dropIfExists('reservations');
   }
};
