@extends('layouts.admin')
@section('title', 'إدارة المستخدمين')
@section('content')
    <div class="py-4">
        <div class="container-fluid">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <h1 class="fs-2 fw-semibold text-dark">إدارة المستخدمين</h1>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">
                إضافة مستخدم جديد
                <svg class="me-2" style="width: 1.25rem; height: 1.25rem;" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </a>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 border-2 border-success shadow-sm"
                    role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <strong>حدثت أخطاء:</strong>
                    <ul class="mb-0 mt-2 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="filters-row mb-3 d-flex gap-2">
                <input type="text" id="searchInput" name="search" data-filter="search" placeholder="بحث عن مستخدم..."
                    class="form-control" style="max-width: 220px;" value="{{ request('search', '') }}">
                <select id="roleFilter" name="role" data-filter="role" class="form-select" style="max-width: 180px;">
                    <option value="" {{ request('role', '') === '' ? 'selected' : '' }}>جميع الأدوار</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>مشرف</option>
                    <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>مستخدم</option>
                </select>
            </div>

            @if ($users->count())
                <div class="mt-4 table-responsive">
                    <table class="table table-bordered table-hover align-middle text-end bg-white shadow-sm rounded">
                        <thead class="table-light">
                            <tr>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>الهاتف</th>
                                <th>الدور</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="fw-bold">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <span class="badge {{ $user->role === 'admin' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $user->role === 'admin' ? 'مشرف' : 'مستخدم' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="btn btn-primary btn-sm">تعديل</a>
                                            <a href="{{ route('admin.users.delete', $user->id) }}"
                                                class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                                                <i class="bi bi-trash me-1"></i>
                                                حذف
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            @else
                <div class="d-flex flex-column align-items-center justify-content-center py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none" viewBox="0 0 24 24"
                        stroke="var(--admin-pink)" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 13h6m-3-3v6m9-2.25V6.75A2.25 2.25 0 0 0 18.75 4.5H5.25A2.25 2.25 0 0 0 3 6.75v10.5A2.25 2.25 0 0 0 5.25 19.5h13.5A2.25 2.25 0 0 0 21 17.25z" />
                    </svg>
                    <div class="mt-3 fs-5 text-admin-pink fw-semibold">لا يوجد مستخدمون حالياً</div>
                </div>
            @endif
        </div>
    </div>
@endsection
@vite(['resources/js/admin.js'])
