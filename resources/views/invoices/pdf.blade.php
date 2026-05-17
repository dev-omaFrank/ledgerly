<x-pdf-layout :invoice="$invoice">
    @php
        $statusClass = match ($invoice->status) {
            'paid' => 'status-paid',
            'draft' => 'status-draft',
            'overdue' => 'status-overdue',
            default => 'status-pending',
        };
    @endphp

    <!-- Header -->
    <div class="header">
        <h1>Invoice {{ $invoice->invoice_number }}</h1>
        <p>Issued {{ \Carbon\Carbon::parse($invoice->issue_date)->format('M d, Y') }}</p>
    </div>

    <!-- Status -->
    <div class="status-row">
        <span class="status-label">STATUS:</span>
        <span class="status-badge {{ $statusClass }}">{{ Str::upper($invoice->status) }}</span>
    </div>

    <!-- Business & Client -->
    <table class="layout-table">
        <tr>
            <td>
                <div class="info-box">
                    <h3>From</h3>
                    <p class="name">{{ $invoice->business->business_name }}</p>
                    <p class="detail">{{ $invoice->business->business_email }}</p>
                    <p class="detail" style="margin-top: 8px;">
                        {{ $invoice->business->bankAccounts->account_name ?? 'N/A' }} |
                        {{ $invoice->business->bankAccounts->bank_name ?? 'N/A' }} |
                        {{ $invoice->business->bankAccounts->account_number ?? 'N/A' }}
                    </p>
                </div>
            </td>
            <td class="right">
                <div class="info-box">
                    <h3>Bill To</h3>
                    <p class="name">{{ $invoice->client->client_name }}</p>
                    <p class="detail">{{ $invoice->client->client_email }}</p>
                </div>
            </td>
        </tr>
    </table>

    <!-- Line Items -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 50%;">Description</th>
                <th style="width: 10%;" class="text-center">Qty</th>
                <th style="width: 20%;" class="text-right">Price</th>
                <th style="width: 20%;" class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoice->items as $item)
                <tr>
                    <td>{{ $item->description ?? 'No description' }}</td>
                    <td class="text-center">{{ $item->quantity ?? 0 }}</td>
                    <td class="text-right">{{ $invoice->currency }} {{ number_format($item->price ?? 0, 2) }}</td>
                    <td class="text-right font-bold">{{ $invoice->currency }}
                        {{ number_format($item->total ?? 0, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #64748b; padding: 20px;">No items found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Totals -->
    <table class="totals-wrapper">
        <tr>
            <td>
                <div class="totals-box">
                    <div class="totals-row">
                        <span class="label">Subtotal</span>
                        <span class="value">{{ $invoice->currency }}
                            {{ number_format($invoice->subtotal ?? 0, 2) }}</span>
                    </div>
                    <div class="totals-row">
                        <span class="label">Tax</span>
                        <span class="value">{{ $invoice->currency }}
                            {{ number_format($invoice->tax ?? 0, 2) }}</span>
                    </div>
                    <div class="totals-row">
                        <span class="label">Discount</span>
                        <span class="value">- {{ $invoice->currency }}
                            {{ number_format($invoice->discount ?? 0, 2) }}</span>
                    </div>
                    <div class="totals-row total">
                        <span class="label font-bold">Total</span>
                        <span class="value">{{ $invoice->currency }}
                            {{ number_format($invoice->total ?? 0, 2) }}</span>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Notes -->
    @if ($invoice->notes)
        <div class="notes" style="margin-top: 30px;">
            <h3>Notes</h3>
            <p>{{ $invoice->notes }}</p>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer" style="margin-top: 30px;">
        <p>Please pay within 14 days. Contact {{ $invoice->business->business_email }} for questions.</p>
        <p style="margin-top: 8px; font-size: 11px;">Generate customized Invoices with {{ config('app.name') }}. Visit
            <a href="{{ url('/') }}">{{ url('/') }}</a> to get started.</p>
    </div>
</x-pdf-layout>
