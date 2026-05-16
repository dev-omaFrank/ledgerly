<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/50">
        <div class="container-max">
            <div class="flex items-center justify-between h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-lg bg-primary flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-slate-900">Ledgerly</span>
                </div>

                <!-- Auth & CTA Buttons -->
                <span class="user-initials text-lg font-bold text-slate-900" style="margin-left: 7em;">Welcome back, </span>
                <div x-data="{ open: false }" class="relative">
                    <!-- Avatar Button -->
                    <button
                        @click="open = !open"
                        class="w-14 h-14 rounded-full bg-primary text-white text-xl font-semibold flex items-center justify-center focus:outline-none">
                        {{ $userInitials }}
                    </button>

                    <!-- Dropdown -->
                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute top-full mt-2 left-0 w-48 bg-white border border-slate-200
                               rounded-lg shadow-lg z-50">

                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                            <i class="fa fa-user"></i>
                            My Profile
                        </a>

                        <div class="border-t border-slate-200 my-1"></div>

                        <!-- Logout (example) -->
                        <!-- <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-2 text-sm
                                text-red-600 hover:bg-red-50">
                                <i class="fa fa-sign-out-alt"></i>
                                Logout
                            </button>
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
    </nav>