<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'SuperAdmin') {
            $companies = Company::with('users')->latest()->get();
            $users = collect();
            return view('admin.invite', compact('companies', 'users'));
        } else {
            $users = User::where('company_id', $user->company_id)
                         ->latest()
                         ->get();
            $companies = collect();
            return view('admin.invite', compact('users', 'companies'));
        }
    }

    public function store(Request $request)
{
    $authUser = Auth::user();

    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|in:Admin,Member',
    ];

    if ($authUser->role === 'SuperAdmin') {
        $rules['company_name'] = 'required|string|max:255';
    }

    $data = $request->validate($rules);

    if ($authUser->role === 'SuperAdmin') {
        // ✅ FIX: firstOrCreate vapar
        $company = Company::firstOrCreate([
            'name' => $data['company_name'],
        ]);
        $companyId = $company->id;
    } else {
        $companyId = $authUser->company_id;
    }

    User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => 'password',
        'role' => $data['role'],
        'company_id' => $companyId,
    ]);

    return redirect('/invite')->with('success', 'User created successfully');
}
}
