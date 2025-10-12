<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>iFiLMS Documents</title>

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
            <i data-lucide="file-text"></i> All Documents
          </div>
          <div class="flex items-center gap-3">
            <button id="themeToggle" class="text-gray-600 dark:text-gray-300 cursor-pointer" title="Toggle Dark Mode">
              <span id="themeIcon" data-lucide="moon"></span>
            </button>
          </div>
        </div>

        <!-- Filters and Search -->
        <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-900 mb-6 shadow-sm">
          <form method="GET" class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            
            <!-- Search Input -->
            <div class="relative w-full sm:w-1/2">
              <input 
                type="text" 
                name="search"
                value="{{ request('search') }}"
                placeholder="Search documents by title or tags..." 
                class="pl-10 pr-4 py-2 w-full border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-400 dark:bg-gray-800 dark:text-white text-sm">
              <i data-lucide="search" class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>

            <!-- Filters -->
            <div class="flex gap-2">
              <select name="category" onchange="this.form.submit()" 
                class="px-2 py-2 border border-gray-300 dark:border-gray-600 rounded-xl dark:bg-gray-800 dark:text-white text-sm">
                <option value="all">All Categories</option>
                <option value="Transcriptions" {{ request('category')=='Transcriptions' ? 'selected' : '' }}>Transcriptions</option>
                <option value="Minutes" {{ request('category')=='Minutes' ? 'selected' : '' }}>Minutes</option>
                <option value="Excerpts" {{ request('category')=='Excerpts' ? 'selected' : '' }}>Excerpts</option>
                <option value="Secretary's Certification" {{ request('category')=="Secretary's Certification" ? 'selected' : '' }}>Secretary's Certification</option>
                <option value="Referendum" {{ request('category')=='Referendum' ? 'selected' : '' }}>Referendum</option>
                <option value="Board Resolution" {{ request('category')=='Board Resolution' ? 'selected' : '' }}>Board Resolution</option>
              </select>

              <select name="meeting_type" onchange="this.form.submit()" 
                class="px-1 py-2 border border-gray-300 dark:border-gray-600 rounded-xl dark:bg-gray-800 dark:text-white text-sm">
                <option value="all">Meeting Type</option>
                <option value="Academic Council Meeting" {{ request('meeting_type')=='Academic Council Meeting' ? 'selected' : '' }}>Academic Council Meeting</option>
                <option value="Administrative Council Meeting" {{ request('meeting_type')=='Administrative Council Meeting' ? 'selected' : '' }}>Administrative Council Meeting</option>
                <option value="Board Meeting" {{ request('meeting_type')=='Board Meeting' ? 'selected' : '' }}>Board Meeting</option>
              </select>

              <select name="sort" onchange="this.form.submit()" 
                class="px-1 py-2 border border-gray-300 dark:border-gray-600 rounded-xl dark:bg-gray-800 dark:text-white text-sm">
                <option value="date" {{ request('sort')=='date' ? 'selected' : '' }}>Sort by Date</option>
                <option value="name" {{ request('sort')=='name' ? 'selected' : '' }}>Sort by Name</option>
              </select>
            </div>
          </form>
        </div>

        <!-- Results Table -->
        <div class="border border-gray-200 dark:border-gray-700 rounded-2xl bg-white dark:bg-gray-900 shadow-sm">
          <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 uppercase text-xs font-semibold">
              <tr>
                <th class="px-6 py-3 text-left">Document Title</th>
                <th class="px-6 py-3 text-left">Category</th>
                <th class="px-6 py-3 text-left">Meeting Type</th>
                <th class="px-6 py-3 text-left">File Type</th>
                <th class="px-6 py-3 text-left">Date Uploaded</th>
                <th class="px-6 py-3 text-left">Uploaded By</th>
                <th class="px-6 py-3 text-center">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              @forelse ($documents as $document)
                <tr>
                  <td class="px-6 py-3">{{ $document->title }}</td>
                  <td class="px-6 py-3">{{ $document->category }}</td>
                  <td class="px-6 py-3">{{ $document->meeting_type ?? '—' }}</td>
                  <td class="px-6 py-3 uppercase">{{ $document->file_type }}</td>
                  <td class="px-6 py-3">{{ $document->upload_date }}</td>
                  <td class="px-6 py-3">{{ $document->staff->name ?? 'Unknown' }}</td>
                  <td class="px-6 py-3 text-center flex justify-center gap-2">
                    <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                      class="px-3 py-1 border rounded-lg bg-blue-500 text-white hover:bg-blue-600">View</a>
                    <a href="{{ asset('storage/' . $document->file_path) }}" download
                      class="px-3 py-1 border rounded-lg bg-green-500 text-white hover:bg-green-600">Download</a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400 italic">
                    No documents yet
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-4 text-sm text-gray-600 dark:text-gray-400">
          <div>
            Rows Per Page 
            <form method="GET" class="inline">
              <input type="hidden" name="search" value="{{ request('search') }}">
              <input type="hidden" name="category" value="{{ request('category') }}">
              <input type="hidden" name="meeting_type" value="{{ request('meeting_type') }}">
              <input type="hidden" name="sort" value="{{ request('sort') }}">
              <select name="per_page" onchange="this.form.submit()"
                class="ml-2 px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-800 dark:text-white">
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
              </select>
            </form>
          </div>
          <div class="flex items-center gap-2">
            {{ $documents->appends(request()->query())->links() }}
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
