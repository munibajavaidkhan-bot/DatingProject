<x-app-layout>
    <h1 class="text-2xl font-bold">Admin Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }} ({{ auth()->user()->role }})</p>
</x-app-layout>
