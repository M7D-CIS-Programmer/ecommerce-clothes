<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب - Luxury Hotel</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1501117716987-c8e1ecb210f9');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-black bg-opacity-60">
    <div class="w-full max-w-md bg-white bg-opacity-90 rounded-2xl shadow-lg p-8">
        <div class="text-center mb-6">
            <img src="https://i.imgur.com/oYiTqum.png" alt="Luxury Hotel Logo" class="w-20 mx-auto mb-2">
            <h2 class="text-2xl font-bold text-yellow-700">إنشاء حساب</h2>
            <p class="text-sm text-gray-600">ابدأ تجربتك الفاخرة في فندقنا</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">الاسم الكامل</label>
                <input id="name" type="text" name="name" required autofocus
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-yellow-600 focus:ring-yellow-600">
                @error('name')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input id="email" type="email" name="email" required
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-yellow-600 focus:ring-yellow-600">
                @error('email')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور</label>
                <input id="password" type="password" name="password" required
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-yellow-600 focus:ring-yellow-600">
                @error('password')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">تأكيد كلمة المرور</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-yellow-600 focus:ring-yellow-600">
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-yellow-700 hover:bg-yellow-800 text-white font-bold py-2 px-4 rounded-xl transition duration-300">
                    إنشاء الحساب
                </button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-gray-700">
            لديك حساب بالفعل؟
            <a href="{{ route('login') }}" class="text-yellow-700 hover:underline">سجّل الدخول الآن</a>
        </p>
    </div>
</body>
</html>
