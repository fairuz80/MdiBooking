<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown title="Menu" :active="Str::startsWith(request()->route()->uri(), 'buttons')">
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <!-- Navigation User -->
        @if (Auth::user()->hasRole('admin'))
        <x-sidebar.sublink title="Kalender" href="{{ route('index.booking') }}"
            :active="request()->routeIs('index.booking')" />

        <x-sidebar.sublink title="Senarai Tempahan" href="{{ route('list.booking') }}"
            :active="request()->routeIs('list.booking')" />
       
        @endif

       
        @if (Auth::user()->hasRole('user'))
        <x-sidebar.sublink title="Kalender" href="{{ route('index.booking') }}"
            :active="request()->routeIs('index.booking')" />

        <x-sidebar.sublink title="Senarai Tempahan" href="{{ route('list.booking') }}"
            :active="request()->routeIs('list.booking')" />
        @endif

        
    </x-sidebar.dropdown>

    @if (Auth::user()->hasRole('admin'))
    <x-sidebar.dropdown title="Selenggara" :active="Str::startsWith(request()->route()->uri(), 'buttons')">
        <x-slot name="icon">
            <x-heroicon-s-cog class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink title="Senarai Pengguna" href="{{ route('list.User') }}"
            :active="request()->routeIs('list.User')" />
        <x-sidebar.sublink title="Pengurusan Bilik" href="{{ route('list.Room') }}"
            :active="request()->routeIs('list.Room')" />
       
    </x-sidebar.dropdown>
    
    @endif

    <x-sidebar.dropdown title="Hubungi Kami" :active="Str::startsWith(request()->route()->uri(), 'buttons')">
        <x-slot name="icon">
            <x-heroicon-s-user-group class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.dropdown>

    @php
        $links = array_fill(0, 20, '');
    @endphp

    <!-- @foreach ($links as $index => $link)
        <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" />
    @endforeach -->

</x-perfect-scrollbar>

