<?php
namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'SuperAdmin') {
            $urls = ShortUrl::with('user', 'company')->latest()->get();
        } elseif ($user->role === 'Admin') {
            $urls = ShortUrl::where('company_id', $user->company_id)->with('user')->latest()->get();
        } else {
            $urls = ShortUrl::where('user_id', $user->id)->latest()->get();
        }

        return view('admin.short_urls.short_urls', compact('urls'));
    }

    public function create()
    {
        return view('admin.short_urls.create-url');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'SuperAdmin') {
            return back()->with('error', 'SuperAdmin cannot create short URLs');
        }
        if (! $user->company_id) {
            return back()->with('error', 'You are not assigned to any company. Contact SuperAdmin.');
        }

        $data = $request->validate(['original_url' => 'required|url']);
        $code = Str::random(6);

        ShortUrl::create([
            'user_id'      => $user->id,
            'company_id'   => $user->company_id,
            'original_url' => $data['original_url'],
            'short_code'   => $code,
        ]);

        return redirect('/short-urls')->with('success', 'Short URL created');
    }
    public function redirect($code)
    {
        $url = ShortUrl::where('short_code', $code)->first();
        if (! $url) {
            abort(404);
        }
        return redirect($url->original_url);
    }
}
