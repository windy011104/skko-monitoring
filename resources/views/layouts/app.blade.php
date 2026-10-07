<!DOCTYPE html>
<html lang="id" x-data="appLayout()" :class="{ 'overflow-hidden': mobileMenuOpen }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Monitoring SKKO PLN UP 3 Bukittinggi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pln: {
                            blue: '#003082',
                            light: '#0064B4',
                            gold: '#FFD700',
                            dark: '#001C4E',
                        }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        /* Sidebar */
        .sidebar-gradient {
            background: linear-gradient(180deg, #001C4E 0%, #003082 40%, #004AAD 100%);
        }

        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(255, 255, 255, 0.12);
            border-left: 3px solid #FFD700;
            padding-left: calc(1rem - 3px);
        }

        .sidebar-link.active {
            background: rgba(255, 215, 0, 0.15);
        }

        .sidebar-link.active .sidebar-icon {
            color: #FFD700;
        }

        .sidebar-link .sidebar-icon {
            transition: color 0.2s;
        }

        /* Submenu */
        .submenu-item:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .submenu-item.active {
            background: rgba(255, 215, 0, 0.1);
            color: #FFD700;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 2px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Cards */
        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Notification dot */
        @keyframes ping-slow {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }
        }

        .ping-slow {
            animation: ping-slow 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="flex h-screen overflow-hidden">

        {{-- ============================================================ --}}
        {{-- SIDEBAR --}}
        {{-- ============================================================ --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="sidebar-gradient fixed inset-y-0 left-0 z-50 w-64 flex flex-col transition-transform duration-300 ease-in-out lg:relative lg:flex">
            {{-- Logo & App Name --}}
            <div class="flex items-center space-x-3 px-5 py-5 border-b border-white border-opacity-10">
                <div
                    class="w-10 h-10 rounded-xl bg-white flex items-center justify-center flex-shrink-0 shadow-lg overflow-hidden">
                    <img src="{{ asset('images/logo pln.jpg') }}" alt="Logo PLN" class="w-9 h-9 object-contain">
                </div>
                <div class="min-w-0">
                    <p class="text-white font-bold text-sm leading-tight truncate">Monitoring SKKO</p>
                    <p class="text-blue-300 text-xs truncate">PLN UP3 Bukittinggi</p>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden ml-auto text-white opacity-60 hover:opacity-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- User Info --}}
            <div class="px-4 py-4 border-b border-white border-opacity-10">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-sm"
                        style="background: linear-gradient(135deg, #FFD700, #FFA500); color: #003082;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-white text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                        <p class="text-blue-300 text-xs truncate">
                            {{ auth()->user()->jabatan ?? 'PLN UP3 Bukittinggi' }}</p>
                    </div>
                    @if (auth()->user()->isAdmin())
                        <span
                            class="flex-shrink-0 text-xs px-2 py-0.5 rounded-full font-semibold bg-red-500 text-white">Admin</span>
                    @else
                        <span
                            class="flex-shrink-0 text-xs px-2 py-0.5 rounded-full font-semibold bg-blue-500 text-white">User</span>
                    @endif
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto sidebar-scroll py-4 px-3 space-y-1">

                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}"
                    class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-lg text-blue-100 hover:text-white {{ request()->routeIs('dashboard') ? 'active text-white' : '' }}">
                    <svg class="sidebar-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>

                {{-- SKKO Management --}}
                <div x-data="{ open: {{ request()->routeIs('skko.*') || request()->routeIs('kontrak.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="sidebar-link w-full flex items-center space-x-3 px-4 py-2.5 rounded-lg text-blue-100 hover:text-white">
                        <svg class="sidebar-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-sm font-medium flex-1 text-left">SKKO, PRK, Kontrak</span>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition
                        class="ml-4 mt-1 space-y-1 border-l border-white border-opacity-10 pl-3">
                        <a href="{{ route('skko.index') }}"
                            class="submenu-item flex items-center space-x-2 px-3 py-2 rounded-lg text-blue-200 hover:text-white text-sm transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                            <span>SKKO</span>
                        </a>
                        <a href="{{ route('progres-kontrak.index') }}"
                            class="submenu-item flex items-center space-x-2 px-3 py-2 rounded-lg text-blue-200 hover:text-white text-sm transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                            <span>Progres Kontrak</span>
                        </a>
                        <a href="{{ route('prk.index') }}"
                            class="submenu-item flex items-center space-x-2 px-3 py-2 rounded-lg text-blue-200 hover:text-white text-sm transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                            <span>PRK</span>
                        </a>
                    </div>
                </div>

                {{-- Monitoring --}}
                <div x-data="{ open: {{ request()->routeIs('monitoring.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="sidebar-link w-full flex items-center space-x-3 px-4 py-2.5 rounded-lg text-blue-100 hover:text-white">
                        <svg class="sidebar-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="text-sm font-medium flex-1 text-left">Monitoring</span>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition
                        class="ml-4 mt-1 space-y-1 border-l border-white border-opacity-10 pl-3">
                        <a href="{{ route('monitoring.index') }}"
                            class="submenu-item flex items-center space-x-2 px-3 py-2 rounded-lg text-blue-200 hover:text-white text-sm transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                            <span>Mon per SKKO</span>
                        </a>
                    </div>
                </div>

                {{-- Alert --}}
                <a href="{{ route('alerts.index') }}"
                    class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-lg text-blue-100 hover:text-white">
                    <svg class="sidebar-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="text-sm font-medium">Alert & Peringatan</span>
                </a>

                {{-- Admin Only Section --}}
                @if (auth()->user()->isAdmin())
                    <div class="pt-3 mt-3 border-t border-white border-opacity-10">
                        <p class="px-4 text-xs font-semibold text-blue-400 uppercase tracking-wider mb-2">Administrasi
                        </p>


                        <a href="{{ route('users.index') }}"
                            class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-lg text-blue-100 hover:text-white">
                            <svg class="sidebar-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="text-sm font-medium">Master User</span>
                        </a>

                        <a href="{{ route('bidang.index') }}"
                            class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-lg text-blue-100 hover:text-white">
                            <svg class="sidebar-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm font-medium">Master Bidang</span>
                        </a>

                        <a href="#"
                            class="sidebar-link flex items-center space-x-3 px-4 py-2.5 rounded-lg text-blue-100 hover:text-white">
                            <svg class="sidebar-icon w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <span class="text-sm font-medium">Import Data</span>
                        </a>
                    </div>
                @endif
            </nav>

            {{-- Logout at Bottom --}}
            <div class="p-4 border-t border-white border-opacity-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center space-x-3 px-4 py-2.5 rounded-lg text-red-300 hover:text-red-200 hover:bg-red-500 hover:bg-opacity-20 transition-all duration-200">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Sidebar Overlay (Mobile) --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        {{-- ============================================================ --}}
        {{-- MAIN CONTENT --}}
        {{-- ============================================================ --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            {{-- TOP NAVBAR --}}
            <header class="bg-white border-b border-gray-200 flex-shrink-0 z-30">
                <div class="flex items-center justify-between h-16 px-4 lg:px-6">

                    {{-- Left: Hamburger + Breadcrumb --}}
                    <div class="flex items-center space-x-4">
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="text-gray-500 hover:text-pln-blue lg:hidden p-1 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div class="hidden md:flex items-center space-x-2 text-sm">
                            <span class="text-gray-400">PLN UP 3 Bukittinggi</span>
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            <span class="text-pln-blue font-semibold">@yield('title', 'Dashboard')</span>
                        </div>
                    </div>

                    {{-- Right: Notifications + User Dropdown --}}
                    <div class="flex items-center space-x-2">
                        {{-- Date --}}
                        <div class="hidden lg:block text-xs text-gray-500 bg-gray-50 px-3 py-1.5 rounded-lg">
                            {{ now()->locale('id')->translatedFormat('l, d F Y') }}
                        </div>

                        {{-- Notifications Bell --}}
                        <button
                            class="relative p-2 text-gray-500 hover:text-pln-blue hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full ping-slow"></span>
                        </button>

                        {{-- User Dropdown --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @click.outside="open = false"
                                class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold"
                                    style="background: linear-gradient(135deg, #003082, #0064B4); color: white;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                                <span
                                    class="hidden md:block text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" x-transition
                                class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                    <span
                                        class="mt-1 inline-block text-xs px-2 py-0.5 rounded-full font-semibold {{ auth()->user()->isAdmin() ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ ucfirst(auth()->user()->role) }}
                                    </span>
                                </div>
                                <a href="#"
                                    class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-pln-blue transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Profil Saya</span>
                                </a>
                                <div class="border-t border-gray-100 mt-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center space-x-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- PAGE CONTENT --}}
            <main class="flex-1 overflow-y-auto">
                @yield('content')
            </main>

            {{-- FOOTER --}}
            <footer class="bg-white border-t border-gray-200 px-6 py-3 flex-shrink-0">
                <p class="text-center text-xs text-gray-400">
                    &copy; {{ date('Y') }} PLN UP 3 Bukittinggi &mdash; Sistem Monitoring SKKO v1.0 &mdash; Logged
                    in as <span class="font-medium">{{ auth()->user()->name }}</span>
                </p>
            </footer>
        </div>
    </div>

    @stack('modals')

    {{-- Modal Konfirmasi Hapus Global --}}
    @include('components.delete-modal')

    <script>
        function appLayout() {
            return {
                sidebarOpen: false,
                mobileMenuOpen: false,
            }
        }
    </script>

    @stack('scripts')

</body>

</html>
