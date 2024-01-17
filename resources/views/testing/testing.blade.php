@extends('layouts.KKP')

@section('testing')
    <div class="flex justify-center p-5">
        <img id="dogPhoto" src="">
    </div>

    <div class="flex justify-center p-5">
        <button class="blue-button" onclick="getJoke()">this is a green button</button>
    </div>

    <div class="flex justify-center gap-10">
        <div class="border border-red-400">01</div>
        <div class="border border-blue-400">02</div>
        <div class="border border-green-400">03</div>
    </div>

    <!-- Your JavaScript code -->
    <script src="{{ asset('js/testing.js') }}"></script>
@endsection
