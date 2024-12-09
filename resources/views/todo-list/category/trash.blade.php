@extends('welcome')

@section('style', asset('css/category.css'))

@section('title', 'trashed')
@auth
    @section('navbar')
        @extends('todo-list.navbar')
    @endsection

    @section('msg')
        @extends('todo_component.alert')
    @endsection

    @section('content')
        <span class="fw-bold mx-5"> Recycle Bin - Category </span>

        @if ($categories->count() > 0)
            <div class="category_Container p-5 ">
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

                                    <span class="num_Task">No Tasks</span>
                                </div>
                            @endif
                            <div class="card-title">
                                {{ $category->title }}
                            </div>
                            <div class="card_icon">

                                <button class="btn" data-bs-toggle="modal" data-bs-target="#Drop2{{ $category->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form action="{{ route('category.restore', $category->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('post')
                                    <button type="submit" class="btn">
                                        <i class="fa-solid fa-rotate-right"></i>
                                    </button>
                                </form>


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
                                                <form action="{{ route('category.delete', $category->id) }}" method="POST"
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
            </div>
        @else
            @include('todo_component.lottieEmpty')
        @endif
    @endsection
@else
    <div> login First </div>
@endauth
