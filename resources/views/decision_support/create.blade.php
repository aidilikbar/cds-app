@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Add Decision Support Entry</h2>

            <form action="{{ route('decision-support.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="patient_id" class="block text-gray-700 font-medium mb-2">Patient</label>
                    <select name="patient_id" id="patient_id" class="w-full border-gray-300 rounded-md">
                        <option value="">Select a Patient</option>
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="analysis_data" class="block text-gray-700 font-medium mb-2">Analysis Data (JSON)</label>
                    <textarea name="analysis_data" id="analysis_data" rows="10" class="w-full border-gray-300 rounded-md">
{
    "condition": "hypertension",
    "severity": "mild",
    "observations": [
        {
            "type": "blood_pressure",
            "value": "140/90",
            "timestamp": "2025-01-19T10:00:00Z"
        },
        {
            "type": "heart_rate",
            "value": 80,
            "timestamp": "2025-01-19T10:05:00Z"
        }
    ]
}
                </textarea>
                    @error('analysis_data')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="recommendation" class="block text-gray-700 font-medium mb-2">Recommendation</label>
                    <textarea name="recommendation" id="recommendation" rows="3"
                              class="w-full border-gray-300 rounded-md"></textarea>
                    @error('recommendation')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">
                        Submit
                    </button>
                    <a href="{{ route('decision-support.index') }}" class="ml-2 bg-gray-300 text-gray-800 px-4 py-2 rounded shadow hover:bg-gray-400">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection