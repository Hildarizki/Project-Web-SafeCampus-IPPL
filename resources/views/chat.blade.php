{{-- resources/views/chat.blade.php --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeCampus - Chat Konselor</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #dcd8fa;
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
            text-decoration: none;
            padding: 16px 20px;
            margin-bottom: 15px;
            border-radius: 15px;
            font-size: 20px;
            transition: 0.3s;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255,255,255,0.15);
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        /* MAIN */
        .main {
            flex: 1;
            padding: 30px 40px;
        }

        /* TOPBAR */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .search-box input {
            width: 460px;
            padding: 15px 25px;
            border: none;
            border-radius: 30px;
            background: white;
            font-size: 16px;
            outline: none;
        }

        .profile {
            font-size: 30px;
            color: #4d4d88;
        }

        /* CHAT BOX */
        .chat-wrapper {
            display: flex;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            min-height: 750px;
        }

        /* LEFT CHAT LIST */
        .chat-list {
            width: 38%;
            border-right: 1px solid #ddd;
            background: #fff;
        }

        .chat-title {
            padding: 25px;
            font-size: 30px;
            font-weight: 700;
            color: #222;
            border-bottom: 1px solid #eee;
        }

        .chat-user {
            padding: 22px 28px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .chat-user.active {
            background: #b8b1f6;
        }

        .chat-user h4 {
            font-size: 22px;
            margin-bottom: 5px;
            color: #222;
        }

        .chat-user p {
            font-size: 16px;
            color: #666;
        }

        /* RIGHT CHAT CONTENT */
        .chat-content {
            flex: 1;
            padding: 30px;
            background: #fafafa;
        }

        .doctor-name {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .online {
            color: #1db954;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .message {
            max-width: 70%;
            padding: 18px 22px;
            border-radius: 18px;
            margin-bottom: 25px;
            font-size: 18px;
            line-height: 1.6;
        }

        .received {
            background: #e6e1ff;
            color: #333;
        }

        .sent {
            background: linear-gradient(to right, #9f52ff, #3b82f6);
            color: white;
            margin-left: auto;
        }

        .time {
            font-size: 14px;
            color: #888;
            margin-top: -18px;
            margin-bottom: 20px;
        }

        .typing {
            display: inline-block;
            background: #f0f0f0;
            padding: 12px 20px;
            border-radius: 18px;
            color: #888;
            font-size: 22px;
        }
    </style>
</head>
<body>

{{-- <div class="container"> --}}

    {{-- SIDEBAR --}}
    {{-- <div class="sidebar">
        <div class="logo">SafeCampus</div>

        <div class="menu">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('laporan') }}">Buat Laporan</a>
            <a href="{{ route('riwayat') }}">Riwayat</a>
            <a href="{{ route('selfcheck') }}">Self-Check</a>
            <a href="{{ route('chat') }}" class="active">Chat</a>
            <a href="{{ route('artikel') }}">Artikel</a>
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

    {{-- MAIN --}}
    <div class="main">

        {{-- TOPBAR --}}
        <div class="topbar">
            <div class="search-box">
                <input type="text" placeholder="Cari sesuatu......">
            </div>

            <div class="profile">
                ˅
            </div>
        </div>

        {{-- CHAT AREA --}}
        <div class="chat-wrapper">

            {{-- LEFT --}}
            <div class="chat-list">
                <div class="chat-title">Pesan</div>

                <div class="chat-user active">
                    <h4>Dr. Sarah Wilson</h4>
                    <p>Bagaimana perasaan kamu hari ini?</p>
                </div>

                <div class="chat-user">
                    <h4>Dr. Maria Garcia</h4>
                    <p>Terima kasih sudah sharing kemarin</p>
                </div>

                <div class="chat-user">
                    <h4>Dr. Lisa Chen</h4>
                    <p>Jangan lupa teknik pernapasan ya...</p>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="chat-content">
                <div class="doctor-name">Dr. Sarah Wilson</div>
                <div class="online">● Online</div>

                <div class="message received">
                    Halo! Bagaimana kabar kamu hari ini?
                    Ada yang ingin kamu ceritakan?
                </div>
                <div class="time">10:15</div>

                <div class="message sent">
                    Halo Dr. Sarah. Hari ini saya merasa sedikit
                    cemas karena ujian besok.
                </div>
                <div class="time" style="text-align:right;">10:18</div>

                <div class="message received">
                    Saya mengerti perasaan cemas sebelum ujian itu wajar.
                    Coba kita praktikkan teknik pernapasan yang sudah
                    kita pelajari kemarin.
                </div>
                <div class="time">10:20</div>

                <div class="message sent">
                    Iya betul, saya akan coba praktikkan sekarang.
                    Terima kasih Dr. Sarah 🙏
                </div>
                <div class="time" style="text-align:right;">10:22</div>

                <div class="typing">•••</div>
            </div>

        </div>
    </div>
</div>

</body>
</html>