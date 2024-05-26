@extends('adminlte::page')

@section('title', '商品詳細')

@section('content_header')
    <h1>商品詳細</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $item->name }}</h3>
                </div>
                <div class="card-body">
                    <p>ID: {{ $item->id }}</p>
                    <p>商品名: {{ $item->name }}</p>
                    <p>種別: {{ $item->type }}</p>
                    <p>価格: {{ $item->detail }}</p>
                    <a href="{{ url('items') }}" class="btn btn-outline-dark">戻る</a>
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
