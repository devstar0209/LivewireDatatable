<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>#dashboard table th, #dashboard table td{padding:10px 5px; white-space: normal;}</style>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--<x-welcome />-->
                

                @if (session()->has('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <span class="font-medium">Success !</span> {{ session('success') }}
                </div>
                @endif

                <div class="p-6 lg:p-8 bg-white border-b border-gray-200" id="dashboard">
                    <livewire:user-data-table />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
