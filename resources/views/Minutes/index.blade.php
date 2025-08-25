<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>iFiLMS Minutes</title>

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

          <div>
            <button onclick="toggleMenu('transcriptionsMenu')" class="flex items-center justify-between w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100 font-medium">
                <span class="flex items-center gap-2"><i data-lucide="captions"></i> Transcriptions</span>
                <i data-lucide="chevron-down" class="transition-all duration-300" id="transcriptionsChevron"></i>
            </button>
            <ul id="transcriptionsMenu" class="ml-6 mt-2 space-y-1 hidden text-gray-600 dark:text-gray-400">
                <li><a href="{{ route('transcriptions.list', 'academic-council') }}" class="hover:underline">Academic Council</a></li>
                <li><a href="{{ route('transcriptions.list', 'administrative-council') }}" class="hover:underline">Administrative Council</a></li>
                <li><a href="{{ route('transcriptions.list', 'board-meetings') }}" class="hover:underline">Board Meetings</a></li>
            </ul>
          </div>

          <div>
            <button onclick="toggleMenu('minutesMenu')" class="flex items-center justify-between w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100 font-medium">
                <span class="flex items-center gap-2"><i data-lucide="clock"></i> Meeting Minutes</span>
                <i data-lucide="chevron-down" class="transition-all duration-300" id="minutesChevron"></i>
            </button>
            <ul id="minutesMenu" class="ml-6 mt-2 space-y-1 hidden text-gray-600 dark:text-gray-400">
                <li><a href="{{ route('minutes.list', 'academic-council') }}" class="hover:underline">Academic Council</a></li>
                <li><a href="{{ route('minutes.list', 'administrative-council') }}" class="hover:underline">Administrative Council</a></li>
                <li><a href="{{ route('minutes.list', 'board-meetings') }}" class="hover:underline">Board Meetings</a></li>
            </ul>
          </div>

          <div>
            <button onclick="toggleMenu('excerptsMenu')" 
                class="flex items-center justify-between w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100 font-medium">
                <span class="flex items-center gap-2"><i data-lucide="book-open-text"></i> Excerpts</span>
                <i data-lucide="chevron-down" class="transition-all duration-300" id="excerptsChevron"></i>
            </button>
            <ul id="excerptsMenu" class="ml-6 mt-2 space-y-1 hidden text-gray-600 dark:text-gray-400">
                <li><a href="{{ route('excerpts.board') }}" class="hover:underline">Board Meetings</a></li>
            </ul>
          </div>

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
            <i data-lucide="clock"></i> Minutes of the Meeting
          </div>

          <div class="flex items-center gap-3">
            <!-- Toggle Dark Mode -->
            <button id="themeToggle" class="text-gray-600 dark:text-gray-300 cursor-pointer" title="Toggle Dark Mode">
              <i data-lucide="moon" id="themeIcon"></i>
            </button>
          </div>
        </div>
        <!-- Category Overview -->
        <div class="p-6 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-900 shadow-sm mb-6">
          <h2 class="text-lg font-semibold mb-2 flex items-center gap-2">
            <i data-lucide="bar-chart-3" class="w-5 h-5"></i> Minutes of the Meeting Overview
          </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Document distribution across all Minutes Folders</p>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
            <div>
              <p class="text-2xl font-bold text-blue-500">0</p>
              <p class="text-sm">Academic Council Meeting</p>
            </div>
            <div>
              <p class="text-2xl font-bold text-green-500">0</p>
              <p class="text-sm">Administrative Council Meeting</p>
            </div>
            <div>
              <p class="text-2xl font-bold text-pink-500">0</p>
              <p class="text-sm">Board Meeting</p>
            </div>
          </div>
        </div>

        <!-- Category Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

          <!-- Academic Council Meeting -->
          <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-900 shadow-sm">
            <div class="flex items-center justify-between mb-2">
              <h3 class="font-semibold">Academic Council Meetings</h3>
              <span class="text-xs text-gray-500">0 documents</span>
            </div>
              <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Academic Council Minutes of the Meeting</p>
              <p class="text-xs mb-1">Last upload: <span class="font-medium">—</span></p>
              <p class="text-xs mb-3">Status: <span class="text-green-500 font-medium">Active</span></p>
            <div class="flex gap-2">
              <a href="{{ route('minutes.list', 'academic-council') }}" 
                class="flex-1 px-3 py-2 text-sm rounded-lg text-center border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800">
                Browse
              </a>
              <button class="flex-1 px-3 py-2 text-sm rounded-lg bg-blue-500 text-white hover:bg-blue-600">Upload</button>
            </div>
          </div>

          <!-- Administrative Council Meeting -->
          <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-900 shadow-sm">
            <div class="flex items-center justify-between mb-2">
              <h3 class="font-semibold">Administrative Council Meeting</h3>
              <span class="text-xs text-gray-500">0 documents</span>
            </div>
              <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Administrative Council Minutes of the Meeting</p>
              <p class="text-xs mb-1">Last upload: <span class="font-medium">—</span></p>
              <p class="text-xs mb-3">Status: <span class="text-green-500 font-medium">Active</span></p>
            <div class="flex gap-2">
              <a href="{{ route('minutes.list', 'administrative-council') }}" 
                class="flex-1 px-3 py-2 text-sm rounded-lg text-center border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800">
                Browse
              </a>
              <button class="flex-1 px-3 py-2 text-sm rounded-lg bg-blue-500 text-white hover:bg-blue-600">Upload</button>
            </div>
          </div>

          <!-- Board Meeting -->
          <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-900 shadow-sm">
            <div class="flex items-center justify-between mb-2">
              <h3 class="font-semibold">Board Meeting</h3>
              <span class="text-xs text-gray-500">0 documents</span>
            </div>
              <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Minutes of the Board Meeting</p>
              <p class="text-xs mb-1">Last upload: <span class="font-medium">—</span></p>
              <p class="text-xs mb-3">Status: <span class="text-green-500 font-medium">Active</span></p>
            <div class="flex gap-2">
              <a href="{{ route('minutes.list', 'board-meetings') }}" 
                class="flex-1 px-3 py-2 text-sm rounded-lg text-center border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800">
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
      icon.setAttribute("data-lucide", isDark ? "sun" : "moon");
      lucide.createIcons();
      localStorage.theme = isDark ? 'dark' : 'light';
    });
  </script>
  </body>
</html>
