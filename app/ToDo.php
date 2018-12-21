<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'to_do';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'due_at', 'user_id'];

}
