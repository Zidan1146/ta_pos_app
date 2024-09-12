@php
    $at = '@';
@endphp

@extends('index.index')

@section('app-title', 'Logs (Preview)')

@section('app-content')
    <div class="alert alert-info ">
        <h1>Preview Mode</h1>
        <p>Click <a href="..">here</a> to come back</p>
        <p>Simplicity... Is everything!</p>
    </div>
    <div class="d-flex align-items-center sticky-top bg-body-secondary py-2 ">
        <a href="{{ route('admin.index') }}" class="me-3 ">
            <img src="{{ asset('vendor/bootstrap/icons/arrow-left.svg') }}" alt="back" width="150%">
        </a>
        <h1 class="fw-bold ">Logs</h1>
    </div>
    <textarea class="form-control bg-white " disabled readonly cols="30" rows="100">
        @foreach ($logs as $log)
            {{ $log->performer }}{{ $at }}[{{ $log->created_at }}][{{ $log->tag }}]: {{ $log->message }}
        @endforeach
    </textarea>
@endsection
