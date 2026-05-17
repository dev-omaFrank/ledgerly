<x-app-layout>
    <x-auth-navbar :userInitials="$userInitials"/>

    <div x-data="{ sidebarOpen: false, showAddModal: false }" class="flex min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
        <x-mobile-toggle-button />
        
        <div class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6">
            
            <!-- Page Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Businesses</h1>
                    <p class="text-slate-600 mt-1 text-sm sm:text-base">Manage and organize your business profiles</p>
                </div>
            </div>

            <!-- Search & Create Business -->
            <div class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-center">
                <div class="relative flex-1 max-w-md">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-slate-400 pointer-events-none"
                        fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.5 5.5a7.5 7.5 0 0010.5 10.5z" />
                    </svg>
                    <input type="text" placeholder="Search businesses by name or email..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all bg-white text-slate-900 placeholder-slate-400 text-sm">
                </div>
                <button @click="showAddModal = true" class="px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors duration-200 shadow-sm flex items-center justify-center gap-2 whitespace-nowrap">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create Business
                </button>
            </div>

            <!-- Businesses Table Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                
                <!-- Table Header -->
                <div class="px-4 sm:px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                        <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375M12 9.75v.75m0 2.25v.75m0 2.25v.75" />
                        </svg>
                        All Businesses
                    </h2>
                </div>

                <!-- Responsive Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b-2 border-slate-200 bg-slate-50">
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Business Name</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider hidden sm:table-cell">Email</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider hidden md:table-cell">Invoices</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider hidden lg:table-cell">Total Revenue</th>
                                <th class="px-4 sm:px-6 py-3 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if ($businesses->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-4 sm:px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375M12 9.75v.75m0 2.25v.75m0 2.25v.75" />
                                            </svg>
                                            <p class="text-slate-600 text-sm font-medium">No businesses found</p>
                                            <p class="text-slate-500 text-xs mt-1">Create your first business profile to get started</p>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($businesses as $business)
                                    <tr class="hover:bg-blue-50/50 transition-colors duration-150">
                                        <!-- Business Name with Avatar -->
                                        <td class="px-4 sm:px-6 py-4 text-sm">
                                            <div class="flex items-center gap-3">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                                    {{ $business->business_name ? substr($business->business_name, 0, 1) : '-' }}
                                                </div>
                                                <p class="text-sm font-semibold text-slate-900">
                                                    {{ $business->business_name ?? '---' }}
                                                </p>
                                            </div>
                                        </td>

                                        <!-- Email (Hidden on mobile) -->
                                        <td class="px-4 sm:px-6 py-4 text-sm text-slate-600 hidden sm:table-cell">
                                            <a href="mailto:{{ $business->business_email }}" class="hover:text-blue-600 transition-colors">
                                                {{ $business->business_email ?? '---' }}
                                            </a>
                                        </td>

                                        <!-- Total Invoices (Hidden on tablet) -->
                                        <td class="px-4 sm:px-6 py-4 text-sm hidden md:table-cell">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                                                {{ $business->invoices_count ?? 0 }}
                                            </span>
                                        </td>

                                        <!-- Total Revenue (Hidden on lg) -->
                                        <td class="px-4 sm:px-6 py-4 text-sm font-semibold text-slate-900 hidden lg:table-cell">
                                            <span class="text-emerald-600">
                                                {{ $business->invoices->first()->currency ?? 'NGN' }}
                                                {{ number_format($business->invoices_sum_total ?? 0, 2) }}
                                            </span>
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-4 sm:px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                {{-- <a href="{{ route('businesses.edit', $business->id) }}" 
                                                   class="p-2 text-slate-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                                                   title="Edit">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 9l-4.663-4.663m0 0l1.25-1.25a2.25 2.25 0 013.182 3.182l-1.25 1.25m0 0L9.75 17.25" />
                                                    </svg>
                                                </a> --}}
                                                <button 
                                                   class="p-2 text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200"
                                                   title="Delete"
                                                   onclick="if(confirm('Are you sure you want to delete this business?')) { /* delete logic */ }">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 2.991a1.125 1.125 0 00-1.06-1.161H7.9c-.51 0-.955.406-1.06 1.161L4.822 5.79m12.986-3.21c-.342-.052-.682-.107-1.022-.166M15 12.75v6m-6-6v6m12-9v.008v9.992a2.25 2.25 0 01-2.25 2.25H5.25a2.25 2.25 0 01-2.25-2.25V6.008V2.25a2.25 2.25 0 012.25-2.25h13.5a2.25 2.25 0 012.25 2.25z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pagination & Info -->
                <div class="px-4 sm:px-6 py-4 border-t border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <p class="text-sm text-slate-600">
                            Showing <span class="font-semibold text-slate-900">{{ $businesses->firstItem() ?? 0 }}</span> 
                            to <span class="font-semibold text-slate-900">{{ $businesses->lastItem() ?? 0 }}</span> 
                            of <span class="font-semibold text-slate-900">{{ $businesses->total() ?? 0 }}</span> businesses
                        </p>
                        <div class="flex gap-2 justify-start sm:justify-end">
                            {{ $businesses->links() }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
