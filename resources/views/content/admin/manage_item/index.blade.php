@php
    $config = [
        'email' => [],
        'number' => ['sellCost', 'buyCost', 'quantity'],
        'password' => [],
        'date' => [],
        'datetime' => [],
        'hidden' => [],
        'tel' => [],
        'select' => [],
        'textarea' => ['description' => [10, 30]]
    ];

@endphp

@extends('index.index')

@section('app-title', 'Manage Item (Preview)')

@section('app-content')
    <div class="alert alert-info ">
        <h1>Preview Mode</h1>
        <p>Click <a href="../..">here</a> to come back</p>
        <p>Simplicity... Is everything!</p>
        <h2>Note:</h2>
        <p>This dummy data is not added from the database, lazy... Once again</p>
    </div>
    <div class="container ">
        <div class="d-flex align-items-center sticky-top bg-body-secondary py-2 ">
            <a href="{{ route('admin.index') }}" class="me-3 ">
                <img src="{{ asset('vendor/bootstrap/icons/arrow-left.svg') }}" alt="back" width="150%">
            </a>
            <h1 class="fw-bold ">Manage Item</h1>
        </div>
        <div class="p-3 bg-white d-flex flex-column rounded-2 gap-4">
            @foreach ($items as $item)
                <div class="action">
                    <x-modal.form.update
                        :iteration="$loop->index"
                        item="item"
                        viewPath="admin.item"
                        :rowCount="2"
                        :model="$item"
                        :inputTypeConfig="$config"
                        :isGenerated="true"
                        :urlParameter="['id' => $item->id ]"/>
                </div>
            @endforeach
            <h2 class="fw-bold text-center">Create New Item</h2>

            <x-form.store
                viewPath="admin.item"
                :isGenerated="false">

                <div class="container d-flex w-100 justify-content-between gap-3">
                    <div class="form-floating w-50">
                        <input type="text" class="form-control" name="code" id="code" placeholder="" value="Automatically Generated" disabled>
                        <label for="code">Item Code</label>
                    </div>
                    <div class="form-floating w-50">
                        <input type="number" class="form-control" name="sellCost" id="sellCost" placeholder="">
                        <label for="sellCost">Sell Cost</label>
                    </div>
                </div>
                <div class="container d-flex w-100 justify-content-between gap-3">
                    <div class="form-floating w-50">
                        <input type="text" class="form-control" name="name" id="name" placeholder="">
                        <label for="name">Item Name</label>
                    </div>
                    <div class="form-floating w-50">
                        <input type="number" class="form-control" name="buyCost" id="buyCost" placeholder="">
                        <label for="buyCost">Buy Cost</label>
                    </div>
                </div>
                <div class="container d-flex w-100 justify-content-between gap-3">
                    <div class="form-floating w-50">
                        <input type="number" class="form-control" name="quantity" id="count" placeholder="">
                        <label for="quantity">Item Quantity</label>
                    </div>
                    <div class="form-floating w-50">
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder=""></textarea>
                        <label for="description">Description</label>
                    </div>
                </div>

            </x-form.store>

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
                <h2 class="fw-bold">Item Data</h2>
                <form action="" method="GET" class="d-flex gap-3">
                    <input type="search" name="item-search" id="item-search" class="form-control" placeholder="Search...">
                    <input type="submit" name="submit" id="submit" value="Search" class="btn btn-primary px-3">
                </form>
            </div>

            <x-table.layout
            :dataModel="$items"
            :isIdShown="false">
                <x-slot name="data">
                    <x-table.data
                    :dataModel="$items"
                    viewPath="admin.item"
                    :isIdShown="false"/>
                </x-slot>
            </x-table.layout>
        </div>
    </div>
@endsection


