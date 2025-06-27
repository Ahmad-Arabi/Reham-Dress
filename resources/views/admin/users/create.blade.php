@extends('layouts.admin')
@section('title', 'إضافة مستخدم جديد')
@section('content')
<div class="py-4">
    <div class="container-fluid" style="max-width: 600px; margin: auto;">
        <h1 class="fs-2 fw-semibold text-dark mb-4">إضافة مستخدم جديد</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST" novalidate class="bg-white p-4 rounded shadow-sm mt-4">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">الهاتف</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">العنوان</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">الدور</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>مستخدم</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>مشرف</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" class="form-control" id="password" name="password" required minlength="6">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="6">
            </div>

            <button type="submit" class="btn btn-success">إضافة المستخدم</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary ms-2">إلغاء</a>
        </form>
    </div>
</div>
@endsection
