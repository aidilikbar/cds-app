@extends('layouts.app')

@section('title', 'Add Decision Support Entry')

@section('content')
<h1 class="h4 mb-3">Add Decision Support Entry</h1>

<form action="{{ route('decision-support.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="patient_id" class="form-label">Patient</label>
        <select name="patient_id" id="patient_id" class="form-select" required>
            <option value="">Select a Patient</option>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="analysis_data" class="form-label">Analysis Data (JSON)</label>
        <textarea name="analysis_data" id="analysis_data" class="form-control" rows="4" required>
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
    </div>

    <div class="mb-3">
        <label for="recommendation" class="form-label">Recommendation</label>
        <textarea name="recommendation" id="recommendation" class="form-control" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection