@extends('frontend.master')

@section('body')

    <div class="error-area ptb-100">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="error-content">
                    <h1>4 <span>0</span> 4</h1>
                    <h3>Oops! Page Not Found</h3>
                    <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
                    <a href="{{ url()->previous() }}" class="default-btn">
                        Return To Previous Page
                    </a>
                    <a href="{{ url('/') }}" class="default-btn">
                        Return To Home Page
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
