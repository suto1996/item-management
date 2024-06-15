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
            $items->where('type', $request->input('type'));
        }


         // 価格での検索
        if ($request->has('min_price') && $request->input('min_price') != '') {
            $minPrice = $request->input('min_price') > 1000000 ? 1000000 : $request->input('min_price');
            $items->where('price', '>=', $minPrice);
        }
        if ($request->has('max_price') && $request->input('max_price') != '') {
            $maxPrice = $request->input('max_price') > 1000000 ? 1000000 : $request->input('max_price');
            $items->where('price', '<=', $maxPrice);
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
                'price' => 'required|integer|min:1|max:1000000',  // 正数のみを許可し、上限を1,000,000に設定
                'stock' => 'required|integer|min:0|max:100', // 在庫数のバリデーションルールを追加
            ],[
                'name.required' => '商品名は必須です。',
                'name.max' => '商品名は100文字以内でなければなりません。',
                'type.required' => '種別は必須です。',
                'type.max' => '種別は100文字以内でなければなりません。',
                'price.required' => '価格は必須です。',
                'price.integer' => '価格は正の整数でなければなりません。',
                'price.min' => '価格は1以上でなければなりません。',
                'price.max' => '価格は1,000,000以下でなければなりません。',
                'stock.required' => '在庫数は必須です。',
                'stock.integer' => '在庫数は整数でなければなりません。',
                'stock.min' => '在庫数は0以上でなければなりません。',
                'stock.max' => '在庫数は100以下でなければなりません。',
                
            ]);
            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
                'stock' => $request->stock, // 在庫数を保存
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    /**
     * 商品編集
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

    /**
     * 商品更新フォームの表示
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);

        return view('item.edit', compact('item'));
    }

    /**
     * 商品更新
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $this->validate($request, [
            'name' => 'required|max:100',
            'type' => 'required|max:100',
            'price' => 'required|integer|min:1|max:1000000', // 正数のみを許可し、上限を1,000,000に設定
            'stock' => 'required|integer|min:0|max:100', // 在庫数のバリデーションルールを追加
        ],[
            'name.required' => '商品名は必須です。',
            'name.max' => '商品名は100文字以内でなければなりません。',
            'type.required' => '種別は必須です。',
            'type.max' => '種別は100文字以内でなければなりません。',
            'price.required' => '価格は必須です。',
            'price.integer' => '価格は正の整数でなければなりません。',
            'price.min' => '価格は1以上でなければなりません。',
            'price.max' => '価格は1,000,000以下でなければなりません。',
            'stock.required' => '在庫数は必須です。',
            'stock.integer' => '在庫数は整数でなければなりません。',
            'stock.min' => '在庫数は0以上でなければなりません。',
            'stock.max' => '在庫数は100以下でなければなりません。',
        ]);

        // 商品更新
        $item = Item::findOrFail($id);
        $item->name = $request->name;
        $item->type = $request->type;
        $item->price = $request->price;
        $item->stock = $request->stock; // 在庫数を更新
        $item->save();

        return redirect('/items')->with('success', '商品が更新されました。');
    }

    public function duplicate($id)
    {
        $item = Item::findOrFail($id);
        
        // 複製処理
        $newItem = $item->replicate();
        $newItem->save();

        return redirect()->route('items.index')->with('success', 'アイテムが複製されました。');
    }
    
    
}
