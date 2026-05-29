@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $profile?->name ?? 'Portfolio' }}</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>
        :root {
            --bg-primary: #0B0F19;
            --bg-secondary: #111827;
            --bg-card: rgba(31, 41, 55, 0.72);

            --text-primary: #E5E7EB;
            --text-secondary: #B6BBC6;
            --text-muted: #8B93A1;

            --primary: #D4AF37;
            --primary-dark: #A67C00;
            --secondary: #B8860B;
            --accent: #F5D76E;

            --border: rgba(212, 175, 55, 0.18);
            --shadow: rgba(212, 175, 55, 0.16);

            --radius-sm: 12px;
            --radius-md: 20px;
            --radius-lg: 28px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Inter, Arial, sans-serif;
            background:
                radial-gradient(circle at 20% 0%, rgba(212, 175, 55, 0.08), transparent 32%),
                radial-gradient(circle at 85% 20%, rgba(255, 255, 255, 0.04), transparent 28%),
                var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.7;
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            width: min(1140px, calc(100% - 40px));
            margin: 0 auto;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(11, 15, 25, 0.82);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            transition: 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(11, 15, 25, 0.96);
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.35);
        }

        .nav-content {
            height: 76px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 900;
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            justify-content: center;
            align-items: center;
            color: #111827;
            box-shadow: 0 0 30px var(--shadow);
        }

        .brand-text small {
            display: block;
            color: var(--text-muted);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: -4px;
        }

        .nav-menu {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .nav-menu a {
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.2s;
        }

        .nav-menu a:hover {
            color: var(--primary);
        }

        .hero {
            min-height: calc(100vh - 76px);
            display: grid;
            align-items: center;
            padding: 80px 0;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            gap: 70px;
            align-items: center;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: rgba(212, 175, 55, 0.08);
            color: var(--accent);
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 22px;
        }

        .hero-title {
            font-size: clamp(44px, 7vw, 76px);
            line-height: 1.04;
            font-weight: 950;
            letter-spacing: -2px;
            margin-bottom: 20px;
        }

        .gradient-text {
            color: var(--primary);
            background: none;
            -webkit-background-clip: unset;
            background-clip: unset;
        }

        .hero-role {
            font-size: clamp(22px, 3vw, 30px);
            color: var(--accent);
            font-weight: 900;
            margin-bottom: 22px;
        }

        .hero-description {
            color: var(--text-secondary);
            font-size: 18px;
            max-width: 640px;
            margin-bottom: 32px;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 14px 24px;
            border-radius: var(--radius-sm);
            font-weight: 900;
            border: 1px solid transparent;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #D4AF37, #8B6F1D);
            color: #111827;
            box-shadow: 0 16px 40px var(--shadow);
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 60px var(--shadow);
        }

        .btn-outline {
            background: rgba(255, 255, 255, 0.04);
            border-color: var(--border);
            color: var(--text-primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: #111827;
            transform: translateY(-4px);
        }

        .socials {
            display: flex;
            gap: 14px;
        }

        .social-link {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 900;
            color: var(--text-secondary);
            transition: 0.25s ease;
            font-size: 20px;
        }

        .social-link:hover {
            background: var(--primary);
            color: #111827;
            transform: translateY(-4px);
        }

        .profile-area {
            position: relative;
            overflow: visible;
            z-index: 1;
        }

        .profile-card {
            position: relative;
            z-index: 1;
            border-radius: 34px;
            padding: 10px;
            background:
                linear-gradient(var(--bg-secondary), var(--bg-secondary)) padding-box,
                linear-gradient(135deg, var(--primary), var(--secondary), var(--accent)) border-box;
            border: 2px solid transparent;
            box-shadow: 0 30px 90px rgba(212, 175, 55, 0.14);
            animation: floatCard 5s ease-in-out infinite;
        }

        .profile-image {
            position: relative;
            z-index: 1;
            height: 520px;
            border-radius: 26px;
            overflow: hidden;
            background: linear-gradient(135deg, #1F2937, #111827);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-placeholder {
            font-size: 96px;
        }

        .floating-badge {
            position: absolute;
            z-index: 20;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(17, 24, 39, 0.95);
            border: 1px solid var(--border);
            backdrop-filter: blur(10px);
            color: var(--accent);
            font-weight: 900;
            font-size: 13px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.35);
            white-space: nowrap;
        }

        .badge-1 {
            top: 34px;
            left: -42px;
            animation: floatBadge 4s ease-in-out infinite;
        }

        .badge-2 {
            top: 160px;
            right: -46px;
            animation: floatBadge 4.5s ease-in-out infinite;
        }

        .badge-3 {
            bottom: 90px;
            left: -48px;
            animation: floatBadge 5s ease-in-out infinite;
        }

        .section {
            padding: 90px 0;
        }

        .section-header {
            text-align: center;
            max-width: 720px;
            margin: 0 auto 50px;
        }

        .section-kicker {
            color: var(--primary);
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: clamp(34px, 5vw, 48px);
            font-weight: 950;
            letter-spacing: -1px;
            margin-bottom: 14px;
        }

        .section-description {
            color: var(--text-secondary);
            font-size: 17px;
        }

        .glass-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            backdrop-filter: blur(14px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.22);
        }

        .about-card {
            padding: 34px;
        }

        .about-card p {
            color: var(--text-secondary);
            font-size: 18px;
        }

        .stats-grid {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .stat-card {
            padding: 24px;
            border-radius: var(--radius-md);
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border);
            text-align: center;
        }

        .stat-card h3 {
            color: var(--primary);
            font-size: 30px;
            font-weight: 950;
        }

        .stat-card p {
            color: var(--text-muted);
            font-size: 14px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .skill-card,
        .project-card {
            transition: 0.25s ease;
        }

        .skill-card:hover,
        .project-card:hover {
            transform: translateY(-8px);
            border-color: rgba(212, 175, 55, 0.5);
        }

        .skill-card {
            padding: 26px;
        }

        .skill-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: rgba(212, 175, 55, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--primary);
            font-weight: 950;
            margin-bottom: 18px;
        }

        .skill-title {
            font-size: 20px;
            font-weight: 900;
            margin-bottom: 14px;
        }

        .skill-meta {
            display: flex;
            justify-content: space-between;
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 8px;
        }

        .progress-track {
            height: 9px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            width: 0;
            border-radius: 999px;
            background: linear-gradient(135deg, #D4AF37, #8B6F1D);
            transition: width 1.2s ease;
        }

        .project-card {
            overflow: hidden;
        }

        .project-image {
            height: 220px;
            background: #111827;
        }

        .project-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .project-body {
            padding: 24px;
        }

        .project-top {
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 12px;
            margin-bottom: 14px;
        }

        .project-title {
            font-size: 22px;
            font-weight: 950;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 950;
            text-transform: uppercase;
        }

        .badge-ongoing {
            background: rgba(250, 204, 21, 0.12);
            color: #fde68a;
            border: 1px solid rgba(250, 204, 21, 0.25);
        }

        .badge-completed {
            background: rgba(34, 197, 94, 0.12);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.25);
        }

        .project-description {
            color: var(--text-secondary);
            margin-bottom: 20px;
        }

        .project-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .btn-small {
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 900;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.05);
        }

        .btn-small.primary {
            background: linear-gradient(135deg, #D4AF37, #8B6F1D);
            color: #111827;
            border-color: transparent;
        }

        .contact-card {
            max-width: 760px;
            margin: 0 auto;
            padding: 34px;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 14px;
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid rgba(34, 197, 94, 0.25);
            color: #86efac;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-secondary);
            font-weight: 800;
        }

        input,
        textarea {
            width: 100%;
            padding: 15px 16px;
            border-radius: 14px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-primary);
            outline: none;
            font: inherit;
        }

        input:focus,
        textarea:focus {
            border-color: var(--primary);
        }

        .confirm-modal {
            position: fixed;
            inset: 0;
            z-index: 999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(8px);
        }

        .confirm-modal.show {
            display: flex;
        }

        .confirm-box {
            width: min(420px, 100%);
            padding: 32px;
            border-radius: 24px;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.45);
            text-align: center;
            animation: modalPop 0.25s ease;
        }

        .confirm-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.12);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 32px;
            font-weight: 950;
        }

        .confirm-box h3 {
            font-size: 26px;
            margin-bottom: 10px;
        }

        .confirm-box p {
            color: var(--text-secondary);
            margin-bottom: 26px;
        }

        .confirm-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .confirm-btn {
            padding: 13px 18px;
            border-radius: 12px;
            border: 1px solid transparent;
            font-weight: 900;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .confirm-btn.cancel {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-primary);
            border-color: var(--border);
        }

        .confirm-btn.cancel:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .confirm-btn.submit {
            background: linear-gradient(135deg, #D4AF37, #8B6F1D);
            color: #111827;
        }

        .confirm-btn.submit:hover {
            transform: translateY(-2px);
        }

        .footer {
            padding: 30px 0;
            text-align: center;
            border-top: 1px solid var(--border);
            color: var(--text-muted);
        }

        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: 0.7s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes floatCard {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-14px);
            }
        }

        @keyframes floatBadge {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes modalPop {
            from {
                opacity: 0;
                transform: scale(0.92) translateY(12px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @media (max-width: 960px) {
            .hero-grid {
                grid-template-columns: 1fr;
            }

            .profile-image {
                height: 420px;
            }

            .grid-3,
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .nav-menu {
                display: none;
            }

            .floating-badge {
                display: none;
            }

            .confirm-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <header class="navbar" id="navbar">
        <div class="container nav-content">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-icon">
                    P
                </span>

                <span class="brand-text">
                    Portfolio
                    <small>UTS Project</small>
                </span>
            </a>

            <nav class="nav-menu">
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#skills">Skills</a>
                <a href="#projects">Projects</a>
                <a href="#contact">Contact</a>
            </nav>
        </div>
    </header>

    <main>

        <section class="hero" id="home">
            <div class="container hero-grid">

                <div class="hero-text reveal">
                    <div class="eyebrow">
                        Laravel Developer Portfolio
                    </div>

                    <h1 class="hero-title">
                        Hi, Saya
                        <span class="gradient-text">
                            {{ $profile?->name ?? 'Christopher' }}
                        </span>
                    </h1>

                    <div class="hero-role">
                        {{ $profile?->role ?? 'Junior Laravel Developer' }}
                    </div>

                    <p class="hero-description">
                        {{ $profile?->bio ?? 'Saya adalah mahasiswa yang sedang fokus belajar pengembangan web modern menggunakan Laravel, Filament v3, Livewire, Blade, MariaDB, dan Docker.' }}
                    </p>

                    <div class="hero-actions">
                        <a href="#projects" class="btn btn-primary">
                            Lihat Projects
                        </a>

                        <a href="#contact" class="btn btn-outline">
                            Contact Me
                        </a>
                    </div>

                    <div class="socials">
                        @if($profile?->github_url)
                            <a
                                href="{{ $profile->github_url }}"
                                target="_blank"
                                class="social-link"
                                aria-label="GitHub"
                            >
                                <i class="fa-brands fa-github"></i>
                            </a>
                        @endif

                        @if($profile?->linkedin_url)
                            <a
                                href="{{ $profile->linkedin_url }}"
                                target="_blank"
                                class="social-link"
                                aria-label="LinkedIn"
                            >
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        @endif

                        @if($profile?->whatsapp_url)
                            <a
                                href="{{ $profile->whatsapp_url }}"
                                target="_blank"
                                class="social-link"
                                aria-label="WhatsApp"
                            >
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="profile-area reveal">
                    <div class="floating-badge badge-1">
                        Laravel
                    </div>

                    <div class="floating-badge badge-2">
                        Filament v3
                    </div>

                    <div class="floating-badge badge-3">
                        Docker
                    </div>

                    <div class="profile-card">
                        <div class="profile-image">
                            @if($profile?->photo)
                                <img
                                    src="{{ Storage::url($profile->photo) }}"
                                    alt="{{ $profile->name }}"
                                >
                            @else
                                <div class="profile-placeholder">
                                    👨‍💻
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="section" id="about">
            <div class="container">
                <div class="section-header reveal">
                    <div class="section-kicker">
                        About
                    </div>

                    <h2 class="section-title">
                        Tentang Saya
                    </h2>

                    <p class="section-description">
                        Profil profesional, stack keahlian, dan bio singkat sesuai kebutuhan website portofolio.
                    </p>
                </div>

                <div class="glass-card about-card reveal">
                    <p>
                        {{ $profile?->bio ?? 'Bio belum diisi melalui admin panel.' }}
                    </p>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <h3>{{ $skills->count() }}</h3>
                            <p>Total Skills</p>
                        </div>

                        <div class="stat-card">
                            <h3>{{ $projects->count() }}</h3>
                            <p>Total Projects</p>
                        </div>

                        <div class="stat-card">
                            <h3>
                                {{ $projects->where('status', 'completed')->count() }}
                            </h3>
                            <p>Project Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="skills">
            <div class="container">
                <div class="section-header reveal">
                    <div class="section-kicker">
                        Skills
                    </div>

                    <h2 class="section-title">
                        Stack Keahlian
                    </h2>

                    <p class="section-description">
                        Data skill ini diambil langsung dari database melalui Filament admin panel.
                    </p>
                </div>

                <div class="grid-3">
                    @forelse($skills as $skill)
                        <div class="glass-card skill-card reveal">
                            <div class="skill-icon">
                                {{ $skill->icon ?: strtoupper(substr($skill->name, 0, 2)) }}
                            </div>

                            <div class="skill-title">
                                {{ $skill->name }}
                            </div>

                            <div class="skill-meta">
                                <span>Proficiency</span>
                                <span>{{ $skill->level }}%</span>
                            </div>

                            <div class="progress-track">
                                <div
                                    class="progress-bar"
                                    data-width="{{ $skill->level }}%"
                                ></div>
                            </div>
                        </div>
                    @empty
                        <p>Skill belum ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="section" id="projects">
            <div class="container">
                <div class="section-header reveal">
                    <div class="section-kicker">
                        Projects
                    </div>

                    <h2 class="section-title">
                        Showcase Project
                    </h2>

                    <p class="section-description">
                        Daftar project yang pernah atau sedang dibuat, termasuk progress laporan project akhir.
                    </p>
                </div>

                <div class="grid-3">
                    @forelse($projects as $project)
                        <article class="glass-card project-card reveal">
                            <div class="project-image">
                                @if($project->thumbnail)
                                    <img
                                        src="{{ Storage::url($project->thumbnail) }}"
                                        alt="{{ $project->title }}"
                                    >
                                @endif
                            </div>

                            <div class="project-body">
                                <div class="project-top">
                                    <h3 class="project-title">
                                        {{ $project->title }}
                                    </h3>

                                    <span class="badge {{ $project->status === 'completed' ? 'badge-completed' : 'badge-ongoing' }}">
                                        {{ ucfirst($project->status) }}
                                    </span>
                                </div>

                                <p class="project-description">
                                    {{ Str::limit($project->description, 110) }}
                                </p>

                                <div class="skill-meta">
                                    <span>Progress Laporan</span>
                                    <span>{{ $project->progress_percent }}%</span>
                                </div>

                                <div class="progress-track">
                                    <div
                                        class="progress-bar"
                                        data-width="{{ $project->progress_percent }}%"
                                    ></div>
                                </div>

                                <div class="project-actions">
                                    @if($project->github_url)
                                        <a
                                            href="{{ $project->github_url }}"
                                            target="_blank"
                                            class="btn-small"
                                        >
                                            GitHub
                                        </a>
                                    @endif

                                    @if($project->demo_url)
                                        <a
                                            href="{{ $project->demo_url }}"
                                            target="_blank"
                                            class="btn-small"
                                        >
                                            Demo
                                        </a>
                                    @endif

                                    <a
                                        href="{{ route('projects.show', $project) }}"
                                        class="btn-small primary"
                                    >
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <p>Project belum ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="section" id="contact">
            <div class="container">
                <div class="section-header reveal">
                    <div class="section-kicker">
                        Contact
                    </div>

                    <h2 class="section-title">
                        Hubungi Saya
                    </h2>

                    <p class="section-description">
                        Form kontak ini tersimpan ke database dan bisa dilihat melalui Filament admin panel.
                    </p>
                </div>

                <div class="glass-card contact-card reveal">
                    @if(session('success'))
                        <div class="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form
                        id="contactForm"
                        action="{{ route('contact.store') }}"
                        method="POST"
                    >
                        @csrf

                        <div class="form-group">
                            <label>Nama</label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="email@example.com"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>Pesan</label>
                            <textarea
                                name="message"
                                rows="6"
                                placeholder="Tulis pesan kamu..."
                                required
                            >{{ old('message') }}</textarea>
                        </div>

                        <button
                            type="button"
                            id="openConfirmModal"
                            class="btn btn-primary"
                            style="width: 100%;"
                        >
                            Kirim Pesan
                        </button>

                        @if($profile?->whatsapp_url)
                            <a
                                href="{{ $profile->whatsapp_url }}"
                                target="_blank"
                                class="btn btn-outline"
                                style="width: 100%; margin-top: 12px;"
                            >
                                Hubungi via WhatsApp
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </section>

    </main>

    <footer class="footer">
        <div class="container">
            © {{ date('Y') }} {{ $profile?->name ?? 'Portfolio' }}. Built with Laravel & Filament v3.
        </div>
    </footer>

    <div
        class="confirm-modal"
        id="confirmModal"
    >
        <div class="confirm-box">
            <div class="confirm-icon">
                ?
            </div>

            <h3>
                Kirim Pesan?
            </h3>

            <p>
                Apakah Anda yakin ingin mengirim pesan ini?
            </p>

            <div class="confirm-actions">
                <button
                    type="button"
                    class="confirm-btn cancel"
                    id="cancelSend"
                >
                    Tidak
                </button>

                <button
                    type="button"
                    class="confirm-btn submit"
                    id="confirmSend"
                >
                    Iya, Kirim
                </button>
            </div>
        </div>
    </div>

    <script>
        const navbar = document.getElementById('navbar');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        const revealElements = document.querySelectorAll('.reveal');

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, {
            threshold: 0.15
        });

        revealElements.forEach((element) => {
            revealObserver.observe(element);
        });

        const progressBars = document.querySelectorAll('.progress-bar');

        const progressObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const width = entry.target.getAttribute('data-width');
                    entry.target.style.width = width;
                }
            });
        }, {
            threshold: 0.5
        });

        progressBars.forEach((bar) => {
            progressObserver.observe(bar);
        });

        const contactForm = document.getElementById('contactForm');
        const openConfirmModal = document.getElementById('openConfirmModal');
        const confirmModal = document.getElementById('confirmModal');
        const cancelSend = document.getElementById('cancelSend');
        const confirmSend = document.getElementById('confirmSend');

        if (
            contactForm &&
            openConfirmModal &&
            confirmModal &&
            cancelSend &&
            confirmSend
        ) {
            openConfirmModal.addEventListener('click', () => {
                if (contactForm.checkValidity()) {
                    confirmModal.classList.add('show');
                } else {
                    contactForm.reportValidity();
                }
            });

            cancelSend.addEventListener('click', () => {
                confirmModal.classList.remove('show');
            });

            confirmSend.addEventListener('click', () => {
                contactForm.submit();
            });

            confirmModal.addEventListener('click', (event) => {
                if (event.target === confirmModal) {
                    confirmModal.classList.remove('show');
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    confirmModal.classList.remove('show');
                }
            });
        }
    </script>

</body>
</html>