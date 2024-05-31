<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all(); // すべての注文履歴を取得
        return view('orders.index', compact('orders')); // 注文履歴一覧を表示するビューへデータを渡す
    }
}
