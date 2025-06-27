@extends('layouts.admin')
@section('title', 'تعديل المستخدم')
@section('content')
    <div class="py-4">
        <div class="container-fluid">
            <div class="mb-4">
                <h1 class="fs-2 fw-semibold text-dark">تعديل المستخدم {{ $user->name }}</h1>
                <div>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary mt-3">
                        الرجوع إلى قائمة المستخدمين
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}"
                class="bg-white p-4 rounded shadow-sm mt-4" style="max-width: 600px; margin: auto;">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4 border-2 border-danger shadow-sm"
                        role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">رقم الهاتف</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">العنوان</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">الدور</label>
                    <select class="form-select" id="role" name="role">
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>مستخدم</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>مدير</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success px-4">تحديث المستخدم</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
@endsection
