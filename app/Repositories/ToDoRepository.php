<?php

namespace App\Repositories;

use App\ToDo;
use Illuminate\Http\Request;

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
     * 
     * @param Request $request
     * @param type $user_id
     * @param type $type
     * @return type
     */
    public function search(Request $request, $user_id = null, $status = []) {

        //attach user id condtion
        if (!is_null($user_id)) {
            $this->model->where('user_id', $user_id);
        }

        //attach type condition
        if (!empty($status)) {
            $status = is_array($status) ? $status : [$status];
            $this->model->whereIn('status', $status);
        }
        
        //Check for search keyword
        if(!empty($request->keyword)){
            
        }

        return $this->model->all();
    }

}
