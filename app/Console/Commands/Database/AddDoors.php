<?php

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class AddDoors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add steerings registers in all environments';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->output = new ConsoleOutput();        
    }

    /**
     * Add brands in table
     *
     * @return void
     */
    public function addDoors()
    {   
        $datas = [
            ['2 portas', 1],
            ['3 portas', 2],
            ['4 portas', 3]
        ];
        
        foreach( $datas as $data) {
            if (!DB::table('doors')->where('name', $data[0])->first()) {                
                DB::table('doors')->insert([                        
                    'name'      => $data[0],
                    'value'    => $data[1],                        
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
            }
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->addDoors();
        } catch (\Exception $e){
            $this->info("Command addDoors returned with error: ".$e->getMessage());
        }
    }
}
