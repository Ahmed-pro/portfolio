<div>
    @if($sent)
        <div class="rounded-2xl border border-green-200 bg-green-50 p-6 text-center dark:border-green-900 dark:bg-green-900/20">
            <p class="font-semibold text-green-700 dark:text-green-400">Thanks for reaching out!</p>
            <p class="mt-1 text-sm text-green-600 dark:text-green-500">Your message has been sent. I'll get back to you soon.</p>
            <button wire:click="$set('sent', false)" class="mt-4 text-sm font-semibold text-green-700 underline dark:text-green-400">Send another message</button>
        </div>
    @else
        <form wire:submit="submit" class="space-y-5 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 dark:border-slate-800 dark:bg-slate-900">
            {{-- Honeypot: hidden from real users, left visible to bots --}}
            <div class="absolute left-[-9999px]" aria-hidden="true">
                <label for="company">Company</label>
                <input type="text" id="company" wire:model="company" tabindex="-1" autocomplete="off">
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <label for="name" class="mb-1.5 block text-sm font-medium">Name</label>
                    <input
                        type="text" id="name" wire:model="name"
                        class="w-full rounded-lg border border-slate-300 bg-transparent px-4 py-2.5 text-sm focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 dark:border-slate-700"
                    >
                    @error('name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-medium">Email</label>
                    <input
                        type="email" id="email" wire:model="email"
                        class="w-full rounded-lg border border-slate-300 bg-transparent px-4 py-2.5 text-sm focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 dark:border-slate-700"
                    >
                    @error('email') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="subject" class="mb-1.5 block text-sm font-medium">Subject</label>
                <input
                    type="text" id="subject" wire:model="subject"
                    class="w-full rounded-lg border border-slate-300 bg-transparent px-4 py-2.5 text-sm focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 dark:border-slate-700"
                >
                @error('subject') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="message" class="mb-1.5 block text-sm font-medium">Message</label>
                <textarea
                    id="message" wire:model="message" rows="5"
                    class="w-full rounded-lg border border-slate-300 bg-transparent px-4 py-2.5 text-sm focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500 dark:border-slate-700"
                ></textarea>
                @error('message') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="submit"
                class="w-full rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-amber-500 disabled:opacity-60 dark:bg-white dark:text-slate-900 dark:hover:bg-amber-500 dark:hover:text-white"
            >
                <span wire:loading.remove wire:target="submit">Send Message</span>
                <span wire:loading wire:target="submit">Sending...</span>
            </button>
        </form>
    @endif
</div>
