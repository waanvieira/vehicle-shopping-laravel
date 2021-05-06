<?php

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class AddBrands extends Command
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
    protected $description = 'Add brands registers in all environments';

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
    public function addBrands()
    {
        $datas = [
            ['CITROEN', 16, 2020],
            ['FIAT', 25, 2020],
            ['FORD', 27, 2020],
            ['GM - CHEVROLET', 29, 2020],
            ['HONDA', 33, 2020],
            ['HYUNDAI', 34, 2020],
            ['JAC', 36, 2020],
            ['KIA MOTORS', 41, 2020],
            ['NISSAN', 59, 2020],
            ['PEUGEOT', 60, 2020],
            ['RENAULT', 64, 2020],
            ['TOYOTA', 73, 2020],
            ['VW - VOLKSWAGEN', 75, 2020],
            ['AM GEN', 1, 2020],
            ['MCLAREN', 2, 2020],
            ['AGRALE', 3, 2020],
            ['ALFA ROMEO', 4, 2020],
            ['ASIA MOTORS', 5, 2020],
            ['AUDI', 6, 2020],
            ['BMW', 7, 2020],
            ['BRM', 8, 2020],
            ['BUGGY', 9, 2020],
            ['BUGRE', 10, 2020],
            ['CBT JIPE', 11, 2020],
            ['CHANGAN', 12, 2020],
            ['CHERY', 13, 2020],
            ['CADILLAC', 14, 2020],
            ['CHRYSLER', 15, 2020],
            ['CROSS LANDER', 17, 2020],
            ['DAEWOO', 18, 2020],
            ['DAIHATSU', 19, 2020],
            ['DODGE', 20, 2020],
            ['EFFA', 21, 2020],
            ['ENGESA', 22, 2020],
            ['ENVEMO', 23, 2020],
            ['FERRARI', 24, 2020],
            ['FIBRAVAN', 26, 2020],
            ['FYBER', 28, 2020],
            ['GREAT WALL', 30, 2020],
            ['GURGEL', 31, 2020],
            ['HAFEI', 32, 2020],
            ['ISUZU', 35, 2020],
            ['JINBEI', 37, 2020],
            ['JPX', 38, 2020],
            ['JAGUAR', 39, 2020],
            ['JEEP', 40, 2020],
            ['LAMBORGHINI', 42, 2020],
            ['LIFAN', 43, 2020],
            ['LOBINI', 44, 2020],
            ['LADA', 45, 2020],
            ['LAND ROVER', 46, 2020],
            ['LEXUS', 47, 2020],
            ['LOTUS', 48, 2020],
            ['MG', 49, 2020],
            ['MINI', 50, 2020],
            ['MAHINDRA', 51, 2020],
            ['MASERATI', 52, 2020],
            ['MATRA', 53, 2020],
            ['MAZDA', 54, 2020],
            ['MERCEDES-BENZ', 55, 2020],
            ['MERCURY', 56, 2020],
            ['MITSUBISHI', 57, 2020],
            ['MIURA', 58, 2020],
            ['PLYMOUTH', 61, 2020],
            ['PONTIAC', 62, 2020],
            ['PORSCHE', 63, 2020],
            ['ROVER', 65, 2020],
            ['SSANGYONG', 66, 2020],
            ['SAAB', 67, 2020],
            ['SATURN', 68, 2020],
            ['SEAT', 69, 2020],
            ['SUBARU', 70, 2020],
            ['SUZUKI', 71, 2020],
            ['TAC', 72, 2020],
            ['TROLLER', 74, 2020],
            ['VOLVO', 76, 2020],
            ['WAKE', 77, 2020],
            ['WALK', 78, 2020],
            ['SMART', 79, 2020],
            ['SHINERAY', 80, 2020],
            ['ASTON MARTIN', 81, 2020],
            ['FOTON', 82, 2020],
            ['RELY', 83, 2020],
            ['ROLLS-ROYCE', 84, 2020],
            ['DKW VEMAG', 85, 2020],
            ['LANDWIND', 86, 2020],
            ['GEELY', 87, 2020],
            ['CHANA', 88, 2020],
            ['PUMA', 89, 2020],
            ['RAM', 90, 2020],
            ['INFINITI', 91, 2020],
            ['TESLA', 92, 2020],
            ['BABY', 93, 2020],
            ['IVECO', 94, 2020],
            ['ACURA', 95, 2020],
            ['HITECH ELETRIC', 96, 2020],
            ['DUCATI', 1, 2060],
            ['BUELL', 2, 2060],
            ['KTM', 3, 2060],
            ['KAHENA', 4, 2060],
            ['FOX', 5, 2060],
            ['MRX', 6, 2060],
            ['YAMAHA', 7, 2060],
            ['IROS', 8, 2060],
            ['SUZUKI', 9, 2060],
            ['TRIUMPH', 10, 2060],
            ['L\'AQUILA', 11, 2060],
            ['SUNDOWN', 12, 2060],
            ['DAELIM', 13, 2060],
            ['AMAZONAS', 14, 2060],
            ['HONDA', 15, 2060],
            ['HERO', 16, 2060],
            ['APRILIA', 17, 2060],
            ['JONNY', 18, 2060],
            ['DERBI', 19, 2060],
            ['ADLY', 20, 2060],
            ['KAWASAKI', 21, 2060],
            ['ORCA', 22, 2060],
            ['DAFRA', 23, 2060],
            ['JOHNNYPAG', 24, 2060],
            ['PIAGGIO', 25, 2060],
            ['MVK', 26, 2060],
            ['REGAL RAPTOR', 27, 2060],
            ['HARLEY-DAVIDSON', 28, 2060],
            ['PEGASSI', 29, 2060],
            ['MV AGUSTA', 30, 2060],
            ['PEUGEOT', 31, 2060],
            ['ATALA', 32, 2060],
            ['MOTO GUZZI', 33, 2060],
            ['CAGIVA', 34, 2060],
            ['LIFAN', 35, 2060],
            ['BAJAJ', 36, 2060],
            ['MALAGUTI', 37, 2060],
            ['AGRALE', 38, 2060],
            ['TRAXX', 39, 2060],
            ['HUSQVARNA', 40, 2060],
            ['KASINSKI', 41, 2060],
            ['BIMOTA', 42, 2060],
            ['LON-V', 43, 2060],
            ['KIMCO', 44, 2060],
            ['DAYANG', 46, 2060],
            ['DAYUN', 47, 2060],
            ['GREEN', 48, 2060],
            ['MIZA', 49, 2060],
            ['GAS GAS', 50, 2060],
            ['BRANDY', 51, 2060],
            ['SANYANG', 52, 2060],
            ['BMW', 53, 2060],
            ['HUSABERG', 54, 2060],
            ['FYM', 55, 2060],
            ['LERIVO', 56, 2060],
            ['GARINNI', 57, 2060],
            ['HAOBAO', 58, 2060],
            ['BUENO', 59, 2060],
            ['JIAPENG VOLCANO', 60, 2060],
            ['HARTFORD', 61, 2060],
            ['EMME', 62, 2060],
            ['CALOI', 63, 2060],
            ['LANDUM', 64, 2060],
            ['MAGRÃO TRICICLOS', 65, 2060],
            ['BETA', 66, 2060],
            ['LAVRALE', 67, 2060],
            ['SIAMOTO', 68, 2060],
            ['BENELLI', 69, 2060],
            ['TARGOS', 70, 2060],
            ['VENTO', 71, 2060],
            ['TIGER', 72, 2060],
            ['BYCRISTO', 73, 2060],
            ['WUYANG', 74, 2060],
            ['SHINERAY', 75, 2060],
            ['BRAVA', 76, 2060],
            ['BRP', 77, 2060],
            ['ROYAL ENFIELD', 78, 2060],
            ['RIGUETE', 79, 2060],
            ['MOTORINO', 80, 2060],
            ['MOTOCAR', 81, 2060],
            ['INDIAN', 82, 2060],
            ['HAOJUE', 83, 2060],
            ['BEE', 84, 2060],
            ['BULL', 85, 2060],
            ['FUSCO MOTOSEGURA', 86, 2060],
            ['POLARIS', 87, 2060],
            ['VOLTZ', 88, 2060],
        ];

        foreach ($datas as $data) {

            if (!DB::table('brands')->where('name', $data[0])->first()) {
                DB::table('brands')->insert([
                    'name'       => $data[0],
                    'value'      => $data[1],
                    'type_id'    => $data[2],
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
            $this->addBrands();
        } catch (\Exception $e) {
            $this->info("Command addBrands returned with error: " . $e->getMessage());
        }
    }
}
