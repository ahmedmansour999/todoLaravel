@extends('welcome')

@section('style', asset('css/home.css'))

@section('title', 'To-Do')


@section('content')

    <div class="row">
        <div class="img-slider col  d-flex  justify-content-center flex-column align-items-center ">

            <div class="item">
                <div class="img">
                    <img src="{{ asset('media/Frame 2.png') }}" alt="" srcset="">
                </div>
                <div class="icons my-2">
                    <div class="active line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <h1>
                    Manage your tasks
                </h1>
                <p>
                    You can easily manage all of your daily tasks in DoMe for free
                </p>
                <div class="foot">
                    <button onclick="nextMove()"  class="btn  btn-dark  next"> NEXT </button>
                </div>

            </div>

            <div class="item">
                <div class="img">
                    <img src="{{ asset('media/Frame 3.png') }}" alt="" srcset="">
                </div>
                <div class="icons my-2">
                    <div class="line"></div>
                    <div class="active line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <h1>
                    Manage your tasks
                </h1>
                <p>
                    You can easily manage all of your daily tasks in DoMe for free
                </p>
                <div class="foot">
                    <button onclick="backMove()"  class="btn text-white back"> BACK </button>
                    <button onclick="nextMove()"  class="btn  btn-dark  next"> NEXT </button>
                </div>
            </div>

            <div class="item">
                <div class="img">
                    <img src="{{ asset('media/Group 1.png') }}" alt="" srcset="">
                </div>
                <div class="icons my-2">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="active line"></div>
                    <div class="line"></div>
                </div>
                <h1>
                    Manage your tasks
                </h1>
                <p>
                    You can easily manage all of your daily tasks in DoMe for free
                </p>
                <div class="foot">
                    <button onclick="backMove()"  class="btn text-white back"> BACK </button>
                    <button onclick="nextMove()"  class="btn  btn-dark  next"> NEXT </button>
                </div>
            </div>
            <div class="item">
                <div class="img">
                    <img src="{{ asset('media/Vector.png') }}" alt="" srcset="">
                </div>
                <div class="join">
                    @auth
                    <a class="btn btn-primary "  href="{{ route('allTasks') }}" > Home </a>

                    @else
                    <a class="btn btn-primary "  href="{{ route('login') }}" > Login </a>
                    <a class="btn  btn-warning "  href="{{ route('register') }}"> Register </a>

                    @endauth

                </div>

            </div>

        </div>
    </div>


@endsection

@section('script')
    <script src="{{ asset('js/home.js') }}"></script>
@endsection
