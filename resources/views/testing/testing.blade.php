@extends('layouts.KKP')

@section('testing')
    <h1>Hello, this is a sample Laravel view!</h1>

    <!-- Button to trigger the alert -->
    <button type="button" onclick="happy()" class="alert-red">Default</button>

    <!-- Your JavaScript code -->
    <script src="{{ asset('js/testing.js') }}"></script>
@endsection
