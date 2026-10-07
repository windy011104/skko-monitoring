<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Monitoring SKKO | PLN UP3 Bukittinggi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        pln: {
                            blue: '#003082',
                            light: '#0064B4',
                            gold: '#FFD700',
                            dark: '#001C4E',
                        }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .animated-bg {
            background: linear-gradient(135deg, #001C4E 0%, #003082 40%, #0064B4 70%, #0087D0 100%);
            position: relative;
            overflow: hidden;
        }

        .animated-bg::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.05) 0%, transparent 60%),
                radial-gradient(circle at 80% 20%, rgba(0, 135, 208, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 20% 80%, rgba(0, 100, 180, 0.3) 0%, transparent 40%);
            animation: pulse-bg 8s ease-in-out infinite alternate;
        }

        .animated-bg::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40%;
            background: linear-gradient(to top, rgba(0, 28, 78, 0.5), transparent);
        }

        @keyframes pulse-bg {
            0% {
                transform: scale(1) rotate(0deg);
            }

            100% {
                transform: scale(1.1) rotate(5deg);
            }
        }

        .grid-pattern {
            background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .floating-circle {
            position: absolute;
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(0, 100, 180, 0.2);
        }

        .btn-login {
            background: linear-gradient(135deg, #003082, #0064B4);
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #001C4E, #003082);
            transform: translateY(-1px);
            box-shadow: 0 10px 30px rgba(0, 48, 130, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }
    </style>
</head>

<body class="min-h-screen flex" x-data>

    <!-- LEFT PANEL - Branding -->
    <div class="hidden lg:flex lg:w-1/2 animated-bg grid-pattern flex-col justify-between p-12 relative overflow-hidden">

        <!-- Decorative Background -->
        <div class="absolute -top-24 -left-24 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-yellow-400/10 rounded-full blur-3xl"></div>

        <!-- Top -->
        <div class="w-20 h-20 rounded-xl bg-white flex items-center justify-center shadow-lg overflow-hidden">
            <img src="{{ asset('images/logo pln.jpg') }}" alt="Logo PLN" class="w-18 h-18 object-contain">
        </div>

        <!-- Main Content -->
        <div class="relative z-10 max-w-xl">
            <p class="text-[#EA580C] text-sm font-bold tracking-widest uppercase mb-4">
                SKKO Management System
            </p>

            <h1 class="text-4xl xl:text-5xl font-bold text-[#075EAA] leading-tight mb-5">
                Monitoring
                <span class="text-[#EA580C]">Konstruksi</span>
                & Kontrak
            </h1>

            <p class="text-[#EA580C]/90 text-base leading-relaxed max-w-md">
                Sistem terintegrasi untuk membantu monitoring SKKO,
                kontrak, progress pekerjaan, pembayaran, dan tindak lanjut
                secara lebih mudah dan terstruktur.
            </p>
        </div>

        <div class="relative z-10">
            <div class="h-px bg-white/10 mb-4"></div>
        </div>

    </div>

    <!-- RIGHT PANEL - Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
        <div class="w-full max-w-md">

            <!-- Mobile Logo (visible only on small screens) -->
            <div class="flex lg:hidden items-center justify-center space-x-3 mb-8">
                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('images/logo pln.jpg') }}" alt="Logo PLN" class="w-10 h-10 object-contain">
                </div>
                <div>
                    <h1 class="text-pln-blue font-bold text-lg">Monitoring SKKO</h1>
                    <p class="text-gray-500 text-xs">PLN UP 3 Bukittinggi</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">Selamat Datang</h2>
                    <p class="text-gray-500 text-sm">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start space-x-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-green-700 text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p class="text-red-700 text-sm">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login.post') }}" x-data="{ showPassword: false, loading: false }"
                    @submit="loading = true">
                    @csrf

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                value="{{ old('email') }}" placeholder="nama@pln.co.id"
                                class="input-focus w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl text-gray-800 text-sm placeholder-gray-400 focus:outline-none focus:border-pln-light transition-all duration-200 @error('email') border-red-400 bg-red-50 @enderror" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input id="password" name="password" :type="showPassword ? 'text' : 'password'"
                                autocomplete="current-password" required placeholder="••••••••"
                                class="input-focus w-full pl-10 pr-12 py-3 border border-gray-200 rounded-xl text-gray-800 text-sm placeholder-gray-400 focus:outline-none focus:border-pln-light transition-all duration-200 @error('password') border-red-400 bg-red-50 @enderror" />
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" style="display:none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-gray-300 text-pln-blue focus:ring-pln-light" />
                            <span class="text-sm text-gray-600">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" :disabled="loading"
                        class="btn-login w-full py-3 px-6 text-white font-semibold rounded-xl text-sm transition-all duration-300 flex items-center justify-center space-x-2 disabled:opacity-70 disabled:cursor-not-allowed">
                        <svg x-show="loading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"
                            style="display:none;">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span x-text="loading ? 'Memproses...' : 'Masuk ke Sistem'">Masuk ke Sistem</span>
                    </button>
                </form>

                <!-- Demo Credentials Info -->
                <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-100">
                    <p class="text-xs font-semibold text-pln-blue mb-2">Akun Demo:</p>
                    <div class="space-y-1">
                        <p class="text-xs text-gray-600"><span class="font-medium text-pln-blue">Admin:</span>
                            admin@pln.co.id / password</p>
                        <p class="text-xs text-gray-600"><span class="font-medium text-gray-600">User:</span>
                            user@pln.co.id / password</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <p class="text-center text-gray-400 text-xs mt-6">
                &copy; {{ date('Y') }} PLN UP 3 Bukittinggi &mdash; Sistem Monitoring SKKO v1.0
            </p>
        </div>
    </div>

</body>

</html>
