<div class="w-1/3" x-data="{ open: false }">
    <div class="mt-1 relative">
    <button type="button" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label" 
    class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
    @click="open = !open"
    >
        <span class="flex items-center flex-wrap">
            <span class="ml-3 block truncate text-black">
            {{ $selectedType }}
            </span>
        </span>
        <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none" >
            <!-- Heroicon name: selector -->
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </span>
        </button>
        <div class="absolute mt-1 w-full rounded-md bg-white shadow-lg" :class="{'hidden': !open}" >
            <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-item-3"
                class="max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                <li id="listbox-item-0" role="option" wire:click="$emit('changeTypeOfResult', 'movie')"
                    class="{{  $selectedType === 'Movies' ? 'text-white bg-indigo-600' : 'text-gray-900 hover:bg-gray-200' }} cursor-pointer select-none relative py-2 pl-3 pr-9hover:bg-gray-200">
                    <div class="flex items-center">
                        <span class="ml-3 block font-normal truncate">
                            Movies
                        </span>
                    </div>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4">
                        <i class="ti-check"></i> 
                    </span>
                </li>
                <li id="listbox-item-0" role="option" wire:click="$emit('changeTypeOfResult', 'tv')"
                    class="{{  $selectedType === 'Tv Shows' ? 'text-white bg-indigo-600' : 'text-gray-900 hover:bg-gray-200' }} cursor-pointer select-none relative py-2 pl-3 pr-9 ">
                    <div class="flex items-center">
                        <span class="ml-3 block font-normal truncate">
                            Tv Shows
                        </span>
                    </div>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4">
                        <i class="ti-check"></i> 
                    </span>
                </li>
                <li id="listbox-item-0" role="option" wire:click="$emit('changeTypeOfResult', 'person')"
                    class="{{  $selectedType === 'People' ? 'text-white bg-indigo-600' : 'text-gray-900 hover:bg-gray-200' }} cursor-pointer select-none relative py-2 pl-3 pr-9 ">
                    <div class="flex items-center">
                        <span class="ml-3 block font-normal truncate">
                            People
                        </span>
                    </div>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4">
                        <i class="ti-check"></i> 
                    </span>
                </li>
                <li id="listbox-item-0" role="option" wire:click="$emit('changeTypeOfResult', 'collection')"
                    class="{{  $selectedType === 'Collections' ? 'text-white bg-indigo-600' : 'text-gray-900 hover:bg-gray-200' }} cursor-pointer select-none relative py-2 pl-3 pr-9 ">
                    <div class="flex items-center">
                        <span class="ml-3 block font-normal truncate">
                            Collections
                        </span>
                    </div>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4">
                        <i class="ti-check"></i> 
                    </span>
                </li>
                <li id="listbox-item-0" role="option" wire:click="$emit('changeTypeOfResult', 'keyword')"
                    class="{{  $selectedType === 'Keywords' ? 'text-white bg-indigo-600' : 'text-gray-900 hover:bg-gray-200' }} cursor-pointer select-none relative py-2 pl-3 pr-9 ">
                    <div class="flex items-center">
                        <span class="ml-3 block font-normal truncate">
                            Keywords
                        </span>
                    </div>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4">
                        <i class="ti-check"></i> 
                    </span>
                </li>
                <li id="listbox-item-0" role="option" wire:click="$emit('changeTypeOfResult', 'company')"
                    class="{{  $selectedType === 'Companies' ? 'text-white bg-indigo-600' : 'text-gray-900 hover:bg-gray-200' }} cursor-pointer select-none relative py-2 pl-3 pr-9 ">
                    <div class="flex items-center">
                        <span class="ml-3 block font-normal truncate">
                            Companies
                        </span>
                    </div>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4">
                        <i class="ti-check"></i> 
                    </span>
                </li>
                
            </ul>
        </div>
    </div>
</div>