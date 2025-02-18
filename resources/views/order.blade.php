@extends('layouts/app')

@section('content')
    <div class="course">
        Курс USD = {{$course}} RUB<br>
        <p>От сайта <a class="course_link" href="https://currencylayer.com/">Currencylayer</a></p>
    </div>
    <div class="form-filter">

    <form action="" id="filter">
        <div class="" style="margin: 20 auto">
            <select class="form-control sort" name="warehouse" id="warehouse">

                <option value="0"> Выберите сортировку по складам</option>
                @foreach($warehouse as $key => $value)
                    <option value="{{$value->id}}" @if(request('warehouse') == $value->id) selected @endif > {{$value['warehouses']}} </option>
                @endforeach
            </select>
        </div>
        <div class="fom-f">
            <select class="form-control sort" name="customer" id="customer">

                <option value="0"> Выберите сортировку поименам заказчиков</option>
                @foreach($customer as $key => $value)
                    <option value="{{$value->customer}}"  @if(request('customer') == $value->customer) selected @endif > {{$value->customer}} </option>
                @endforeach
            </select>
        </div>
        <div class="fom-f">
            <select class="form-control sort" name="limit" id="limit">
                <option value="20"> Выберите число заказов</option>
                <option value="5"   @if(request('limit') == 5) selected @endif  >  5</option>
                <option value="10"  @if(request('limit') == 10) selected @endif > 10</option>
                <option value="15"  @if(request('limit') == 15) selected @endif > 15</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-lg px-4 gap-3">Фильтровать</button>
    </form>
        <div class="nav-button">
            <a href="{{URL::to( '/products' )}}" class="btn btn-primary btn-lg px-4 gap-3">Товары</a>
            <a href="{{URL::to( '/warehouses' )}}" class="btn btn-primary btn-lg px-4 gap-3">Склады</a>
            <a href="{{URL::to( '/orders/create' )}}" class="btn btn-primary btn-lg px-4 gap-3">Создать заказ</a>
            <a href="{{URL::to( '/orders/movement/history' )}}" class="btn btn-primary btn-lg px-4 gap-3">История заказов</a>
        </div>
    </div>
    @foreach (['message7', 'message4', 'message5', 'message6'] as $message)
        @if (session($message))
            <div class="alert alert-danger">
                {{ session($message) }}
            </div>
        @endif
    @endforeach
    @foreach (['message8', 'message9', 'message10'] as $message)
        @if (session($message))
            <div class="alert alert-success">
                {{ session($message) }}
            </div>
        @endif
    @endforeach
<table>
        @foreach($order as $key => $value)
                <tr>
                    <td><div>{{$value->id}} - id продукта;  </div></td>
                    <td><div>{{$value->customer}} - Заказчик; </div></td>
                    <td><div>{{$value->warehouse_id }} - Cклад;  </div></td>
                    <td><div>{{$value->status }} - Статус;  </div></td>
                    <td><div><a href="{{URL::to( '/orders/'. $value->id )}}"> Изменить;</a></div></td>
                    <form  action="/orders/{{$value->id}}/complete" method="POST">
                    @csrf
                    @method('PUT')
                        <td><div><button type="submit"> Завершить заказ;</button></div></td>
                    </form>
                    <form  action="/orders/{{$value->id}}/cancel" method="POST">
                        @csrf
                        @method('PUT')
                        <td><div><button type="submit"> Отмена заказа;</button></div></td>
                    </form>
                    <form  action="/orders/{{$value->id}}/resume" method="POST">
                        @csrf
                        @method('PUT')
                        <td><div><button type="submit"> Возобновление заказа;</button></div></td>
                    </form>
                </tr>
        @endforeach
</table>
<div class="links">
    {{ $order->links() }}
</div>


@endsection

