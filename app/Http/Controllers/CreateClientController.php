<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientProfileRequest;
use App\Models\ClientModel;
use Illuminate\Support\Facades\Auth;

class CreateClientController extends Controller
{
    public function fetchClients()
    {        
        $userInitials = Auth::user()->getNameInitials(); //getnameInitials is defined in User model.

        $clients = ClientModel::where('user_id', auth()->id())
            ->with(['business', clients]);
            ->withSum('invoices as total_billed', 'total')
            ->with(['invoices' => function($query){
                $query->latest()->select('id', 'client_id', 'currency');
            }])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.clients', compact(
            'userInitials',
            'clients',
        ));
    }

    public function createClient(StoreClientProfileRequest $request)
    {
        $data = $request->validated();

        ClientModel::create([
            'user_id' => auth()->id(),
            'client_name' => $data['clientName'],
            'client_email' => $data['clientEmail'],
            'client_address' => $data['clientAddress'],
            'client_phone_no' => $data['clientPhoneNo'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'You have successfully created a client profile for ' . $data['clientName']
        ]);

    }
}
