@extends('layouts.main')

@section('title', 'Minerstat Hardware')

@section('content')
    <h2>Hardware Stats for {{ $workerId }}</h2>

    @if (!empty($gpu))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>GPU</th>
                    <th>Temp (¡ÆC)</th>
                    <th>Fan (%)</th>
                    <th>Core Clock (MHz)</th>
                    <th>Memory Clock (MHz)</th>
                    <th>Power (W)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gpu as $gpuInfo)
                    <tr>
                        <td>{{ $gpuInfo['name'] ?? 'N/A' }}</td>
                        <td>{{ $gpuInfo['temp'] ?? '-' }}</td>
                        <td>{{ $gpuInfo['fan'] ?? '-' }}</td>
                        <td>{{ $gpuInfo['coreClock'] ?? '-' }}</td>
                        <td>{{ $gpuInfo['memClock'] ?? '-' }}</td>
                        <td>{{ $gpuInfo['power'] ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No GPU data found or worker not reporting.</p>
    @endif
@endsection