<?php

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class AddFeatures extends Command
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
    protected $description = 'Add features registers in all environments';
    
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
    public function addFeatures()
    {   
        $datas = [
            ['Air bag', 5, 2020],
            ['Alarme', 6, 2020],
            ['Ar condicionado', 1, 2020],
            ['Trava elétrica', 4, 2020],
            ['Vidro elétrico', 3, 2020],
            ['Som', 7, 2020],
            ['Sensor de ré', 8, 2020],
            ['Câmera de ré', 9, 2020],
            ['Blindado', 10, 2020],
            ['Direção hidráulica', 2, 2020],
            ['ABS', 1, 2060],
            ['Computador de bordo', 2, 2060],
            ['Escapamento esportivo', 3, 2060],
            ['Bolsa / Baú / Bauleto', 4, 2060],
            ['Contra peso no guidon', 5, 2060],
            ['Alarme', 6, 2060],
            ['Amortecedor de direção', 7, 2060],
            ['Faróis de neblina', 8, 2060],
            ['GPS', 9, 2060],
            ['Som', 10, 2060]
        ];
        
        foreach( $datas as $data) {
            
            if (!DB::table('features')->where('name', $data[0])->first()) {
                DB::table('features')->insert([                        
                    'name'      => $data[0],                    
                    'value'     => $data[1],
                    'type_id'   => $data[2],
                    'created_at'=> now(),
                    'updated_at'=> now()
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
            $this->addFeatures();
        } catch (\Exception $e){
            $this->info("Command addFeatures returned with error: ".$e->getMessage());
        }
    }
}
