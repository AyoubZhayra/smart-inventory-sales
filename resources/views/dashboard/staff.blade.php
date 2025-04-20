@extends('layouts.staff')

@section('title', 'Staff Dashboard')

@section('content')
    <div class="space-y-8 fade-in">
        <!-- Staff Dashboard Header -->
        <div class="bg-gradient-to-r from-green-600 to-emerald-700 rounded-xl shadow-lg p-6 mb-6">
            <h1 class="text-2xl font-bold text-white mb-2">Staff Dashboard</h1>
            <p class="text-green-100">Welcome, {{ Auth::user()->name }}. Manage sales and inventory operations here.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
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

            <!-- Products Count -->
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
                                <dt class="text-base font-medium text-gray-500 truncate">Total Products</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-3xl font-bold text-gray-900">0</div>
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
        </div>

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

        <!-- Staff Quick Actions -->
        <div class="hover-card bg-white shadow-md rounded-xl border border-gray-200 transform transition-all duration-300">
            <div class="p-8">
                <h3 class="text-xl font-semibold leading-6 text-gray-900">Quick Actions</h3>
                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <a href="#" class="gradient-border inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:-translate-y-1">
                        <svg class="-ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        New Sale
                    </a>
                    <a href="#" class="gradient-border inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-green-50 hover:text-green-600 hover:border-green-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform transition-all duration-200 hover:-translate-y-1">
                        <svg class="-ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        View Inventory
                    </a>
                    <a href="#" class="gradient-border inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-yellow-50 hover:text-yellow-600 hover:border-yellow-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transform transition-all duration-200 hover:-translate-y-1">
                        <svg class="-ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Sales History
                    </a>
                    <a href="#" class="gradient-border inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-red-50 hover:text-red-600 hover:border-red-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transform transition-all duration-200 hover:-translate-y-1">
                        <svg class="-ml-1 mr-3 h-6 w-6 text-gray-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Low Stock Items
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection 