<!-- Settings Dropdown - Fixed Version -->
<div class="hidden sm:flex sm:items-center sm:ml-6">
    <div class="relative" x-data="{ open: false }">
        <!-- Dropdown Toggle -->
        <button 
            @click="open = !open"
            @click.away="open = false"
            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
            :class="{ 'text-gray-700': open }"
        >
            <div>{{ Auth::user()->name }}</div>
            <div class="ml-1">
                <svg 
                    class="fill-current h-4 w-4 transition-transform duration-200" 
                    :class="{ 'rotate-180': open }"
                    xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 20 20"
                >
                    <path 
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" 
                    />
                </svg>
            </div>
        </button>

        <!-- Dropdown Menu -->
        <div 
            x-show="open" 
            x-cloak 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" 
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            style="display: none;"
        >
            <!-- Profile Link -->
            <a 
                href="{{ route('profile.edit') }}" 
                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150"
                @click="open = false"
            >
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                {{ __('Profile') }}
            </a>

            <!-- Divider -->
            <div class="border-t border-gray-100"></div>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button 
                    type="submit" 
                    class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150"
                    @click="open = false"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                >
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</div>