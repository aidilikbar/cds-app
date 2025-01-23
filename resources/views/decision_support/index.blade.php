@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold">Decision Support Entries</h1>
            <a href="{{ route('decision-support.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition">
                Add New Entry
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Analysis Data</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Recommendation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($data as $entry)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $entry->id }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $entry->patient->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @if ($entry->decoded_analysis_data)
                                    <div>
                                        <strong>Condition:</strong> {{ $entry->decoded_analysis_data['condition'] ?? 'N/A' }}<br>
                                        <strong>Severity:</strong> {{ $entry->decoded_analysis_data['severity'] ?? 'N/A' }}<br>
                                        <strong>Observations:</strong>
                                        <ul class="list-disc ml-6">
                                            @foreach ($entry->decoded_analysis_data['observations'] as $observation)
                                                <li>
                                                    <strong>Type:</strong> {{ $observation['type'] ?? 'N/A' }},
                                                    <strong>Value:</strong> {{ $observation['value'] ?? 'N/A' }},
                                                    <strong>Timestamp:</strong> {{ $observation['timestamp'] ?? 'N/A' }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <strong>Recommendation:</strong> {{ $entry->recommendation ?? 'N/A' }}
                                    </div>
                                @else
                                    <em>No Analysis Data</em>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-500">{{ $entry->recommendation }}</td>
                            <td class="px-6 py-4 text-sm space-x-2">
                                <a href="{{ route('decision-support.edit', $entry->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                    Edit
                                </a>
                                <form action="{{ route('decision-support.destroy', $entry->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection