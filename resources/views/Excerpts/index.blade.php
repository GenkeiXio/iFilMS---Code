<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>iFiLMS Excerpts</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
    }
  </script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- Inter Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
  <body class="bg-white dark:bg-[#1a1a1a] text-gray-700 dark:text-gray-200 transition-colors duration-300">

    <div class="flex min-h-screen">

      <!-- Sidebar -->
      <aside class="w-64 border-r border-gray-200 dark:border-gray-700 bg-white dark:bg-[#181818] p-4 space-y-4">
        <!-- Logo -->
        <div class="mb-6 flex items-center space-x-2">
          <h1 class="text-[22px] font-extrabold uppercase tracking-wide">
            <span class="text-blue-500">BICOL</span> <span class="text-orange-500">UNIVERSITY</span>
          </h1>
        </div>

        <!-- Sidebar menu -->
        <nav class="space-y-2 text-sm">
          <div class="text-gray-400 font-semibold dark:text-gray-500">Dashboard</div>

          <!-- Collapsible Sections (Transcriptions, Minutes) -->
          <a href="{{ url('/dashboard') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100 hover:bg-blue-100 dark:hover:bg-blue-800/40 transition">
              <i data-lucide="house"></i> Dashboard
          </a>

          <a href="{{ route('mainsidebar.upload') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100 hover:bg-blue-100 dark:hover:bg-blue-800/40 transition">
              <i data-lucide="upload"></i> Upload
          </a>

          <a href="{{ route('mainsidebar.documents') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100 hover:bg-blue-100 dark:hover:bg-blue-800/40 transition">
              <i data-lucide="file-text"></i> Documents
          </a>

          <a href="{{ route('mainsidebar.categories') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100 hover:bg-blue-100 dark:hover:bg-blue-800/40 transition">
            <i data-lucide="folder-open"></i> Categories
          </a>

          <hr class="my-3">

          <a href="{{ route('transcriptions.index') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100">
            <i data-lucide="captions"></i> Transcriptions
          </a>

          <a href="{{ route('minutes.index') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100">
            <i data-lucide="clock"></i> Minutes
          </a>

          <a href="{{ route('excerpts.index') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100">
            <i data-lucide="book-open-text"></i> Excerpts
          </a>

          <a href="{{ route('secretary-certification.index') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100">
            <i data-lucide="badge-check"></i> Secretary's Certification
          </a>

          <a href="{{ route('referendum.index') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100">
            <i data-lucide="file-text"></i> Referendum
          </a>

          <a href="{{ route('board-resolution.index') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100">
            <i data-lucide="file-text"></i> Board Resolution
          </a>

          <hr class="my-3">

          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-2 px-3 text-gray-700 dark:text-gray-100">
            <i data-lucide="log-out"></i> LogOut
          </a>
          <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
        </nav>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-6">
        <!-- Topbar -->
        <div class="flex justify-between items-center mb-6">
          <div class="flex items-center gap-3 text-lg font-semibold">
            <i data-lucide="book-open-text"></i> Excerpts
          </div>
          <div>
            <button id="themeToggle" class="text-gray-600 dark:text-gray-300 cursor-pointer" title="Toggle Dark Mode">
              <span id="themeIcon" data-lucide="moon"></span>
            </button>
          </div>
        </div>

        <!-- Category Overview -->
        <div class="p-6 border rounded-xl bg-white dark:bg-gray-900 shadow-sm mb-6">
          <h2 class="text-lg font-semibold mb-2 flex items-center gap-2">
            <i data-lucide="bar-chart-3"></i> Excerpts Overview
          </h2>
          <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Document distribution across Excerpts folder</p>
          <div class="flex justify-center text-center">
            <div>
              <p class="text-2xl font-bold text-pink-500">{{ $boardCount }}</p>
              <p class="text-sm">Board Meeting</p>
            </div>
          </div>
        </div>

        <!-- Category Card -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div class="p-4 border rounded-xl bg-white dark:bg-gray-900 shadow-sm">
            <div class="flex justify-between mb-2">
              <h3 class="font-semibold">Board Meeting</h3>
              <span class="text-xs text-gray-500">{{ $boardCount }} documents</span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Board Meeting excerpts</p>
            <p class="text-xs mb-1">Last upload:
              <span class="font-medium">{{ $lastUpload }}</span>
            </p>
            <p class="text-xs mb-3">Status:
              <span class="{{ $status === 'Active' ? 'text-green-500' : 'text-red-500' }} font-medium">
                {{ $status }}
              </span>
            </p>
            <div class="flex gap-2">
              <a href="{{ route('excerpts.list') }}" 
                class="flex-1 px-3 py-2 text-sm rounded-lg text-center border hover:bg-gray-100 dark:hover:bg-gray-800">
                Browse
              </a>
              <button class="flex-1 px-3 py-2 text-sm rounded-lg bg-blue-500 text-white hover:bg-blue-600">Upload</button>
            </div>
          </div>
        </div>
      </main>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 text-xs text-gray-400 dark:text-gray-500">
      © 2025 Bicol University Board of Regents • All rights reserved.
    </footer>

  <!-- Scripts -->
  <script>
    // Lucide Icons
    lucide.createIcons();

    // Collapsible Menus
    function toggleMenu(id) {
      const menu = document.getElementById(id);
      const chevron = document.querySelector(`#${id.replace("Menu", "Chevron")}`);
      menu.classList.toggle('hidden');
      chevron.classList.toggle('rotate-180');
    }

    // Theme Toggle
    const toggle = document.getElementById('themeToggle');
    const icon = document.getElementById('themeIcon');
    const html = document.documentElement;

    // Load saved mode
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      html.classList.add('dark');
      icon.setAttribute("data-lucide", "sun");
    } else {
      icon.setAttribute("data-lucide", "moon");
    }
    lucide.createIcons();

    // Toggle theme
    toggle.addEventListener('click', () => {
      html.classList.toggle('dark');
      const isDark = html.classList.contains('dark');

      // Replace span content each time
      const iconContainer = document.getElementById('themeIcon');
      iconContainer.innerHTML = "";
      iconContainer.setAttribute("data-lucide", isDark ? "sun" : "moon");
      lucide.createIcons();

      localStorage.theme = isDark ? 'dark' : 'light';
    });
  </script>
  </body>
</html>
