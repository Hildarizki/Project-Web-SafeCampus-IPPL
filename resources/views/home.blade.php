<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SafeCampus</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

a, a:visited, a:hover, a:active {
    text-decoration: none;
    color: inherit;
}

body {
    background: #f7f8fc;
    color: #1f2937;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: auto;
}

/* NAVBAR */
header {
    background: white;
    padding: 20px 0;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 700;
    color: #7c3aed;
}

.logo img {
    width: 35px;
}

.nav-links {
    display: flex;
    gap: 25px;
    align-items: center;
}

.nav-links a {
    color: #374151;
    font-weight: 500;
    transition: 0.3s;
}

.nav-links a:hover {
    color: #7c3aed;
}

/* BUTTON */
.btn {
    padding: 10px 22px;
    border-radius: 25px;
    font-weight: 600;
    transition: 0.3s;
}

.btn-outline {
    border: 2px solid #7c3aed;
    color: #7c3aed;
}

.btn-outline:hover {
    background: #7c3aed;
    color: white;
}

.btn-primary {
    background: linear-gradient(to right, #8b5cf6, #3b82f6);
    color: white;
}

.btn-primary:hover {
    opacity: 0.9;
}

/* HERO */
.hero {
    background: linear-gradient(135deg, #ede9fe, #e0e7ff);
    padding: 100px 0;
}

.hero-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 40px;
}

.hero-text h1 {
    font-size: 52px;
    margin-bottom: 20px;
}

.hero-text span {
    color: #9333ea;
}

.hero-text p {
    color: #6b7280;
    margin-bottom: 30px;
}

.hero-buttons {
    display: flex;
    gap: 15px;
}

.hero-image img {
    width: 100%;
    max-width: 450px;
}

/* SECTION */
section {
    padding: 90px 0;
}

.section-title {
    text-align: center;
    margin-bottom: 50px;
}

.section-title h2 {
    font-size: 36px;
}

.section-title p {
    color: #6b7280;
}

/* CARDS */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
}

.card {
    background: white;
    padding: 30px;
    border-radius: 20px;
    transition: 0.3s;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.card:hover {
    transform: translateY(-8px);
}

.card h3 {
    margin: 15px 0;
}

.card p {
    color: #6b7280;
}

/* WHY */
.why {
    background: linear-gradient(135deg, #f5f7ff, #eef2ff);
}

.why-content {
    display: flex;
    align-items: center;
    gap: 50px;
}

.why-text h2 {
    font-size: 40px;
    margin-bottom: 20px;
}

.why-text p {
    color: #6b7280;
    margin-bottom: 30px;
}

.why-image img {
    width: 100%;
    max-width: 450px;
}

/* FOOTER */
footer {
    background: linear-gradient(to right, #4c1d95, #2563eb);
    color: white;
    padding: 60px 0 30px;
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
}

footer a {
    transition: 0.3s;
}

footer a:hover {
    color: #c7d2fe;
}

.copyright {
    text-align: center;
    margin-top: 40px;
    font-size: 14px;
}

/* ===== ARTICLES ===== */
.articles-section {
    background: #f3f4f8;
}

.articles {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
}

.article-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0,0,0,0.05);
    transition: 0.3s;
}

.article-card:hover {
    transform: translateY(-8px);
}

.article-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.article-content {
    padding: 20px;
}

.article-date {
    font-size: 13px;
    color: #7c3aed;
    margin-bottom: 8px;
}

.article-content h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.article-content p {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 15px;
}

.read-more {
    font-size: 14px;
    color: #7c3aed;
    font-weight: 500;
}

.read-more:hover {
    opacity: 0.8;
}

/* ===== FOOTER UPGRADE ===== */
.footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 40px;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.footer-logo img {
    width: 35px;
}

.social-icons {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.social-icons a {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}
</style>
</head>

<body>

<header>
    <div class="container navbar">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}">
            SafeCampus
        </div>

        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Articles</a>
            <a href="#">Contact</a>
            <a href="#" class="btn btn-primary">Login</a>
            <a href="#" class="btn btn-primary">Sign Up</a>
        </div>
    </div>
</header>

<section class="hero">
    <div class="container hero-content">
        <div class="hero-text">
            <h1>Speak Up, <span>Stay Safe!</span></h1>
            <p>Report bullying incidents anonymously and get the support you 
need. We're here to create a safer campus environment for 
everyone.</p>

            <div class="hero-buttons">
                <a href="#" class="btn btn-primary">Laporkan</a>
                <a href="#" class="btn btn-outline">Self Check</a>
            </div>
        </div>

        <div class="hero-image">
            <img src="{{ asset('images/1.png') }}">
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="section-title">
            <h2>Our Features</h2>
            <p>Everything you need</p>
        </div>

        <div class="cards">
            <div class="card">
                <img src="{{ asset('images/3.png') }}">
                <h3>Anonymous Reporting</h3>
                <p>Report safely.</p>
            </div>

            <div class="card">
                <img src="{{ asset('images/4.png') }}">
                <h3>Chat with Counselors</h3>
                <p>Talk anytime.</p>
            </div>

            <div class="card">
                <img src="{{ asset('images/5.png') }}">
                <h3>Mental Health Check</h3>
                <p>Quick tools.</p>
            </div>

            <div class="card">
                <img src="{{ asset('images/6.png') }}">
                <h3>Articles</h3>
                <p>Helpful info.</p>
            </div>
        </div>
    </div>
</section>

<section class="why">
    <div class="container why-content">
        <div class="why-text">
            <h2>Why SafeCampus?</h2>
            <p>We believe every student deserves to feel safe and supported in 
their learning environment. SafeCampus provides a confidential 
platform where you can speak up about concerns, access mental 
health resources, and connect with professionals who care about 
your wellbeing.</p>
            <a href="#" class="btn btn-primary">Learn More</a>
        </div>

        <div class="why-image">
            <img src="{{ asset('images/2.png') }}">
        </div>
    </div>
</section>

    <section class="articles-section">
    <div class="container">
        <div class="section-title">
            <h2>Latest Articles</h2>
            <p>Stay informed with our latest resources and insights</p>
        </div>

        <div class="articles">

            <div class="article-card">
                <img src="{{ asset('images/artikel1.jpg') }}">
                <div class="article-content">
                    <div class="article-date">March 15, 2024</div>
                    <h3>Understanding Mental Health on Campus</h3>
                    <p>Learn about common mental health challenges students face.</p>
                    <a href="#" class="read-more">Baca Selengkapnya →</a>
                </div>
            </div>

            <div class="article-card">
                <img src="{{ asset('images/artikel2.jpg') }}">
                <div class="article-content">
                    <div class="article-date">March 12, 2024</div>
                    <h3>How to Stand Against Bullying</h3>
                    <p>Practical steps to create a safer environment.</p>
                    <a href="#" class="read-more">Baca Selengkapnya →</a>
                </div>
            </div>

            <div class="article-card">
                <img src="{{ asset('images/artikel3.jpg') }}">
                <div class="article-content">
                    <div class="article-date">March 10, 2024</div>
                    <h3>Self-Care Tips for Students</h3>
                    <p>Simple daily practices to maintain mental wellbeing.</p>
                    <a href="#" class="read-more">Baca Selengkapnya →</a>
                </div>
            </div>

        </div>
    </div>
</section>


<footer>
    <div class="container footer-grid">

        <div>
            <div class="footer-logo">
                <img src="{{ asset('images/logo.png') }}">
                <h4>SafeCampus</h4>
            </div>
            <p>
                Creating safer campus environments through anonymous reporting
                and comprehensive support services.
            </p>

            <div class="social-icons">
                <a href="#">F</a>
                <a href="#">T</a>
                <a href="#">I</a>
                <a href="#">L</a>
            </div>
        </div>

        <div>
            <h4>Quick Links</h4>
            <a href="#">Home</a>
            <a href="#">About Us</a>
            <a href="#">Features</a>
            <a href="#">Articles</a>
            <a href="#">Contact</a>
        </div>

        <div>
            <h4>Support</h4>
            <a href="#">Help Center</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">FAQs</a>
            <a href="#">Report Issue</a>
        </div>

        <div>
            <h4>Resources</h4>
            <a href="#">Mental Health</a>
            <a href="#">Safety Tips</a>
            <a href="#">Counseling</a>
            <a href="#">Crisis Hotline</a>
            <a href="#">Community</a>
        </div>

    </div>

    <div class="copyright">
        © 2024 SafeCampus. All rights reserved.
    </div>
</footer>

</body>
</html>