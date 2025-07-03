    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('movements', function (Blueprint $table) {
            $table->dateTime('date_return')->nullable()->after('date');
        });
    }

    public function down()
    {
        Schema::table('movements', function (Blueprint $table) {
            $table->dropColumn('date_return');
        });
    }
};
