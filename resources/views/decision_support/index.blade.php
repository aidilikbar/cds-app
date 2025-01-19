@extends('layouts.app')

@section('title', 'Decision Support Entries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4">Decision Support Entries</h1>
    <a href="{{ route('decision-support.create') }}" class="btn btn-primary">Add New Entry</a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Analysis Data</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($decisionSupports as $support)
            <tr>
                <td>{{ $support->id }}</td>
                <td>{{ $support->patient->user->name }}</td>
                <td>
                    <div class="analysis-data">
                        <span class="short-data">
                            {{ \Illuminate\Support\Str::limit(json_encode($support->analysis_data, JSON_PRETTY_PRINT), 50) }}
                        </span>
                        <span class="full-data d-none">
                            <pre>{{ json_encode($support->analysis_data, JSON_PRETTY_PRINT) }}</pre>
                        </span>
                        <a href="#" class="read-more btn btn-link p-0">Read More</a>
                    </div>
                </td>
                <td>
                    <a href="{{ route('decision-support.edit', $support->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('decision-support.destroy', $support->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No decision support entries found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const readMoreLinks = document.querySelectorAll('.read-more');

        readMoreLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const parent = this.closest('.analysis-data');
                const shortData = parent.querySelector('.short-data');
                const fullData = parent.querySelector('.full-data');

                if (fullData.classList.contains('d-none')) {
                    shortData.classList.add('d-none');
                    fullData.classList.remove('d-none');
                    this.textContent = 'Read Less';
                } else {
                    shortData.classList.remove('d-none');
                    fullData.classList.add('d-none');
                    this.textContent = 'Read More';
                }
            });
        });
    });
</script>