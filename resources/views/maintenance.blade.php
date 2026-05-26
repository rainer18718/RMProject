<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-b from-white to-zinc-100 font-[Inter,Poppins,system-ui,sans-serif] text-zinc-900">
    <main class="flex min-h-screen items-center justify-center px-4 py-8">
        <section class="w-full max-w-md rounded-2xl border border-zinc-200 bg-zinc-100 p-6 shadow-lg shadow-black/5 sm:p-8">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-yellow-100 text-zinc-900 ring-1 ring-yellow-200">
                <svg viewBox="0 0 24 24" fill="none" class="h-7 w-7" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.7 6.3a4.5 4.5 0 0 0-5.9 5.9L4 17l3 3 4.8-4.8a4.5 4.5 0 0 0 5.9-5.9l-3.2 3.2-3-3 3.2-3.2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="mt-5 text-center">
                <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-yellow-500">Maintenance Mode</p>
                <h1 class="mt-3 text-3xl font-semibold tracking-tight text-zinc-950 sm:text-4xl">We'll be back soon</h1>
            </div>

            <div class="mt-6 rounded-2xl border border-zinc-200 bg-white/70 p-4 sm:p-5">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-zinc-900">Updating system...</p>
                        <p class="mt-1 text-sm text-zinc-600">Estimated time: 15 to 30 minutes</p>
                    </div>
                    <span class="mt-0.5 h-5 w-5 animate-spin rounded-full border-2 border-yellow-300 border-t-zinc-900"></span>
                </div>

                <div class="mt-4 h-2 overflow-hidden rounded-full bg-zinc-300">
                    <div class="h-full w-2/3 rounded-full bg-yellow-500"></div>
                </div>
            </div>

            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                <button type="button" onclick="window.location.reload()" class="inline-flex min-h-11 flex-1 items-center justify-center rounded-xl bg-zinc-950 px-5 text-sm font-medium text-white transition duration-200 hover:bg-yellow-500 hover:text-zinc-950 hover:shadow-md hover:shadow-yellow-300/40">
                    Refresh
                </button>
                <a href="/" class="inline-flex min-h-11 flex-1 items-center justify-center rounded-xl border border-yellow-300 bg-zinc-100 px-5 text-sm font-medium text-zinc-900 transition duration-200 hover:bg-yellow-50 hover:border-yellow-400">
                    Go Back
                </a>
            </div>

            <p class="mt-5 text-center text-sm text-zinc-500">Thank you for your patience.</p>
        </section>
    </main>
</body>
</html>
