@php
    use Illuminate\Support\Facades\Storage;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $project->title }}</title>

    <style>
        body {
            margin: 0;
            font-family: Inter, Arial, sans-serif;
            background: #08031a;
            color: white;
            line-height: 1.7;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* === ANIMATIONS === */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInScale {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .navbar {
            animation: fadeInDown 0.6s ease-out;
            background: #141027;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .page {
            animation: fadeInUp 0.8s ease-out;
        }

        .card {
            animation: slideInScale 0.6s ease-out 0.2s both;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(126, 47, 255, 0.15);
        }

        .hero-image {
            animation: slideInScale 0.6s ease-out 0.1s both;
            transition: all 0.3s ease;
        }

        .hero-image:hover {
            transform: scale(1.02);
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .navbar {
            background: #141027;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .nav-container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
        }

        .brand {
            font-size: 22px;
            font-weight: 800;
            color: #6f7cff;
        }

        .page {
            max-width: 1120px;
            margin: 0 auto;
            padding: 70px 24px;
        }

        .badge {
            display: inline-block;
            padding: 7px 14px;
            border-radius: 999px;
            background: rgba(124, 58, 237, 0.22);
            color: #c4b5fd;
            font-size: 13px;
            font-weight: 900;
            margin-bottom: 18px;
        }

        h1 {
            font-size: clamp(36px, 6vw, 58px);
            margin: 0 0 18px;
            line-height: 1.1;
        }

        p {
            color: #b9c4f2;
            font-size: 18px;
        }

        .hero-image {
            margin-top: 36px;
            height: 430px;
            background: #171528;
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #3a3b5d;
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card {
            margin-top: 30px;
            background: #252641;
            border: 1px solid #3a3b5d;
            border-radius: 18px;
            padding: 28px;
        }

        .progress-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            color: #b9c4f2;
            font-weight: 800;
        }

        .progress-track {
            height: 10px;
            background: #444764;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #6b2cff, #db00ff);
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 26px;
        }

        .btn {
            padding: 13px 22px;
            border-radius: 10px;
            font-weight: 900;
        }

        .btn-primary {
            background: linear-gradient(135deg, #722cff, #d600ff);
            color: white;
        }

        .btn-secondary {
            background: #383b5d;
            color: white;
        }
    </style>
</head>

<body>

    <header class="navbar">
        <nav class="nav-container">
            <a
                href="{{ route('home') }}"
                class="brand"
            >
                Portfolio
            </a>

            <a href="{{ route('home') }}#projects">
                Kembali
            </a>
        </nav>
    </header>

    <main class="page">

        <span class="badge">
            {{ ucfirst($project->status) }}
        </span>

        <h1>
            {{ $project->title }}
        </h1>

        <p>
            {{ $project->description }}
        </p>

        <div class="hero-image">
            @if($project->thumbnail)
                <img
                    src="{{ Storage::url($project->thumbnail) }}"
                    alt="{{ $project->title }}"
                >
            @endif
        </div>

        <section class="card">
            <h2>
                Progress Project Akhir
            </h2>

            <p>
                Bagian ini menampilkan progress laporan awal/proposal project akhir sesuai kebutuhan UTS.
            </p>

            <div class="progress-meta">
                <span>
                    Progress
                </span>

                <span>
                    {{ $project->progress_percent }}%
                </span>
            </div>

            <div class="progress-track">
                <div
                    class="progress-bar"
                    style="width: {{ $project->progress_percent }}%"
                ></div>
            </div>

            <div class="actions">
                @if($project->report_file)
                    <a
                        href="{{ Storage::url($project->report_file) }}"
                        target="_blank"
                        class="btn btn-primary"
                    >
                        Lihat PDF Laporan
                    </a>

                    <a
                        href="{{ Storage::url($project->report_file) }}"
                        download
                        class="btn btn-secondary"
                    >
                        Download PDF
                    </a>
                @else
                    <p>
                        File laporan PDF belum diupload.
                    </p>
                @endif
            </div>
        </section>

        <section class="card">
            <h2>
                Link Project
            </h2>

            <div class="actions">
                @if($project->github_url)
                    <a
                        href="{{ $project->github_url }}"
                        target="_blank"
                        class="btn btn-secondary"
                    >
                        GitHub
                    </a>
                @endif

                @if($project->demo_url)
                    <a
                        href="{{ $project->demo_url }}"
                        target="_blank"
                        class="btn btn-primary"
                    >
                        Live Demo
                    </a>
                @endif
            </div>
        </section>

    </main>

    <script>
        // Page transition animation
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && link.hostname === window.location.hostname && !link.target && !link.hasAttribute('onclick')) {
                const href = link.getAttribute('href');
                if (href && !href.startsWith('#') && !href.startsWith('javascript:')) {
                    e.preventDefault();
                    document.body.style.opacity = '0';
                    document.body.style.transform = 'translateY(20px)';
                    document.body.style.transition = 'all 0.3s ease-out';
                    
                    setTimeout(() => {
                        window.location.href = href;
                    }, 300);
                }
            }
        });
    </script>

</body>

</html>