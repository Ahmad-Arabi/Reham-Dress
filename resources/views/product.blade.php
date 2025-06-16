@extends('layouts.app')

@section('content')
    @if ($product)
    @if (session('success'))
            <h1>
                {{ session('success') }}
            </h1>
        @endif
        @if (session('error'))
            <h1>
                {{ session('error') }}
            </h1>
        @endif
        <div style="max-width: 600px; margin: 2rem auto; border: 1px solid #eee; border-radius: 8px; padding: 2rem;">
            <h2>{{ $product->name }}</h2>
            <img src="{{ $product->thumbnail ? asset('storage/products/thumbnails/' . $product->id . '/' . $product->thumbnail) : asset('images/fallback.jpg')}}" class="w-25">

            <p>{{ $product->description }}</p>
            <p><strong>Price:</strong> ${{ $product->price }}</p>
            <form method="POST" action="{{ route('cart.add') }}" style="margin-top: 1rem;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div style="margin-bottom: 1rem;">
                    <label for="color">Color:</label>
                    <select name="color" id="color">
                        @foreach ($product->colors as $color)
                            <option value="{{ $color->id }}">{{ $color->color }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-bottom: 1rem;">
                    <label for="size">Size (Age):</label>
                    <select name="size" id="size">
                        @foreach ($product->sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->age }}</option>
                        @endforeach
                    </select>

                <div>
                    <input type="number" name="quantity">
                </div>
                </div>
                <button type="submit"
                    style="padding: 0.5rem 1.5rem; background: #38bdf8; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Add
                    to Cart</button>
            </form>
        </div>

    @else
        <p>No product found.</p>
    @endif
@endsection
