<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'SuperAdmin') {
            $totalUrls      = ShortUrl::count();
            $totalUsers     = User::count();
            $totalCompanies = Company::count();
            $recentUrls     = ShortUrl::with('user', 'company')
                                ->latest()
                                ->take(5)
                                ->get();
        } elseif ($user->role === 'Admin') {
            $totalUrls      = ShortUrl::where('company_id', $user->company_id)->count();
            $totalUsers     = User::where('company_id', $user->company_id)->count();
            $totalCompanies = 0;
            $recentUrls     = ShortUrl::where('company_id', $user->company_id)
                                ->with('user')
                                ->latest()
                                ->take(5)
                                ->get();
        } else {
            // Member
            $totalUrls      = ShortUrl::where('user_id', $user->id)->count();
            $totalUsers     = 0;
            $totalCompanies = 0;
            $recentUrls     = ShortUrl::where('user_id', $user->id)
                                ->latest()
                                ->take(5)
                                ->get();
        }

        return view('dashboard', compact(
            'totalUrls',
            'totalUsers',
            'totalCompanies',
            'recentUrls'
        ));
    }
}
