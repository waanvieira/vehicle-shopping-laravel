<?php

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class AddExchange extends Command
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
    protected $description = 'Add AddExchange registers in all environments';
    
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
     * Add AddExchanges in table
     *
     * @return void
     */
    public function addExchange()
    {       
        $datas = [
            ['Sim', 1],
            ['Não', 2]
        ];
        
        foreach( $datas as $data) {
            if (!DB::table('exchanges')->where('name', $data[0])->first()) {                
                DB::table('exchanges')->insert([                        
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
     *s
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->addExchange();
        } catch (\Exception $e){
            $this->info("Command addExchange returned with error: ".$e->getMessage());
        }
    }
}
