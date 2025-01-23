@extends('layouts.app')

@section('title', 'Welcome to the Clinical Decision Support')

@section('content')
<div class="container mx-auto mt-10 text-center">
    <h1 class="text-3xl font-bold mb-4">Welcome to the Clinical Decision Support System</h1>
    <p class="text-lg text-gray-700 mb-8">
        Empowering healthcare professionals with intelligent decision-making tools.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-2">Decision Support</h2>
            <p class="text-gray-600">Manage and review clinical decision support data and recommendations.</p>
            <a href="{{ route('decision-support.index') }}" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                View Decision Support
            </a>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-2">Coming Soon</h2>
            <p class="text-gray-600">Stay tuned for upcoming features to enhance clinical decision-making.</p>
            <a href="#" class="inline-block mt-4 px-4 py-2 bg-gray-400 text-white rounded cursor-not-allowed">
                Explore
            </a>
        </div>
    </div>
</div>
@endsection