@php
    $config = [
        'email' => ['email'],
        'number' => [],
        'password' => ['password'],
        'date' => [],
        'datetime' => [],
        'hidden' => [],
        'tel' => [],
        'select' => ['gender' => ['male', 'female']],
        'textarea' => ['address' => [10, 30]]
    ];

@endphp

@extends('index.index')

@section('app-title', 'Manage User (Preview)')

@section('app-content')

    <div class="container ">
        @foreach ($cashiers as $cashier)
            <div class="action">
                <x-modal.form.update
                    :iteration="$loop->index"
                    item="cashier"
                    viewPath="admin.cashier"
                    :rowCount="2"
                    :model="$cashier"
                    :inputTypeConfig="$config"
                    :isGenerated="true"
                    :urlParameter="['id' => $cashier->id ]"/>
            </div>
        @endforeach

        <div class="d-flex align-items-center sticky-top bg-body-secondary py-2 ">
            <a href="{{ route('admin.index') }}" class="me-3 ">
                <img src="{{ asset('vendor/bootstrap/icons/arrow-left.svg') }}" alt="back" width="150%">
            </a>
            <h1 class="fw-bold ">Manage User</h1>
        </div>
        <div class="p-3 bg-white d-flex flex-column rounded-2 gap-4">

            <h2 class="fw-bold text-center">Create new Cashier</h2>
            <div class="my-3">
                <x-form.store
                    viewPath="admin.cashier"
                    :isGenerated="false">
                    <div class="d-flex gap-3">
                        <div class="form-floating w-50">
                            <input type="text" class="form-control" name="username" id="username" placeholder="">
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating w-50">
                            <input type="text" class="form-control" name="email" id="email" placeholder="">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="form-floating w-50">
                            <input type="password" class="form-control" name="password" id="password" placeholder="">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating w-50">
                            <input type="tel" class="form-control" name="telephone-number" id="telephone-number" placeholder="">
                            <label for="email">Telephone Number</label>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="form-floating w-50">
                            <select name="gender" id="gender" class="form-control">
                                <option value="-">-</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <label for="gender">Gender</label>
                        </div>
                        <div class="form-floating w-50">
                            <textarea name="address" id="address" cols="30" rows="10" class="form-control" placeholder=""></textarea>
                            <label for="address">Address</label>
                        </div>
                    </div>
                </x-form.store>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger my-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="d-flex justify-content-between">
                <h2 class="fw-bold">Account Data</h2>
                <form action="" method="GET" class="d-flex gap-3">
                    @csrf
                    <input type="search" name="item-search" id="item-search" class="form-control" placeholder="Search...">
                    <input type="submit" name="submit" id="submit" value="Search" class="btn btn-primary px-3">
                </form>
            </div>

            <x-table.layout
                :dataModel="$cashiers">
                <x-slot name="data">
                    <x-table.data
                        :dataModel="$cashiers"
                        viewPath="admin.cashier"
                        />
                </x-slot>
            </x-table.layout>
        </div>
    </div>
@endsection


