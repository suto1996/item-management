@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">商品名</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="type">種別</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">種別を選択してください</option>
                                <option value="トップス" {{ $item->type == 'トップス' ? 'selected' : '' }}>トップス</option>
                                <option value="アウター" {{ $item->type == 'アウター' ? 'selected' : '' }}>アウター</option>
                                <option value="パンツ" {{ $item->type == 'パンツ' ? 'selected' : '' }}>パンツ</option>
                                <option value="グッズ" {{ $item->type == 'グッズ' ? 'selected' : '' }}>グッズ</option>
                                <!-- 他の種別のオプションを追加 -->
                            </select>
                            @error('type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">価格</label>
                            <input type="text" name="price" id="price" class="form-control" value="{{ $item->price }}">
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">在庫数</label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ $item->stock }}">
                            @error('stock')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-success">更新</button>
                        <a href="{{ url('items') }}" class="btn btn-outline-dark">戻る</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <!-- Optional: Add custom CSS here -->
@stop

@section('js')
    <!-- Optional: Add custom JS here -->
@stop
