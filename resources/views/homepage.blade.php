@extends('layouts.app')

@section('title', 'Welcome to the CDS App')

@section('content')
<div class="container text-center">
    <h1 class="my-4">Welcome to the Clinical Decision Support System</h1>
    <p class="lead">
        Empowering healthcare professionals with intelligent decision-making tools.
    </p>

    <div class="row mt-5">
        <!-- Link to Decision Support Feature -->
        <div class="col-md-6">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Decision Support</h5>
                    <p class="card-text">Manage and review clinical decision support data and recommendations.</p>
                    <a href="{{ route('decision-support.index') }}" class="btn btn-primary">View Decision Support</a>
                </div>
            </div>
        </div>

        <!-- Placeholder for Future Features -->
        <div class="col-md-6">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Coming Soon</h5>
                    <p class="card-text">Stay tuned for upcoming features to enhance clinical decision-making.</p>
                    <a href="#" class="btn btn-secondary disabled">Explore</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection