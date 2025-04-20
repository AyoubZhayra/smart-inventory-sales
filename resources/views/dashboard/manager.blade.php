@extends('layouts.manager')

@section('title', 'Manager Dashboard')

@section('content')
    <div class="space-y-8 fade-in">
        <!-- Manager Dashboard Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg p-8 mb-6">
            <h1 class="text-3xl font-bold text-white mb-4">Welcome, {{ Auth::user()->name }}!</h1>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Stock Value -->
            <div class="hover-card bg-white overflow-hidden rounded-xl shadow-md border border-gray-200 transform transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-blue-50 text-blue-600 transform transition-transform hover:scale-110 duration-300">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-6 w-0 flex-1">
                            <dl>
                                <dt class="text-base font-medium text-gray-500 truncate">Total Stock Value</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-3xl font-bold text-gray-900">0.00 DH</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Low Stock Items -->
            <div class="hover-card bg-white overflow-hidden rounded-xl shadow-md border border-gray-200 transform transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-red-50 text-red-600 transform transition-transform hover:scale-110 duration-300">
                                <svg class="h-8 w-8 pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-6 w-0 flex-1">
                            <dl>
                                <dt class="text-base font-medium text-gray-500 truncate">Low Stock Items</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-3xl font-bold text-gray-900">0</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Sales -->
            <div class="hover-card bg-white overflow-hidden rounded-xl shadow-md border border-gray-200 transform transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-green-50 text-green-600 transform transition-transform hover:scale-110 duration-300">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-6 w-0 flex-1">
                            <dl>
                                <dt class="text-base font-medium text-gray-500 truncate">Today's Sales</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-3xl font-bold text-gray-900">0.00 DH</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Revenue -->
            <div class="hover-card bg-white overflow-hidden rounded-xl shadow-md border border-gray-200 transform transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-purple-50 text-purple-600 transform transition-transform hover:scale-110 duration-300">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-6 w-0 flex-1">
                            <dl>
                                <dt class="text-base font-medium text-gray-500 truncate">Monthly Revenue</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-3xl font-bold text-gray-900">0.00 DH</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Sales -->
            <div class="hover-card bg-white shadow-md rounded-xl border border-gray-200 transform transition-all duration-300">
                <div class="p-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold leading-6 text-gray-900">Recent Sales</h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            Today
                        </span>
                    </div>
                    <div class="mt-6">
                        <div class="text-center text-gray-500 py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No recent sales</h3>
                            <p class="mt-2 text-base text-gray-500">Start making sales to see them here.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock Alerts -->
            <div class="hover-card bg-white shadow-md rounded-xl border border-gray-200 transform transition-all duration-300">
                <div class="p-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold leading-6 text-gray-900">Stock Alerts</h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <svg class="mr-1.5 h-2.5 w-2.5 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                <circle cx="4" cy="4" r="3" />
                            </svg>
                            Live
                        </span>
                    </div>
                    <div class="mt-6">
                        <div class="text-center text-gray-500 py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400 pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No stock alerts</h3>
                            <p class="mt-2 text-base text-gray-500">Items running low will appear here.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="hover-card bg-white shadow-md rounded-xl border border-gray-200 transform transition-all duration-300">
                <div class="p-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold leading-6 text-gray-900">Recent Users</h3>
                        <a href="{{ route('users.index') }}" class="text-base font-medium text-blue-600 hover:text-blue-500 transition-colors duration-200">View all</a>
                    </div>
                    <div class="mt-6">
                        <div class="text-center text-gray-500 py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No recent users</h3>
                            <p class="mt-2 text-base text-gray-500">Add users to manage access.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manager-only Tools Section -->
        <div class="hover-card bg-white shadow-md rounded-xl border border-gray-200 transform transition-all duration-300">
            <div class="p-8">
                <h3 class="text-xl font-semibold leading-6 text-gray-900">Manager Tools</h3>
                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <a href="#" class="gradient-border inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-purple-50 hover:text-purple-600 hover:border-purple-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform transition-all duration-200 hover:-translate-y-1">
                        <svg class="-ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Reports
                    </a>
                    <a href="{{ route('users.index', ['openModal' => 'true']) }}" class="gradient-border inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-200 hover:-translate-y-1">
                        <svg class="-ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Manage Users
                    </a>
                    <a href="#" class="gradient-border inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:-translate-y-1">
                        <svg class="-ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                        Analytics
                    </a>
                    <a href="#" class="gradient-border inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 hover:text-gray-600 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transform transition-all duration-200 hover:-translate-y-1">
                        <svg class="-ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Settings
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="hover-card bg-white shadow-md rounded-xl border border-gray-200 transform transition-all duration-300">
            <div class="p-8">
                <h3 class="text-xl font-semibold leading-6 text-gray-900">Quick Actions</h3>
                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
                    @foreach([
                        ['text' => 'New Sale', 'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6', 'color' => 'blue', 'href' => '#'],
                        ['text' => 'Add Stock', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'color' => 'green', 'href' => '#'],
                        ['text' => 'View Report', 'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'purple', 'href' => '#'],
                        ['text' => 'Add User', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'indigo', 'href' => route('users.index', ['openModal' => 'true'])],
                        ['text' => 'Settings', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 'color' => 'gray', 'href' => '#']
                    ] as $action)
                        <a href="{{ $action['href'] }}" class="gradient-border inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-{{ $action['color'] }}-50 hover:text-{{ $action['color'] }}-600 hover:border-{{ $action['color'] }}-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{ $action['color'] }}-500 transform transition-all duration-200 hover:-translate-y-1">
                            <svg class="-ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-{{ $action['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}" />
                            </svg>
                            {{ $action['text'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection 