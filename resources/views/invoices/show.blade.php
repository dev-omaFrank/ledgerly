<x-app-layout>
    @php
        $isPdf = request()->query('download') ?? false;
    @endphp

    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
        <x-mobile-toggle-button/>

        <div class="flex-1 p-4 sm:p-6 lg:p-8">
            <div class="max-w-5xl mx-auto space-y-6 bg-white shadow-sm border border-slate-200 rounded-xl overflow-hidden">

                @if($isPdf)
                    {{-- PDF-friendly layout(pdf-version) --}}
                    <div class="p-6 sm:p-8 space-y-6">
                        <!-- Header -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Invoice {{ $invoice->invoice_number }}</h1>
                                <p class="text-sm text-slate-600 mt-1">Issued {{ \Carbon\Carbon::parse($invoice->issue_date)->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-slate-900">STATUS:</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $invoice->status === 'paid' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                    {{ $invoice->status === 'draft' ? 'bg-slate-100 text-slate-700' : '' }}
                                    {{ $invoice->status === 'overdue' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ !in_array($invoice->status, ['paid','draft','overdue']) ? 'bg-amber-100 text-amber-700' : '' }}
                                ">
                                    {{ Str::upper($invoice->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Business & Client Info -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 border border-slate-200 rounded-lg">
                                <h3 class="font-semibold text-slate-900 mb-2">From</h3>
                                <p class="font-medium text-slate-900">{{ $invoice->business->business_name }}</p>
                                <p class="text-sm text-slate-600">{{ $invoice->business->business_email }}</p>
                                <p class="text-sm text-slate-600 mt-2">
                                    {{ $invoice->business->bankAccounts->account_name ?? 'N/A' }} | 
                                    {{ $invoice->business->bankAccounts->bank_name ?? 'N/A' }} | 
                                    {{ $invoice->business->bankAccounts->account_number ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="p-4 border border-slate-200 rounded-lg">
                                <h3 class="font-semibold text-slate-900 mb-2">Bill To</h3>
                                <p class="font-medium text-slate-900">{{ $invoice->client->client_name }}</p>
                                <p class="text-sm text-slate-600">{{ $invoice->client->client_email }}</p>
                            </div>
                        </div>

                        <!-- Line Items Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-slate-50 border-b-2 border-slate-200">
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Description</th>
                                        <th class="px-4 py-3 text-center text-xs font-semibold text-slate-600 uppercase">Qty</th>
                                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600 uppercase">Price</th>
                                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-600 uppercase">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200">
                                    @foreach($invoice->items as $item)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="px-4 py-3 text-sm text-slate-900">{{ $item->description }}</td>
                                            <td class="px-4 py-3 text-sm text-slate-900 text-center">{{ $item->quantity }}</td>
                                            <td class="px-4 py-3 text-sm text-slate-900 text-right">{{ $invoice->currency }} {{ number_format($item->price, 2) }}</td>
                                            <td class="px-4 py-3 text-sm font-semibold text-slate-900 text-right">{{ $invoice->currency }} {{ number_format($item->total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Totals -->
                        <div class="flex justify-end">
                            <div class="w-full sm:w-80 space-y-3 border border-slate-200 rounded-lg p-4 bg-slate-50">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-600">Subtotal</span>
                                    <span class="font-medium text-slate-900">{{ $invoice->currency }} {{ number_format($invoice->subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-600">Tax</span>
                                    <span class="font-medium text-slate-900">{{ $invoice->currency }} {{ number_format($invoice->tax, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-600">Discount</span>
                                    <span class="font-medium text-slate-900">- {{ $invoice->currency }} {{ number_format($invoice->discount, 2) }}</span>
                                </div>
                                <div class="border-t border-slate-300 pt-3 flex justify-between">
                                    <span class="font-bold text-slate-900">Total</span>
                                    <span class="font-bold text-lg text-blue-600">{{ $invoice->currency }} {{ number_format($invoice->total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        @if($invoice->notes)
                            <div class="p-4 border border-slate-200 rounded-lg bg-slate-50">
                                <h3 class="font-semibold text-slate-900 mb-2">Notes</h3>
                                <p class="text-sm text-slate-600">{{ $invoice->notes }}</p>
                            </div>
                        @endif

                        <!-- Footer -->
                        <div class="border-t border-slate-200 pt-6 text-center">
                            <p class="text-sm text-slate-600">Please pay within 14 days. Contact {{ $invoice->business->business_email }} for questions.</p>
                            <p class="text-xs text-slate-500 mt-2">Generate customized Invoices with Digital Horizon. Visit <a href="{{ url('/') }}" class="text-blue-600 hover:underline">{{ url('/') }}</a> to get started.</p>
                        </div>
                    </div>

                @else
                    {{-- Web-based responsive layout --}}
                    <div class="p-4 sm:p-6 lg:p-8 space-y-6">
                        <!-- Header with Actions -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Invoice {{ $invoice->invoice_number }}</h1>
                                <p class="text-sm text-slate-600 mt-1">Issued {{ \Carbon\Carbon::parse($invoice->issue_date)->format('M d, Y') }}</p>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="{{ route('invoices.pdf', [$invoice->id, 'download' => 1]) }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm">
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33A3 3 0 0116.5 19.5H6.75z" />
                                    </svg>
                                    Download PDF
                                </a>
                                <a href="{{ route('invoices.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors duration-200 text-sm">
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                                    </svg>
                                    Back
                                </a>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-slate-900">STATUS:</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $invoice->status === 'paid' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                    {{ $invoice->status === 'draft' ? 'bg-slate-100 text-slate-700' : '' }}
                                    {{ $invoice->status === 'overdue' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ !in_array($invoice->status, ['paid','draft','overdue']) ? 'bg-amber-100 text-amber-700' : '' }}
                                ">
                                    {{ Str::upper($invoice->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Business & Client Info -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-6 border border-slate-200 rounded-lg bg-slate-50">
                                <h3 class="text-sm font-semibold text-slate-600 uppercase mb-3">From</h3>
                                <p class="font-bold text-slate-900">{{ $invoice->business->business_name }}</p>
                                <p class="text-sm text-slate-600 mt-1">{{ $invoice->business->business_email }}</p>
                                <p class="text-sm text-slate-600 mt-3">
                                    <span class="font-medium">{{ $invoice->business->bankAccounts->account_name ?? 'N/A' }}</span><br>
                                    {{ $invoice->business->bankAccounts->bank_name ?? 'N/A' }}<br>
                                    {{ $invoice->business->bankAccounts->account_number ?? 'N/A' }}
                                </p>
                            </div>

                            <div class="p-6 border border-slate-200 rounded-lg bg-slate-50">
                                <h3 class="text-sm font-semibold text-slate-600 uppercase mb-3">Bill To</h3>
                                <p class="font-bold text-slate-900">{{ $invoice->client->client_name }}</p>
                                <p class="text-sm text-slate-600 mt-1">{{ $invoice->client->client_email }}</p>
                            </div>
                        </div>

                        <!-- Line Items Table -->
                        <div class="overflow-x-auto border border-slate-200 rounded-lg">
                            <table class="w-full min-w-max">
                                <thead class="bg-slate-50 border-b border-slate-200 sticky top-0 z-10">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap">Description</th>
                                        <th class="px-6 py-3 text-center text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap">Qty</th>
                                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap">Price</th>
                                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200">
                                    @foreach($invoice->items as $item)
                                        <tr class="hover:bg-slate-50 transition-colors duration-150">
                                            <td class="px-6 py-4 text-sm text-slate-900 whitespace-nowrap">{{ $item->description }}</td>
                                            <td class="px-6 py-4 text-sm text-slate-900 text-center whitespace-nowrap">{{ $item->quantity }}</td>
                                            <td class="px-6 py-4 text-sm text-slate-900 text-right whitespace-nowrap">{{ $invoice->currency }} {{ number_format($item->price, 2) }}</td>
                                            <td class="px-6 py-4 text-sm font-semibold text-slate-900 text-right whitespace-nowrap">{{ $invoice->currency }} {{ number_format($item->total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Totals -->
                        <div class="flex justify-end">
                            <div class="w-full sm:w-96 space-y-3 border border-slate-200 rounded-lg p-6 bg-gradient-to-br from-slate-50 to-white">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-600">Subtotal</span>
                                    <span class="font-medium text-slate-900">{{ $invoice->currency }} {{ number_format($invoice->subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-600">Tax</span>
                                    <span class="font-medium text-slate-900">{{ $invoice->currency }} {{ number_format($invoice->tax, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-600">Discount</span>
                                    <span class="font-medium text-slate-900">- {{ $invoice->currency }} {{ number_format($invoice->discount, 2) }}</span>
                                </div>
                                <div class="border-t border-slate-300 pt-3 flex justify-between">
                                    <span class="font-bold text-slate-900">Total</span>
                                    <span class="font-bold text-lg text-blue-600">{{ $invoice->currency }} {{ number_format($invoice->total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        @if($invoice->notes)
                            <div class="p-6 border border-slate-200 rounded-lg bg-slate-50">
                                <h3 class="font-semibold text-slate-900 mb-2">Notes</h3>
                                <p class="text-sm text-slate-600">{{ $invoice->notes }}</p>
                            </div>
                        @endif

                        <!-- Footer -->
                        <div class="border-t border-slate-200 pt-6 space-y-2">
                            <p class="text-sm text-slate-600">Please pay within 14 days. Contact {{ $invoice->business->business_email }} for questions.</p>
                            <p class="text-xs text-slate-500">Generate customized Invoices with {{ config('app_name') }}. Visit <a href="{{ url('/') }}" class="text-blue-600 hover:underline">{{ url('/') }}</a> to get started.</p>
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </div>
</x-app-layout>
