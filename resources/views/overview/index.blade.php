@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Overview') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Total Members</h3>
                                <p class="text-4xl font-bold text-gray-900">{{ $totalMembers }}</p>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Active Members</h3>
                                <p class="text-4xl font-bold text-green-500">{{ $activeMembers }}</p>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Inactive Members</h3>
                                <p class="text-4xl font-bold text-red-500">{{ $inactiveMembers }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800">Member Sign-ups (Last 30 Days)</h3>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <canvas id="memberSignupsChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Members</h3>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <ul class="divide-y divide-gray-200">
                                    @foreach($recentMembers as $member)
                                        <li class="py-4 flex">
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">{{ $member->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $member->email }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('memberSignupsChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartData['labels']) !!},
                    datasets: [{
                        label: 'Member Sign-ups',
                        data: {!! json_encode($chartData['data']) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush
