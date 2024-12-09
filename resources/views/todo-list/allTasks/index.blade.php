@extends('welcome')

@section('style', asset('css/allTask.css'))

@section('title', 'To-Do')
@auth
    @section('navbar')
        @extends('todo-list.navbar')
    @endsection

    @section('msg')
        @extends('todo_component.alert')
    @endsection

    @section('content')
        <div class="container">
            <div class="container-title"> <span>Welcome </span> <span class="mx-1">back,</span> <span
                    class="name mx-1 text-lowercase ">
                    {{ explode(' ', Auth::user()->name)[0] }}👋</span>
            </div>

            <div class="container-description">
                @if ($tasks->count() > 0)
                    <span class="opacity-low mx-3 name "> You’ve got {{ $tasks->count() }} tasks to do. </span>
                @else
                    <span class="opacity-low mx-3 name "> You don’t have any tasks to do. </span>
                @endif
            </div>

            <div class="container-task ">
                <div class="add-task">
                    <div class="row">
                        <div class="col-lg-10 mx-auto container-addTask d-flex flex-row align-items-center mt-4  ">
                            <button type="button" class="btn  btn-lg btn-primary float-end " data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                <li class="fas fa-plus"></li> <span class="mx-2 text-white ">add new task</span>

                            </button>
                        </div>
                    </div>

                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Task</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('task.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Enter title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="pending">Pending</option>
                                                <option value="completed">Completed</option>
                                                <option value="cancelled">cancelled</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            @if ($categories->count() > 0)
                                                <label for="category">category</label>
                                                <select class="form-select" id="category" name="category_id">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @endforeach

                                                </select>
                                            @else
                                                <br>
                                                <a class="btn btn-primary " href="{{ route('category.index') }}"> Add
                                                    category First </a>
                                            @endif
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">save</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($tasks->count() > 0)
                <div class="show_tasks">
                    @foreach ($tasks as $task)
                        <div class="row">
                            <div class="card col-11 col-lg-10 mx-auto" id="{{ $task->id }}">
                                <div class="card-title">
                                    <div class="right">
                                        <button class="updatebtn" data-bs-toggle="modal"
                                            data-bs-target="#taskModal{{ $task->id }}"></button>
                                        <div class="modal fade" id="taskModal{{ $task->id }}" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">update Task</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('task.update', $task->id) }}" method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="title">Title</label>
                                                                <input type="text" class="form-control" id="title"
                                                                    name="title" value="{{ $task->title }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description">Description</label>
                                                                <textarea class="form-control" id="description" name="description">
                                                                {{ $task->description }}
                                                            </textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="status">Status</label>
                                                                <select class="form-select" id="status" name="status">
                                                                    <option value="pending"
                                                                        {{ $task->status == 'pending' ? 'selected' : '' }}>
                                                                        Pending
                                                                    </option>
                                                                    <option value="completed"
                                                                        {{ $task->status == 'completed' ? 'selected' : '' }}>
                                                                        Completed</option>
                                                                    <option value="cancelled"
                                                                        {{ $task->status == 'cancelled' ? 'selected' : '' }}>
                                                                        cancelled</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="category">category</label>
                                                                <select class="form-select" id="category"
                                                                    name="category_id">
                                                                    @foreach ($categories as $category)
                                                                        <option
                                                                            {{ $task->category_id === $category->id ? 'selected' : '' }}
                                                                            value="{{ $category->id }}">
                                                                            {{ $category->title }}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="modal-footer ">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="fs-5 text-uppercase">{{ $task->title }}</h1>
                                    </div>
                                    <div class="status">
                                        @if ($task->status == 'pending')
                                            <span class="badge bg-info">Pending</span>
                                        @elseif($task->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($task->status == 'cancelled')
                                            <span class="badge bg-danger">cancelled</span>
                                        @endif

                                    </div>
                                </div>
                                <div class="card-description">
                                    <p class="task-description">{{ $task->description }}</p>

                                    <span class="time">Created at : {{ $task->created_at }} </span>
                                </div>
                                <div class="card-delete">

                                    <button class="btn" data-bs-toggle="modal"
                                        data-bs-target="#Drop2{{ $task->id }}">
                                        <i class="fas fa-close"></i>
                                    </button>
                                </div>
                                <div class="modal fade" id="Drop2{{ $task->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Are you sure </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('task.softdelete', $task->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete Permanently</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                @include('todo_component.lottieEmpty')
            @endif

        </div>
    @endsection
@else
    <div> login First </div>

@endauth
