<?php

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class AddMotorPowers extends Command
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
    protected $description = 'Add motor powers registers in all environments';
    
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
    public function addMotorPowers()
    {   
        $datas = [
            ['1.0', 1,],
            ['1.2', 2,],
            ['1.3', 3,],
            ['1.4', 4,],
            ['1.5', 5,],
            ['1.6', 6,],
            ['1.7', 7,],
            ['1.8', 8,],
            ['1.9', 9,],
            [ '2.0 - 2.9', 10],
            [ '3.0 - 3.9', 11],
            [ '4.0 ou mais', 12],
        ];
        
        foreach( $datas as $data) {
            if (!DB::table('motor_powers')->where('name', $data[0])->first()) {                
                DB::table('motor_powers')->insert([                        
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
            $this->addMotorPowers();
        } catch (\Exception $e){
            $this->info("Command addMotorPowers returned with error: ".$e->getMessage());
        }
    }
}
