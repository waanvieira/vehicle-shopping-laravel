<?php

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class AddFuels extends Command
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
    protected $description = 'Add fuels registers in all environments';
    
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
    public function addFuels()
    {   
        $datas = [
            ['Gasolina', 1],
            ['Álcool', 2],
            ['Flex', 3],
            ['Gás Natural', 4],
            ['Diesel', 5],
            ['Elétrico', 6],
        ];
        
        foreach( $datas as $data) {
            if (!DB::table('fuels')->where('name', $data[0])->first()) {                
                DB::table('fuels')->insert([                        
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
            $this->addFuels();
        } catch (\Exception $e){
            $this->info("Command addFuels returned with error: ".$e->getMessage());
        }
    }
}
