<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login - ElegantFit</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-image: url('{{ asset('assets/img/hotel/showcase-3.webp') }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-black bg-opacity-60">
    <div class="w-full max-w-md bg-white bg-opacity-90 rounded-2xl shadow-lg p-8">
        <div class="text-center mb-6">
            <img src="{{ asset('assets/img/hotel/logo.jpg') }}" alt="Luxury Hotel Logo" class="w-20 mx-auto mb-2">
            <h2 class="text-2xl font-bold text-yellow-700">login</h2>
            <p class="text-sm text-gray-600">welcome to Luxury Hotel</p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" required autofocus
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-yellow-600 focus:ring-yellow-600">
                @error('email')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">password</label>
                <input id="password" type="password" name="password" required
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-yellow-600 focus:ring-yellow-600">
                @error('password')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded text-yellow-600">
                    <span class="ml-2 text-sm text-gray-600">remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-yellow-700 hover:underline">forget my password ?</a>
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-yellow-700 hover:bg-yellow-800 text-white font-bold py-2 px-4 rounded-xl transition duration-300">
                    login
                </button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-gray-700">
            you don't have an account? 
            <a href="{{ route('register') }}" class="text-yellow-700 hover:underline"> create new account</a>
        </p>
    </div>
</body>
</html>
