@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>[x-cloak]{display: none !important;}</style>

    <div class="min-h-screen flex bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-500 border-r flex flex-col justify-between">
            <div>
            <div class="p-4 text-x2 font-bold">CMS</div>

            <nav class="px-2 space-y-1">
                <a href="{{ route('dashboard') }}"
                   class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('dashboard') ? 'bg-gray-100 font-semibold' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('contracts.index') }}"
                   class="blocks px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('contracts.*') ? 'bg-gray-100 font-semibold' : '' }}">
                    Kontrak
                </a>
            </nav>
        </div>

        <!--- Logout Section --->
        <div class="p-4 border-t">
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded bg-red-500 text-white hover:bg-red-600 transition">
                    Logout
                </button>
            </form>
        </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6">
            <div class="max-w-6xl mx-auto">
                <h1 class="text-2xl font-semibold mb-6">{{ $title ?? 'Dashboard' }}</h1>
                {{ $slot }}
            </div>
        </main>
    </div>
<