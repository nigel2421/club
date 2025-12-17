@extends('layouts.app')

@section('title', 'Members')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Members</h1>
            <div>
                <a href="{{ route('overview') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Overview</a>
                <a href="{{ route('members.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Member</a>
                <a href="{{ route('members.showUploadForm') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Upload Members</a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{!! session('error') !!}</span>
            </div>
        @endif

        <div class="mb-4">
            <form action="{{ route('members.index') }}" method="GET">
                <input type="text" name="search" placeholder="Search..." class="px-4 py-2 border rounded w-full" value="{{ request('search') }}">
            </form>
        </div>

        @if ($members->isEmpty())
            <p class="text-gray-700">No members found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Member Number</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Member Type</th>
                            <th class="px-4 py-2">Phone Number</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">DOB</th>
                            <th class="px-4 py-2">Age</th>
                            <th class="px-4 py-2">DOJ</th>
                            <th class="px-4 py-2">Profession</th>
                            <th class="px-4 py-2">Race</th>
                            <th class="px-4 py-2 text-center" colspan="6">Subscriptions</th>
                            <th class="px-4 py-2">Minimum Spent</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                        <tr>
                            <th colspan="10"></th>
                            @for ($year = 2020; $year <= 2025; $year++)
                                <th class="px-4 py-2">{{ $year }}</th>
                            @endfor
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td class="border px-4 py-2">{{ $member->member_number }}</td>
                                <td class="border px-4 py-2">{{ $member->name }}</td>
                                <td class="border px-4 py-2">{{ $member->member_type }}</td>
                                <td class="border px-4 py-2">{{ $member->phone_number }}</td>
                                <td class="border px-4 py-2">{{ $member->email }}</td>
                                <td class="border px-4 py-2">{{ $member->date_of_birth }}</td>
                                <td class="border px-4 py-2">{{ $member->age }}</td>
                                <td class="border px-4 py-2">{{ $member->doj }}</td>
                                <td class="border px-4 py-2">{{ $member->profession }}</td>
                                <td class="border px-4 py-2">{{ $member->race }}</td>
                                @for ($year = 2020; $year <= 2025; $year++)
                                    <td class="border px-4 py-2 text-center">
                                        @php
                                            $subscription = $member->subscriptions->firstWhere('year', $year);
                                        @endphp
                                        {{ $subscription ? '$' . number_format($subscription->revenue, 2) : 'N/A' }}
                                    </td>
                                @endfor
                                <td class="border px-4 py-2">{{ $member->minimum_spent }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('members.show', $member->id) }}" class="text-blue-500">View</a>
                                    <a href="{{ route('members.edit', $member->id) }}" class="text-yellow-500">Edit</a>
                                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $members->appends(['search' => request('search')])->links() }}
            </div>
        @endif
    </div>
@endsection
