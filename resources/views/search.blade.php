@extends('master')
@section('content')
<div class=" custom-product">
      <div class="col-sm-4">
          <a>filter</a>
      </div>
      <div class="col-sm-8">
        <div class="trending-wrapper">
            <h3>Result For Products</h3>
            @foreach ($product as $item)
            <div class="Searched-item">
              <a href="detail/{{$item['id']}}">
              <img class="trending-image" src="{{ asset('uploads/gallery/' . $item->image) }}">
              <div class="">
                  <h2>{{$item['name']}}</h2>
                  <h2>{{$item['description']}}</h2>
              </div>
              </a>
             </div>     
             @endforeach
             </div>
          </div>
      </div>
</div>
@endsection
