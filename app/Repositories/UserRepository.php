<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    private $model;

    public function __construct(User $model)
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
    public function getAll($do_query = null, $paginate = null, array $data = null)
    {
        $query = $this->model;

        if ($do_query) {
            return $query;
        }

        if ($paginate) {
            return $query->paginate($paginate);
        }

        // if ($take > 0 || false !== $take) {
        //     $this->turma->take($take);
        //   }

        return $query->get();
    }

    /**
     * Find By ID
     *
     * @param int|uuid $id
     * @return void
     */
    public function findByID($id)
    {
        return $this->model->where('uuid', $id)->first();
    }

    /**
     * Register user
     *
     * @param Request $request
     * @return response
     */
    public function store($request)
    {        
        DB::beginTransaction();

        $request['expires_at'] = date('Y-m-d', strtotime('+7 days'));
        $request['delete_account_at'] = date('Y-m-d', strtotime('+15 days'));        
        $response = $this->model->create($request->all());
            
        if (!$response) {
            DB::rollBack();            
            return false;
        }

        DB::commit();
        return $response;            
    }
    /**
     * Updata User
     *
     * @param int|string $id
     * @param Request $request
     * @return void
     */
    public function update($id, $request)
    {        

        DB::beginTransaction();

        $response = tap($this->findByID($id), function ($model) use ($request) {
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
