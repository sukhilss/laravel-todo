@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit task
                    <div class="float-right">
                        <a href="{{ route('tasks', ['tab' => 'New']) }}" class="btn btn-sm btn-primary">Task list</a>
                    </div>
                </div>
                <form method="POST" action="{{ route('tasks-put', $task->id) }}" novalidate>
                    <input type="hidden" name="_method" value="put" />
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-6">
                                <input type="text" name='title' value="{{ old('title', $task->title) }}" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="inputTitle" placeholder="Title">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-6">
                                <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" rows="5">{{ old('description', $task->description) }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputDueDate" class="col-sm-2 col-form-label">Due date</label>
                            <div class="col-sm-6">
                                <input type="text" name='due_at' value="{{ old('due_at', date('Y-m-d H:i', strtotime($task->due_at))) }}" class="form-control {{ $errors->has('due_at') ? 'is-invalid' : '' }}" id="inputDueDate" placeholder="Due date">
                                @if ($errors->has('due_at'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('due_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
