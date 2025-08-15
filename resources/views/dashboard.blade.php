<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>iFiLMS Dashboard</title>

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
      <div>
        <button onclick="toggleMenu('transcriptionsMenu')" class="flex items-center justify-between w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100 font-medium">
          <span class="flex items-center gap-2"><i data-lucide="folder-open"></i> Transcriptions</span>
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


      <!-- Others -->
      <a href="{{ route('secretary-certification.index') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100">
        <i data-lucide="badge-check"></i> Secretary's Certification
      </a>
      <a href="{{ route('referendum.index') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100">
        <i data-lucide="file-text"></i> Referendum
      </a>

      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-2 px-3 text-blue-500 mt-4">
        <i data-lucide="log-out"></i> LogOut
      </a>
      <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>

      <button class="flex items-center gap-2 px-3 text-gray-500 dark:text-gray-400"><i data-lucide="settings"></i> Settings</button>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-6">
    <!-- Topbar -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-3 text-lg font-semibold">
        <i data-lucide="layout-dashboard"></i> Dashboard
        </div>

        <div class="flex items-center gap-3">
        <!-- Search input with icon -->
        <div class="relative">
          <input type="text" placeholder="Search"
            class="pl-12 pr-4 py-1.5 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-800 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 text-sm" />

          <i data-lucide="search" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
        </div>

        <!-- Toggle Dark Mode -->
        <button id="themeToggle" class="text-gray-600 dark:text-gray-300 cursor-pointer" title="Toggle Dark Mode">
            <i data-lucide="moon" id="themeIcon"></i>
        </button>
        </div>
    </div>

    <!-- Tabs -->
    <div class="border-b mb-4 flex gap-6 text-sm">
      <button class="pb-2 border-b-2 border-black dark:border-white font-semibold">Active</button>
      <button class="pb-2 text-gray-400 dark:text-gray-500">List of All Documents</button>
    </div>

    <!-- Sample Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full border-t border-gray-200 dark:border-gray-600 text-sm">
        <thead class="bg-gray-100 dark:bg-gray-700 text-left text-gray-600 dark:text-gray-300">
          <tr>
            <th class="px-4 py-2">Document Title</th>
            <th class="px-4 py-2">File Type</th>
            <th class="px-4 py-2">Date Uploaded</th>
            <th class="px-4 py-2">Uploaded By</th>
            <th class="px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-b dark:border-gray-700">
            <td class="px-4 py-3">Minutes.pdf</td>
            <td class="px-4 py-3 font-bold">PDF</td>
            <td class="px-4 py-3">31/05/2025</td>
            <td class="px-4 py-3 font-medium">OUBS Staff</td>
            <td class="px-4 py-3 space-y-1">
              <a href="#" class="text-blue-500 hover:underline block">View</a>
              <a href="#" class="text-gray-500 hover:underline block">Download</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-4 text-sm text-gray-600 dark:text-gray-400">
      <div>
        Rows Per Page:
        <select class="border rounded px-2 py-1 ml-1 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
          <option>10</option>
          <option>25</option>
        </select>
      </div>
      <div class="flex items-center gap-2">
        <span>Page 1 of 1</span>
        <button>«</button>
        <button>‹</button>
        <button>›</button>
        <button>»</button>
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
