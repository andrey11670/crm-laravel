@extends('layouts/app')

@section('content')
    <a type="submit" class="btn btn-primary btn-lg px-4 gap-3" href="{{URL::to('/orders')}}">Вернуться к заказам</a>
<form action="/orders/movement/history" id="filter">
    @csrf
    <div class="fom-f" >
        <select class="form-control sort" name="warehouse" id="warehouse">

            <option value=""> Выберите сортировку по складам</option>
            @foreach($warehouse as $key => $value)
                <option value="{{$value['id']}}" @if(request('warehouse') == $value['id']) selected @endif>{{$value['warehouses']}}</option>
                {{--<option value="{{$value['id']}}">{{$value['warehouses']}} </option>--}}
            @endforeach

        </select>

    </div>
    <div class="fom-f" >
        <select class="form-control sort" name="product" id="product">

            <option value=""> Выберите сортировку по продуктам</option>
            @foreach($product as $key => $value)
                <option value="{{$value['id']}}"@if(request('product') == $value['id']) selected @endif>{{$value['name']}} </option>
            @endforeach
        </select>

    </div>

    <label for="startDate">Начальная дата:</label>
    <input type="date" id="startDate" name="startDate" value="{{ request('startDate') }}">

    <label for="endDate">Конечная дата:</label>
    <input type="date" id="endDate" name="endDate" value="{{ request('endDate') }}">
    <div class="fom-f">

        <select class="form-control sort" name="limit" id="limit">
            <option value="20"> Выберите число заказов</option>
            <option value="5"  @if(request('limit') == 5) selected @endif>  5</option>
            <option value="10" @if(request('limit') == 10) selected @endif> 10</option>
            <option value="15" @if(request('limit') == 15) selected @endif> 15</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary btn-lg px-4 gap-3">Фильтровать</button>
</form>

    <table>
        @foreach($movement as $key => $value)
            <tr>
                <td><div>{{$value->id}} - id продукта;  </div></td>
                <td><div>{{$value->product['name'] }} - Название товара;  </div></td>
                <td><div>{{$warehouse_name[$key]}} - Cклад;  </div></td>
                <td><div>{{$value->stock }} - Остаток;  </div></td>
                {{--<td><div>{{$value->status }} - Статус;  </div></td>--}}
            </tr>
        @endforeach
    </table>
    <div class="links">
        {{ $movement->links() }}
    </div>

@endsection

