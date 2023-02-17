<?php
namespace App\Providers;
use App\Config\PengajuanAksi;
use App\Config\Role;
use App\Http\Services\Pegawai\PengajuanService;
use App\Models\Pengajuan;
use App\Models\PengajuanHistori;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
   /**
    * Register any application services.
    *
    * @return void
    */
   public function register()
   {
      //
   }
   /**
    * Bootstrap any application services.
    *
    * @return void
    */
   public function boot()
   {

    

      Blade::directive('rupiah', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });

      Blade::directive('tanggal', function($expression) {
         return "<?php echo \Carbon\Carbon::parse($expression)->translatedFormat('d-m-Y H:i:s'); ?>";
     });

     Blade::directive('tanggal_only', function($expression) {
      return "<?php echo \Carbon\Carbon::parse($expression)->translatedFormat('d-m-Y'); ?>";
  });

     Blade::directive('jam', function($expression) {
      return "<?php echo \Carbon\Carbon::parse($expression)->translatedFormat('H:i'); ?>";
  });


   }
}
