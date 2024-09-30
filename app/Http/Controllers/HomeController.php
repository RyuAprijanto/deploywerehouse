<?php
  
namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class HomeController extends Controller
{
    
    public function index_home(){
        $products = DB::table('products')
            ->join('users', 'products.user_id', '=', 'users.id')
            ->where('user_id', '=', Auth::user()->id)
            ->select('products.*')
            ->simplePaginate(8); 
            $allTypes = DB::table('products')
            ->join('types', 'products.type_id', '=', 'types.id')
            ->where('products.user_id', '=', Auth::user()->id)
            ->select('types.name')
            ->distinct()
            ->pluck('name');
        return view('main', compact('products', 'allTypes'));
    }
    
    public function viewPageSearch(Request $request)
{
    $search = $request->input('search');
    $type = $request->input('type');
    $sortBy = $request->input('sort_by', 'name'); // Default sorting by name
    $sortOrder = $request->input('sort_order', 'asc'); // Default sort order ascending

    // Fetch all unique types
    $allTypes = DB::table('products')
        ->join('types', 'products.type_id', '=', 'types.id')
        ->where('products.user_id', '=', Auth::user()->id)
        ->select('types.name')
        ->distinct()
        ->pluck('name');

    $query = DB::table('products')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->join('types', 'products.type_id', '=', 'types.id') // Always join the types table
        ->where('products.user_id', '=', Auth::user()->id);

    // Search bar
    if ($search) {
        $query->where('products.name', 'LIKE', "%{$search}%");
    }

    // Filter bar
    if ($type && $type !== 'All') {
        $query->where('types.name', $type);
    }

    // Apply sorting
    $products = $query->select('products.*', 'types.name as type_name')
        ->orderBy($sortBy, $sortOrder) // Apply sorting
        ->paginate(8);

    return view('main', compact('products', 'search', 'type', 'allTypes'));
}


    


public function showProfile()
{
    $user = Auth::user();

    // Fetch recent changes
    $recentChanges = History::with('user')
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    // Fetch the last 5 months of profit/loss
    $monthlyTransactions = DB::table('transactions')
        ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
        ->select(
            DB::raw('YEAR(transactions.date) as year'),
            DB::raw('MONTH(transactions.date) as month'),
            DB::raw('SUM(CASE WHEN transaction_types.name = "Penjualan" THEN transactions.price ELSE -transactions.price END) as total')
        )
        ->where('transactions.user_id', $user->id) // Corrected user ID reference
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->limit(5)
        ->get();

    return view('profile', compact('user', 'recentChanges', 'monthlyTransactions'));
}


    public function index_addItem(Request $request)
    {
        //home ke add item? idk
        return view('addItem');

    }
}