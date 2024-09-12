@php
    use Carbon\Carbon;
    $itemCounter = 0;
@endphp

@extends('index.index')

@section('app-title', 'Transaction History (Preview)')

@section('app-content')
    <div class="alert alert-info ">
        <h1>Preview Mode</h1>
        <p>Click <a href="..">here</a> to come back</p>
        <p>Simplicity... Is everything!</p>
        <h2>Note:</h2>
        <p>This dummy data is not added from the database, lazy... Once again</p>
    </div>

    <div class="container ">
        <div class="d-flex align-items-center sticky-top bg-body-secondary py-2 ">
            <a href="{{ route('admin.index') }}" class="me-3 ">
                <img src="{{ asset('vendor/bootstrap/icons/arrow-left.svg') }}" alt="back" width="150%">
            </a>
            <h1 class="fw-bold ">Transaction History</h1>
        </div>
        <h2>Transaction Data</h2>
        <div class="p-3 bg-white d-flex flex-column rounded-2 gap-3">
            <p class="m-0">filter: none</p>
                @foreach ($timeData as $time)
                @php
                    $itemCounter = 0;
                @endphp
                    <div class="d-flex flex-column p-3 bg-success rounded-2 px-4 text-white fw-bold">
                        <p>Time: {{ $time->created_at }}</p>
                        <table class="table table-hover">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Item Name</th>
                                <th>Count</th>
                                <th>Cost</th>
                                <th>Pay</th>
                                <th>Date</th>
                            </tr>
                            @foreach ($transactionData as $transaction)
                                @if (Carbon::parse($transaction->date)->eq(Carbon::parse($time->created_at)))
                                    @php
                                        $itemCounter++;
                                    @endphp
                                    <tr class="text-center">
                                        <td>{{ $itemCounter }}</td>
                                        <td>{{ $transaction->itemName }}</td>
                                        <td>{{ $transaction->count }}</td>
                                        <td>{{ $transaction->cost }}</td>
                                        <td>{{ $transaction->pay }}</td>
                                        <td>{{ $transaction->date }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

