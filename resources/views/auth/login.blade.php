<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Inventory Management</title>
    @vite('resources/css/app.css')
    <style>
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-900 via-indigo-900 to-purple-900 flex items-center justify-center p-6 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 -z-10">
        <!-- Floating Circles -->
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-float" style="animation-delay: -2s;"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl animate-float" style="animation-delay: -4s;"></div>
        
        <!-- Grid Pattern -->
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-indigo-500/5 to-transparent 
            backdrop-blur-[1px] opacity-30" 
            style="background-size: 30px 30px; background-image: linear-gradient(to right, rgb(99 102 241 / 0.1) 1px, transparent 1px), linear-gradient(to bottom, rgb(99 102 241 / 0.1) 1px, transparent 1px);">
        </div>

        <!-- Glowing Orbs -->
        <div class="absolute top-10 right-10 w-4 h-4 bg-blue-400 rounded-full animate-pulse-slow"></div>
        <div class="absolute bottom-10 left-10 w-4 h-4 bg-purple-400 rounded-full animate-pulse-slow" style="animation-delay: -2s;"></div>
        <div class="absolute top-1/2 right-1/4 w-4 h-4 bg-indigo-400 rounded-full animate-pulse-slow" style="animation-delay: -1s;"></div>
    </div>

    <!-- Login Container -->
    <div class="w-full max-w-md relative z-10">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-full bg-gradient-to-tr from-blue-500 to-purple-600 shadow-lg mb-4 
                relative before:absolute before:inset-0 before:bg-gradient-to-tr before:from-blue-500/50 before:to-purple-600/50 
                before:rounded-full before:blur-lg before:-z-10">
                <svg class="w-12 h-12 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-white mb-2 text-shadow-lg">Welcome Back</h2>
            <p class="text-blue-100/80">Inventory Management System</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 space-y-6 border border-white/20
            relative before:absolute before:inset-0 before:-z-10 before:bg-gradient-to-b before:from-white/10 before:to-white/5 before:rounded-2xl">
            
            @if(session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-500/10 border border-green-500/20 text-green-200">
                {{ session('success') }}
            </div>
            @endif

            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                <!-- Email Input -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-blue-100">
                        Email address
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-blue-300 group-focus-within:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" required 
                            class="block w-full pl-10 pr-3 py-2.5 border border-white/10 rounded-xl
                            text-white placeholder-blue-300 bg-white/5 backdrop-blur-sm
                            focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            transition duration-150 ease-in-out text-sm" 
                            placeholder="Enter your email">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-blue-100">
                        Password
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-blue-300 group-focus-within:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" required 
                            class="block w-full pl-10 pr-3 py-2.5 border border-white/10 rounded-xl
                            text-white placeholder-blue-300 bg-white/5 backdrop-blur-sm
                            focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            transition duration-150 ease-in-out text-sm" 
                            placeholder="Enter your password">
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" 
                            class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-white/10 rounded bg-white/5 transition duration-150 ease-in-out">
                        <label for="remember_me" class="ml-2 block text-sm text-blue-100">
                            Remember me
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <!-- Sign In Button -->
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 rounded-xl text-sm font-semibold text-white
                        bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                        transform transition duration-150 hover:scale-[1.02] active:scale-[0.98] shadow-lg
                        hover:shadow-blue-500/25">
                        Sign in
                    </button>

                    <!-- Register Button -->
                    @if($showRegister)
                    <a href="{{ route('register') }}" 
                        class="w-full flex justify-center py-3 px-4 rounded-xl text-sm font-semibold
                        text-white border-2 border-white/20 hover:bg-white/10
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                        transform transition duration-150 hover:scale-[1.02] active:scale-[0.98]
                        backdrop-blur-sm">
                        Create new account
                    </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-center text-sm text-blue-200/60">
            <p>© 2024 Inventory Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 