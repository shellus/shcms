<?php

namespace App\Console\Commands;

use App\File;
use Illuminate\Console\Command;

class migrate_file extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migratefile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $count = File::count();
        $i = 0;
        File::chunk(1000, function ($files)use(&$i,$count) {
            foreach ($files as $file) {
                \DB::beginTransaction();
                /**
                 * @var $file File
                 */
                $file_info = json_decode($file ->value, true);
                $file -> title = $file_info['name'];
                $file -> filename = $file_info['name'];
                $file -> mime_type = $file_info['mime'];
                $file -> size = $file_info['size'];
                $file -> save_path = $file_info['savename'];

                $file -> value = '';

                $file -> save();
                \DB::commit();
                $i++;
                $this -> info("{$file->id}");
                $this -> info("{$i}/{$count}");

            }
        });


    }
}
