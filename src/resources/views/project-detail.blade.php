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

    <title>
        {{ $project->title }}
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-slate-950 text-white">

    <header class="border-b border-white/10 bg-slate-950/80 px-6 py-4">
        <nav class="mx-auto flex max-w-6xl items-center justify-between">
            <a
                href="{{ route('home') }}"
                class="text-xl font-bold"
            >
                Portfolio
            </a>

            <a
                href="{{ route('home') }}#projects"
                class="text-sm text-slate-300 hover:text-white"
            >
                Kembali
            </a>
        </nav>
    </header>

    <main class="px-6 py-16">
        <div class="mx-auto max-w-5xl">

            <div class="mb-10">
                <span class="rounded-full bg-indigo-500/20 px-4 py-2 text-sm font-semibold text-indigo-300">
                    {{ ucfirst($project->status) }}
                </span>

                <h1 class="mt-6 text-5xl font-bold">
                    {{ $project->title }}
                </h1>

                <p class="mt-6 max-w-3xl text-lg leading-relaxed text-slate-300">
                    {{ $project->description }}
                </p>
            </div>

            <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/5">
                @if($project->thumbnail)
                    <img
                        src="{{ Storage::url($project->thumbnail) }}"
                        alt="{{ $project->title }}"
                        class="h-[420px] w-full object-cover"
                    >
                @else
                    <div class="flex h-[420px] items-center justify-center bg-slate-900 text-slate-500">
                        No Image
                    </div>
                @endif
            </div>

            <section class="mt-12 rounded-3xl border border-white/10 bg-white/5 p-8">
                <h2 class="mb-4 text-3xl font-bold">
                    Progress Project Akhir
                </h2>

                <div class="mb-4 flex items-center justify-between">
                    <p class="text-slate-300">
                        Persentase progress pengerjaan project.
                    </p>

                    <span class="font-semibold text-indigo-300">
                        {{ $project->progress_percent }}%
                    </span>
                </div>

                <div class="h-4 overflow-hidden rounded-full bg-slate-800">
                    <div
                        class="h-full rounded-full bg-indigo-500"
                        style="width: {{ $project->progress_percent }}%"
                    ></div>
                </div>

                @if($project->report_file)
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a
                            href="{{ Storage::url($project->report_file) }}"
                            target="_blank"
                            class="rounded-full bg-indigo-500 px-6 py-3 font-semibold text-white hover:bg-indigo-600"
                        >
                            Lihat PDF Laporan
                        </a>

                        <a
                            href="{{ Storage::url($project->report_file) }}"
                            download
                            class="rounded-full border border-white/20 px-6 py-3 font-semibold text-white hover:bg-white hover:text-slate-950"
                        >
                            Download PDF
                        </a>
                    </div>
                @else
                    <p class="mt-6 text-slate-400">
                        File laporan PDF belum diupload.
                    </p>
                @endif
            </section>

            <section class="mt-12 rounded-3xl border border-white/10 bg-white/5 p-8">
                <h2 class="mb-6 text-3xl font-bold">
                    Link Project
                </h2>

                <div class="flex flex-wrap gap-4">
                    @if($project->github_url)
                        <a
                            href="{{ $project->github_url }}"
                            target="_blank"
                            class="rounded-full bg-white px-6 py-3 font-semibold text-slate-950 hover:bg-indigo-200"
                        >
                            GitHub
                        </a>
                    @endif

                    @if($project->demo_url)
                        <a
                            href="{{ $project->demo_url }}"
                            target="_blank"
                            class="rounded-full border border-white/20 px-6 py-3 font-semibold text-white hover:bg-white hover:text-slate-950"
                        >
                            Live Demo
                        </a>
                    @endif
                </div>
            </section>

        </div>
    </main>

</body>

</html>d