<x-app-layout>
    <x-auth-navbar :userInitials="$userInitials"/>

    <div x-data="{ sidebarOpen: false, showAddModal: false }" class="flex min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
        <x-mobile-toggle-button />
        
        <div class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6">
            
            <!-- Page Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Clients</h1>
                    <p class="text-slate-600 mt-1 text-sm sm:text-base">Manage and organize your client information</p>
                </div>
            </div>

            <!-- Search & Add Client -->
            <div class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-center">
                <div class="relative flex-1 max-w-md">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-slate-400 pointer-events-none"
                        fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.5 5.5a7.5 7.5 0 0010.5 10.5z" />
                    </svg>
                    <input type="text" placeholder="Search clients by name or email..."
                        class="pl-10 pr-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all bg-white text-slate-900 placeholder-slate-400 text-sm">
                </div>
                <button @click="openModal() = true" class="px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors duration-200 shadow-sm flex items-center justify-center gap-2 whitespace-nowrap">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add Client
                </button>
            </div>

            <!-- Clients Table Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                
                <!-- Table Header -->
                <div class="px-4 sm:px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                       <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                        fill="#2930d9" viewBox="2 2 20 20" >
                        <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                        <path d="M6 2a2 2 0 1 0 0 4 2 2 0 1 0 0-4M4 22h4v-7h2V8c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v7h2zM17 2a2 2 0 1 0 0 4 2 2 0 1 0 0-4m2 5h-4c-.45 0-.84.3-.96.73l-2 7 1.59.45L13 18h2v4h4v-4h2l-.63-2.82 1.59-.45-2-7C19.84 7.3 19.44 7 19 7"></path>
                        </svg>
                        All Clients
                    </h2>
                </div>

                <!-- Responsive Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b-2 border-slate-200 bg-slate-50">
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Client Name</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider hidden sm:table-cell">Email</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider hidden md:table-cell">Invoices</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider hidden lg:table-cell">Total Billed</th>
                                <th class="px-4 sm:px-6 py-3 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if ($clients->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-4 sm:px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 001.591-.079 8.88 8.88 0 01-.81 2.667A9.375 9.375 0 1115.128 19.128z" />
                                            </svg>
                                            <p class="text-slate-600 text-sm font-medium">No clients found</p>
                                            <p class="text-slate-500 text-xs mt-1">Add your first client to get started</p>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($clients as $client)
                                    <tr class="hover:bg-blue-50/50 transition-colors duration-150">
                                        <!-- Client Name with Avatar -->
                                        <td class="px-4 sm:px-6 py-4 text-sm">
                                            <div class="flex items-center gap-3">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                                    <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                                    fill="#2930d9" viewBox="2 2 20 20" >
                                                    <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                                                    <path d="M12 12c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5m0-8c1.65 0 3 1.35 3 3s-1.35 3-3 3-3-1.35-3-3 1.35-3 3-3M4 22h16c.55 0 1-.45 1-1v-1c0-3.86-3.14-7-7-7h-4c-3.86 0-7 3.14-7 7v1c0 .55.45 1 1 1m6-7h4c2.76 0 5 2.24 5 5H5c0-2.76 2.24-5 5-5"></path>
                                                    </svg>
                                                    {{ $client->client_name ? substr($client->client_name, 0, 1) : '-' }}
                                                </div>
                                                <p class="text-sm font-semibold text-slate-900">
                                                    {{ $client->client_name ?? '---' }} [{{ $client->client_email ?? '---' }}] 
                                                </p>
                                                   
                                            </div>
                                        </td>

                                        <!-- Email (Hidden on mobile) -->
                                        <td class="px-4 sm:px-6 py-4 text-sm text-slate-600 hidden sm:table-cell">
                                            <a href="mailto:{{ $client->client_email }}" class="hover:text-blue-600 transition-colors">
                                                {{ $client->client_email ?? '---' }}
                                            </a>
                                        </td>

                                        <!-- Total Invoices (Hidden on tablet) -->
                                        <td class="px-4 sm:px-6 py-4 text-sm hidden md:table-cell">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                                {{ $client->invoices_count ?? 0 }}
                                            </span>
                                        </td>

                                        <!-- Total Billed (Hidden on lg) -->
                                        <td class="px-4 sm:px-6 py-4 text-sm font-semibold text-slate-900 hidden lg:table-cell">
                                            <span class="text-emerald-600">
                                                {{ $client->invoices->first()->currency ?? 'NGN' }}
                                                {{ isset($client->total_billed) ? number_format($client->total_billed, 2) : '0.00' }}
                                            </span>
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-4 sm:px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                {{-- <a href="{{ route('clients.edit', $client->id) }}" 
                                                   class="p-2 text-slate-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                                                   title="Edit">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 9l-4.663-4.663m0 0l1.25-1.25a2.25 2.25 0 013.182 3.182l-1.25 1.25m0 0L9.75 17.25" />
                                                    </svg>
                                                </a> --}}
                                                <button 
                                                   class="p-2 text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200"
                                                   title="Delete"
                                                   onclick="if(confirm('Are you sure you want to delete this client?')) { /* delete logic */ }">
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
                            Showing <span class="font-semibold text-slate-900">{{ $clients->firstItem() ?? 0 }}</span> 
                            to <span class="font-semibold text-slate-900">{{ $clients->lastItem() ?? 0 }}</span> 
                            of <span class="font-semibold text-slate-900">{{ $clients->total() ?? 0 }}</span> clients
                        </p>
                        <div class="flex gap-2 justify-start sm:justify-end">
                            {{ $clients->links() }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    @include('popups.add-client')

</x-app-layout>
