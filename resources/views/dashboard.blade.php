@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-700">Total Members</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $totalMembers }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-700">Good Standing</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $goodStandingMembers }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-700">Average Age</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $averageAge }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-700">Member Types</h3>
            <ul>
                @foreach($memberTypes as $type => $count)
                    <li>{{ $type }}: {{ $count }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
