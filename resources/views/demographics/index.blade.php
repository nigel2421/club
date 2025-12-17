@extends('layouts.app')

@section('title', 'Demographics')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Demographics</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="border rounded-lg p-4">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="border rounded-lg p-4">
                <canvas id="memberTypeChart"></canvas>
            </div>
            <div class="border rounded-lg p-4">
                <canvas id="genderChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($statusData)) !!},
                datasets: [{
                    label: 'Member Status',
                    data: {!! json_encode(array_values($statusData)) !!},
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });

        // Member Type Chart
        const memberTypeCtx = document.getElementById('memberTypeChart').getContext('2d');
        new Chart(memberTypeCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($memberTypeData)) !!},
                datasets: [{
                    label: 'Member Types',
                    data: {!! json_encode(array_values($memberTypeData)) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });

        // Gender Chart
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($genderData)) !!},
                datasets: [{
                    label: 'Gender Distribution',
                    data: {!! json_encode(array_values($genderData)) !!},
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
@endsection
