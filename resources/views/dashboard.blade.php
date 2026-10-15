<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- ==================== WELCOME ==================== -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-2xl">
                        👋
                    </div>
                    <div>
                        <div class="text-xl font-bold text-gray-800">
                            Welcome back, {{ auth()->user()->name }}!
                        </div>
                        <div class="text-sm text-gray-500 mt-0.5">
                            You're logged in as
                            <span class="font-medium text-gray-700">{{ auth()->user()->role }}</span>
                            @if(auth()->user()->company)
                                at <span class="font-medium text-gray-700">{{ auth()->user()->company->name }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== STATS CARDS ==================== -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Total URLs -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-gray-500">Total URLs</div>
                            <div class="text-3xl font-bold text-gray-800 mt-1">
                                {{ $totalUrls }}
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center text-2xl">
                            🔗
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-gray-500">
                                @if(auth()->user()->role === 'SuperAdmin')
                                    Total Users
                                @else
                                    Company Users
                                @endif
                            </div>
                            <div class="text-3xl font-bold text-gray-800 mt-1">
                                {{ $totalUsers }}
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center text-2xl">
                            👥
                        </div>
                    </div>
                </div>

                <!-- Companies / Role -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-gray-500">
                                @if(auth()->user()->role === 'SuperAdmin')
                                    Total Companies
                                @else
                                    Your Role
                                @endif
                            </div>
                            <div class="text-3xl font-bold text-gray-800 mt-1">
                                @if(auth()->user()->role === 'SuperAdmin')
                                    {{ $totalCompanies }}
                                @else
                                    <span class="text-lg">{{ auth()->user()->role }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center text-2xl">
                            🏢
                        </div>
                    </div>
                </div>

            </div>

            <!-- ==================== QUICK ACTIONS ==================== -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Short URLs -->
                <a href="{{ url('/short-urls') }}"
                   class="block bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition p-6 group">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center text-2xl">
                            🔗
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition">
                                Short URLs
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                @if(auth()->user()->role === 'SuperAdmin')
                                    View all short URLs across every company
                                @elseif(auth()->user()->role === 'Admin')
                                    Manage your company's short URLs
                                @else
                                    View and create your short URLs
                                @endif
                            </p>
                        </div>
                        <div class="text-gray-400 group-hover:text-blue-600 transition text-xl">
                            →
                        </div>
                    </div>
                </a>

                <!-- Invite User -->
                <a href="{{ url('/invite') }}"
                   class="block bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition p-6 group">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center text-2xl">
                            👥
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-green-600 transition">
                                Invite User
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                @if(auth()->user()->role === 'SuperAdmin')
                                    Invite a new Admin in a new company
                                @else
                                    Invite Admin or Member to your company
                                @endif
                            </p>
                        </div>
                        <div class="text-gray-400 group-hover:text-green-600 transition text-xl">
                            →
                        </div>
                    </div>
                </a>

            </div>

            <!-- ==================== RECENT SHORT URLS ==================== -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Recent Short URLs</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            @if(auth()->user()->role === 'SuperAdmin')
                                Latest URLs across all companies
                            @elseif(auth()->user()->role === 'Admin')
                                Latest URLs from your company
                            @else
                                URLs you recently created
                            @endif
                        </p>
                    </div>
                    <a href="{{ url('/short-urls') }}"
                       class="text-sm font-medium text-blue-600 hover:text-blue-800">
                        View all →
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">
                                    Short Link
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">
                                    Original URL
                                </th>
                                @if(auth()->user()->role !== 'Member')
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">
                                        Created By
                                    </th>
                                @endif
                                @if(auth()->user()->role === 'SuperAdmin')
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">
                                        Company
                                    </th>
                                @endif
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">
                                    Created
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentUrls as $url)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-3">
                                        <a href="/{{ $url->short_code }}" target="_blank"
                                           class="text-blue-600 hover:text-blue-800 font-medium text-sm break-all">
                                            {{ url('/') }}/{{ $url->short_code }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-3 text-sm text-gray-700 break-all max-w-md">
                                        {{ Str::limit($url->original_url, 50) }}
                                    </td>
                                    @if(auth()->user()->role !== 'Member')
                                        <td class="px-6 py-3 text-sm text-gray-600">
                                            {{ $url->user->name ?? '-' }}
                                        </td>
                                    @endif
                                    @if(auth()->user()->role === 'SuperAdmin')
                                        <td class="px-6 py-3 text-sm text-gray-600">
                                            {{ $url->company->name ?? '-' }}
                                        </td>
                                    @endif
                                    <td class="px-6 py-3 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $url->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="text-4xl mb-2">📭</div>
                                        <div class="text-gray-500 text-sm">No short URLs yet.</div>
                                        @if(auth()->user()->role !== 'SuperAdmin')
                                            <a href="/short-urls/create"
                                               class="inline-block mt-3 text-sm font-medium text-blue-600 hover:text-blue-800">
                                                Create your first URL →
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
