<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-3">
            <div class="p-6 text-gray-900">
                Welcome
            </div>
            <div class="flex-1 py-12"">
                <x-nav-link :href="route('login')">Login</x-nav-link>
                <x-nav-link :href="route('register')">Register</x-nav-link>
                @auth
                <x-nav-link :href="route('todo.index')">My Tasks</x-nav-link>
                @endauth
            </div>
        </div>
    </div>
</x-guest-layout>
