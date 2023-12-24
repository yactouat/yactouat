@extends('components.layout')

@section('title', 'systems status')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-xl font-semibold mb-4">systems status</h1>
        <p class="mb-4">{{ $systemsStatus }}</p>
        <p>you can check application logs @ <a 
            href="https://console.cloud.google.com/logs/query"
            target="_blank"
        >https://console.cloud.google.com/logs/query</a></p>
    </div>    
@endsection
