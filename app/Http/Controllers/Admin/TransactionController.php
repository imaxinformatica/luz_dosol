<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Order::all();
        return view('admin.pages.transaction.index')
        ->with('transactions', $transactions);
    }

    public function show(Order $transaction)
    {
        return view('admin.pages.transaction.show')
        ->with('order', $transaction);
    }
}
