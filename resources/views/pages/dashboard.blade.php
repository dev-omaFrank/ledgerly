{{-- Dashboard Page --}}
<x-app-layout>
    <!-- Navbar -->
    <x-auth-navbar :userInitials="$userInitials"/>
    
    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
        <!-- Mobile Toggle Button -->
        <x-mobile-toggle-button/>

        <!-- Main Content -->
        <div class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6">
            
            <!-- Page Header -->
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Dashboard</h1>
                <p class="text-slate-600 mt-2 text-sm sm:text-base">Welcome back! Here's your business overview</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <!-- Total Revenue Card -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Total Revenue</p>
                            <p class="text-2xl sm:text-3xl font-bold text-slate-900 mt-2">₦{{ $totalRevenue }}</p>
                            {{-- <p class="text-xs text-emerald-600 font-semibold mt-2">↑ 12.5% from last month</p> --}}
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-emerald-50 flex items-center justify-center flex-shrink-0">
                            <svg class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Outstanding Revenue Card -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Outstanding</p>
                            <p class="text-2xl sm:text-3xl font-bold text-slate-900 mt-2">₦{{ $outstandingRevenue }}</p>
                            {{-- <p class="text-xs text-amber-600 font-semibold mt-2">↓ 2.4% from last month</p> --}}
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                            <svg class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5-1.5a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Clients Card -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200 sm:col-span-2 lg:col-span-1">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-slate-600 text-sm font-medium">Active Clients</p>
                            <p class="text-2xl sm:text-3xl font-bold text-slate-900 mt-2">{{ $activeClients }}</p>
                            {{-- <p class="text-xs text-blue-600 font-semibold mt-2">↑ 5.1% from last month</p> --}}
                        </div>
                        <div class="h-12 w-12 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 001.591-.079 8.988 8.988 0 01-7.23 4.568 8.969 8.969 0 01-6.191-2.206A8.969 8.969 0 0121 12a8.97 8.97 0 01-7.23 8.128m0 0a9.364 9.364 0 01-1.584-.063 8.97 8.97 0 01-1.588-.15 8.987 8.987 0 00-7.231 4.569A8.969 8.969 0 0121 12Z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Invoices Table -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                
                <!-- Card Header -->
                <div class="p-6 border-b border-slate-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.66V18a2.25 2.25 0 002.25 2.25H18" />
                            </svg>
                            <h2 class="text-xl font-bold text-slate-900">Recent Invoices</h2>
                        </div>
                        <a href="{{ route('invoices.index') }}" class="text-blue-600 hover:text-blue-700 transition-colors text-sm font-medium flex items-center gap-1 flex-shrink-0">
                            View all
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Invoice ID</th>
                                <th class=" sm:table-cell px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Client</th>
                                <th class=" md:table-cell px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Amount</th>
                                <th class=" lg:table-cell px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Date</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                                <th class="hidden px-4 sm:px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($invoices as $invoice)
                                <tr class="hover:bg-slate-50 transition-colors duration-150">
                                    <td class="px-4 sm:px-6 py-4">
                                        <p class="text-sm font-semibold text-blue-600">{{ $invoice->invoice_number }}</p>
                                    </td>
                                    <td class=" sm:table-cell px-4 sm:px-6 py-4">
                                        <p class="text-sm text-slate-900">{{ $invoice->client->client_name ?? 'N/A' }}</p>
                                    </td>
                                    <td class=" md:table-cell px-4 sm:px-6 py-4">
                                        <p class="text-sm font-semibold text-slate-900">{{ $invoice->total }}</p>
                                    </td>
                                    <td class="  lg:table-cell px-4 sm:px-6 py-4">
                                        <p class="text-sm text-slate-600">{{ $invoice->issue_date }}</p>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4">
                                        @php
                                            $statusColor = match($invoice->status) {
                                                'Paid' => 'bg-emerald-100 text-emerald-700',
                                                'Sent' => 'bg-amber-100 text-amber-700',
                                                default => 'bg-red-100 text-red-700'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                                            {{ Illuminate\Support\Str::of($invoice->status)->upper() }}
                                        </span>
                                    </td>
                                    <td class="hidden px-4 sm:px-6 py-4 text-right">
                                        <button class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors duration-200">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 sm:px-6 py-12">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="h-12 w-12 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.66V18a2.25 2.25 0 002.25 2.25H18" />
                                            </svg>
                                            <p class="text-slate-500 font-medium">No invoices found</p>
                                            <p class="text-slate-400 text-sm mt-1">Create your first invoice to get started</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-blue-50 to-blue-25 rounded-2xl p-6 sm:p-8 border border-blue-200 shadow-sm">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Ready to bill your clients?</h2>
                        <p class="mt-2 text-slate-600 text-sm sm:text-base">
                            Create a professional invoice in seconds and get paid faster.
                        </p>
                    </div>
                    <a href="{{ route('invoices.create.get') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200 whitespace-nowrap flex-shrink-0">
                        Create New Invoice
                    </a>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
