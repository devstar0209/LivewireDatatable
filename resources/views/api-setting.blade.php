<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between gap-5 justify-end">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('API Setting') }}
          </h2>
        </div>
        
                            
        <div>
          <div>
            <a href="{{ route('api.setting.create') }}" id="open-btn" data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
              Add New API
            </a>
          </div>
        </div>
      </div>
      
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
                    <livewire:api-setting-data-table />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
