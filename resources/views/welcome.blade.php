<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pemantauan Absensi Berbasis Cloud</title>

    <!-- Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f6ff;
            color: #1e293b;
        }

        /* Navbar */
        .cloud-navbar {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid #dbeafe;
            transition: 0.3s ease;
        }

        .cloud-navbar a:hover {
            color: #2563eb !important;
            transform: translateY(-1px);
        }

        /* Button Cloud */
        .btn-primary-cloud {
            background: #2563eb;
            color: white;
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 600;
            transition: 0.25s;
        }

        .btn-primary-cloud:hover {
            background: #1e3a8a;
            transform: translateY(-2px);
        }

        /* Hero Text Gradient */
        .hero-title {
            background: linear-gradient(90deg, #1e3a8a, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Image Floating */
        .img-floating {
            filter: drop-shadow(0 8px 18px rgba(59, 130, 246, 0.35));
            transition: 0.3s;
        }

        .img-floating:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-blue-50 text-gray-800">

    <!-- ============================ -->
    <!-- NAVBAR -->
    <!-- ============================ -->
    <nav class="cloud-navbar fixed top-0 left-0 w-full z-50 py-4 shadow-md">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">

            <!-- Logo kiri -->
            <div class="flex items-center space-x-3">
                <div class="bg-blue-100 p-2 rounded-full text-blue-600 text-xl font-bold">☁️</div>
                <span class="font-bold text-xl text-blue-700">Cloud Absensi</span>
            </div>

            <!-- Menu kanan -->
            <ul class="flex space-x-8 text-gray-700 font-medium">
                <li><a href="#" class="hover:text-blue-600">Beranda</a></li>
                <li><a href="#" class="hover:text-blue-600">Tentang</a></li>
                @auth
                    <li><a href="{{ url('/dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
                @else
                    <li>
                        <a href="{{ route('login') }}"
                           class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-md transition">
                           Login
                        </a>
                    </li>
                @endauth
            </ul>

        </div>
    </nav>

    <!-- ============================ -->
    <!-- HERO SECTION -->
    <!-- ============================ -->
    <section class="min-h-screen flex items-center justify-center pt-24">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between space-y-12 md:space-y-0">

            <!-- Teks -->
            <div class="md:w-1/2 space-y-6 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight hero-title">
                    Aplikasi Pemantauan Absensi
                </h1>

                <p class="text-lg text-gray-600 leading-relaxed">
                    Sistem absensi modern untuk sekolah. 
                    Pantau kehadiran secara real-time, cepat, dan aman.
                </p>

                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary-cloud inline-block shadow-md">
                        Masuk ke Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary-cloud inline-block shadow-md">
                        Mulai Sekarang
                    </a>
                @endauth
            </div>

            <!-- Gambar -->
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('images/cloud.png') }}">
            </div>
        </div>
    </section>

    <!-- ============================ -->
    <!-- FOOTER -->
    <!-- ============================ -->
    <footer class="bg-white text-gray-600 text-sm py-4 text-center border-t border-blue-100">
        © 2025 Cloud Absensi — Sistem Pemantauan Absensi
    </footer>

</body>
</html>
