<x-guest-layout>
    <style>
     
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
            max-width: 448px;
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
                justify-content: space-between;
                align-items: center;
            }
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

        .login-button {
            background: linear-gradient(45deg, #ec4899, #a855f7) !important;
            color: white !important;
            font-weight: bold !important;
            padding: 12px 32px !important;
            border-radius: 12px !important;
            border: none !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
            transition: all 0.2s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            text-decoration: none !important;
            cursor: pointer !important;
            font-size: 16px !important;
            width: 100% !important;
        }

        .login-button:hover {
            background: linear-gradient(45deg, #db2777, #9333ea) !important;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
            transform: translateY(-2px) !important;
        }

        .login-button svg {
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
    

  <div class="kids-login-container" dir="rtl">
    <div class="kids-login-wrapper">
        <!-- Decorations -->
        <div class="decoration decoration-1">💖</div>
        <div class="decoration decoration-2">🌟</div>
        <div class="decoration decoration-3">🧸</div>
        <div class="decoration decoration-4">🌈</div>

        <!-- Header -->
        <div class="header-section">
            <div class="logo-circle">
                🐻
            </div>
            <h1 class="main-title">أنشئ حسابك</h1>
            <p class="subtitle">انضمي إلى عالم HugsyWugsy الساحر 💫</p>
        </div>

        <!-- Register Card -->
        <div class="login-card">
            <form method="POST" action="{{ route('register') }}" class="login-form">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label class="form-label" for="name">
                        الاسم
                    </label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="form-input" placeholder="ادخلي اسمك">
                    <x-input-error :messages="$errors->get('name')" class="error-message" />
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label" for="email">
                        البريد الإلكتروني
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           class="form-input" placeholder="you@example.com">
                    <x-input-error :messages="$errors->get('email')" class="error-message" />
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label class="form-label" for="phone">
                        رقم الهاتف
                    </label>
                    <input id="phone" type="number" name="phone" value="{{ old('phone') }}" required
                           class="form-input" placeholder="079XXXXXXX">
                    <x-input-error :messages="$errors->get('phone')" class="error-message" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">
                        كلمة المرور
                    </label>
                    <input id="password" type="password" name="password" required
                           class="form-input" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="error-message" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">
                        تأكيد كلمة المرور
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="form-input" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
                </div>

                <!-- Actions -->
                <div class="action-buttons">
                    <a href="{{ route('login') }}" class="forgot-link">
                        لديك حساب بالفعل؟
                    </a>
                    <button type="submit" class="login-button">
                        تسجيل
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="footer-section">
            <p class="footer-main">💕 أهلاً بك في HugsyWugsy!</p>
            <p class="footer-sub">اللطافة والراحة والإبداع كلها في حساب واحد 🧸</p>
        </div>
    </div>
</div>

</x-guest-layout>
