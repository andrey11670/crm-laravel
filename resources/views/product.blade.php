@extends('layouts/app')

@section('content')
    <a type="submit" class="btn btn-primary btn-lg px-4 gap-3" href="{{URL::to('/orders')}}">Вернуться к заказам</a>
<table>
    @foreach($product as $key => $value)
        <tr>
            {{--<div>{{$value->id}} - id продукта;</div>--}}
            <td ><div>{{$value->name}} - Название продукта;</div></td>
            <td><div>{{$value->price}} - Цена</div></td>
            <td><div>{{$value->stock->stock}} - Остаток на складе</div></td>
        </tr>
    @endforeach
</table>
@endsection
