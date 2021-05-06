<?php

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class AddRegDates extends Command
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
    protected $description = 'Add reg dates registers in all environments';
    
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
    public function addRegDates()
    {   
        $datas = [
            ['1950 ou anterior', 1950],
            ['1955', 1955],
            ['1960', 1960],
            ['1965', 1965],
            ['1970', 1970],
            ['1975', 1975],
            ['1980', 1980],
            ['1981', 1981],
            ['1982', 1982],
            ['1983', 1983],
            ['1984', 1984],
            ['1985', 1985],
            ['1986', 1986],
            ['1987', 1987],
            ['1988', 1988],
            ['1989', 1989],
            ['1990', 1990],
            ['1991', 1991],
            ['1992', 1992],
            ['1993', 1993],
            ['1994', 1994],
            ['1995', 1995],
            ['1996', 1996],
            ['1997', 1997],
            ['1998', 1998],
            ['1999', 1999],
            ['2000', 2000],
            ['2001', 2001],
            ['2002', 2002],
            ['2003', 2003],
            ['2004', 2004],
            ['2005', 2005],
            ['2006', 2006],
            ['2007', 2007],
            ['2008', 2008],
            ['2009', 2009],
            ['2010', 2010],
            ['2011', 2011],
            ['2012', 2012],
            ['2013', 2013],
            ['2014', 2014],
            ['2015', 2015],
            ['2016', 2016],
            ['2017', 2017],
            ['2018', 2018],
            ['2019', 2019],
            ['2020', 2020],
            ['2021', 2021]
        ];
        
        foreach( $datas as $data) {
            if (!DB::table('reg_dates')->where('name', $data[0])->first()) {                
                DB::table('reg_dates')->insert([                        
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
            $this->addRegDates();
        } catch (\Exception $e){
            $this->info("Command addRegDates returned with error: ".$e->getMessage());
        }
    }
}
