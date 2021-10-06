<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $model;
    protected $relationships;

    protected function setModel($model, $relationships = [])
    {
        $this->model            = $model;
        $this->relationships    = $relationships;
    }

    public function getModel($id = null)
    {
        if (is_null($id))
        {
            return new $this->model;
        }

        return $this->find($id);
    }

    public function save($params, $id = null)
    {
        $model = $this->getModel($id);

        $model->fill($params)->save();
        if (!empty($this->relationships))
        {
            $model->with($this->relationships);
        }

        return $model;
    }

    public function bulkSave($data)
    {
        return $this->getModel()->insert($data);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function getMaxId()
    {
        return $this->model->orderBy('id', 'desc')->first()['id'] ?? 0;
    }

    public function all($params = null)
    {
        if (is_null($params))
        {
            return $this->model->with($this->relationships)->get();
        }

        return $this->model->with($this->relationships)->where($params)->get();
    }

    public function find($id)
    {
        return $this->model->with($this->relationships)->findOrFail($id);
    }

    public function findById($id, $column = 'id')
    {
        return $this->model->with($this->relationships)->where($column, $id)->first();
    }

    public function getMaxDate()
    {
        return $this->model->orderBy('created_at', 'desc')->first()['created_at'] ?? '2000/01/01 00:00:00';
    }

    public function paginate($params = null, $includes = [], $paginateNo = 15)
    {
        $modelQuery = (is_null($params)) ? $this->model->with($this->relationships) : $this->model->with($this->relationships)->where($params);

        return $modelQuery->with($includes)->paginate($paginateNo);
    }
}
