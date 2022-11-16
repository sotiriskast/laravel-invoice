<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class ClientTransactionsExport implements FromView
{
    /**
     *
     * @return View
     */
    public function view(): View
    {
        $query = Payment::with('invoice.client.user')->select('payments.*');
        $user = Auth::user();
        if ($user->hasRole('client')) {
            $query->whereHas('invoice.client', function ($q) use ($user) {
                $q->where('user_id', $user->client->user_id);
            });
        }
        $transactions = $query->get();

        return view('excel.client_transactions_excel', compact('transactions'));
    }
}
