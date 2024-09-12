@extends('index.index')

@section('app-title', 'Client Login (Preview)')

@section('app-content')
    <div class="container-fluid ">
        <div class="alert alert-info ">
            <h1>Preview Mode</h1>
            <p>Click <a href=".">here</a> to come back</p>
            <h2>Note:</h2>
            <p>Login button will show error, I apologize and well... can't do anything about it</p>
        </div>
        <div class="h-100 d-flex justify-content-center align-items-center ">
            <div class="bg-white rounded-3 w-50 p-2 d-flex flex-column justify-content-center align-items-center ">
                <h1 class="mt-3">Wellcome!!!</h1>
                <div class="my-4 ">
                    <form action="{{ route('login.action') }}" method="POST">
                        @csrf
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control"  disabled readonly name="client-id" id="client-id" value="Generated Automatically">
                            <label for="client-id">ID</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <input type="password" class="form-control " name="client-password" id="client-password" placeholder="">
                            <label for="client-password " class="form-label ">Password</label>
                        </div>

                        <div class="d-flex justify-content-center ">
                            <input type="submit" value="Login" class="btn btn-primary ">
                        </div>
                    </form>
                </div>
                @if (session()->has('error'))
                    <div class="d-flex align-items-center ">
                        <p class="text-danger text-center text-wrap">{{ session('error') }}</p>
                    </div>
                @endif
                <footer class="my-3 d-flex flex-column align-items-center ">
                    <p class="m-0">A cool Company 2024-???</p>
                    <p class="m-0">All rights reserved</p>
                </footer>
            </div>
        </div>
    </div>
@endsection
