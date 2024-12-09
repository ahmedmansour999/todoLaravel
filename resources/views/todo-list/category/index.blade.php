@extends('welcome')

@section('style', asset('css/category.css'))

@section('title', 'category')
@auth
    @section('navbar')
        @extends('todo-list.navbar')
    @endsection

    @section('msg')
        @extends('todo_component.alert')
    @endsection

    @section('content')
        <div class="category_Container p-5 ">

            <div class="category_head mb-5">
                <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i
                        class="fas fa-plus"></i> Add
                    Category</button>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add category</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('category.store') }}" method="POST">
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
                                    <div class="modal-footer ">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">save</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($categories->count() > 0)
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="card col col-sm-10 col-md-4 col-lg-3 " id="{{ $category->id }}">
                            @if ($category->tasks->count() > 0)
                                <div class="card-details">
                                    <span class="num_Task">you Have</span>
                                    <span class="number"> {{ $category->tasks->count() }}</span>
                                    <span class="num_Task">task</span>
                                </div>
                            @else
                                <div class="card-details">

                                    <span class="num_Task">You Dont Have Any Task</span>
                                </div>
                            @endif
                            <div class="card-title">
                                {{ $category->title }}
                            </div>
                            <div class="card_icon">
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#Drop{{ $category->id }}">
                                    <i class="fa fa-edit"></i></button>
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#Drop2{{ $category->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                {{-- Start Here --}}
                                <div class="modal fade" id="Drop2{{ $category->id }}" data-bs-backdrop="static"
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
                                                <form action="{{ route('category.softDelete', $category->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete Permanently</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- finish here --}}
                                <div class="modal fade" id="Drop{{ $category->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add category</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('category.update', $category->id) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="title">Title</label>
                                                        <input type="text" class="form-control" id="title"
                                                            name="title" value="{{ $category->title }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description">Description</label>
                                                        <textarea class="form-control" id="description" name="description">
                                                            {{ $category->description }}
                                                        </textarea>
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
