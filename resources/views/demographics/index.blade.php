@extends('layouts.app')

@section('title', 'Demographics')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Demographics</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="border rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-2">Member Status</h2>
                <canvas id="statusChart"></canvas>
            </div>
            <div class="border rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-2">Member Types</h2>
                <canvas id="memberTypeChart"></canvas>
            </div>
            <div class="border rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-2">Gender Distribution</h2>
                <canvas id="genderChart"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-4 mt-8">
            <div class="border rounded-lg p-4 flex flex-col items-center justify-center">
                <h2 class="text-xl font-semibold mb-2">Average Member Age</h2>
                <p class="text-4xl font-bold">{{ $averageAge }}</p>
            </div>
            <div class="border rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-2">Profession Distribution</h2>
                <canvas id="professionChart"></canvas>
            </div>
            <div class="border rounded-lg p-4">
                <h2 class="text-xl font-semibold mb-2">Race Distribution</h2>
                <canvas id="raceChart"></canvas>
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
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
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

        // Profession Chart
        const professionCtx = document.getElementById('professionChart').getContext('2d');
        new Chart(professionCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($professionData)) !!},
                datasets: [{
                    label: 'Profession',
                    data: {!! json_encode(array_values($professionData)) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            }
        });

        // Race Chart
        const raceCtx = document.getElementById('raceChart').getContext('2d');
        new Chart(raceCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($raceData)) !!},
                datasets: [{
                    label: 'Race',
                    data: {!! json_encode(array_values($raceData)) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
@endsection
