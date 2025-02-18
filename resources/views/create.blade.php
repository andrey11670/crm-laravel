@extends('layouts/app')

@section('content')
    <a type="submit" class="btn btn-primary btn-lg px-4 gap-3" href="{{URL::to('/orders')}}">Вернуться к заказам</a>
<form action="/orders" method="POST">

    @csrf
    <div class="">Введите имя для начала заказа</div>
    <input type="text" name="customer" value="{{ old('customer') }}" style="margin-bottom: 10px;">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<table>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@foreach($product as $key => $value)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <input type="checkbox" class="checkbox"  name="order_items[]" value="{{$value->id}}">
                            <label for="{{$value->id}}">{{$value->id}} - id продукта;</label>
                            <div style="display: flex; align-items: center; gap: 5px;" class="product-item-add" data-product-id="{{$value->id}}">
                                <input type="hidden" name="quantity[{{ $value->id }}]" value="0">
                                <p style="display: inline-block; margin: auto;}">Количество: <span class="quantity">0</span></p>
                                <button class="plus-btn" type="button">+</button>
                                <button class="minus-btn" type="button">-</button>
                            </div>
                        </div>
                    </td>
                    <td><div>{{$value->name}} - Название </div></td>
                    <td><div>{{$value->stock['stock']}} - Остатки на складе</div></td>
                </tr>
@endforeach
</table>
    <button type="submit" class="btn btn-primary btn-lg px-4 gap-3">Заказать</button>
</form>


@endsection


