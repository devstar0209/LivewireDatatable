<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <x-slot name="header">
      
      <div class="flex justify-between gap-5 justify-end">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">            
            New Domain Blacklist
          </h2>
        </div>
      </div>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-12 bg-white overflow-hidden shadow-xl sm:rounded-lg sm:px-6 lg:px-8 sm:py-6 lg:py-8">
                <form wire:submit="save">
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Domain Details</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">This domain will be blacklisted.</p>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                <div class="col-span-full">
                                    <label for="domain" class="block text-sm font-medium leading-6 text-gray-900">Domain</label>
                                    <div class="mt-2">
                                        <input type="text" wire:model="domain" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                    @error('domain') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-center gap-x-6">
                        <x-button>{{ __('Save') }}</x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
