@php
    $isEditMode = false;
    $totalCost = 0;
@endphp
@extends('index.index')

@section('app-title', 'Transaction (Preview)')

@section('app-content')
    <div class="alert alert-info ">
        <h1>Preview Mode</h1>
        <p>Click <a href=".">here</a> to come back</p>
        <p>Simplicity... Is everything!</p>
        <h2>Note:</h2>
        <p>This dummy data is not added from the database, lazy... Once again</p>
        <p>No button works for now... What a pity!</p>
    </div>

    <div class="container ">
        <div class="d-flex align-items-center sticky-top bg-body-secondary py-2 ">
            <a href="." class="me-3 ">
                <img src="{{ asset('vendor/bootstrap/icons/arrow-left.svg') }}" alt="back" width="150%">
            </a>
            <h1 class="fw-bold ">Transaction</h1>
        </div>
        <div class="p-3 bg-white d-flex flex-column rounded-2 gap-4">
            @if ($errors->any())
                <div class="alert alert-danger my-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="d-flex gap-3">
                <table class="table table-bordered table-striped h-100">
                    <tr>
                        <th>ID</th>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Cost Per Unit(s)</th>
                        <th>Buy Count</th>
                        <th>Cost</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($transactionBuyTemp as $transactionTemp)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transactionTemp->item_id }}</td>
                            <td>{{ $transactionTemp->item->name }}</td>
                            <td>{{ $transactionTemp->cost }}</td>
                            <td>{{ $transactionTemp->count }}</td>
                            <td>{{ $transactionTemp->cost * $transactionTemp->count }}</td>
                            <td class="d-flex justify-content-between">
                                <form action="{{ route("cashier.transaction.delete", ['id' => $transactionTemp->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $totalCost = $totalCost + ($transactionTemp->cost * $transactionTemp->count);
                        @endphp
                    @endforeach

                </table>
                <div class="container bg-secondary w-50 rounded-2 p-4">
                    <div class="text-center text-white">
                        <p class="fs-3 mb-0">Total</p>
                        <p class="fs-2 fw-bold">Rp {{ $totalCost }}</p>
                    </div>
                    <form action="{{ route('cashier.transaction.action') }}" method="POST" class="d-flex flex-column gap-3">
                        @csrf
                        <input type="hidden" name="totalCost" id="totalCost" value="{{ $totalCost }}">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="buy" id="buy" placeholder="">
                            <label for="buy">Buy</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" name="return" id="return" placeholder="" value="Auto Generated" disabled >
                            <label for="return">Return</label>
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Complete Transaction">
                        </div>
                    </form>
                </div>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRecord">Add Item Manually</button>
            <x-modal.form.layout
                viewPath="cashier.transaction"
                operation="store"
                :urlParameter="null"
                :isEditMode="$isEditMode"
                id="addRecord"
                title="Add a new Item to Buy">
                <div class="d-flex">
                    <div class="form-floating">
                        <select name="item_id" id="item_id" class="form-control">
                            @foreach ($transactionItems as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label for="item_id">Item to buy</label>
                    </div>
                    <div class="form-floating">
                        <input type="number" id="count" name="count" class="form-control">
                        <label for="count">Buy Count</label>
                    </div>
                </div>
            </x-modal.form.layout>
        </div>
    </div>
@endsection

