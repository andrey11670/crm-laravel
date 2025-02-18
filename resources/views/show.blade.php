@extends('layouts/app')

@section('content')
    <a type="submit" class="btn btn-primary btn-lg px-4 gap-3" href="{{URL::to('/orders')}}">Вернуться к заказам</a>
    <form action="/orders/{{$order->id}}" method="POST">
        @csrf

        @method('PATCH')
            <div class="">Поле редактирования имени заказчика</div>
            <input type="text" name="customer" value="{{$order->customer}}">

            <div style="padding: 30px 0">{{$order->customer}} - Заказчик; </div>

            <div>{{$order->status }} - Статус;  </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

          @foreach (['message', 'message8', 'message9'] as $message)
            @if (session($message))
                <div class="alert alert-danger">
                    {{ session($message) }}
                </div>
            @endif
        @endforeach


        @if(session('success'))
            <div class="alert alert-success">
                {{session('success') }}
            </div>
        @endif
        <table>
        @foreach($orderItems as $key => $value)

                <tr>
                    <td><div>{{$products[$key]->name}} - Название товара;</div></td>
                    <td><div>{{$products[$key]->price}} - Цена товара;</div></td>
                    <td><div>{{ $products[$key]->id }} - продукт айди;</div></td>
                    <td><div>{{ $products[$key]->stock->stock }} - остатки;</div></td>

                    <td style="display: flex; align-items: center; gap: 10px;" class="product-item" data-product-id="{{$products[$key]->id}}">
                        <input type="hidden" name="count[{{ $products[$key]->id }}]" value="{{$value->count}}">
                        <button class="plus-btn" type="button">+</button>
                        <span class="quantity">{{$value->count}}</span>
                        <button class="minus-btn" type="button">-</button>
                        <p style="display: inline-block; margin: auto;}">  - Количество</p>
                    </td>

                    <td><input type="checkbox" class="checkbox"  name="order_items[]" value="{{$value->id}}">
                        <label for="{{$products[$key]->id}}">Удалить </label></td>
                </tr>
            @endforeach
        </table>

        <button type="submit" class="btn btn-primary btn-lg px-4 gap-3">Сохранить изменеия</button>
    </form>


@endsection
