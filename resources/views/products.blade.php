@extends('layouts.app')

@section('content')
    {{-- <div class="row">

        @foreach ($products as $product)
            <div class="col-3" style="margin: 100px 31px 34px 4px;">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        {{ $product->name }}
                    </div>
                    <img class="card-img-top" src="/images/{{ $product->image }}" alt="Card image cap" width="100px"
                        height="100px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text">{{ $product->subTitle }}</p>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        
    </div> --}}
    <div class="row">
        @foreach ($products as $product)
            <div class="card" style="width: 18rem;margin-right:40px;border: 2px solid #007bff;">
                <img class="card-img-top" src="/images/{{ $product->image }}" alt="Card image cap" width="350px" height="350px">
                <div class="card-body">
                    <h5 class="card-title"> {{ $product->name }}</h5>
                    <p class="card-text">{{ $product->title }}</p>
                </div>
                <div class="card-body">
                    <form action="/cart" method="post"style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary "> Add to cart</button>
                    </form >
                    <a href="/product/{{ $product->id }}" class="btn btn-outline-primary">
                        View
                    </a>
                </div>

            </div>
        @endforeach
    </div>
@endsection
