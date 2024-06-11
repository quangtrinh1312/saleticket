<?php

namespace App\Repositories;

/**
 *
 * Class AbstractRepository
 * @package App\Repositories
 */

abstract class AbstractRepository
{
    protected $model;
    const LIMIT = 10;

    const PAGINATE = 10;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function getLists()
    {
        return $this->model->get();
    }

    public function update($id, $params)
    {
        return $this->model->where('id', $id)
            ->update($params);
    }

    public function getListPaginates($limit = self::LIMIT) 
    {
        return $this->model->select()->orderBy('id','DESC')
            ->paginate($limit);
    }

    public function create($params)
    {
        return $this->model->create($params);
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function getById($id)
    {
        return $this->model->withTrashed()->where('id', $id)
            ->first();
    }

    public function inserts($params)
    {
        return $this->model->insert($params);
    }

    public function getListByTake($take)
    {
        $data = $this->model
            ->orderBy('id', 'DESC')
            ->take($take)
            ->get();

        return $data;
    }

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getListDESC()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function getListByArrIds($params)
    {
        return $this->model->whereIn('id',$params)->get();
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)
            ->first();
    }

    public function getFirt() {
        return $this->model->first();
    }
}
