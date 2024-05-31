@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">商品名</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="商品名">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <select class="form-control" id="type" name="type">
                                <option value="">種別を選択してください</option>
                                <option value="トップス">トップス</option>
                                <option value="アウター">アウター</option>
                                <option value="パンツ">パンツ</option>
                                <option value="グッズ">グッズ</option>
                                <!-- 必要に応じて他の種別を追加 -->
                            </select>
                        </div>

                       
                        <div class="form-group">
                            <label for="price">価格</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="価格">
                        </div>
                        <div class="form-group">
                             <label for="stock">在庫数</label>
                             <input type="number" class="form-control" id="stock" name="stock" placeholder="在庫数">
                        </div>

                    </div>

                    <div class="card-footer">
                    <button type="submit" class="btn btn-outline-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
