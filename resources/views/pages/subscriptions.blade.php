{{-- Subscriptions Management Page --}}
<x-app-layout>
    <x-auth-navbar :userInitials="$userInitials"/>

    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
        <x-mobile-toggle-button />
        
        <div class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6">
            
            <!-- Page Header -->
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Subscriptions</h1>
                <p class="text-slate-600 mt-2 text-sm sm:text-base">Manage and track all your active subscriptions</p>
            </div>

            <!-- Header Controls -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <!-- Search Bar -->
                <div class="relative w-full sm:max-w-sm">
                    <input type="text" placeholder="Search subscriptions..." class="w-full pl-12 pr-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-slate-900 placeholder-slate-400">
                </div>

                <!-- Renew Button -->
                <button class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors duration-200 shadow-sm flex items-center justify-center gap-2 flex-shrink-0">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Renew Subscription
                </button>
            </div>

            <!-- Subscriptions Table Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                
                <!-- Card Header -->
                <div class="p-6 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h2 class="text-xl font-bold text-slate-900">All Subscriptions</h2>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Plan Name</th>
                                <th class="sm:table-cell px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                                <th class="md:table-cell px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Start Date</th>
                                <th class="lg:table-cell px-4 sm:px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Next Billing</th>
                                    </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse ($subscriptions as $subscription)
                                <tr class="hover:bg-slate-50 transition-colors duration-150">
                                    <!-- Plan Name -->
                                    <td class="px-4 sm:px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                                                <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-slate-900">{{ $subscription->plan->name ?? 'N/A' }}</p>
                                                <p class="text-xs text-slate-500 mt-1">{{ $subscription->plan->description ?? 'Standard Plan' }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="sm:table-cell px-4 sm:px-6 py-4">
                                        @php
                                            $statusColor = match($subscription->status) {
                                                'active' => 'bg-emerald-100 text-emerald-700',
                                                'pending' => 'bg-amber-100 text-amber-700',
                                                'cancelled' => 'bg-red-100 text-red-700',
                                                'expired' => 'bg-slate-100 text-slate-700',
                                                default => 'bg-slate-100 text-slate-700'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                                            {{ ucfirst($subscription->status) }}
                                        </span>
                                    </td>

                                    <!-- Start Date (Hidden on Mobile) -->
                                    <td class="md:table-cell px-4 sm:px-6 py-4">
                                        <p class="text-sm text-slate-900">{{ $subscription->start_date ? $subscription->start_date->format('M d, Y') : 'N/A' }}</p>
                                        <p class="text-xs text-slate-500 mt-1">{{ $subscription->start_date ? $subscription->start_date->format('h:i A') : '' }}</p>
                                    </td>

                                    <!-- End Date (Hidden on Tablet) -->
                                    <td class="hidden lg:table-cell px-4 sm:px-6 py-4">
                                        <p class="text-sm text-slate-900">{{ $subscription->end_date ? $subscription->end_date->copy()->subDays(3)->format('M d, Y') : 'N/A' }}</p>
                                        <p class="text-xs text-slate-500 mt-1">{{ $subscription->end_date ? $subscription->end_date->copy()->subDays(3)->format('h:i A') : '' }}</p>
                                    </td>

                                    <!-- Next Billing (Hidden on Tablet) -->
                                    <td class="lg:table-cell px-4 sm:px-6 py-4">
                                        <p class="text-sm text-slate-900">{{ $subscription->next_billing_date ? $subscription->next_billing_date->format('M d, Y') : 'N/A' }}</p>
                                        <p class="text-xs text-slate-500 mt-1">{{ $subscription->next_billing_date ? $subscription->next_billing_date->format('h:i A') : '' }}</p>
                                    </td>

                                    <!-- Actions -->
                                    {{-- <td class="px-4 sm:px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200" title="Edit">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200" title="Delete">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td> --}}
                                </tr>
                            @empty
                                <!-- Empty State -->
                                <tr>
                                    <td colspan="6" class="px-4 sm:px-6 py-12">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="h-12 w-12 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-slate-500 font-medium">No subscriptions found</p>
                                            <p class="text-slate-400 text-sm mt-1">Subscribe to the pro plan to get started</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($subscriptions->hasPages())
                    <div class="px-4 sm:px-6 py-4 border-t border-slate-200 bg-slate-50">
                        {{ $subscriptions->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>
