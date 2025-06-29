<x-guest-layout>
   <div class="kids-login-container" dir="rtl">
    <div class="kids-login-wrapper">
        <!-- عناصر تزيينية -->
        <div class="decoration decoration-1">🧸</div>
        <div class="decoration decoration-2">🎈</div>
        <div class="decoration decoration-3">🌈</div>
        <div class="decoration decoration-4">⭐</div>

        <!-- قسم العنوان -->
        <div class="header-section">
            <div class="logo-circle">
                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h1 class="main-title">مرحباً بعودتك!</h1>
            <p class="subtitle">سجّلي الدخول لتكتشفي أزياء الأطفال الساحرة</p>
        </div>

        <!-- بطاقة تسجيل الدخول -->
        <div class="login-card">
            <!-- حالة الجلسة -->
            <x-auth-session-status class="session-status" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <!-- البريد الإلكتروني -->
                <div class="form-group">
                    <x-input-label for="email" class="form-label">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        {{ __('البريد الإلكتروني') }}
                    </x-input-label>
                    <x-text-input id="email"
                        class="form-input"
                        type="email"
                        name="email"
                        :value="old('email')"
                    
                        autofocus
                        autocomplete="username"
                        placeholder="name@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="error-message" />
                </div>

                <!-- كلمة المرور -->
                <div class="form-group">
                    <x-input-label for="password" class="form-label">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        {{ __('كلمة المرور') }}
                    </x-input-label>
                    <x-text-input id="password"
                        class="form-input"
                        type="password"
                        name="password"
                    
                        autocomplete="current-password"
                        placeholder="أدخلي كلمة المرور" />
                    <x-input-error :messages="$errors->get('password')" class="error-message" />
                </div>

                <!-- تذكرني -->
                <div class="remember-section">
                    <label for="remember_me" class="remember-label">
                        <input id="remember_me"
                            type="checkbox"
                            class="remember-checkbox"
                            name="remember">
                        <span>{{ __('تذكرني') }}</span>
                    </label>
                </div>

                <!-- أزرار التحكم -->
                <div class="action-buttons">
                    <a href="{{ route('register') }}" class="register-button" style="text-decoration:none;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        {{ __('إنشاء حساب جديد') }} 
                    </a>
                    <x-primary-button class="login-button">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                         {{ __('تسجيل الدخول') }} 
                    </x-primary-button>
                </div>
                
            </form>
        </div>

    </div>
</div>


    <style>
        /* Reset and base styles */
        * {
            box-sizing: border-box;
        }

        /* Main container */
        .kids-login-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #fce7f3 0%, #f3e8ff 50%, #dbeafe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 16px;
            position: relative;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .kids-login-wrapper {
            width: 100%;
            position: relative;
        }

        /* Decorative elements */
        .decoration {
            position: absolute;
            font-size: 48px;
            opacity: 0.2;
            pointer-events: none;
            z-index: 1;
        }

        .decoration-1 {
            top: 40px;
            left: 40px;
            font-size: 64px;
            animation: bounce 2s infinite;
        }

        .decoration-2 {
            top: 80px;
            right: 80px;
            font-size: 32px;
            animation: pulse 2s infinite;
        }

        .decoration-3 {
            bottom: 80px;
            left: 80px;
            font-size: 40px;
            animation: bounce 2s infinite 1s;
        }

        .decoration-4 {
            bottom: 40px;
            right: 40px;
            font-size: 24px;
            animation: pulse 2s infinite 0.5s;
        }

        /* Header section */
        .header-section {
            text-align: center;
            margin-bottom: 32px;
            z-index: 10;
            position: relative;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #ec4899, #a855f7);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            color: white;
            transition: transform 0.3s ease;
        }

        .logo-circle:hover {
            transform: scale(1.05);
        }

        .main-title {
            font-size: 36px;
            font-weight: bold;
            background: linear-gradient(45deg, #ec4899, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0 0 8px 0;
        }

        .subtitle {
            color: #6b7280;
            font-size: 18px;
            margin: 0;
        }

        /* Login card */
        .login-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            padding: 32px;
            border: 1px solid rgba(255,255,255,0.2);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
            z-index: 10;
        }

        .login-card:hover {
            transform: scale(1.01);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 96px;
            height: 96px;
            background: linear-gradient(225deg, rgba(254, 240, 138, 0.5), rgba(252, 165, 165, 0.5));
            border-radius: 0 0 0 24px;
        }

        .login-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, rgba(191, 219, 254, 0.5), rgba(196, 181, 253, 0.5));
            border-radius: 0 24px 0 0;
        }

        /* Form styles */
        .login-form {
            position: relative;
            z-index: 2;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: flex;
            align-items: center;
            color: #374151;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-label svg {
            color: #ec4899;
            margin-right: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background-color: #f9fafb;
            color: #374151;
            font-size: 16px;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #ec4899;
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
            background-color: white;
            transform: translateY(-1px);
        }

        .form-input:hover {
            background-color: white;
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .error-message {
            color: #ef4444;
            font-size: 14px;
            margin-top: 4px;
        }

        /* Remember me section */
        .remember-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 24px 0;
        }

        .remember-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #6b7280;
            font-size: 14px;
        }

        .remember-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid #ec4899;
            border-radius: 6px;
            margin-right: 12px;
            accent-color: #ec4899;
        }

        /* Action buttons */
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin: 32px 0;
        }

        @media (min-width: 640px) {
            .action-buttons {
                flex-direction: row;
                justify-content: flex-end;
                align-items: center;
                gap: 16px;
            }
            .login-button, .register-button {
                width: 260px;
                min-width: 200px;
                max-width: 100%;
            }
            .login-button {
                order: 1;
            }
            .register-button {
                order: 2;
            }
        }

        .login-button, .register-button {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-weight: bold !important;
            padding: 14px 32px !important;
            border-radius: 12px !important;
            border: none !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
            transition: all 0.2s ease !important;
            text-decoration: none !important;
            cursor: pointer !important;
            font-size: 16px !important;
            width: 100% !important;
            min-width: fit-content;
            max-width: 100%;
            min-height: 52px;
        }
        .login-button {
            background: linear-gradient(45deg, #ec4899, #a855f7) !important;
            color: white !important;
        }
        .login-button:hover {
            background: linear-gradient(45deg, #db2777, #9333ea) !important;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
            transform: translateY(-2px) !important;
        }
        .register-button {
            background-color: #fff !important;
            color: #374151 !important;
            border: 2px solid #e5e7eb !important;
        }
        .register-button:hover {
            background-color: #f9fafb !important;
            border-color: #d1d5db !important;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1) !important;
            transform: translateY(-1px) !important;
            color: #111827 !important;
        }

        .forgot-link {
            display: inline-flex;
            align-items: center;
            color: #ec4899;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .forgot-link:hover {
            color: #be185d;
            background-color: #fdf2f8;
        }

        .forgot-link svg {
            margin-right: 8px;
        }

        @media (min-width: 640px) {
            .login-button {
                width: auto !important;
            }
        }

        /* Divider */
        .divider {
            position: relative;
            margin: 32px 0;
            text-align: center;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #e5e7eb;
        }

        .divider span {
            background-color: white;
            color: #6b7280;
            padding: 0 16px;
            font-size: 14px;
            border-radius: 20px;
        }

        /* Register section */
        .register-section {
            text-align: center;
        }

        .register-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            background-color: white;
            color: #374151;
            font-weight: 600;
            padding: 12px 32px;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }

        .register-button:hover {
            background-color: #f9fafb;
            border-color: #d1d5db;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            transform: translateY(-1px);
            color: #111827;
        }

        .register-button svg {
            margin-right: 8px;
        }

        @media (min-width: 640px) {
            .register-button {
                width: auto;
            }
        }

        /* Footer */
        .footer-section {
            text-align: center;
            margin-top: 32px;
            z-index: 10;
            position: relative;
        }

        .footer-main {
            color: #6b7280;
            font-size: 14px;
            margin: 0 0 8px 0;
        }

        .footer-sub {
            color: #9ca3af;
            font-size: 12px;
            margin: 0;
        }

        /* Animations */
        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% {
                transform: translate3d(0,0,0);
            }
            40%, 43% {
                transform: translate3d(0,-10px,0);
            }
            70% {
                transform: translate3d(0,-5px,0);
            }
            90% {
                transform: translate3d(0,-2px,0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Session status */
        .session-status {
            margin-bottom: 24px;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .kids-login-container {
                padding: 24px 16px;
            }
            
            .login-card {
                padding: 24px;
            }
            
            .main-title {
                font-size: 28px;
            }
            
            .decoration-1, .decoration-2, .decoration-3, .decoration-4 {
                display: none;
            }
        }
    </style>
</x-guest-layout>