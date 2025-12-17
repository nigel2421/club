@extends('layouts.app')

@section('title', 'View Member')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">View Member</h1>

        <div class="border rounded-lg p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                    <p class="font-bold">Phone Number:</p>
                    <p>{{ $member->phone_number }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-bold">Date of Joining:</p>
                    <p>{{ $member->doj }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-bold">Profession:</p>
                    <p>{{ $member->profession }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-bold">Race:</p>
                    <p>{{ $member->race }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-bold">Minimum Spent:</p>
                    <p>{{ $member->minimum_spent }}</p>
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
            </div>

            <div class="mt-4">
                <h2 class="text-xl font-bold mb-2">Subscriptions</h2>
                @if($member->subscriptions->isNotEmpty())
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Year</th>
                                <th class="px-4 py-2">Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($member->subscriptions as $subscription)
                                <tr>
                                    <td class="border px-4 py-2">{{ $subscription->year }}</td>
                                    <td class="border px-4 py-2">${{ number_format($subscription->revenue, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No subscriptions found for this member.</p>
                @endif
            </div>

            <div class="mt-4">
                <a href="{{ route('members.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Members List</a>
            </div>
        </div>
    </div>
@endsection
