<x-app-layout>
    <x-auth-navbar :userInitials="$userInitials"/>

    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
        <x-mobile-toggle-button />
        
        <div class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6">
            
            <!-- Page Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Invoices</h1>
                    <p class="text-slate-600 mt-1 text-sm sm:text-base">Manage and track all your invoices</p>
                </div>
            </div>

            <!-- Search & New Invoice -->
            <div class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-center">
                <div class="relative flex-1 max-w-md">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-slate-400 pointer-events-none"
                        fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.5 5.5a7.5 7.5 0 0010.5 10.5z" />
                    </svg>
                    <input type="text" placeholder="Search invoices by ID..."
                        class="pl-10 pr-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all bg-white text-slate-900 placeholder-slate-400 text-sm">
                </div>
                <a href="{{ route('invoices.create.get') }}" class="px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors duration-200 shadow-sm flex items-center justify-center gap-2 whitespace-nowrap">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New Invoice
                </a>
            </div>

            <!-- Invoices Table Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                
                <!-- Table Header -->
                <div class="px-4 sm:px-6 py-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <h2 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                        <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.66V6.75a9 9 0 015.25-1.526c.055 0 .11 0 .162.01.868-.021 1.713.211 2.406.673a2.25 2.25 0 012.25 2.25v12.75c0 1.141-.901 2.112-2.064 2.192m-7.889-14.071A8.973 8.973 0 0112 15.75c2.9 0 5.461 1.04 7.5 2.75m0 0A8.973 8.973 0 0112 20.25c-2.9 0-5.461-1.04-7.5-2.75" />
                        </svg>
                        All Invoices
                    </h2>
                </div>

                <!-- Responsive Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b-2 border-slate-200 bg-slate-50">
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Invoice ID</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider hidden sm:table-cell">Client</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider hidden md:table-cell">Amount</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider hidden lg:table-cell">Date</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">Status</th>
                                <th class="px-4 sm:px-6 py-3 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($invoices as $invoice)
                                <tr class="hover:bg-blue-50/50 transition-colors duration-150">
                                    <!-- Invoice ID -->
                                    <td class="px-4 sm:px-6 py-4 text-sm font-semibold text-blue-600">
                                        {{ $invoice->invoice_number }}
                                    </td>

                                    <!-- Client (Hidden on mobile) -->
                                    <td class="px-4 sm:px-6 py-4 text-sm text-slate-900 hidden sm:table-cell">
                                        {{ $invoice->client->client_name }}
                                    </td>

                                    <!-- Amount (Hidden on tablet) -->
                                    <td class="px-4 sm:px-6 py-4 text-sm font-semibold text-slate-900 hidden md:table-cell">
                                        {{ $invoice->total }}
                                    </td>

                                    <!-- Date (Hidden on lg) -->
                                    <td class="px-4 sm:px-6 py-4 text-sm text-slate-600 hidden lg:table-cell">
                                        {{ $invoice->issue_date }}
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="px-4 sm:px-6 py-4 text-sm">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap
                                            @if ($invoice->status === 'Paid') 
                                                bg-emerald-100 text-emerald-700 border border-emerald-200
                                            @elseif($invoice->status === 'Sent') 
                                                bg-amber-100 text-amber-700 border border-amber-200
                                            @else 
                                                bg-red-100 text-red-700 border border-red-200 
                                            @endif">
                                            {{ Illuminate\Support\Str::of($invoice->status)->upper() }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-4 sm:px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('invoices.show', $invoice->id) }}" 
                                               class="p-2 text-slate-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200"
                                               title="View">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </a>
                                            {{-- <a href="{{ route('invoices.edit', $invoice->id) }}" 
                                               class="p-2 text-slate-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors duration-200"
                                               title="Edit">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 9l-4.663-4.663m0 0l1.25-1.25a2.25 2.25 0 013.182 3.182l-1.25 1.25m0 0L9.75 17.25" />
                                                </svg>
                                            </a> --}}
                                            <button 
                                               class="p-2 text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200"
                                               title="Delete"
                                               onclick="if(confirm('Are you sure?')) { /* delete logic */ }">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 2.991a1.125 1.125 0 00-1.06-1.161H7.9c-.51 0-.955.406-1.06 1.161L4.822 5.79m12.986-3.21c-.342-.052-.682-.107-1.022-.166M15 12.75v6m-6-6v6m12-9v.008v9.992a2.25 2.25 0 01-2.25 2.25H5.25a2.25 2.25 0 01-2.25-2.25V6.008V2.25a2.25 2.25 0 012.25-2.25h13.5a2.25 2.25 0 012.25 2.25z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination & Info -->
                <div class="px-4 sm:px-6 py-4 border-t border-slate-200 bg-gradient-to-r from-slate-50 to-white">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <p class="text-sm text-slate-600">
                            Showing <span class="font-semibold text-slate-900">{{ $invoices->firstItem() }}</span> 
                            to <span class="font-semibold text-slate-900">{{ $invoices->lastItem() }}</span> 
                            of <span class="font-semibold text-slate-900">{{ $invoices->total() }}</span> results
                        </p>
                        <div class="flex gap-2 justify-start sm:justify-end">
                            {{ $invoices->links() }}
                        </div>
                    </div>
                </div>

            </div>

            <!-- Empty State (if no invoices) -->
            @if($invoices->isEmpty())
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
                    <svg class="h-16 w-16 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.66V6.75a9 9 0 015.25-1.526c.055 0 .11 0 .162.01.868-.021 1.713.211 2.406.673a2.25 2.25 0 012.25 2.25v12.75c0 1.141-.901 2.112-2.064 2.192m-7.889-14.071A8.973 8.973 0 0112 15.75c2.9 0 5.461 1.04 7.5 2.75m0 0A8.973 8.973 0 0112 20.25c-2.9 0-5.461-1.04-7.5-2.75" />
                    </svg>
                    <h3 class="text-lg font-semibold text-slate-900 mb-2">No invoices yet</h3>
                    <p class="text-slate-600 mb-6">Create your first invoice to get started</p>
                    <a href="{{ route('invoices.create.get') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create Invoice
                    </a>
                </div>
            @endif

        </div>
    </div>

</x-app-layout>
