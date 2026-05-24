<?php

namespace App\Http\Middleware;

use App\Models\BusinessModel;
use App\Models\Invoice;
use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkFreeLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('billing/upgrade')) {
            return $next($request);
        }

        $userId = auth()->id();

        $noActiveSubscription = Subscription::where('user_id', $userId)
            ->where('status', 'active')
            ->exists();

        $invoiceLimitReached = Invoice::where('user_id', $userId)->count() >= 3;

        $businessLimitReached = BusinessModel::where('user_id', $userId)->count() >= 3;

        if (
            !$noActiveSubscription &&
            ($invoiceLimitReached || $businessLimitReached)
        ) {
            return redirect('billing/upgrade')->setStatusCode(402);
        }

        return $next($request);
    }
}
