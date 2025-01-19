@extends('layouts.app')

@section('title', 'Edit Decision Support Entry')

@section('content')
<h1 class="h4 mb-3">Edit Decision Support Entry</h1>

<form action="{{ route('decision-support.update', $decisionSupport->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="patient_id" class="form-label">Patient</label>
        <select name="patient_id" id="patient_id" class="form-select" required>
            @foreach ($patients as $patient)
                <option value="{{ $patient->id }}" {{ $patient->id == $decisionSupport->patient_id ? 'selected' : '' }}>
                    {{ $patient->user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="analysis_data" class="form-label">Analysis Data (JSON)</label>
        <textarea name="analysis_data" id="analysis_data" class="form-control" rows="4" required>{{ $decisionSupport->analysis_data }}</textarea>
    </div>

    <div class="mb-3">
        <label for="recommendation" class="form-label">Recommendation</label>
        <textarea name="recommendation" id="recommendation" class="form-control" rows="4" required>{{ $decisionSupport->recommendation }}</textarea>
    </div>

    <div class="d-flex">
        <button type="submit" class="btn btn-primary me-2">Update</button>
        <a href="{{ route('decision-support.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection