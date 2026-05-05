<!DOCTYPE html>
<html lang="id">
<head>
    <a href="laporan.html" class="active">Buat Laporan</a>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan - SafeCampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#EDE9FF] font-sans">

<div class="flex min-h-screen rounded-[30px] overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-[280px] bg-gradient-to-b from-[#6D6AEF] to-[#7C79F2] text-white p-8">
        <div class="flex items-center gap-3 mb-14">
            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                🛡️
            </div>
            <h1 class="text-3xl font-bold">SafeCampus</h1>
        </div>

        <nav class="space-y-5 text-xl">
            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10">🏠 Dashboard</a>

            <a href="#" class="flex items-center gap-4 px-4 py-4 rounded-2xl bg-white/10 shadow-lg border border-white/10">
                📄 Buat Laporan
            </a>

            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10">🕒 Riwayat</a>
            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10">❤️ Self-Check</a>
            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10">💬 Chat</a>
            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl hover:bg-white/10">📚 Artikel</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">

        <!-- Header -->
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-4xl font-bold text-[#2E2E48]">Buat Laporan</h2>

            <div class="flex items-center gap-6">
                <div class="bg-white rounded-full px-6 py-3 w-[420px] shadow-sm">
                    <input
                        type="text"
                        placeholder="Cari sesuatu......."
                        class="w-full outline-none text-gray-600"
                    >
                </div>

                <div class="text-2xl">🔔</div>
                <div class="w-12 h-12 rounded-full bg-pink-200"></div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white/60 rounded-[30px] p-10 shadow-sm max-w-5xl">

            <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Kategori -->
                <div>
                    <label class="font-semibold text-gray-700">Kategori Kejadian</label>
                    <div class="grid grid-cols-4 gap-4 mt-4">
                        <button type="button" class="bg-white rounded-full py-4 font-medium">Verbal</button>
                        <button type="button" class="bg-white rounded-full py-4 font-medium">Fisik</button>
                        <button type="button" class="bg-white rounded-full py-4 font-medium">Siber</button>
                        <button type="button" class="bg-white rounded-full py-4 font-medium">Lainnya</button>
                    </div>
                </div>

                <!-- Lokasi -->
                <div>
                    <label class="font-semibold text-gray-700">Lokasi Kejadian</label>
                    <input
                        type="text"
                        name="lokasi"
                        placeholder="Masukkan lokasi kejadian"
                        class="w-full mt-3 p-4 rounded-2xl border-none outline-none"
                    >
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="font-semibold text-gray-700">Deskripsi Kejadian</label>
                    <textarea
                        name="deskripsi"
                        rows="4"
                        placeholder="Ceritakan detail kejadian yang terjadi..."
                        class="w-full mt-3 p-4 rounded-2xl border-none outline-none"
                    ></textarea>
                </div>

                <!-- Upload -->
                <div>
                    <label class="font-semibold text-gray-700">Upload Foto (Opsional)</label>
                    <div class="mt-4 border-2 border-dashed rounded-2xl p-14 text-center bg-white">
                        <p class="text-gray-500 text-lg">Klik untuk upload atau drag & drop</p>
                        <p class="text-sm text-gray-400 mt-2">PNG, JPG hingga 10MB</p>
                        <input type="file" name="bukti" class="mt-4">
                    </div>
                </div>

                <!-- Urgensi -->
                <div>
                    <label class="font-semibold text-gray-700">Tingkat Urgensi</label>
                    <div class="grid grid-cols-3 gap-4 mt-4">
                        <label class="bg-white rounded-2xl py-4 text-center cursor-pointer">
                            <input type="radio" name="urgensi" value="tidak_urgent"> Tidak Urgent
                        </label>

                        <label class="bg-white rounded-2xl py-4 text-center cursor-pointer">
                            <input type="radio" name="urgensi" value="sedang"> Sedang
                        </label>

                        <label class="bg-red-50 border border-red-300 rounded-2xl py-4 text-center cursor-pointer text-red-500">
                            <input type="radio" name="urgensi" value="darurat"> Darurat
                        </label>
                    </div>
                </div>

                <!-- Anonim -->
                <div class="bg-[#F6F2FF] rounded-2xl p-5 flex items-center gap-4">
                    <input type="checkbox" name="anonim" class="w-5 h-5">
                    <label class="text-lg text-gray-700">Kirim laporan secara anonim</label>
                </div>

                <!-- Button -->
                <div class="grid grid-cols-2 gap-4 pt-4">
                    <button
                        type="button"
                        class="bg-white rounded-2xl py-4 font-semibold text-gray-700"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="bg-gradient-to-r from-purple-500 to-blue-500 text-white rounded-2xl py-4 font-semibold"
                    >
                        Kirim Laporan
                    </button>
                </div>
            </form>

        </div>
    </main>
</div>

</body>
</html>
