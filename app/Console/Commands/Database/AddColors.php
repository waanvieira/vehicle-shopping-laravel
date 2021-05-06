<?php

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class addColors extends Command
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
    protected $description = 'Add colors registers in all environments';
    
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
     * Add colors in table
     *
     * @return void
     */
    public function addColors()
    {
        $datas = [
            ['Preto', 1],
            ['Branco', 2],
            ['Prata', 3],
            ['Vermelho', 4],
            ['Cinza', 5],
            ['Azul', 6],
            ['Amarelo', 7],
            ['Verde', 8],
            ['Laranja', 9],
            ['Outra', 10]
        ];
        
        foreach( $datas as $data) {
            
            if (!DB::table('colors')->where('name', $data[0])->first()) {                
                DB::table('colors')->insert([                        
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
            $this->addColors();
        } catch (\Exception $e){
            $this->info("Command addColors returned with error: ".$e->getMessage());
        }
    }
}
