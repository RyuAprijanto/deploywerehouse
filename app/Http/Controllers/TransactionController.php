<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Transaction;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function viewTransactions(Request $request)
    {
        $userId = Auth::id();
        $selectedMonth = $request->get('month', 'All');
        $selectedYear = $request->get('year', 'All');
    
        // Group transactions by year and month, calculate total per month
        $monthlyTransactions = DB::table('transactions')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->select(
                DB::raw('YEAR(transactions.date) as year'),
                DB::raw('MONTH(transactions.date) as month'),
                DB::raw('SUM(CASE WHEN transaction_types.name = "Penjualan" THEN transactions.price ELSE -transactions.price END) as total')
            )
            ->where('transactions.user_id', $userId)
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(5)
            ->get();
    
        // Fetch transactions, apply filters only if a specific month or year is selected
        $transactions = Transaction::where('user_id', $userId)
            ->with('transactionType')
            ->when($selectedMonth !== 'All', function ($query) use ($selectedMonth) {
                return $query->whereMonth('date', $selectedMonth);
            })
            ->when($selectedYear !== 'All', function ($query) use ($selectedYear) {
                return $query->whereYear('date', $selectedYear);
            })
            ->orderBy('date', 'desc')
            ->paginate(5);
    
        return view('transactions', [
            'transactions' => $transactions,
            'monthlyTransactions' => $monthlyTransactions,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
        ]);
    }
    
    
    public function viewAllMonthlyTransactions()
{
    $userId = Auth::id();

    $monthlyTransactions = DB::table('transactions')
        ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
        ->select(
            DB::raw('YEAR(transactions.date) as year'),
            DB::raw('MONTH(transactions.date) as month'),
            DB::raw('SUM(CASE WHEN transaction_types.name = "Penjualan" THEN transactions.price ELSE -transactions.price END) as total')
        )
        ->where('transactions.user_id', $userId)
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->paginate(10); // Adjust the pagination as needed

    return view('monthlyTransactions', [
        'monthlyTransactions' => $monthlyTransactions
    ]);
}


    public function create()
    {
        // Get all transaction types
        $transactionTypes = TransactionType::all();

        return view('addTransaction', compact('transactionTypes'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        // Create new transaction
        Transaction::create([
            'user_id' => $userId,
            'date' => $request->input('date'),
            'transaction_type_id' => $request->input('transaction_type_id'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('viewTransactions')->with('success', 'Transaction added successfully.');
    }
}
