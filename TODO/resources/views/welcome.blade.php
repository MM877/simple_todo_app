<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div class="max-w-2xl w-full bg-white rounded-2xl shadow-xl p-8 space-y-10">
            
            <!-- Welcome Section -->
            <div class="text-center space-y-4">
                <h1 class="text-5xl font-bold text-gray-800">Welcome to My Todo App</h1>
                <p class="text-xl text-gray-600">Organize your tasks and boost your productivity</p>
                
                <!-- Let's Start Button -->
                <div class="mt-4">
                    <a href="{{ route('login') }}" 
                       class="inline-block px-10 py-3 bg-green-500 text-white rounded-lg text-lg font-semibold hover:bg-green-600 shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2">
                        Let's Start
                    </a>
                </div>
            </div>

            <!-- Auth Buttons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center mt-8">
                <a href="{{ route('login') }}" 
                   class="min-w-[160px] px-8 py-3.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-semibold text-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-center focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none">
                    Login
                </a>
                <a href="{{ route('register') }}" 
                   class="min-w-[160px] px-8 py-3.5 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-lg font-semibold text-lg hover:from-indigo-700 hover:to-indigo-800 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-center focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none">
                    Register
                </a>
            </div>

            <!-- Feature Highlights -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div class="p-6 bg-blue-50 rounded-xl">
                    <svg class="w-12 h-12 mx-auto text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800">Organize Tasks</h3>
                    <p class="text-gray-600 mt-2">Keep track of all your tasks in one place</p>
                </div>
                <div class="p-6 bg-indigo-50 rounded-xl">
                    <svg class="w-12 h-12 mx-auto text-indigo-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800">Stay Productive</h3>
                    <p class="text-gray-600 mt-2">Manage your time effectively</p>
                </div>
                <div class="p-6 bg-purple-50 rounded-xl">
                    <svg class="w-12 h-12 mx-auto text-purple-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800">Achieve Goals</h3>
                    <p class="text-gray-600 mt-2">Complete tasks and reach your objectives</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
