<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\BusinessModel;
use App\Models\ClientModel;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class invoiceController extends Controller
{
    public function getClientsAndBusinesses()
    {
        $clients = ClientModel::where('user_id', auth()->id())
            ->orderBy('client_name')
            ->select('id', 'client_name', 'client_email')
            ->get();

        $businesses = BusinessModel::where('user_id', auth()->id())
            ->orderBy('business_name')
            ->select('id', 'business_name', 'business_email')
            ->get();

        $userInitials = Auth::user()->getNameInitials(); // getnameInitials is defined in User model.

        return view('invoices.create', compact('clients', 'businesses', 'userInitials'));
    }

    public function createInvoice(InvoiceRequest $request)
    {
        $data = $request->validated();

        $invoice = DB::transaction(function () use ($data) {
            $year = Carbon::parse($data['issue_date'])->year;

            // Lock last invoice row for this business/year to avoid race conditions
            $lastInvoice = Invoice::where('business_id', $data['business_id'])
                ->whereYear('issue_date', $year)
                ->lockForUpdate()
                ->orderByDesc('id')
                ->first();

            // Dynamically generate invoice number
            do {
                $nextNumber = $lastInvoice
                    ? (int) substr($lastInvoice->invoice_number, -5) + 1
                    : 1;

                $formattedSequence = str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
                $invoiceNumber = "INV-{$formattedSequence}";

                // Check if invoice number already exists
                $exists = Invoice::where('invoice_number', $invoiceNumber)
                    ->lockForUpdate()
                    ->exists();

                $nextNumber++; // increment if it exists
            } while ($exists);

            // calculate monetary values
            $subtotal = collect($data['items'])->sum(fn ($item) => $item['quantity'] * $item['price']);
            $taxAmount = $subtotal * ($data['tax'] / 100);
            $total = $subtotal + $taxAmount - $data['discount'];

            if ($total < 0) {
                throw ValidationException::withMessages([
                    'discount' => 'Discount cannot exceed invoice total.',
                ]);
            }

            $invoiceData = collect($data)
                ->except(['items']) // remove nested items
                ->toArray();

            $invoiceData['user_id'] = auth()->id(); // explicitly set user_id
            $invoiceData['invoice_number'] = $invoiceNumber;
            $invoiceData['subtotal'] = round($subtotal, 2);
            $invoiceData['tax'] = round($taxAmount, 2);
            $invoiceData['total'] = round($total, 2);

            $invoice = Invoice::create($invoiceData);

            foreach ($data['items'] as $item) {
                $invoice->items()->create([
                    ...$item,
                    'total' => round($item['quantity'] * $item['price'], 2),
                ]);
            }

            return $invoice;
        });

        return response()->json([
            'status' => true,
            'message' => 'Invoice created successfully.',
            // 'data' => $invoice
        ]);
    }

    public function fetchInvoices()
    {
        $userInitials = Auth::user()->getNameInitials(); // getnameInitials is defined in User model.

        $invoices = Invoice::with(['business', 'client'])
            ->latest()
            ->paginate(10);

        return view('pages.invoices', compact('invoices', 'userInitials'));
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['business.bankAccounts', 'client', 'items']);

        return view('invoices.show', compact('invoice'));
    }

    public function updateInvoice(Invoice $invoice, Request $request)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:draft,sent,paid,partial,overdue,cancelled'],
        ]);

        $invoice->status = $validated['status'];

        $invoice->save();

        return response()->json([
            'status' => true,
            'message' => 'You have successfully updated your invoice',
        ]);
    }

    public function pdfView(Invoice $invoice)
    {
        $invoice->load(['business', 'client', 'items']);

        return view('invoices.show', compact('invoice'));
    }

    // public function downloadInvoicePdf(Invoice $invoice)
    // {
    //     \Log::info('PDF download attempt', [
    //         'user_id' => auth()->id(),
    //         'user_id_type' => gettype(auth()->id()),
    //         'invoice_id' => $invoice->id,
    //         'invoice_user_id' => $invoice->user_id,
    //         'invoice_user_id_type' => gettype($invoice->user_id),
    //         'url' => request()->fullUrl(),
    //     ]);

    //     if ($invoice->user_id != auth()->id()) {
    //         \Log::warning('PDF download blocked - ownership mismatch', [
    //             'auth_id' => auth()->id(),
    //             'invoice_user_id' => $invoice->user_id,
    //         ]);
    //         abort(403);
    //     }

    //     $invoice->load(['business', 'client', 'items']);

    //     // Pass a flag to indicate PDF mode
    //     $pdf = Pdf::loadView('invoices.pdf', [
    //         'invoice' => $invoice,
    //     ])->setPaper('a4', 'portrait');

    //     return response()->streamDownload(
    //         fn () => print ($pdf->output()),
    //         "invoice-{$invoice->invoice_number}.pdf"
    //     );
    // }

    public function downloadInvoicePdf(Invoice $invoice)
    {
        return response('Test: Invoice '.$invoice->id.' for user '.auth()->id());
    }
}
