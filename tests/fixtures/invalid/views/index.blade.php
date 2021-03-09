@extends('layout')

@section('content')
    @php
        $title = 'Hello world';
    @endphp

    <h1>{{ $title ?? 'Fallback title' }}</h1>
@endsection
