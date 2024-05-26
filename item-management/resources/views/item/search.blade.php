@extends('adminlte::page')

@section('title', '商品検索')

@section('content_header')
    <h1>商品検索</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            <form id="searchForm" action="{{ route('items.index') }}" method="GET"> <!-- 商品一覧画面のURLに変更 -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="商品名を入力してください" name="name" id="name">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="種別を入力してください" name="type" id="type">
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="number" class="form-control" placeholder="最低価格" name="min_price" min="0" id="min_price">
                    </div>
                    <div class="col-md-6">
                        <input type="number" class="form-control" placeholder="最高価格" name="max_price" min="0" id="max_price">
                    </div>
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-outline-secondary" type="submit">検索</button>
                </div>
                <div id="error-message" class="text-danger" style="display:none;">
                    少なくとも1つのフィールドに入力してください。
                </div>
            </form>
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
