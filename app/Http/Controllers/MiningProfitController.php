<?php

namespace App\Http\Controllers;

use App\Models\MiningProfit;
use Illuminate\Http\Request;

class MiningProfitController extends Controller
{
    public function index()
    {
        $profits = MiningProfit::latest()->with('user')->paginate(20);
        return view('admin.mining_profit.index', compact('profits'));
    }
}
