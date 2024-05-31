@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <form id="searchForm" action="{{ route('items.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="商品名を入力してください" name="name" id="name" value="{{ request('name') }}">
                                </div>
                                <div class="input-group mb-3">
                    <select class="form-control" name="type" id="type">
                        <option value="">種別を選択してください</option>
                        <option value="トップス">トップス</option>
                        <option value="アウター">アウター</option>
                        <option value="パンツ">パンツ</option>
                        <option value="グッズ">グッズ</option>
                        <!-- 他の種別のオプションを追加 -->
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="number" class="form-control" placeholder="最低価格" name="min_price" min="0" id="min_price" value="{{ request('min_price') }}">
                    </div>
                    <div class="col-md-6">
                        <input type="number" class="form-control" placeholder="最高価格" name="max_price" min="0" id="max_price" value="{{ request('max_price') }}">
                    </div>
                </div>
               
                    <button class="btn btn-outline-secondary" type="submit">検索</button>
                </div>
                <div id="error-message" class="text-danger" style="display:none;">
                    少なくとも1つのフィールドに入力してください。
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if($items->isEmpty())
                <p>該当する商品が見つかりませんでした。</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>商品名</th>
                            <th>種別</th>
                            <th>価格</th>
                            <th>在庫数</th> 

                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->stock }}</td> <!-- データに追加 -->

                                
                                
                                <td class="text-right">
                                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-outline-info btn-sm">編集</a>
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('本当に削除しますか？')">削除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@stop

@section('css')
    <style>
        #error-message {
            margin-top: 10px;
        }
    </style>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('searchForm');
            const errorMessage = document.getElementById('error-message');
            const inputs = form.querySelectorAll('input');

            form.addEventListener('submit', function(event) {
                if (Array.from(inputs).every(input => input.value.trim() === '')) {
                    event.preventDefault();
                    errorMessage.style.display = 'block';
                } else {
                    errorMessage.style.display = 'none';
                }
            });

            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (Array.from(inputs).some(input => input.value.trim() !== '')) {
                        errorMessage.style.display = 'none';
                    }
                });
            });
        });
    </script>
@stop
