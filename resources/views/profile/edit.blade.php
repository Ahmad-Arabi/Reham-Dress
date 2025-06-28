<x-app-layout>
    @section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('الملف الشخصي') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Profile Information Card -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl">
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-8">
                            <div class="flex items-center space-x-4 space-x-reverse">
                                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-10 h-10 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="text-white">
                                    <h3 class="text-2xl font-bold">{{ Auth::user()->name }}</h3>
                                    <p class="text-blue-100">{{ Auth::user()->email }}</p>
                                    <p class="text-blue-100">{{ Auth::user()->phone }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                                @csrf
                                @method('patch')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل</label>
                                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف</label>
                                        <input id="phone" name="phone" type="tel" value="{{ old('phone', $user->phone) }}" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">العنوان</label>
                                        <input id="address" name="address" type="text" value="{{ old('address', $user->address) }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4">
                                    <button type="submit" class="w-full flex items-center space-x-3 space-x-reverse p-3 rounded-lg hover:bg-red-50 transition duration-200 text-red-600">
                                        حفظ التغييرات
                                    </button>
                                    
                                    @if (session('status') === 'profile-updated')
                                        <p class="text-green-600 font-medium animate-pulse">تم حفظ التغييرات بنجاح!</p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Password Update Section -->
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl mt-6">
                        <div class="bg-gradient-to-r from-red-500 to-pink-500 px-6 py-4">
                            <h3 class="">تغيير كلمة المرور</h3>
                        </div>

                        <div class="p-6">
                            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                                @csrf
                                @method('put')

                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">كلمة المرور الحالية</label>
                                    <input id="current_password" name="current_password" type="password" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200">
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">كلمة المرور الجديدة</label>
                                        <input id="password" name="password" type="password" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200">
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">تأكيد كلمة المرور</label>
                                        <input id="password_confirmation" name="password_confirmation" type="password" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200">
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4">
                                    <button type="submit" class="w-full flex items-center space-x-3 space-x-reverse p-3 rounded-lg hover:bg-red-50 transition duration-200 text-red-600">
                                        تحديث كلمة المرور
                                    </button>
                                    
                                    @if (session('status') === 'password-updated')
                                        <p class="text-green-600 font-medium animate-pulse">تم تحديث كلمة المرور بنجاح!</p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order History Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Stats -->
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">إحصائيات سريعة</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">إجمالي الطلبات</span>
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $user->orders->count() }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">الطلبات المكتملة</span>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $user->orders->where('status', 'delivered')->count() }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">الطلبات قيد التنفيذ</span>
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $user->orders->whereIn('status', ['pending', 'processing', 'shipped'])->count() }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">إجمالي المبلغ</span>
                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ number_format($user->orders->sum('total_amount'), 2) }} د.أ
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-800">آخر الطلبات</h3>
                            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                عرض الكل
                            </a>
                        </div>
                        
                        @if($user->orders->count() > 0)
                            <div class="space-y-3">
                                @foreach($user->orders->take(3) as $order)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm font-medium text-gray-900">طلب #{{ $order->id }}</span>
                                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                                @if($order->status == 'delivered') bg-green-100 text-green-800
                                                @elseif($order->status == 'shipped') bg-blue-100 text-blue-800
                                                @elseif($order->status == 'processing') bg-yellow-100 text-yellow-800
                                                @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                @switch($order->status)
                                                    @case('pending') قيد الانتظار @break
                                                    @case('processing') قيد التنفيذ @break
                                                    @case('shipped') تم الشحن @break
                                                    @case('delivered') تم التسليم @break
                                                    @case('cancelled') ملغي @break
                                                @endswitch
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between text-sm text-gray-600">
                                            <span>{{ $order->created_at->format('d/m/Y') }}</span>
                                            <span class="font-semibold">{{ number_format($order->total_amount, 2) }} د.أ</span>
                                        </div>
                                        @if($order->tracking)
                                            <div class="mt-2 text-xs text-blue-600">
                                                رقم التتبع: {{ $order->tracking }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <p class="text-gray-500">لا توجد طلبات حتى الآن</p>
                                <a href="#" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                                    تسوق الآن
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Account Actions -->
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">إجراءات الحساب</h3>
                        <div class="space-y-3">
                            <a href="#" class="flex items-center space-x-3 space-x-reverse p-3 rounded-lg hover:bg-gray-50 transition duration-200">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <span class="text-gray-700">تاريخ الطلبات</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 space-x-reverse p-3 rounded-lg hover:bg-gray-50 transition duration-200">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <span class="text-gray-700">تصفح المنتجات</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-3 space-x-reverse p-3 rounded-lg hover:bg-red-50 transition duration-200 text-red-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>تسجيل الخروج</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>