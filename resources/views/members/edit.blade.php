@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Edit Member</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="list-disc mt-2 ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('members.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name', $member->name) }}" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email', $member->email) }}" required>
            </div>
            <div class="mb-4">
                <label for="contact_details" class="block text-gray-700 text-sm font-bold mb-2">Contact Details:</label>
                <input type="text" name="contact_details" id="contact_details" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('contact_details', $member->contact_details) }}" required>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="good_standing" {{ old('status', $member->status) == 'good_standing' ? 'selected' : '' }}>Good Standing</option>
                    <option value="delinquent" {{ old('status', $member->status) == 'delinquent' ? 'selected' : '' }}>Delinquent</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="member_type" class="block text-gray-700 text-sm font-bold mb-2">Member Type:</label>
                <select name="member_type" id="member_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="regular" {{ old('member_type', $member->member_type) == 'regular' ? 'selected' : '' }}>Regular</option>
                    <option value="premium" {{ old('member_type', $member->member_type) == 'premium' ? 'selected' : '' }}>Premium</option>
                    <option value="vip" {{ old('member_type', $member->member_type) == 'vip' ? 'selected' : '' }}>VIP</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="date_of_birth" class="block text-gray-700 text-sm font-bold mb-2">Date of Birth:</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('date_of_birth', $member->date_of_birth) }}" required>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Member
                </button>
                <a href="{{ route('members.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
