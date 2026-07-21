<div>
    {{-- Nav --}}
    <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/80 backdrop-blur dark:border-slate-800/70 dark:bg-slate-950/80">
        <nav class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <a href="#home" class="text-lg font-bold tracking-tight">{{ $this->profile->name }}</a>

            <div class="hidden items-center gap-8 md:flex">
                <a href="#about" class="text-sm font-medium text-slate-600 transition hover:text-amber-500 dark:text-slate-300">About</a>
                <a href="#skills" class="text-sm font-medium text-slate-600 transition hover:text-amber-500 dark:text-slate-300">Skills</a>
                <a href="#portfolio" class="text-sm font-medium text-slate-600 transition hover:text-amber-500 dark:text-slate-300">Portfolio</a>
                <a href="#contact" class="text-sm font-medium text-slate-600 transition hover:text-amber-500 dark:text-slate-300">Contact</a>
            </div>

            <div class="flex items-center gap-3">
                <button
                    @click="dark = !dark"
                    aria-label="Toggle dark mode"
                    class="rounded-full p-2 text-slate-600 transition hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
                >
                    <svg x-show="!dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 15.5A9.75 9.75 0 1 1 8.5 2.25 7.5 7.5 0 0 0 21.75 15.5Z"/></svg>
                    <svg x-show="dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1.5m0 15V21m9-9h-1.5M4.5 12H3m15.36 6.36-1.06-1.06M6.7 6.7 5.64 5.64m12.72 0-1.06 1.06M6.7 17.3l-1.06 1.06M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z"/></svg>
                </button>

                <a href="#contact" class="hidden rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-amber-500 sm:inline-block dark:bg-white dark:text-slate-900 dark:hover:bg-amber-500 dark:hover:text-white">
                    Hire Me
                </a>

                <button @click="mobileNavOpen = !mobileNavOpen" class="rounded-full p-2 text-slate-600 md:hidden dark:text-slate-300" aria-label="Toggle menu">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5m-16.5 5.25h16.5m-16.5 5.25h16.5"/></svg>
                </button>
            </div>
        </nav>

        <div x-show="mobileNavOpen" x-collapse class="border-t border-slate-200 px-6 py-4 md:hidden dark:border-slate-800">
            <div class="flex flex-col gap-3">
                <a href="#about" @click="mobileNavOpen = false" class="text-sm font-medium text-slate-600 dark:text-slate-300">About</a>
                <a href="#skills" @click="mobileNavOpen = false" class="text-sm font-medium text-slate-600 dark:text-slate-300">Skills</a>
                <a href="#portfolio" @click="mobileNavOpen = false" class="text-sm font-medium text-slate-600 dark:text-slate-300">Portfolio</a>
                <a href="#contact" @click="mobileNavOpen = false" class="text-sm font-medium text-slate-600 dark:text-slate-300">Contact</a>
            </div>
        </div>
    </header>

    <main>
        {{-- Hero --}}
        <section id="home" class="mx-auto flex max-w-6xl flex-col-reverse items-center gap-12 px-6 py-20 md:flex-row md:py-28">
            <div data-animate class="flex-1 text-center md:text-left">
                <p class="mb-3 text-sm font-semibold uppercase tracking-widest text-amber-500">Welcome to my portfolio</p>
                <h1 class="text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl">
                    Hi, I'm {{ $this->profile->name }}
                </h1>
                @if($this->profile->title)
                    <p class="mt-3 text-xl font-medium text-slate-600 dark:text-slate-300">{{ $this->profile->title }}</p>
                @endif
                @if($this->profile->bio)
                    <p class="mx-auto mt-6 max-w-xl text-slate-600 md:mx-0 dark:text-slate-400">
                        {{ Str::limit($this->profile->bio, 220) }}
                    </p>
                @endif

                <div class="mt-8 flex flex-wrap items-center justify-center gap-4 md:justify-start">
                    <a href="#portfolio" class="rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-amber-500 dark:bg-white dark:text-slate-900 dark:hover:bg-amber-500 dark:hover:text-white">
                        View My Work
                    </a>
                    @if($this->profile->resume_url)
                        <a href="{{ $this->profile->resume_url }}" target="_blank" rel="noopener" class="rounded-full border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-amber-500 hover:text-amber-500 dark:border-slate-700 dark:text-slate-200">
                            Download CV
                        </a>
                    @endif
                </div>

                @if(!empty($this->profile->socials))
                    <div class="mt-8 flex items-center justify-center gap-4 md:justify-start">
                        @foreach($this->profile->socials as $social)
                            @if(!empty($social['url']))
                                <a href="{{ $social['url'] }}" target="_blank" rel="noopener" class="rounded-full border border-slate-200 p-2.5 text-slate-500 transition hover:border-amber-500 hover:text-amber-500 dark:border-slate-800 dark:text-slate-400">
                                    <x-social-icon :platform="$social['platform'] ?? 'website'" />
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <div data-animate class="flex-shrink-0">
                <div class="relative h-56 w-56 overflow-hidden rounded-full border-4 border-white shadow-xl sm:h-72 sm:w-72 dark:border-slate-800">
                    @if($this->profile->avatar_url)
                        <img src="{{ $this->profile->avatar_url }}" alt="{{ $this->profile->name }}" class="h-full w-full object-cover">
                    @else
                        <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-amber-400 to-orange-500 text-6xl font-bold text-white">
                            {{ Str::of($this->profile->name)->substr(0, 1) }}
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- Highlights / Stats --}}
        @if(!empty($this->profile->highlights))
            <section class="border-y border-slate-200 bg-slate-50 py-10 dark:border-slate-800 dark:bg-slate-900/40">
                <div class="mx-auto grid max-w-6xl grid-cols-2 gap-8 px-6 text-center sm:grid-cols-4">
                    @foreach($this->profile->highlights as $highlight)
                        <div data-animate>
                            <p class="text-3xl font-extrabold text-amber-500">
                                <span data-counter-target="{{ (int) filter_var($highlight['value'], FILTER_SANITIZE_NUMBER_INT) }}">0</span>{{ preg_replace('/[0-9]/', '', $highlight['value']) }}
                            </p>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $highlight['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- About --}}
        <section id="about" class="mx-auto max-w-4xl scroll-mt-20 px-6 py-20">
            <div data-animate>
                <p class="text-sm font-semibold uppercase tracking-widest text-amber-500">About Me</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">A little about who I am</h2>
                <div class="mt-6 space-y-4 leading-relaxed text-slate-600 dark:text-slate-400">
                    {!! nl2br(e($this->profile->bio)) !!}
                </div>

                <dl class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @if($this->profile->email)
                        <div class="flex items-center gap-3 rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                            <dt class="text-sm font-semibold text-slate-500 dark:text-slate-400">Email</dt>
                            <dd class="text-sm">{{ $this->profile->email }}</dd>
                        </div>
                    @endif
                    @if($this->profile->phone)
                        <div class="flex items-center gap-3 rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                            <dt class="text-sm font-semibold text-slate-500 dark:text-slate-400">Phone</dt>
                            <dd class="text-sm">{{ $this->profile->phone }}</dd>
                        </div>
                    @endif
                    @if($this->profile->location)
                        <div class="flex items-center gap-3 rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                            <dt class="text-sm font-semibold text-slate-500 dark:text-slate-400">Location</dt>
                            <dd class="text-sm">{{ $this->profile->location }}</dd>
                        </div>
                    @endif
                    @if($this->profile->years_experience)
                        <div class="flex items-center gap-3 rounded-xl border border-slate-200 p-4 dark:border-slate-800">
                            <dt class="text-sm font-semibold text-slate-500 dark:text-slate-400">Experience</dt>
                            <dd class="text-sm">{{ $this->profile->years_experience }}+ years</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </section>

        {{-- Skills --}}
        @if($this->skills->isNotEmpty())
            <section id="skills" class="scroll-mt-20 bg-slate-50 py-20 dark:bg-slate-900/40">
                <div class="mx-auto max-w-5xl px-6">
                    <div data-animate class="text-center">
                        <p class="text-sm font-semibold uppercase tracking-widest text-amber-500">My Skills</p>
                        <h2 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Tools & technologies I work with</h2>
                    </div>

                    <div class="mt-12 grid grid-cols-1 gap-10 md:grid-cols-2">
                        @foreach($this->skills as $category => $categorySkills)
                            <div data-animate>
                                <h3 class="mb-4 text-lg font-semibold text-slate-800 dark:text-slate-100">{{ $category }}</h3>
                                <div class="space-y-5">
                                    @foreach($categorySkills as $skill)
                                        <div>
                                            <div class="mb-1.5 flex items-center justify-between text-sm">
                                                <span class="font-medium">{{ $skill->name }}</span>
                                                <span class="text-slate-400">{{ $skill->level }}%</span>
                                            </div>
                                            <div class="h-2 w-full overflow-hidden rounded-full bg-slate-200 dark:bg-slate-800">
                                                <div
                                                    data-skill-bar
                                                    data-level="{{ $skill->level }}"
                                                    style="width: 0%"
                                                    class="skill-bar-fill h-2 rounded-full bg-gradient-to-r from-amber-500 to-orange-500"
                                                ></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Portfolio --}}
        <section id="portfolio" class="mx-auto max-w-6xl scroll-mt-20 px-6 py-20">
            <div data-animate class="text-center">
                <p class="text-sm font-semibold uppercase tracking-widest text-amber-500">Portfolio</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Some of my recent work</h2>
            </div>

            @if($this->categories->isNotEmpty())
                <div class="mt-10 flex flex-wrap items-center justify-center gap-3">
                    <button
                        wire:click="setCategory('all')"
                        class="rounded-full px-4 py-2 text-sm font-medium transition {{ $activeCategory === 'all' ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-300' }}"
                    >
                        All
                    </button>
                    @foreach($this->categories as $category)
                        <button
                            wire:click="setCategory('{{ $category }}')"
                            class="rounded-full px-4 py-2 text-sm font-medium transition {{ $activeCategory === $category ? 'bg-slate-900 text-white dark:bg-white dark:text-slate-900' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-300' }}"
                        >
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            @endif

            <div wire:loading.class="opacity-50" class="mt-10 grid grid-cols-1 gap-8 transition-opacity sm:grid-cols-2 lg:grid-cols-3">
                @forelse($this->projects as $project)
                    <div wire:key="project-{{ $project->id }}" class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-slate-800 dark:bg-slate-900">
                        <div class="aspect-video w-full overflow-hidden bg-slate-100 dark:bg-slate-800">
                            @if($project->image_url)
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="flex h-full w-full items-center justify-center text-slate-400">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-12 w-12"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5 8.5 11l3.5 3.5L17 9l4 4.5M3 6.75h18M3 6.75v10.5A2.25 2.25 0 0 0 5.25 19.5h13.5A2.25 2.25 0 0 0 21 17.25V6.75M3 6.75A2.25 2.25 0 0 1 5.25 4.5h13.5A2.25 2.25 0 0 1 21 6.75"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <div class="flex items-center justify-between gap-2">
                                <h3 class="font-semibold">{{ $project->title }}</h3>
                                @if($project->featured)
                                    <span class="rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-semibold text-amber-700 dark:bg-amber-500/10 dark:text-amber-400">Featured</span>
                                @endif
                            </div>
                            @if($project->category)
                                <p class="mt-1 text-xs font-medium uppercase tracking-wide text-slate-400">{{ $project->category }}</p>
                            @endif
                            @if($project->description)
                                <p class="mt-3 text-sm text-slate-600 dark:text-slate-400">{{ Str::limit($project->description, 100) }}</p>
                            @endif
                            <div class="mt-4 flex items-center gap-4">
                                @if($project->project_url)
                                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="text-sm font-semibold text-amber-500 hover:text-amber-600">Live Demo &rarr;</a>
                                @endif
                                @if($project->repo_url)
                                    <a href="{{ $project->repo_url }}" target="_blank" rel="noopener" class="text-sm font-semibold text-slate-500 hover:text-slate-700 dark:text-slate-400">Source Code</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-slate-500 dark:text-slate-400">No projects to show yet — check back soon!</p>
                @endforelse
            </div>
        </section>

        {{-- Contact --}}
        <section id="contact" class="scroll-mt-20 bg-slate-50 py-20 dark:bg-slate-900/40">
            <div class="mx-auto max-w-2xl px-6">
                <div data-animate class="text-center">
                    <p class="text-sm font-semibold uppercase tracking-widest text-amber-500">Contact</p>
                    <h2 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Let's work together</h2>
                    <p class="mt-3 text-slate-600 dark:text-slate-400">Have a project in mind? Send me a message and I'll get back to you.</p>
                </div>

                <div data-animate class="mt-10">
                    @livewire('contact-form')
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 py-8 text-center text-sm text-slate-500 dark:border-slate-800 dark:text-slate-500">
        &copy; {{ now()->year }} {{ $this->profile->name }}. All rights reserved.
    </footer>
</div>
