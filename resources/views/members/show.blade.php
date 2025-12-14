@extends('layouts.app')

@section('title', 'View Member')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">View Member</h1>

        <div class="border rounded-lg p-4">
            <div class="mb-4">
                <p class="font-bold">Name:</p>
                <p>{{ $member->name }}</p>
            </div>
            <div class="mb-4">
                <p class="font-bold">Email:</p>
                <p>{{ $member->email }}</p>
            </div>
            <div class="mb-4">
                <p class="font-bold">Member Number:</p>
                <p>{{ $member->member_number }}</p>
            </div>
            <div class="mb-4">
                <p class="font-bold">Contact Details:</p>
                <p>{{ $member->contact_details }}</p>
            </div>
            <div class="mb-4">
                <p class="font-bold">Status:</p>
                <p>{{ $member->status }}</p>
            </div>
            <div class="mb-4">
                <p class="font-bold">Member Type:</p>
                <p>{{ $member->member_type }}</p>
            </div>
            <div class="mb-4">
                <p class="font-bold">Date of Birth:</p>
                <p>{{ $member->date_of_birth }}</p>
            </div>
            <div class="mt-4">
                <a href="{{ route('members.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Members List</a>
            </div>
        </div>
    </div>
@endsection
