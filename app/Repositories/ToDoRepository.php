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

        $model = $this->model::select();

        //attach user id condtion
        if (!is_null($user_id)) {
            $model->where('user_id', $user_id);
        }

        //attach type condition
        if (!empty($status)) {
            $status = is_array($status) ? $status : [$status];
            $model->whereIn('status', $status);
        }

        //Check for search keyword
        if (!empty($request->keyword)) {
            $model->where(function($query) use ($request){
                $query->where('title', 'like', "%{$request->keyword}%");
                $query->orWhere('description', 'like', "%{$request->keyword}%");
            });
        }

        return $model->get();
    }
    
    /**
     * Create a new record in the database
     * 
     * @param array $data
     * @return type
     */
    public function attachUserIdandSave(array $data, $userId = null) {
        $data['user_id'] = $userId;
        return $this->create($data);
    }
    
    /**
     * Show the record with the given id
     * 
     * @param type $id
     * @param type $user_id
     * @return type
     */
    public function showUserSpecific($id, $user_id) {
        return $this->model->where('user_id', $user_id)->findOrFail($id);
    }
    
    /**
     * Show the record with the given id
     * 
     * @param type $id
     * @param type $user_id
     * @return type
     */
    public function updateUserSpecific($data, $id, $user_id) {
        $record =  $this->model->where('user_id', $user_id)->whereId($id)->findOrFail($id);
        $record->update($data);
    }
    
    /**
     * Update status
     * 
     * @param type $id
     * @param type $user_id
     * @param type $request
     */
    public function updateStatus($id, $user_id, $request) {
        $record =  $this->model->where('user_id', $user_id)->whereId($id)->findOrFail($id);
        $record->status = $request->is_completed == 1 ? 'Completed' : 'New';
        $record->save();
    }
}
