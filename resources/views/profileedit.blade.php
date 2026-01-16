@extends('layout')

@section('title', 'Edit Profile - ShareAMeal')
@section('body-class', 'profile-page')

@push('page-css')
<link href="{{ asset('assets/css/profileedit.css') }}" rel="stylesheet">
@endpush
@push('page-js')
<script src="{{ asset('assets/js/profileedit.js') }}"></script>
@endpush


@section('content')
<main class="container profile-wrapper">

    <!-- PROFILE TITLE -->
    <div class="profile-title">EDIT PROFILE</div>

    <div class="row mt-4">

        <!-- LEFT COLUMN -->
        <div class="col-md-4 profile-left">
            <!-- Avatar with upload -->
<div class="profile-avatar-card upload-avatar">
    <svg viewBox="0 0 240 240">
        <circle cx="120" cy="120" r="50" fill="#f4d4ba" />
        <circle cx="102" cy="115" r="5" fill="#2b2b2b" />
        <circle cx="138" cy="115" r="5" fill="#2b2b2b" />
        <path d="M102 140 q18 14 36 0" stroke="#2b2b2b" stroke-width="4" fill="none" stroke-linecap="round"/>
    </svg>

    <!-- Hidden File Input -->
    <input type="file" id="avatarInput" accept="image/*" style="display:none;">

    <!-- Upload Icon -->
    <button type="button" class="avatar-upload-btn" id="avatarUploadBtn" title="Change Avatar">
        📤
    </button>
</div>


            <!-- Streak -->
            <div class="streak-card mt-3">
                <img src="https://img.freepik.com/free-psd/star-cup-3d-icon-illustration-background_56104-2821.jpg?semt=ais_hybrid&w=740&q=80" alt="trophy">
                <div class="streak-text">
                    <h5>Streak</h5>
                    <h2>5</h2>
                </div>
            </div>

            <!-- Back to Profile -->
            <a href="{{ route('profile') }}" class="btn-update mt-3">BACK TO PROFILE</a>
        </div>

        <!-- RIGHT COLUMN -->
<div class="col-md-8 profile-right">
    <div class="profile-info-card">

        <!-- Name + Date -->
        <div class="profile-info-row">
            <input type="text" name="name" class="profile-name" value="{{ $user->name }}">
            <div class="profile-date">{{ now()->format('D, d M Y') }}</div>
        </div>

        <!-- Editable Form -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="profile-form row g-3">
                <div class="col-md-6">
                    <label>Matric No</label>
                    <input type="text" class="form-control readonly-input" name="matric_no" value="{{ $user->matric_no }}" readonly>
                </div>

                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                </div>

                <div class="col-md-6">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current">
                </div>

                <div class="col-md-6">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password">
                </div>
            </div>
        </form>
    </div> <!-- END profile-info-card -->

    <!-- Action Buttons OUTSIDE THE BOX -->
    <div class="profile-actions mt-3 d-flex flex-wrap gap-2 justify-content-center">
        <button type="button" id="deleteBtn" class="btn-delete">DELETE ACCOUNT</button>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            <button type="submit" class="btn-save">SAVE</button>
        </form>
        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
           class="btn-logout">
           LOG OUT
        </a>

        {{-- Hidden logout form --}}
        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
            @csrf
        </form>
        {{-- Hidden Delete Form --}}
        <form id="delete-account-form" method="POST" action="{{ route('profile.destroy') }}" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    </div>

</div>


        

            </div>
        </div>
    </div>
</main>

<!-- Confirmation Box -->
<div class="confirm-box" id="confirmBox">
    <div class="confirm-content">
        <p>Are you sure you want to delete your account?</p>
        <div class="confirm-buttons">
            <button type="button" id="cancelDelete" class="btn-cancel">Cancel</button>
            <button type="button" id="confirmDelete" class="btn-confirm-delete">Delete</button>
        </div>
    </div>
</div>
@endsection
