<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SafeCampus Dashboard</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background: #d9d6f8;
      padding: 30px;
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
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 40px;
    }

    .menu a {
      display: block;
      text-decoration: none;
      color: white;
      padding: 15px 18px;
      margin-bottom: 12px;
      border-radius: 14px;
      font-size: 18px;
      transition: 0.3s;
    }

    .menu a.active,
    .menu a:hover {
      background: rgba(255,255,255,0.2);
    }

    .main {
      flex: 1;
      padding: 30px 40px;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .search-box input {
      width: 450px;
      padding: 14px 20px;
      border: 1px solid #ddd;
      border-radius: 30px;
      outline: none;
      font-size: 16px;
    }

    .profile {
      display: flex;
      align-items: center;
      gap: 15px;
      font-size: 24px;
    }

    .profile img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }

    h1 {
      color: #4a4a8a;
      font-size: 42px;
    }

    .subtitle {
      color: #6c6ca8;
      margin-top: 10px;
      margin-bottom: 30px;
      font-size: 18px;
    }

    .cards {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      margin-bottom: 30px;
    }

    .card {
      background: white;
      padding: 25px;
      border-radius: 18px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.05);
    }

    .card h3 {
      color: #4a4a8a;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 30px;
      font-weight: bold;
      color: #4a4a8a;
    }

    .section-title {
      font-size: 24px;
      color: #4a4a8a;
      margin-bottom: 20px;
      margin-top: 10px;
    }

    .actions {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      margin-bottom: 30px;
    }

    .action-btn {
      padding: 24px;
      border-radius: 18px;
      font-size: 20px;
      font-weight: bold;
      border: none;
      cursor: pointer;
      color: white;
    }

    .pink { background: #f47fb0; }
    .blue { background: #6d8cff; }
    .light { background: #dcd7ff; color: #5a4db2; }

    .report-box {
      background: white;
      padding: 25px;
      border-radius: 18px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.05);
    }

    .report-item {
      display: flex;
      justify-content: space-between;
      padding: 16px 0;
      border-bottom: 1px solid #eee;
      font-size: 18px;
    }

    .status {
      padding: 8px 16px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: bold;
    }

    .process {
      background: #ffe8b3;
      color: #8a6500;
    }

    .done {
      background: #d6f3d6;
      color: #2f7d32;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="sidebar">
          <div class="logo">
             <img src="{{ asset('images/logo.png') }}">
             <span>SafeCampus</span>
          </div>

      <div class="menu">
        <a href="#" class="active"><img src="{{ asset('images/Home Page.png') }}">Dashboard</a>
        <a href="#">Buat Laporan</a><img src="{{ asset('images/Document.png') }}">
        <a href="#">Riwayat</a><img src="{{ asset('images/Clock.png') }}">
        <a href="#">Self Check</a><img src="{{ asset('images/Handshake Heart.png') }}">
        <a href="#">Chat</a><img src="{{ asset('images/Chat Bubble.png') }}">
        <a href="#">Artikel</a><img src="{{ asset('images/Page.png') }}">
      </div>
    </div>

    <div class="main">
      <div class="topbar">
        <div class="search-box">
          <input type="text" placeholder="Cari sesuatu...">
        </div>

        <div class="profile">
          🔔
          <img src="https://i.pravatar.cc/100" alt="profile">
        </div>
      </div>

      <h1>Halo, Hilda!</h1>
      <p class="subtitle">Selamat datang kembali di SafeCampus</p>

      <div class="cards">
        <div class="card">
          <h3>Total Laporan</h3>
          <p>12</p>
        </div>

        <div class="card">
          <h3>Sedang Diproses</h3>
          <p>5</p>
        </div>

        <div class="card">
          <h3>Selesai</h3>
          <p>7</p>
        </div>
      </div>

      <div class="section-title">Quick Actions</div>

      <div class="actions">
        <button class="action-btn pink">Buat Laporan</button>
        <button class="action-btn blue">Chat Konselor</button>
        <button class="action-btn light">Self Check</button>
      </div>

      <div class="section-title">Laporan Terbaru</div>

      <div class="report-box">
        <div class="report-item">
          <span>Bully di Kantin</span>
          <span class="status process">Diproses</span>
        </div>

        <div class="report-item">
          <span>Intimidasi di Perpustakaan</span>
          <span class="status done">Selesai</span>
        </div>

        <div class="report-item">
          <span>Kasus Body Shaming</span>
          <span class="status process">Diproses</span>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
