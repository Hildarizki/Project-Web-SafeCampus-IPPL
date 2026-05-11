<!DOCTYPE html> 
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan - SafeCampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F5F5F5] font-sans">

<div class="flex min-h-screen rounded-[30px] overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-[280px] bg-gradient-to-b from-[#6D6AEF] to-[#7C79F2] text-white p-8">
        <div class="flex items-center gap-3 mb-14">
            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" class="w-6 h-6">
            </div>
            <h1 class="text-3xl font-bold">SafeCampus</h1>
        </div>

        <nav class="space-y-5 text-xl">
            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10">
                <img src="{{ asset('images/Home Page.png') }}" class="w-6 h-6"> Dashboard
            </a>

            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10">
                <img src="{{ asset('images/Document.png') }}" class="w-6 h-6"> Buat Laporan
            </a>

            <a href="#" class="flex items-center gap-4 px-4 py-4 rounded-2xl bg-white/10 shadow-lg border border-white/10">
                <img src="{{ asset('images/Page.png') }}" class="w-6 h-6"> Riwayat
            </a>

            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10">
                <img src="{{ asset('images/Handshake Heart.png') }}" class="w-6 h-6"> Self-Check
            </a>

            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10">
                <img src="{{ asset('images/Chat Bubble.png') }}" class="w-6 h-6"> Chat
            </a>

            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10">
                <img src="{{ asset('images/Page.png') }}" class="w-6 h-6"> Artikel
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">

        <!-- Search -->
        <div class="mb-10">
            <div class="bg-white rounded-full px-6 py-4 w-[500px] shadow-sm flex items-center gap-4">
                <img src="{{ asset('images/Clock.png') }}" class="w-5 h-5">
                <input type="text" placeholder="Cari laporan......." class="w-full outline-none text-gray-600">
            </div>
        </div>

        <!-- Header -->
        <div class="mb-10">
            <h2 class="text-5xl font-bold text-[#3C3B7A] mb-2">Halo, Hilda!</h2>
            <p class="text-2xl text-[#4D4D7A]">Selamat datang kembali di SafeCampus</p>
        </div>

        <!-- Filter -->
        <div class="bg-[#E9E5FF] rounded-[25px] p-8 mb-8">
            <div class="grid grid-cols-3 gap-8">

                <div>
                    <label class="font-semibold text-gray-700">Cari Laporan</label>
                    <input type="text" placeholder="Cari berdasarkan judul...."
                        class="w-full mt-3 p-4 rounded-2xl bg-white outline-none">
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Kategori</label>
                    <select class="w-full mt-3 p-4 rounded-2xl bg-white outline-none">
                        <option>Semua Kategori</option>
                        <option>Verbal</option>
                        <option>Fisik</option>
                        <option>Siber</option>
                    </select>
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Status</label>
                    <select class="w-full mt-3 p-4 rounded-2xl bg-white outline-none">
                        <option>Semua Status</option>
                        <option>Diproses</option>
                        <option>Selesai</option>
                        <option>Ditolak</option>
                    </select>
                </div>

            </div>
        </div>

        <!-- Cards -->
        <div class="space-y-6">

            <!-- Card -->
            <div class="bg-[#E9E5FF] rounded-[25px] p-8 flex justify-between items-center">
                <div>
                    <h3 class="text-3xl font-bold text-[#2E2E48] mb-4">Pelecehan Verbal di Ruang Kelas</h3>

                    <p class="flex items-center gap-2 text-gray-600 mb-2">
                        <img src="{{ asset('images/Home_Page.png') }}" class="w-5 h-5">
                        Gedung A, lantai 3, Ruang 301
                    </p>

                    <p class="flex items-center gap-2 text-gray-600">
                        <img src="{{ asset('images/Clock.png') }}" class="w-5 h-5">
                        15 Januari 2025, 14:30
                    </p>
                </div>

                <div class="text-right space-y-4">
                    <span class="bg-yellow-200 text-yellow-700 px-6 py-2 rounded-full">Diproses</span>
                    <br>
                    <button class="bg-gradient-to-r from-purple-500 to-blue-500 text-white px-8 py-3 rounded-full">
                        Lihat Detail
                    </button>
                </div>
            </div>

        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center gap-4 mt-10">
            <button class="w-12 h-12 rounded-xl bg-[#E9E5FF]">◀</button>
            <button class="w-12 h-12 rounded-xl bg-gradient-to-r from-purple-500 to-blue-500 text-white">1</button>
            <button class="w-12 h-12 rounded-xl bg-[#E9E5FF]">2</button>
            <button class="w-12 h-12 rounded-xl bg-[#E9E5FF]">3</button>
            <button class="w-12 h-12 rounded-xl bg-[#E9E5FF]">▶</button>
        </div>

    </main>
</div>

</body>
</html>