<?php

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class AddGearBox extends Command
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
    protected $description = 'Add fuels gear box in all environments';
    
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
    public function addGearBox()
    {   
        $datas = [
            ['Manual', 1],
            ['Automático', 2],
            ['Semi-Automático', 3]
        ];
        
        foreach( $datas as $data) {
            if (!DB::table('gear_boxes')->where('name', $data[0])->first()) {                
                DB::table('gear_boxes')->insert([                        
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
            $this->addGearBox();
        } catch (\Exception $e){
            $this->info("Command addGearBox returned with error: ".$e->getMessage());
        }
    }
}
