<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NewController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:new-controller {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        if(!is_dir("app/NewController"))
             mkdir('app/NewController');
        $file = fopen('app/NewController/'.$this->argument('name').'.php','w');

        $get_content = file_get_contents('storage/app/public/newController.txt');
        $get_content=  str_replace('classname',$this->argument('name'),$get_content);
        fwrite($file, $get_content);
        fclose($file);
    }
}
