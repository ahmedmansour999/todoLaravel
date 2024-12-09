<style>
    .alert .alertBtn {
        background: transparent;
        border: none;
    }

    .alertDiv {
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .alertDiv.hide {
        opacity: 0;
        visibility: hidden;
    }
</style>


@if (session('success'))
    <div class="alert alert-success alertDiv">
        {{ session('success') }} <button class="alertBtn"> <i class="fas fa-xmark"></i> </button>
    </div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger mx-5 my-2 alertDiv ">
            {{ $error }} <button class="alertBtn"> <i class="fas fa-xmark"></i> </button>
        </div>
    @endforeach
@endif
