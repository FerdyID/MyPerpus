<?php

namespace App\Domain\Repositories;

abstract class AbstractRepository implements AbstractInterface
{
    
    protected $model;
    
    /**
     * AbstractRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }
    
    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }
    
    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }
    
    public function getAll()
    {
        return $this->model->all();
    }
    
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }
    
    public function getByField($att, $field)
    {
        return $this->model->where($att, $field);
    }
    
    public function paginate($limit = 3, $key, $search)
    {
        return $this->model->where($key, 'like', '%' . $search . '%')->paginate($limit);
    }
    
    /**
     * @param array $attributes
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(array $attributes)
    {
        $q = $this->model->create($attributes);
        if (!$q) {
            return $this->createError();
        }
        return $this->createSuccess();
    }
    
    public function createError()
    {
        return response()->json(['created' => false], 500);
    }
    
    public function createSuccess()
    {
        return response()->json(['created' => true], 200);
    }
    
    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes)
    {
        $q = $this->getById($id)->fill($attributes)->save();
        if (!$q) {
            return $this->updateError();
        }
        return $this->updateSuccess($attributes);
    }
    
    public function updateSuccess($data)
    {
        return response()->json($data);
    }
    
    public function updateError()
    {
        return response()->json(['updated' => false], 500);
    }
    
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $q = $this->getById($id);
        if (!$q) {
            return $this->deleteError();
        }
        $q->delete();
        return $this->deleteSuccess();
    }
    
    public function deleteError()
    {
        return response()->json(['deleted' => false], 500);
    }
    
    public function deleteSuccess()
    {
        return response()->json(['deleted' => true], 200);
    }
}
