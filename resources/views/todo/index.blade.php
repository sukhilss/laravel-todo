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
                    <ul class="nav nav-tabs card-header-tabs float-left">
                        <li class="nav-item">
                            <a class="nav-link {{ $tab == "New" ? 'active' : '' }}" href="{{ route('tasks', ['tab' => 'New']) }}">Pending Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $tab == 'Completed' ? 'active' : '' }}" href="{{ route('tasks', ['tab' => 'Completed']) }}">Completed tasks</a>
                        </li>
                    </ul>
                    <div class="float-right">
                        <a href="{{ route('tasks-new') }}" class="btn btn-sm btn-primary">Add task</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th width="10%">Completed?</th>
                                    <th width="15%">Title</th>
                                    <th>Description</th>
                                    <th width="15%">Due Date</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                @forelse ($tasks as $task)
                                <tr>
                                    <td width="10%"><input type="checkbox" class="submit-checkbox" data-id="{{ $task->id }}"></td>
                                    <td width="15%">{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td width="20%">{{ $task->due_at }}</td>
                                    <td width="15%">
                                        <a href="{{ route('tasks-edit', $task->id) }}">Edit</a>
                                        <a href="{{ route('tasks-destroy', [$task->id]) }}">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No tasks found!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
