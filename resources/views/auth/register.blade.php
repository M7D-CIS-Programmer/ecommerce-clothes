<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> create account - CozaStore </title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-black bg-opacity-60">
    <div class="w-full max-w-md bg-white bg-opacity-90 rounded-2xl shadow-lg p-8">
        <div class="text-center mb-6">
            <img src="{{asset('images/logo.jpg')}}" alt="CozaStore Logo" class="w-20 mx-auto mb-2">
            <h2 class="text-2xl font-bold text-yellow-700">regester</h2>
            <p class="text-sm text-gray-600">Start your luxury experience at our store
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input id="name" type="text" name="name" required autofocus
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-yellow-600 focus:ring-yellow-600">
                @error('name')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" required
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-yellow-600 focus:ring-yellow-600">
                @error('email')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-yellow-600 focus:ring-yellow-600">
                @error('password')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700"> Confirm Password
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-yellow-600 focus:ring-yellow-600">
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-yellow-700 hover:bg-yellow-800 text-white font-bold py-2 px-4 rounded-xl transition duration-300">
                    create account
                </button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-gray-700">
            you already have an account?
            <a href="{{ route('login') }}" class="text-yellow-700 hover:underline">login now</a>
        </p>
    </div>
</body>

</html>