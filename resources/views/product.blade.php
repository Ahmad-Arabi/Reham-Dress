@php
    $product = $product ?? null;
@endphp

@extends('layouts.app')

@section('content')
@if($product)
@if (session('success'))
                    
                            <div class="toast-body">
                                {{ session('success') }}
                            </div>

                
                @endif
@if (session('errorr'))
                    
                            <div class="toast-body">
                                {{ session('errorr') }}
                            </div>

                  
                @endif
    <div style="max-width: 600px; margin: 2rem auto; border: 1px solid #eee; border-radius: 8px; padding: 2rem;">
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->description }}</p>
        <p><strong>Price:</strong> ${{ $product->price }}</p>
        <form method="POST" action="{{ route('cart.add') }}" style="margin-top: 1rem;">
            @csrf
            <div style="margin-bottom: 1rem;">
                <label for="color">Color:</label>
                <select name="color" id="color">
                    @foreach($product->colors as $color)
                        <option value="{{ $color->color }}">{{ $color->color }}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-bottom: 1rem;">
                <label for="size">Size (Age):</label>
                <select name="size" id="size">
                    @foreach($product->sizes as $size)
                        <option value="{{ $size->age }}">{{ $size->age }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="padding: 0.5rem 1.5rem; background: #38bdf8; color: #fff; border: none; border-radius: 4px; cursor: pointer;">Add to Cart</button>
        </form>
    </div>
@else
    <p>No product found.</p>
@endif
@endsection
