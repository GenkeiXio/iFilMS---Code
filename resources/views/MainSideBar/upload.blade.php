<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>iFiLMS Upload</title>

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
            <i data-lucide="upload"></i> Upload Documents
          </div>
          <div class="flex items-center gap-3">
            <button id="themeToggle" class="text-gray-600 dark:text-gray-300 cursor-pointer" title="Toggle Dark Mode">
              <i data-lucide="moon" id="themeIcon"></i>
            </button>
          </div>
        </div>

        <!-- Upload Section -->
        <section class="space-y-6">
          <!-- File Upload -->
          <div class="border rounded-xl p-6 shadow-sm bg-white dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-lg font-semibold mb-2">File Upload</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
              Drag and drop files or click to browse. Supports PDF, DOCX, CSV, Excel, and TXT files.
            </p>
            <div
              class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-10 text-center cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition"
            >
              <i data-lucide="upload-cloud" class="w-12 h-12 mx-auto text-gray-400"></i>
              <p class="mt-2 text-gray-600 dark:text-gray-300 font-medium">Drop files here</p>
              <p class="text-sm text-gray-400">or click to browse from your computer</p>
              <button class="mt-4 px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 hover:bg-blue-100 dark:hover:bg-blue-600/50 transition">
                Choose Files
              </button>
            </div>
          </div>

          <!-- Document Information -->
          <div class="border rounded-xl p-6 shadow-sm bg-white dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-lg font-semibold mb-2">Document Information</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
              Provide metadata to help organize and find this document later
            </p>

            <form class="space-y-5">
              <!-- Title + Category -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium mb-1">Document Title *</label>
                  <input type="text" placeholder="Enter document title"
                    class="w-full px-4 py-2 border rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-400 text-sm">
                </div>
                <div>
                  <label class="block text-sm font-medium mb-1">Category *</label>
                  <select class="w-full px-4 py-2 border rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-400 text-sm">
                    <option>All Categories</option>
                    <option>Transcriptions</option>
                    <option>Minutes</option>
                    <option>Excerpts</option>
                    <option>Secretary's Certification</option>
                    <option>Referendum</option>
                    <option>Board Resolution</option>
                  </select>
                </div>
                <div>
                  <label class="block text-sm font-medium mb-1">Meeting Type *</label>
                  <select class="w-full px-4 py-2 border rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-400 text-sm">
                    <option>Meeting Type</option>
                    <option>Academic Council Meeting</option>
                    <option>Administrative Council Meeting</option>
                    <option>Board Meeting</option>
                  </select>
                </div>
              </div>

              <!-- Tags -->
              <div>
                <label class="block text-sm font-medium mb-1">Tags</label>
                <input type="text" placeholder="Enter tags separated by commas (e.g., board meeting, 2024, policy)"
                  class="w-full px-4 py-2 border rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-400 text-sm">
              </div>

              <!-- Actions -->
              <div class="flex justify-end gap-3">
                <button type="submit" class="px-4 py-2 border rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                  Upload Documents
                </button>
              </div>
            </form>
          </div>
        </section>
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
