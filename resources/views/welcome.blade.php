@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to the Member Management System</h1>
            <a href="{{ route('members.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Go to Members List</a>
        </div>
    </div>
@endsection
