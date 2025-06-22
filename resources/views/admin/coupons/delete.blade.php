@extends('layouts.admin')
@section('title', 'إدارة الكوبونات')
@section('content')
    <div class="py-4">
        <div class="container-fluid">
        <div class="mb-4">
            <h1 class="fs-2 fw-semibold text-dark">حذف الكوبون {{ $coupon->code }}</h1>
            <div>
                <a href="{{  route('admin.coupons.index') }}" class="btn btn-primary  mt-3">
                الرجوع إلى قائمة الكوبونات

                </a>
            </div>
        </div>
    </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.coupons.destroy', $coupon->id) }}" class="bg-white p-4 rounded shadow-sm mt-4" style="max-width: 600px; margin: auto;">
                @csrf
                @method('DELETE')
                <div class="mb-3">
                    <p class="mb-4 fs-5">هل أنت متأكد أنك تريد حذف الكوبون <strong>{{ $coupon->code }}</strong>؟</p>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-danger px-4">حذف الكوبون</button>
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary ms-2">إلغاء</a>
                </div>
            </form>
        </div>

        
    </div>
@endsection
