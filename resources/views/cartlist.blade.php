@extends('master')
@section('content')
<div class=" custom-product">
      <div class="col-sm-10">
        <div class="trending-wrapper">
            <h3>Result For Products</h3>
            <a class="btn btn-success" href="ordernow">Order Now</a> <br><br>
            @foreach ($products as $item)
            <div class=" row Searched-item cart-list-devider">
             <div class="col-sm-3">
                <a href="detail/{{$item->id}}">
                    <img class="trending-image" src="{{ asset('uploads/gallery/' . $item->image) }}">
                    </a>
             </div>
             <div class="col-sm-4">
                    <div class="">
                        <h2>{{$item->name}}</h2>
                        <h2>{{$item->description}}</h2>
                        <h3>{{$item->price}}</h3>
                    </div>
                    </a>
             </div>
             <div class="col-sm-3">
                 <a href="/removecart/{{$item->cart_id}}" class="btn btn-warning">Remove Item </a>
             </div>
             </div>     
             @endforeach
             </div>
          </div>
      </div>
</div>
@endsection
