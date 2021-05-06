<?php

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class AddCubicCms extends Command
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
    protected $description = 'Add cubic registers in all environments';
    
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
     * Add cubics in table
     *
     * @return void
     */
    public function addCubicCms()
    {       
        $datas = [
            ['Preto', 1],
            ['Branco', 2],
            ['Prata', 3],
            ['Vermelho'],
            ['Cinza', 5],
            ['Azul', 6],
            ['Amarelo', 7],
            ['Verde', 8],
            ['Laranja', 9],
            ['Outra', 10]
        ];
        
        foreach( $datas as $data) {
            if (!DB::table('cubic_cms')->where('name', $data[0])->first()) {                
                DB::table('cubic_cms')->insert([                        
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
            $this->addCubicCms();
        } catch (\Exception $e){
            $this->info("Command addCubicCms returned with error: ".$e->getMessage());
        }
    }
}
