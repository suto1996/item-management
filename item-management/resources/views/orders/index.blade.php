@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>注文履歴</h2>
        @if ($orders->isEmpty())
            <p>注文履歴がありません。</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>注文番号</th>
                        <th>注文者名</th>
                        <th>注文日時</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td><a href="{{ route('orders.show', $order->id) }}">詳細を表示</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
