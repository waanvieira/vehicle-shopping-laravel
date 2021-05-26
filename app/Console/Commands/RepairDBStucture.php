<?php

namespace App\Console\Commands;

use App\Console\Commands\Database\{
    AddColors,
    AddDoors,
    AddFinancials,
    AddSteerings,
    AddCubicCms,
    AddExchange,
    AddFeatures,
    AddFuels,
    AddGearBox,
    addMotorPowers,
    AddRegDates,
    AddTypes,
    addBrands,
    addModels,
    AddVersions
};

use Illuminate\Console\Command;

class RepairDBStucture extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repair:structure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Commando for repair and update data base';

    /**
     * Command list to be independent 
     * 
     * 
     * @var array
     */
    protected $commandsList = [
        AddColors::class,        
        AddDoors::class,
        AddFinancials::class,
        AddSteerings::class,
        AddCubicCms::class,
        AddExchange::class,
        AddFeatures::class,
        AddFuels::class,
        AddGearBox::class,
        addMotorPowers::class,
        AddRegDates::class,
        AddTypes::class,
        addBrands::class,
        addModels::class,
        AddVersions::class
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach ($this->commandsList as $command) {
            $instance = new $command;
            $instance->handle();
            $this->info(sprintf('Comando %s foi executado com sucesso.', get_class($instance)));
        }
    }
}
