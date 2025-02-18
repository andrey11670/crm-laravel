@extends('layouts/app')

@section('content')
    <a type="submit" class="btn btn-primary btn-lg px-4 gap-3" href="{{URL::to('/orders')}}">Вернуться к заказам</a>
<table>
    @foreach($warehouse as $key => $value)
        <tr>
            <td><div>{{$value->id}} - id cклада;</div></td>
            <td><div>{{$value->warehouses}} - Название склада</div></td>
        </tr>
    @endforeach
</table>
@endsection
