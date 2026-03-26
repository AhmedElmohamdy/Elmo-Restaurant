@extends('Shared_Layouts.SharedAdminView')

@section('Title') Admin Dashboard @endsection

@section('Content')
<div class="container-fluid py-4">

    {{-- ── Stats Cards ──────────────────────────────────── --}}
    <div class="row mb-4">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-primary border-4 shadow h-100 py-2">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Bookings</div>
                        <div class="h4 fw-bold text-dark mb-0">{{ $totalBookings }}</div>
                    </div>
                    <div class="fs-1 text-secondary opacity-25">📅</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-warning border-4 shadow h-100 py-2">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs fw-bold text-warning text-uppercase mb-1">Pending Bookings</div>
                        <div class="h4 fw-bold text-dark mb-0">{{ $pendingBookings }}</div>
                    </div>
                    <div class="fs-1 text-secondary opacity-25">⏳</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-success border-4 shadow h-100 py-2">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs fw-bold text-success text-uppercase mb-1">Total Products</div>
                        <div class="h4 fw-bold text-dark mb-0">{{ $totalProducts }}</div>
                    </div>
                    <div class="fs-1 text-secondary opacity-25">🍽️</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-info border-4 shadow h-100 py-2">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs fw-bold text-info text-uppercase mb-1">Total Reviews</div>
                        <div class="h4 fw-bold text-dark mb-0">{{ $totalReviews }}</div>
                    </div>
                    <div class="fs-1 text-secondary opacity-25">⭐</div>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Charts Row 1 ─────────────────────────────────── --}}
    <div class="row mb-4">

        {{-- Bookings per month --}}
        <div class="col-xl-8 mb-4">
            <div class="card shadow h-100">
                <div class="card-header fw-bold text-primary">📈 Bookings Per Month</div>
                <div class="card-body">
                    <canvas id="bookingsLineChart" height="100"></canvas>
                </div>
            </div>
        </div>

        {{-- Bookings by status --}}
        <div class="col-xl-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header fw-bold text-primary">🥧 Bookings by Status</div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="bookingsPieChart" height="200"></canvas>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Charts Row 2 ─────────────────────────────────── --}}
    <div class="row mb-4">

        {{-- Products per category --}}
        <div class="col-xl-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header fw-bold text-primary">📊 Products Per Category</div>
                <div class="card-body">
                    <canvas id="categoryBarChart" height="120"></canvas>
                </div>
            </div>
        </div>

        {{-- Reviews per month --}}
        <div class="col-xl-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header fw-bold text-primary">⭐ Reviews Per Month</div>
                <div class="card-body">
                    <canvas id="reviewsLineChart" height="120"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@section('scripts')
<script>
    const monthLabels        = @json($monthLabels);
    const bookingsMonthData  = @json($monthData);
    const acceptedCount      = {{ $acceptedCount }};
    const pendingCount       = {{ $pendingCount }};
    const categoryLabels     = @json($categoryLabels);
    const categoryData       = @json($categoryProductCount);
    const reviewData         = @json($reviewData);

    // ── Bookings per month (Line) ──────────────────────────
    new Chart(document.getElementById('bookingsLineChart'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Bookings',
                data: bookingsMonthData,
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78,115,223,0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // ── Bookings by status (Pie) ───────────────────────────
    new Chart(document.getElementById('bookingsPieChart'), {
        type: 'doughnut',
        data: {
            labels: ['Accepted', 'Pending'],
            datasets: [{
                data: [acceptedCount, pendingCount],
                backgroundColor: ['#1cc88a', '#f6c23e'],
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // ── Products per category (Bar) ────────────────────────
    new Chart(document.getElementById('categoryBarChart'), {
        type: 'bar',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Products',
                data: categoryData,
                backgroundColor: [
                    '#4e73df','#1cc88a','#36b9cc',
                    '#f6c23e','#e74a3b','#858796'
                ],
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // ── Reviews per month (Line) ───────────────────────────
    new Chart(document.getElementById('reviewsLineChart'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Reviews',
                data: reviewData,
                borderColor: '#1cc88a',
                backgroundColor: 'rgba(28,200,138,0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
</script>
@endsection
