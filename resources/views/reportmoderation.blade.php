@extends('layout')

@section('title', 'Admin - Report Details')

@push('page-css')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link href="{{ asset('assets/css/reportmoderation.css') }}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('page-js')
<script src="{{ asset('assets/js/reportmoderation.js') }}"></script>
@endpush

@section('content')
<div id="moderation-page-content">
<div class="page-wrapper">
    <div class="header-row">
        <div class="title">REPORT DETAILS</div>
        <div class="filter-right">
            <button class="year-btn">2026</button>
            <button class="all-btn" onclick="resetFilters()">All</button>
            
        </div>
    </div>

    <div class="list-label">LIST OF THE REPORTS</div>
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search reports...">

    <div class="table-container">
        <table id="reportTable">
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Food Name</th>
                    <th>Category</th>
                    <th>Donor</th>
                    <th>Recipient</th>
                    <th>Qty</th>
                    <th>Expiry</th>
                    <th>Location</th>
                    <th>Date Submitted</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $index => $report)
                @php
                    $foodNames = ['Nasi Ayam', 'Bakso', 'Roti Gardenia', 'Mee Kari', 'Sandwich Telur', 'Laksa'];
                    $categories = ['Rice Meals', 'Noodles', 'Bread & Pastries', 'Noodles', 'Bread & Pastries', 'Noodles'];
                    $donors = ['Azri', 'Imane', 'Sya', 'Hafie', 'Ina', 'Ahmad'];
                    $recipients = ['Aiman', 'Mawarda', 'Habibah', 'Malik', 'Syae', 'Izrin'];
                    $quantities = [1, 1, 2, 1, 1, 2];
                    $expiries = ['04/12/2025', '30/11/2025', '21/09/2025', '11/05/2025', '27/03/2025', '07/01/2025'];
                    $submittedDates = ['04/12/2025', '30/11/2025', '22/09/2025', '12/05/2025', '27/03/2025', '07/01/2025'];
                    $locations = ['Mahallah Zubair Al-Awwam', 'Mahallah Hafsah', 'Mahallah Aminah', 'Mahallah Al-Faruq', 'Mahallah Nusaibah', 'Mahallah As-Siddiq'];
                    
                    $staticReasons = [
                        'Food spoiled / smell bad',
                        'Donor did not come to the pickup point',
                        'The bread has mold in it',
                        'Has insects in the food',
                        'Bread moldy',
                        'Laksa has awful smell'
                    ];

                    $staticImages = [
                        'https://images.deliveryhero.io/image/fd-my/LH/f42w-hero.jpg?width=512&height=384&quality=45',
                        'https://mahallah.iium.edu.my/hafsah/wp-content/uploads/sites/11/2021/02/IMG-20210207-WA0040.jpg',
                        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScn5P27QdgeD4V7ki7aP5t5VFa-0L_axyG_Q&s',
                        'https://cdn.rasa.my/2022/02/Untitled-design-87.jpg',
                        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQt-7gGPsKPqBvn428MT7eM7PWlymul0kedXw&s',
                        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtIZtZco2mktkUllO9HJGO0-MZZAbdj0rQkg&s'
                    ];

                    $i = $index % 6;
                @endphp
                <tr onclick="showDetails(this)" 
                    data-id="{{ $report->id }}" 
                    data-reason="{{ $staticReasons[$i] }}"
                    data-comment="{{ $report->admin_comment }}"
                    data-proof="{{ $staticImages[$i] }}">
                    
                    <td>{{ sprintf('%02d', $index + 1) }}</td>
                    <td>{{ $foodNames[$i] }}</td>
                    <td>{{ $categories[$i] }}</td>
                    <td>{{ $donors[$i] }}</td>
                    <td>{{ $recipients[$i] }}</td>
                    <td>{{ $quantities[$i] }}</td>
                    <td>{{ $expiries[$i] }}</td>
                    <td>{{ $locations[$i] }}</td>
                    <td>{{ $submittedDates[$i] }}</td>
                    <td>
                        <span class="badge {{ strtolower(str_replace(' ', '-', $report->status)) }}">
                            {{ strtoupper($report->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

<div class="modal-bg" id="modalBg">
    <div class="modal-box">
        <h2 style="border-bottom: 2px solid #b21d04; padding-bottom: 10px; color: #b21d04;">Report Details</h2>
        
        <div id="modalContent"></div>

        <div style="margin-top:20px;">
            <strong>Proof Provided:</strong>
            <div id="proofContainer" style="margin-top:10px;"></div>
        </div>
        
        <div id="commentSection" style="margin-top:15px;"></div>
        <div id="adminActions" style="margin-top:20px;"></div>
        
        <button class="close-btn" onclick="closeModal()">Close</button>
    </div>
</div>

@endsection