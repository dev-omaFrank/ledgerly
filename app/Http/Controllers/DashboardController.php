<?php

namespace App\Http\Controllers;

use App\Models\ClientModel;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function fetchDashboardStats(){
        $userId = auth()->id();
        $userInitials = Auth::user()->getNameInitials(); //getnameInitials is defined in User model.

        $totalRevenue = Invoice::where('status', 'paid')
            ->where('user_id', $userId)
            ->sum('total');

        $outstandingRevenue = Invoice::whereIn('status', ['sent', 'overdue'])
            ->where('user_id', $userId)
            ->sum('total');

        $activeClients = ClientModel::where('user_id', $userId)
            ->whereHas('invoices')
            ->count();

        // $avgPaymentTime = Invoice::where('status', 'Paid')
        //     ->where('user_id', $userId)
        //     ->selectRaw('AVG(DATEDIFF(paid_date, issue_date)) as avg_days')
        //     ->value('avg_days');

        $invoices = Invoice::with(['business', 'client'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);


        return view('pages.dashboard', compact(
            'userInitials',
            'totalRevenue',
            'outstandingRevenue',
            'activeClients',
            // 'avgPaymentTime',
            'invoices'
        ));
    }
}
