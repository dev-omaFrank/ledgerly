<?php

namespace App\Http\Controllers;

class SubscriptionsController extends Controller
{
    public function loadSubscriptionsPage()
    {
        $user = auth()->user();
        $userInitials = $user->getNameInitials();

        // Get all subscriptions for the user with plan, sorted by start date descending
        $subscriptions = $user->subscriptions()
            ->with('plan')
            ->orderByDesc('start_date') 
            ->get()
            ->unique('plan_id') 
            ->values();         

        // Convert date fields to Carbon instances
        $subscriptions->transform(function ($subscription) {
            $subscription->start_date = $subscription->start_date ? \Carbon\Carbon::parse($subscription->start_date) : null;
            $subscription->end_date = $subscription->end_date ? \Carbon\Carbon::parse($subscription->end_date) : null;
            $subscription->next_billing_date = $subscription->next_billing_date ? \Carbon\Carbon::parse($subscription->next_billing_date) : null;

            return $subscription;
        });

        // Paginate manually using LengthAwarePaginator
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $currentItems = $subscriptions->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedSubscriptions = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentItems,
            $subscriptions->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('pages.subscriptions', [
            'userInitials' => $userInitials,
            'subscriptions' => $paginatedSubscriptions,
        ]);
    }
}
