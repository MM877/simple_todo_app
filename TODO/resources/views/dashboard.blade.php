<x-layouts.app :title="__('Dashboard')">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700">
                    <h1 class="text-2xl font-bold text-white">My Tasks</h1>
                    <p class="text-blue-100 text-sm">Organize your day, achieve your goals</p>
                </div>

                <!-- Todo Component -->
                <livewire:todos />

                <!-- Summary Footer -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t dark:border-gray-700">
                    <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400">
                        <span>Completed: <span class="font-medium text-gray-900 dark:text-gray-200" x-text="$wire.todos.filter(todo => todo.completed).length">0</span></span>
                        <span>Remaining: <span class="font-medium text-gray-900 dark:text-gray-200" x-text="$wire.todos.filter(todo => !todo.completed).length">0</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>