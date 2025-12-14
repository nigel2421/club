@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-700">Gender Distribution</h3>
            <canvas id="genderChart"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-700">Member Type Distribution</h3>
            <canvas id="memberTypeChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Gender Chart
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'pie',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    label: 'Gender Distribution',
                    data: [{{ $genderDistribution['male'] }}, {{ $genderDistribution['female'] }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
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
                labels: [@foreach($memberTypes as $type => $count)'{{ $type }}',@endforeach],
                datasets: [{
                    label: 'Member Type Distribution',
                    data: [@foreach($memberTypes as $type => $count){{ $count }},@endforeach],
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
    </script>
@endsection
