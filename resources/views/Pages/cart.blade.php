@extends('layouts.main')

@section('content')
<div class="container py-4">
     <div id="success" style="display:none" class="col-md-8 text-center h3 p-4 bg-success text-light rounded">تمت عملية الشراء بنجاح</div>
      @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center table-sm">
            <thead class="table-light">
                <tr>
                    <th>{{ __('message.select') }}</th>
                    <th>{{ __('message.image') }}</th>
                    <th>{{ __('cart.product') }}</th>
                    <th>{{ __('cart.price') }}</th>
                    <th>{{ __('cart.quantity') }}</th>
                    <th>{{ __('cart.total_price') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php($totalPrice = 0)
                @foreach($items as $item)
                    @php($totalPrice += $item->price * $item->pivot->quantity)
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_products[]" value="{{ $item->id }}">
                        </td>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <span>لا صورة</span>
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }} $</td>
                        <td>{{ $item->pivot->quantity }}</td>
                        <td>{{ $item->price * $item->pivot->quantity }} $</td>
                        <td>
                            <form method="post" action="{{ route('cart.remove_all', $item->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm" style="background-color: #c26b6b">
                                    {{ __('cart.remove_all') }}
                                </button>
                            </form>
                            <form method="post" action="{{ route('cart.remove_one', $item->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm" style="background-color: #FFC8C8">
                                    {{ __('cart.remove_one') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h5 class="mt-4 text-end">
            {{ __('cart.final_total') }}: {{ $totalPrice }} $
        </h5>
           <!-- Set up a container element for the button -->
                    <div class="d-inline-block" id="paypal-button-container" ></div>
                    <a href="{{ route('credit.checkout') }}" class="d-inline-block mb-4 float-start btn bg-cart" style="text-decoration:none;background-color: #c26b6b">
                        <span>بطاقة ائتمانية</span>
                        <i class="fas fa-credit-card"></i>
                    </a>
                    <!-- زر الدفع عند الاستلام -->
<form action="{{ route('cash.checkout') }}" method="POST" class="d-inline-block float-start ms-2">
    @csrf
    <button type="submit" class="btn bg-success mb-4  text-white">
        <span>الدفع عند الاستلام</span>
        <i class="fas fa-money-bill-wave"></i>
    </button>
</form>

    </div>

</div>
@endsection
