<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminNotification;
use App\Models\Book;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;

class AdminController extends Controller
{
    public function index()
    {
        // ── Cards ──────────────────────────────────────────
        $totalBookings   = Book::count();
        $pendingBookings = Book::where('status', 'pending')->count();
        $totalProducts   = Product::count();
        $totalReviews    = Review::count();

        // ── Bookings per month (last 6 months) ─────────────
        $bookingsPerMonth = Book::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $months     = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $monthLabels = [];
        $monthData   = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthLabels[] = $months[$i - 1];
            $monthData[]   = $bookingsPerMonth[$i] ?? 0;
        }

        // ── Bookings by status (pie) ────────────────────────
        $acceptedCount = Book::where('status', 'accepted')->count();
        $pendingCount  = Book::where('status', 'pending')->count();

        // ── Products per category (bar) ─────────────────────
        $categories        = Category::withCount('products')->get();
        $categoryLabels    = $categories->pluck('category_name');
        $categoryProductCount = $categories->pluck('products_count');

        // ── Reviews per month ───────────────────────────────
        $reviewsPerMonth = Review::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $reviewData = [];
        for ($i = 1; $i <= 12; $i++) {
            $reviewData[] = $reviewsPerMonth[$i] ?? 0;
        }
        $notifications = AdminNotification::orderBy('created_at', 'desc')->take(5)->get();
        $notifCount    = AdminNotification::where('is_read', false)->count();
        return view(' Admin.Home.Index', compact('notifications', 'notifCount','totalBookings', 'pendingBookings', 'totalProducts', 'totalReviews',
            'monthLabels', 'monthData',
            'acceptedCount', 'pendingCount',
            'categoryLabels', 'categoryProductCount',
            'reviewData'));
    }
}
