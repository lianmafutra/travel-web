<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use File;
use Illuminate\Support\Facades\File as FacadesFile;

class run extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
     
      // Artisan::command('php artisan serve');
      $this->info("Running at ".getHostByName(getHostName()).'...');
    
      FacadesFile::append('C:\Windows\System32\drivers\etc\hosts', getHostByName(getHostName()).' travel.test2'.PHP_EOL);
      exec('php artisan serve --host='.getHostByName(getHostName()) .' > /dev/null 2>&1 &');
    }
}
