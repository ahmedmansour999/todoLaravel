@extends('welcome')

@section('style', asset('css/allTask.css'))

@section('title', 'trashed')
@auth
    @section('navbar')
        @extends('todo-list.navbar')
    @endsection

    @section('msg')
        @extends('todo_component.alert')
    @endsection

    @section('content')
        <div class="container">
            <span class="fw-bold"  > Recycle Bin - Tasks </span>
            @if ($tasks->count() > 0)
                <div class="show_tasks">
                    @foreach ($tasks as $task)
                        <div class="row">
                            <div class="card col-11 col-lg-10 mx-auto" id="{{ $task->id }}">
                                <div class="card-title">
                                    <div class="right">
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
                                {{-- Btn For delete Card --}}
                                <div class="card-delete">
                                    <div class="btn-group dropstart">
                                        <button class="gear-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-gear"></i>
                                        </button>

                                        <div class="dropdown-menu">
                                            <div class="hover_red">
                                                <button class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#Drop2{{ $task->id }}">
                                                    Remove
                                                </button>
                                            </div>
                                            <div class="hover_blue">
                                                <button class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#Drop{{ $task->id }}">
                                                    restore
                                                </button>
                                            </div>
                                        </div>
                                    </div>

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
                                                <form action="{{ route('task.delete', $task->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete Permanently</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Btn For Delete Card --}}
                                {{-- Btn For restore Card --}}

                                <div class="modal fade" id="Drop{{ $task->id }}" data-bs-backdrop="static"
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
                                                <form action="{{ route('task.restore', $task->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-success">Restore</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Btn For restore Card --}}

                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                @include('todo_component.lottieEmpty')
            @endif
        </div>
    @endsection


@endauth
