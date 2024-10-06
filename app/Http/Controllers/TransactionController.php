<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __invoke()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $transactions=Auth::user()->transaction()->orderBy('date','desc')->paginate(5);
        return view('dashboard',['transactions'=>$transactions]);
    }

    public function create()
    {
        return view('transaction_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'=>'required|in:income,expense',
            'amount'=>'required|numeric|min:0.01',
            'category'=>'required|string|max:255',
            'date'=>'required|date',
            'description'=>'nullable|string',
        ]);

        Auth::user()->transaction()->create($request->all());
        return redirect()->route('dashboard')->with('success','Transaction added successfully!');

    }
       
    public function edit($id)
    {
        $transaction=Transaction::findOrFail($id);

        if($transaction->user_id!==Auth::id()){
            abort(403);
        }
        return view('transactions_edit',['transaction'=>$transaction]);
    }

    public function update(Request $request, $id)
    {
        $transaction=Transaction::findOrFail($id);

        if($transaction->user_id!== Auth::id()){
            abort(403);
        }

        $request->validate([
            'type'=>'required|in:income,expense',
            'amount'=>'required|numeric|min:0.01',
            'category'=>'required|string|max:255',
            'date'=>'required|date',
            'description'=>'nullable|string',
        ]);
        
        $transaction->update($request->all());
        return redirect()->route('dashboard')->with('success','Transaction updated successfully!');
    }
    
    public function destroy($id)
    {   
        $transaction=Transaction::findOrFail($id);
        if($transaction->user_id!==Auth::id())
        {
            abort(403);
        }

        $transaction->delete();
        return redirect()->route('dashboard')->with('success','Transaction deleted successfully');
    }

    public function filter(Request $request)
    {
        $query = Transaction::query();

        $search = $request->input('search');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('type', 'like', '%' . $search . '%')
                  ->orWhere('amount', 'like', '%' . $search . '%')
                  ->orWhere('category', 'like', '%' . $search . '%')
                  ->orWhere('date', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            $query->whereBetween('date', [$fromDate, $toDate]);
        }

        $transactions = $query->get();

        return view('dashboard',['transactions'=>$transactions]);
    }

    public function monthlyChart()
    {
        $year = now()->year;

        $monthlyIncome = Transaction::selectRaw('MONTH(date) as month, SUM(amount) as total')
            ->where('user_id', Auth::id())
            ->where('type', 'income')
            ->whereYear('date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $monthlyExpense = Transaction::selectRaw('MONTH(date) as month, SUM(amount) as total')
            ->where('user_id', Auth::id())
            ->where('type', 'expense')
            ->whereYear('date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $incomeData = [];
        $expenseData = [];
    
        for ($i = 1; $i <= 12; $i++) {
            $incomeData[] = $monthlyIncome[$i] ?? 0;
            $expenseData[] = $monthlyExpense[$i] ?? 0;
        }

        return view('chart', compact('incomeData', 'expenseData'));
    }
}