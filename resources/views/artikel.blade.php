<!-- resources/views/artikel.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Edukasi - SafeCampus</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #d9d6f8;
        }

        a {
            text-decoration: none;
        }

        
    .container {
      display: flex;
      min-height: 90vh;
      background: #f7f7ff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .sidebar {
      width: 260px;
      background: linear-gradient(180deg, #7b7df5, #6b6eea);
      color: white;
      padding: 30px 20px;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 40px;
    }

    .logo img {
      width: 40px;
    }
        
        .menu a {
            display: block;
            color: white;
            padding: 16px 20px;
            border-radius: 16px;
            margin-bottom: 12px;
            font-size: 20px;
            transition: 0.3s;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255,255,255,0.15);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        /* MAIN */

        .main {
            flex: 1;
            padding: 30px 40px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .search-box input {
            width: 480px;
            padding: 16px 24px;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            outline: none;
            background: white;
        }

        .profile {
            font-size: 28px;
            color: #4b4b8f;
        }

        /* CONTENT */

        .content-box {
            background: #f8f8ff;
            border-radius: 24px;
            padding: 35px;
        }

        h1 {
            font-size: 42px;
            color: #23263b;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 18px;
        }

        /* FILTER BUTTON */

        .filters {
            display: flex;
            gap: 15px;
            margin-bottom: 35px;
        }

        .filter-btn {
            padding: 12px 24px;
            border-radius: 30px;
            border: none;
            background: #d9d6f8;
            color: #444;
            font-size: 16px;
            cursor: pointer;
        }

        .filter-btn.active {
            background: linear-gradient(to right, #9d4edd, #3b82f6);
            color: white;
        }

        /* CARDS */

        .article-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .card {
            background: #e8e5ff;
            border-radius: 20px;
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: 210px;
            object-fit: cover;
        }

        .card-content {
            padding: 22px;
        }

        .tag {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .purple {
            background: #efe3ff;
            color: #8b3dff;
        }

        .red {
            background: #ffe3df;
            color: #ff4a3d;
        }

        .green {
            background: #dff7e5;
            color: #2f9e44;
        }

        .card h3 {
            font-size: 28px;
            margin-bottom: 14px;
            color: #23263b;
        }

        .card p {
            color: #666;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .btn {
            display: block;
            text-align: center;
            padding: 14px;
            border-radius: 14px;
            background: linear-gradient(to right, #9d4edd, #3b82f6);
            color: white;
            font-weight: 600;
        }
    </style>
</head>
<body>
{{-- 
<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="logo">
            🛡 SafeCampus
        </div>

        <div class="menu">
            <a href="/dashboard">Dashboard</a>
            <a href="/laporan">Buat Laporan</a>
            <a href="/riwayat">Riwayat</a>
            <a href="/self-check">Self-Check</a>
            <a href="/chat">Chat</a>
            <a href="/artikel" class="active">Artikel</a>
        </div>

    </div> --}}

    <div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="logo">
        <img src="{{ asset('images/logo.png') }}">
        <span>SafeCampus</span>
      </div>

      <div class="menu">
        <a href="#" class="active">
          <img src="{{ asset('images/Home Page.png') }}">
          Dashboard
        </a>

        <a href="#">
          <img src="{{ asset('images/Document.png') }}">
          Buat Laporan
        </a>

        <a href="#">
          <img src="{{ asset('images/Clock.png') }}">
          Riwayat
        </a>

        <a href="#">
          <img src="{{ asset('images/Handshake Heart.png') }}">
          Self Check
        </a>

        <a href="#">
          <img src="{{ asset('images/Chat Bubble.png') }}">
          Chat
        </a>

        <a href="#">
          <img src="{{ asset('images/Page.png') }}">
          Artikel
        </a>
      </div>
    </div>

    <!-- MAIN -->
    <div class="main">

        <div class="topbar">
            <div class="search-box">
                <input type="text" placeholder="Cari sesuatu......">
            </div>

            <div class="profile">
                ⌄
            </div>
        </div>

        <div class="content-box">

            <h1>Artikel Edukasi</h1>
            <p class="subtitle">
                Temukan artikel dan tips untuk keamanan kampus
            </p>

            <div class="filters">
                <button class="filter-btn active">Semua</button>
                <button class="filter-btn">Bullying</button>
                <button class="filter-btn">Mental Health</button>
                <button class="filter-btn">Tips</button>
            </div>

            <div class="article-grid">

                <!-- CARD 1 -->
                <div class="card">
                    <img src="{{ asset('images/artikel1.jpg') }}" alt="Artikel 1">

                    <div class="card-content">
                        <span class="tag purple">Mental Health</span>

                        <h3>Mengatasi Stres Akademik</h3>

                        <p>
                            Tips dan strategi untuk mengelola tekanan akademik
                            dan menjaga kesehatan mental selama kuliah...
                        </p>

                        <a href="#" class="btn">Baca Selengkapnya</a>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="card">
                    <img src="{{ asset('images/artikel2.jpg') }}" alt="Artikel 2">

                    <div class="card-content">
                        <span class="tag red">Bullying</span>

                        <h3>Mencegah Bullying di Kampus</h3>

                        <p>
                            Panduan lengkap untuk mengenali, mencegah,
                            dan melaporkan kasus bullying...
                        </p>

                        <a href="#" class="btn">Baca Selengkapnya</a>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="card">
                    <img src="{{ asset('images/artikel3.jpg') }}" alt="Artikel 3">

                    <div class="card-content">
                        <span class="tag green">Tips</span>

                        <h3>Tips Keamanan Malam Hari</h3>

                        <p>
                            Panduan praktis untuk tetap aman saat
                            beraktivitas di kampus pada malam hari...
                        </p>

                        <a href="#" class="btn">Baca Selengkapnya</a>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>