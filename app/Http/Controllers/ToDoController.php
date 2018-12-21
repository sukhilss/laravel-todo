<?php

namespace App\Http\Controllers;

use App\ToDo;
use Illuminate\Http\Request;
use App\Repositories\ToDoRepository;
use App\Http\Requests\StoreTodoRequest;

class ToDoController extends Controller {

    /**
     * Repository for to do
     *
     * @var type 
     */
    protected $toDoRepo;

    /**
     * 
     * @param ToDo $toDo
     */
    public function __construct(ToDo $toDo) {
        $this->middleware('auth');
        $this->toDoRepo = new ToDoRepository($toDo);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!in_array($request->get('tab'), ['New', 'Completed'])) {
            abort(404);
        }

        return view('todo.index', [
            'tab' => $request->get('tab'),
            'tasks' => $this->toDoRepo->search($request, auth()->id(), $request->get('tab'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreTodoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request) {
        $request->validated();

        //Create new task
        $this->toDoRepo->attachUserIdandSave($request->only($this->toDoRepo->getModel()->fillable), auth()->id());

        return redirect()->route('tasks', ['tab' => 'New']);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $task = $this->toDoRepo->showUserSpecific($id, auth()->id());

        return view('todo.edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->toDoRepo->updateUserSpecific($request->only($this->toDoRepo->getModel()->fillable), $id, auth()->id());
        return redirect()->route('tasks', ['tab' => 'New']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->model->delete($id);
        return redirect()->route('tasks', ['tab' => 'New']);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $id
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request, $id) {
        $this->toDoRepo->updateStatus($id, auth()->id(), $request);
        return redirect()->route('tasks', ['tab' => 'New']);
    }


}
