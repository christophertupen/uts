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
        {{ $profile?->name ?? 'Portfolio' }}
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-slate-950 text-white">

    <header class="fixed top-0 z-50 w-full border-b border-white/10 bg-slate-950/80 backdrop-blur">
        <nav class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <a
                href="{{ route('home') }}"
                class="text-xl font-bold text-white"
            >
                {{ $profile?->name ?? 'Portfolio' }}
            </a>

            <div class="hidden gap-6 md:flex">
                <a href="#about" class="text-sm text-slate-300 hover:text-white">
                    About
                </a>

                <a href="#skills" class="text-sm text-slate-300 hover:text-white">
                    Skills
                </a>

                <a href="#projects" class="text-sm text-slate-300 hover:text-white">
                    Projects
                </a>

                <a href="#contact" class="text-sm text-slate-300 hover:text-white">
                    Contact
                </a>
            </div>
        </nav>
    </header>

    <main>

        <section class="min-h-screen px-6 pt-32">
            <div class="mx-auto grid max-w-6xl items-center gap-12 md:grid-cols-2">

                <div>
                    <p class="mb-4 text-sm uppercase tracking-[0.3em] text-indigo-400">
                        Personal Portfolio
                    </p>

                    <h1 class="mb-6 text-5xl font-bold leading-tight md:text-7xl">
                        {{ $profile?->name ?? 'Nama Kamu' }}
                    </h1>

                    <h2 class="mb-6 text-2xl text-indigo-300">
                        {{ $profile?->role ?? 'Junior Laravel Developer' }}
                    </h2>

                    <p class="mb-8 max-w-xl text-lg leading-relaxed text-slate-300">
                        {{ $profile?->bio ?? 'Saya adalah mahasiswa yang sedang belajar menjadi junior developer dengan fokus Laravel, Filament, Livewire, Blade, MariaDB, dan Docker.' }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a
                            href="#projects"
                            class="rounded-full bg-indigo-500 px-6 py-3 font-semibold text-white hover:bg-indigo-600"
                        >
                            Lihat Project
                        </a>

                        @if($profile?->whatsapp_url)
                            <a
                                href="{{ $profile->whatsapp_url }}"
                                target="_blank"
                                class="rounded-full border border-white/20 px-6 py-3 font-semibold text-white hover:bg-white hover:text-slate-950"
                            >
                                Hubungi Saya
                            </a>
                        @endif
                    </div>
                </div>

                <div class="flex justify-center">
                    <div class="relative h-80 w-80 overflow-hidden rounded-full border border-white/10 bg-slate-900 shadow-2xl">
                        @if($profile?->photo)
                            <img
                                src="{{ Storage::url($profile->photo) }}"
                                alt="{{ $profile->name }}"
                                class="h-full w-full object-cover"
                            >
                        @else
                            <div class="flex h-full w-full items-center justify-center text-7xl font-bold text-indigo-400">
                                {{ strtoupper(substr($profile?->name ?? 'P', 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </section>

        <section
            id="about"
            class="px-6 py-24"
        >
            <div class="mx-auto max-w-6xl">
                <div class="mb-12">
                    <p class="mb-2 text-sm uppercase tracking-[0.3em] text-indigo-400">
                        About
                    </p>

                    <h2 class="text-4xl font-bold">
                        Tentang Saya
                    </h2>
                </div>

                <div class="rounded-3xl border border-white/10 bg-white/5 p-8">
                    <p class="text-lg leading-relaxed text-slate-300">
                        {{ $profile?->bio ?? 'Bio belum diisi.' }}
                    </p>

                    <div class="mt-8 grid gap-4 md:grid-cols-3">
                        <div class="rounded-2xl bg-slate-900 p-6">
                            <p class="text-sm text-slate-400">
                                Email
                            </p>

                            <p class="mt-2 font-semibold">
                                {{ $profile?->email ?? '-' }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-900 p-6">
                            <p class="text-sm text-slate-400">
                                Phone
                            </p>

                            <p class="mt-2 font-semibold">
                                {{ $profile?->phone ?? '-' }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-900 p-6">
                            <p class="text-sm text-slate-400">
                                Total Project
                            </p>

                            <p class="mt-2 font-semibold">
                                {{ $projects->count() }} Project
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section
            id="skills"
            class="px-6 py-24"
        >
            <div class="mx-auto max-w-6xl">
                <div class="mb-12">
                    <p class="mb-2 text-sm uppercase tracking-[0.3em] text-indigo-400">
                        Skills
                    </p>

                    <h2 class="text-4xl font-bold">
                        Stack Keahlian
                    </h2>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($skills as $skill)
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                            <div class="mb-4 flex items-center justify-between">
                                <h3 class="text-xl font-semibold">
                                    {{ $skill->name }}
                                </h3>

                                <span class="text-sm text-indigo-300">
                                    {{ $skill->level }}%
                                </span>
                            </div>

                            <div class="h-3 overflow-hidden rounded-full bg-slate-800">
                                <div
                                    class="h-full rounded-full bg-indigo-500"
                                    style="width: {{ $skill->level }}%"
                                ></div>
                            </div>

                            @if($skill->icon)
                                <p class="mt-4 text-sm text-slate-400">
                                    {{ $skill->icon }}
                                </p>
                            @endif
                        </div>
                    @empty
                        <p class="text-slate-400">
                            Skill belum ditambahkan.
                        </p>
                    @endforelse
                </div>
            </div>
        </section>

        <section
            id="projects"
            class="px-6 py-24"
        >
            <div class="mx-auto max-w-6xl">
                <div class="mb-12">
                    <p class="mb-2 text-sm uppercase tracking-[0.3em] text-indigo-400">
                        Projects
                    </p>

                    <h2 class="text-4xl font-bold">
                        Showcase Project
                    </h2>
                </div>

                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($projects as $project)
                        <article class="overflow-hidden rounded-3xl border border-white/10 bg-white/5">
                            <div class="h-52 bg-slate-900">
                                @if($project->thumbnail)
                                    <img
                                        src="{{ Storage::url($project->thumbnail) }}"
                                        alt="{{ $project->title }}"
                                        class="h-full w-full object-cover"
                                    >
                                @else
                                    <div class="flex h-full items-center justify-center text-slate-500">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                                <div class="mb-3 flex items-center justify-between">
                                    <span class="rounded-full bg-indigo-500/20 px-3 py-1 text-xs font-semibold text-indigo-300">
                                        {{ ucfirst($project->status) }}
                                    </span>

                                    <span class="text-sm text-slate-400">
                                        {{ $project->progress_percent }}%
                                    </span>
                                </div>

                                <h3 class="mb-3 text-2xl font-bold">
                                    {{ $project->title }}
                                </h3>

                                <p class="mb-6 line-clamp-3 text-slate-300">
                                    {{ $project->description }}
                                </p>

                                <div class="mb-6 h-2 overflow-hidden rounded-full bg-slate-800">
                                    <div
                                        class="h-full rounded-full bg-indigo-500"
                                        style="width: {{ $project->progress_percent }}%"
                                    ></div>
                                </div>

                                <a
                                    href="{{ route('projects.show', $project) }}"
                                    class="inline-flex rounded-full bg-white px-5 py-2 font-semibold text-slate-950 hover:bg-indigo-200"
                                >
                                    Detail Project
                                </a>
                            </div>
                        </article>
                    @empty
                        <p class="text-slate-400">
                            Project belum ditambahkan.
                        </p>
                    @endforelse
                </div>
            </div>
        </section>

        <section
            id="contact"
            class="px-6 py-24"
        >
            <div class="mx-auto max-w-4xl">
                <div class="mb-12 text-center">
                    <p class="mb-2 text-sm uppercase tracking-[0.3em] text-indigo-400">
                        Contact
                    </p>

                    <h2 class="text-4xl font-bold">
                        Hubungi Saya
                    </h2>

                    <p class="mt-4 text-slate-300">
                        Kirim pesan melalui form berikut. Pesan akan tersimpan di database.
                    </p>
                </div>

                @if(session('success'))
                    <div class="mb-6 rounded-2xl border border-green-500/30 bg-green-500/10 p-4 text-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                <form
                    action="{{ route('contact.store') }}"
                    method="POST"
                    class="rounded-3xl border border-white/10 bg-white/5 p-8"
                >
                    @csrf

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm text-slate-300">
                                Nama
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white outline-none focus:border-indigo-500"
                                required
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm text-slate-300">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white outline-none focus:border-indigo-500"
                                required
                            >
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="mb-2 block text-sm text-slate-300">
                            Pesan
                        </label>

                        <textarea
                            name="message"
                            rows="5"
                            class="w-full rounded-xl border border-white/10 bg-slate-900 px-4 py-3 text-white outline-none focus:border-indigo-500"
                            required
                        >{{ old('message') }}</textarea>
                    </div>

                    <button
                        type="submit"
                        class="mt-6 rounded-full bg-indigo-500 px-8 py-3 font-semibold text-white hover:bg-indigo-600"
                    >
                        Kirim Pesan
                    </button>
                </form>

                @if($profile?->whatsapp_url)
                    <div class="mt-6 text-center">
                        <a
                            href="{{ $profile->whatsapp_url }}"
                            target="_blank"
                            class="inline-flex rounded-full border border-white/20 px-6 py-3 font-semibold text-white hover:bg-white hover:text-slate-950"
                        >
                            Chat via WhatsApp
                        </a>
                    </div>
                @endif
            </div>
        </section>

    </main>

    <footer class="border-t border-white/10 px-6 py-8 text-center text-slate-400">
        <p>
            © {{ date('Y') }} {{ $profile?->name ?? 'Portfolio' }}. Built with Laravel & Filament v3.
        </p>
    </footer>

</body>

</html>