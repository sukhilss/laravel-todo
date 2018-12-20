<?php

namespace App\Repositories;

use App\ToDo;

class ToDoRepository extends Repository {
    
    /**
     * Constructor to bind model to Repository
     * 
     * @param ToDo $model
     */
    public function __construct(ToDo $model) {
        parent::__construct($model);
    }
    
    /**
     * Get all instances of model
     * 
     * @return type
     */
    public function search() {
        return $this->model->all();
    }
    
}