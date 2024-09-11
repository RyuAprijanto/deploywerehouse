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
<<<<<<< HEAD
     public function viewTransactions()
{
    $userId = Auth::id();

    // Group transactions by year and month, calculate total per month
=======
    public function viewTransactions(Request $request)
    {
        $userId = Auth::id();
        
        // Get the selected month and year from the request, or default to the current month and year
        $selectedMonth = $request->get('month', now()->month);
        $selectedYear = $request->get('year', now()->year);
        
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
        
        // Fetch the filtered transactions based on the selected month and year
        $transactions = Transaction::where('user_id', $userId)
            ->with('transactionType')
            ->when($selectedMonth !== 'All', function ($query) use ($selectedMonth) {
                return $query->whereMonth('date', $selectedMonth);
            })
            ->whereYear('date', $selectedYear)
            ->orderBy('date', 'desc')
            ->paginate(5);
        
        // Calculate total value for the selected month and year

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

>>>>>>> 50d6e19 (yes)
    $monthlyTransactions = DB::table('transactions')
        ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
        ->select(
            DB::raw('YEAR(transactions.date) as year'),
            DB::raw('MONTH(transactions.date) as month'),
<<<<<<< HEAD
            DB::raw('SUM(CASE WHEN transaction_types.name = "sell" THEN transactions.price ELSE -transactions.price END) as total')
=======
            DB::raw('SUM(CASE WHEN transaction_types.name = "Penjualan" THEN transactions.price ELSE -transactions.price END) as total')
>>>>>>> 50d6e19 (yes)
        )
        ->where('transactions.user_id', $userId)
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
<<<<<<< HEAD
        ->get();

    $transactions = Transaction::where('user_id', $userId)
        ->with('transactionType')
        ->orderBy('date', 'desc')
        ->get();
    
    $currentMonth = now()->month;
    $currentYear = now()->year;
    $totalValue = DB::table('transactions')
        ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
        ->where('transactions.user_id', '=', Auth::id())
        ->whereMonth('transactions.date', $currentMonth)
        ->whereYear('transactions.date', $currentYear)  // Add this to restrict to the current year
        ->select(DB::raw('SUM(CASE 
            WHEN transaction_types.name = "sell" THEN transactions.price 
            WHEN transaction_types.name = "buy" THEN -transactions.price 
            ELSE 0 END) as total_profit_loss'))
        ->value('total_profit_loss');

    return view('transactions', [
        'transactions' => $transactions,
        'monthlyTransactions' => $monthlyTransactions,
        'totalValue' => $totalValue
=======
        ->paginate(10); // Adjust the pagination as needed

    return view('monthlyTransactions', [
        'monthlyTransactions' => $monthlyTransactions
>>>>>>> 50d6e19 (yes)
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
