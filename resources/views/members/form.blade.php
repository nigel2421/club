@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ isset($member) ? 'Edit Member' : 'Add Member' }}</h2>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <form action="{{ isset($member) ? route('members.update', $member->id) : route('members.store') }}" method="POST">
            @csrf
            @if(isset($member))
                @method('PUT')
            @endif
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" value="{{ old('name', $member->name ?? '') }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" value="{{ old('email', $member->email ?? '') }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="member_number">
                    Member Number
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="member_number" type="text" name="member_number" value="{{ old('member_number', $member->member_number ?? '') }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="contact_details">
                    Contact Details
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="contact_details" type="text" name="contact_details" value="{{ old('contact_details', $member->contact_details ?? '') }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                    Status
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="status" name="status">
                    <option value="good_standing" {{ old('status', $member->status ?? '') == 'good_standing' ? 'selected' : '' }}>Good Standing</option>
                    <option value="defaulted" {{ old('status', $member->status ?? '') == 'defaulted' ? 'selected' : '' }}>Defaulted</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="member_type">
                    Member Type
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="member_type" name="member_type">
                    <option value="town" {{ old('member_type', $member->member_type ?? '') == 'town' ? 'selected' : '' }}>Town</option>
                    <option value="life" {{ old('member_type', $member->member_type ?? '') == 'life' ? 'selected' : '' }}>Life</option>
                    <option value="upcountry" {{ old('member_type', $member->member_type ?? '') == 'upcountry' ? 'selected' : '' }}>Upcountry</option>
                    <option value="junior" {{ old('member_type', $member->member_type ?? '') == 'junior' ? 'selected' : '' }}>Junior</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date_of_birth">
                    Date of Birth
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth', $member->date_of_birth ?? '') }}">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    {{ isset($member) ? 'Update Member' : 'Add Member' }}
                </button>
            </div>
        </form>
    </div>
@endsection
