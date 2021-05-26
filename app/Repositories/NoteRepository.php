<?php

namespace App\Repositories;

use App\Models\Note;
use Illuminate\Support\Facades\DB;

class NoteRepository
{
    private $model;

    public function __construct(Note $model)
    {
        $this->model = $model;
    }

    /**
     * @param EloquentQueryBuilder|QueryBuilder $query
     * @param int                               $take
     * @param bool                              $paginate
     *
     * @return EloquentCollection|Paginator
     */
    public function getAll($doQuery = null, $paginate = null, array $data = null, $take = null)
    {
        
        $query = $this->model;
        
        if ($doQuery) {
            return $query;
        }
        
        if ($paginate) {
            return $query->paginate($paginate);
        }

        if ($take > 0 || false !== $take) {
            return $query->take($take);
        }

        return $query->get();
    }

    /**
     * Find by ID
     *
     * @param int $id
     * @return void
     */
    public function findByID($id)
    {        
        return $this->model->where('id', $id)->first();
    }

    /**
     * Find by uuid
     *
     * @param string $uuid
     * @return void
     */
    public function findByUUID($uuid)
    {        
        return $this->model->where('uuid', $uuid)->first();
    }

    /**
     * Register 
     *
     * @param Request $request
     * @return response
     */
    public function store($request)
    {
        DB::beginTransaction();
        
        $response = $this->model->create($request->all());        

        if (!$response) {
            DB::rollBack();
            return false;
        }
        
        DB::commit();
        return $response;      
    }
    
    /**
     * Update
     *
     * @param int|uuid $id
     * @param Request $request
     * @return void
     */
    public function update($request, $id)
    {
        DB::beginTransaction();
        
        $response = tap($this->findByUUID($id), function ($model) use ($request) {
            return $model->update($request->all());
        });

        if (!$response) {
            DB::rollBack();
            return false;
        }

        DB::commit();
        
        return $response;        
    }

    /**
     * Delete register
     *
     * @param uuid $id
     * @return void
     */
    public function destroy($id)
    {        
        $response = $this->model->where('uuid', $id)->first();
        return $response->delete();
    }

}

