<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧と検索機能
     */
    public function index(Request $request)
    {
        $items = Item::query();

        // 商品名での検索
        if ($request->has('name') && $request->input('name') != '') {
            $items->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // 種別での検索
        if ($request->has('type') && $request->input('type') != '') {
            $items->where('type', 'like', '%' . $request->input('type') . '%');
        }

        // 価格での検索
        if ($request->has('min_price') && $request->input('min_price') != '') {
            $items->where('price', '>=', $request->input('min_price'));
        }
        if ($request->has('max_price') && $request->input('max_price') != '') {
            $items->where('price', '<=', $request->input('max_price'));
        }

        // 検索結果を取得
        $items = $items->get();

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'type' => 'required|max:100',  // 追加のバリデーション
                'price' => 'required',  // 追加のバリデーション
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    /**
     * 商品詳細
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);

        return view('item.show', compact('item'));
    }

    /**
     * 商品削除
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect('/items');
    }
}
