<?php

namespace App\Services;

use App\Repositories\VehicleRepository;

class VehicleService
{
    private $repository;

    /**
     * Construct method
     *
     * @param VehicleRepository $repository
     */
    public function __construct(VehicleRepository $repository)
    {
        $this->repository = $repository;
    }

     /**
     * Show all resgisters
     *
     * @param Int $paginate
     * @param String $currentPage
     * @param Array $dataForm
     * @return Collection
     */
    public function getAll($paginate = null, $currentPage = null, $dataForm = null)
    {
        return $this->repository->getAll($paginate, $currentPage, $dataForm);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\  $request
     * @return mix
     */
    public function store($request)
    {        
        return $this->repository->store($request);
    }

    /**
     * Store or create newly created resource in storage.
     *
     * @param  \Illuminate\Http\  $request
     * @return mix
     */
    public function firstOrCreate($request)
    {        
        return $this->repository->firstOrCreate($request);
    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findByID($id)
    {
        return $this->repository->findByID($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  uuif  $uuid
     * @return \Illuminate\Http\Response
     */
    public function findByUUID($uuid)
    {
        return $this->repository->findByUUID($uuid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        return $this->repository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}