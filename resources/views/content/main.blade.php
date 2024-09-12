@extends('index.index')

@section('app-title', 'Main Page')

@section('app-content')
    <div class="alert alert-info ">
        <h1>Howdy!</h1>
        <p class="mb-0">This app is still on developement, but you can take a look at the UI by using these link below</p>
        <p class="m-0">Also, no Database Integration for the time being... Just the UI</p>
    </div>

    <h2>Client (Cashier in this case)</h2>
    <ul>
        <li>
            <a href="{{ route('login.index') }}">Login Page</a>
        </li>
        <li>
            <a href="{{ route('cashier.transaction.index') }}">Transaction</a>
        </li>
    </ul>

    <h2>Admin</h2>
    <ul>
        <li>
            <a href="{{ route('admin.login.index') }}">Login Page</a>
        </li>
        <li>
            <a href="{{ route('admin.index') }}">Main Menu</a>
        </li>
        <li>
            <a href="{{ route('admin.log') }}">Logs</a>
        </li>
        <li>
            <a href="{{ route('admin.transaction_history') }}">Transaction History (Detailed)</a>
        </li>
        <li>
            <a href="{{ route('admin.cashier.index') }}">Manage User</a>
        </li>
        <li>
            <a href="{{ route('admin.item.index') }}">Manage Item</a>
        </li>
    </ul>
@endsection
