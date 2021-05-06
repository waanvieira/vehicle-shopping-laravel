<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Vehicle;

class VehicleObserver
{
    /**
     * Event created when is creating a vehicle
     *
     * @return void
     */
    public function creating(Vehicle $vehicle)
    {
        $vehicle->user_id = auth()->check() ? auth()->user()->id : User::first();
    }

    /**
     * Event created when is created a vehicle
     *
     * @return void
     */
    public function created(Vehicle $vehicle)
    {

    }

    /**
     * Event created when is updating a vehicle
     *
     * @return void
     */
    public function updating(Vehicle $vehicle)
    {

    }

    /**
     * Event created when is updated a vehicle
     *
     * @return void
     */
    public function updated(Vehicle $vehicle)
    {

    }

    /**
     * Event created when is deleted a vehicle
     *
     * @return void
     */
    public function deleted(Vehicle $vehicle)
    {

    }
}
