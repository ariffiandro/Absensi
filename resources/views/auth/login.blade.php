<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-blue-100 flex justify-center items-center min-h-screen">

    <div class="bg-gray flex rounded-2xl shadow-lg overflow-hidden w-[900px]">
        <!-- Bagian kiri (gambar anatomi) -->
        <div class="w-1/2 flex items-center justify-center bg-white p-6">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo sekolah" class="w-72">
        </div>

        <!-- Bagian kanan (form login) -->
        <div class="w-1/2 bg-blue-300 p-10 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-center mb-6">LOGIN</h2>

            @if (session('status'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4 text-center">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-300">
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" type="password" name="password" required class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-gray-300">
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    Login
                </button>

                <p class="text-sm text-center text-gray-600 mt-4">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Registrasi</a>
                </p>
            </form>
        </div>
    </div>

</body>

</html>
