<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface {

    /**
     *
     * @var type 
     */
    protected $model;

    /**
     * Constructor to bind model to Repository
     * 
     * @param Model $model
     */
    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * Get all instances of model
     * 
     * @return type
     */
    public function all() {
        return $this->model->all();
    }

    /**
     * Create a new record in the database
     * 
     * @param array $data
     * @return type
     */
    public function create(array $data) {
        return $this->model->create($data);
    }

    /**
     * Update record in the database
     * 
     * @param array $data
     * @param type $id
     * @return type
     */
    public function update(array $data, $id) {
        $record = $this->find($id);
        return $record->update($data);
    }

    /**
     * Remove record from the database
     * 
     * @param type $id
     * @return type
     */
    public function delete($id) {
        return $this->model->destroy($id);
    }

    /**
     * Show the record with the given id
     * 
     * @param type $id
     * @return type
     */
    public function show($id) {
        return $this->model - findOrFail($id);
    }

    /**
     * Get the associated model
     * 
     * @return type
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * Set the associated model
     * 
     * @param type $model
     * @return $this
     */
    public function setModel($model) {
        $this->model = $model;
        return $this;
    }

    /**
     * Eager load database relationships
     * 
     * @param type $relations
     * @return type
     */
    public function with($relations) {
        return $this->model->with($relations);
    }

}
