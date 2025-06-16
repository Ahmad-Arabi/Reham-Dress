<section class="profile-section bg-white p-6 rounded-3xl shadow-md border border-pink-200" dir="rtl">
    <!-- عنوان القسم -->
    <header class="mb-6 text-center">
        <h2 class="text-xl font-bold text-pink-700 flex items-center justify-center gap-2">
            <svg width="24" height="24" fill="none" stroke="currentColor" class="text-pink-500" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A8.96 8.96 0 0112 15c2.21 0 4.21.803 5.879 2.137M15 11a3 3 0 11-6 0 3 3 0 016 0zM12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>
            معلومات الملف الشخصي
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            حدّثي بياناتك الشخصية وعنوان البريد الإلكتروني الخاص بك ✨
        </p>
    </header>

    <!-- نموذج إعادة إرسال التحقق -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- نموذج تحديث الملف الشخصي -->
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- الاسم الكامل -->
        <div>
            <x-input-label for="name" :value="__('الاسم الكامل')" class="text-pink-800 font-semibold" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-2 block w-full rounded-xl border-pink-300 focus:ring-pink-400"
                :value="old('name', $user->name)"
                required autofocus autocomplete="name"
                placeholder="أدخلي اسمك الكامل" />
            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('name')" />
        </div>

        <!-- البريد الإلكتروني -->
        <div>
            <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-pink-800 font-semibold" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-2 block w-full rounded-xl border-pink-300 focus:ring-pink-400"
                :value="old('email', $user->email)"
                required autocomplete="username"
                placeholder="name@example.com" />
            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 bg-yellow-50 p-3 rounded-xl border border-yellow-200 text-yellow-800">
                    <p class="text-sm">
                        عنوان بريدك الإلكتروني لم يتم التحقق منه بعد 📧
                        <button
                            form="send-verification"
                            class="underline text-sm text-pink-600 hover:text-pink-800 transition duration-200">
                            اضغطي هنا لإعادة إرسال رسالة التحقق
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-green-600 text-sm">
                            تم إرسال رابط تحقق جديد إلى بريدك الإلكتروني 🎉
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- أزرار الحفظ -->
        <div class="flex items-center gap-4">
            <x-primary-button class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-xl transition-all">
                💾 حفظ التعديلات
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >تم الحفظ بنجاح ✅</p>
            @endif
        </div>
    </form>
</section>
