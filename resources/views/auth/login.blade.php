<x-layouts.guest>
    <style>
        .login-container {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-radius: 24px;
            padding: 48px;
            position: relative;
            overflow: hidden;
            max-width: 450px;
            margin: 0 auto;
            transform: translateY(0);
            transition: all 0.3s ease;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(118, 75, 162, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 32px 64px -12px rgba(0, 0, 0, 0.35);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 32px;
            position: relative;
            z-index: 1;
        }
        
        .login-title {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }
        
        .login-subtitle {
            color: #6b7280;
            font-size: 0.95rem;
            font-weight: 500;
        }
        
        .form-group {
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .form-input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid rgba(229, 231, 235, 0.8);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 1);
        }
        
        .form-input::placeholder {
            color: #9ca3af;
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            margin: 24px 0;
            position: relative;
            z-index: 1;
        }
        
        .checkbox-input {
            width: 18px;
            height: 18px;
            border-radius: 6px;
            border: 2px solid #d1d5db;
            background: rgba(255, 255, 255, 0.9);
            margin-right: 12px;
            transition: all 0.3s ease;
        }
        
        .checkbox-input:checked {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }
        
        .checkbox-label {
            color: #4b5563;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            user-select: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 16px;
            padding: 16px 32px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .forgot-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .forgot-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }
        
        .forgot-link:hover::after {
            width: 100%;
        }
        
        .forgot-link:hover {
            color: #764ba2;
        }
        
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 32px;
            position: relative;
            z-index: 1;
        }
        
        .error-message {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            color: #dc2626;
            font-size: 0.85rem;
            font-weight: 500;
            margin-top: 8px;
        }
        
        .status-message {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 12px;
            padding: 16px 20px;
            color: #059669;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 24px;
            text-align: center;
        }
        
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            overflow: hidden;
        }
        
        .floating-elements::before,
        .floating-elements::after {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-elements::before {
            top: 20%;
            right: 10%;
            animation-delay: 0s;
        }
        
        .floating-elements::after {
            bottom: 20%;
            left: 10%;
            animation-delay: 3s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        @media (max-width: 640px) {
            .login-container {
                padding: 32px 24px;
                margin: 20px;
                border-radius: 20px;
            }
            
            .login-title {
                font-size: 1.75rem;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 16px;
            }
        }
    </style>

    <div class="login-container">
        <div class="floating-elements"></div>
        
        <div class="login-header">
            <h1 class="login-title">Selamat Datang</h1>
            <p class="login-subtitle">Silakan masuk ke akun Anda</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">
                    📧 {{ __('Email') }}
                </label>
                <input id="email" 
                       class="form-input" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="Masukkan email Anda" />
                @if ($errors->get('email'))
                    <div class="error-message">
                        @foreach ($errors->get('email') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">
                    🔒 {{ __('Password') }}
                </label>
                <input id="password" 
                       class="form-input"
                       type="password"
                       name="password"
                       required 
                       autocomplete="current-password"
                       placeholder="Masukkan password Anda" />
                @if ($errors->get('password'))
                    <div class="error-message">
                        @foreach ($errors->get('password') as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="checkbox-container">
                <input id="remember_me" 
                       type="checkbox" 
                       class="checkbox-input" 
                       name="remember">
                <label for="remember_me" class="checkbox-label">
                    {{ __('Remember me') }}
                </label>
            </div>

            <div class="form-actions">
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="btn-primary">
                    <span style="position: relative; z-index: 1;">
                        🚀 {{ __('Log in') }}
                    </span>
                </button>
            </div>
        </form>
    </div>
</x-layouts.guest>