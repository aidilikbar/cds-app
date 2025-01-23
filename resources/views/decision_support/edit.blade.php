@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Decision Support Entry</h1>

    <form method="POST" action="{{ route('decision-support.update', $data->id) }}">
        @csrf
        @method('PUT')

        <!-- Patient Dropdown -->
        <div class="mb-4">
            <label for="patient_id" class="block text-gray-700 font-bold">Patient</label>
            <select name="patient_id" id="patient_id" class="w-full border-gray-300 rounded-md">
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ $patient->id == $data->patient_id ? 'selected' : '' }}>
                        {{ $patient->user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Analysis Data -->
        <div class="mb-4">
            <label for="analysis_data" class="block text-gray-700 font-bold">Analysis Data</label>
            <textarea name="analysis_data" id="analysis_data" rows="5" class="w-full border-gray-300 rounded-md">
                {{ $data->analysis_data }}
            </textarea>
        </div>

        <!-- Recommendation -->
        <div class="mb-4">
            <label for="recommendation" class="block text-gray-700 font-bold">Recommendation</label>
            <input type="text" name="recommendation" id="recommendation" value="{{ $data->recommendation }}" class="w-full border-gray-300 rounded-md">
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('decision-support.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection