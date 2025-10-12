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
            <i data-lucide="layout-dashboard"></i> Dashboard
          </div>

          <div class="flex items-center gap-3">
            

            <!-- Toggle Dark Mode -->
            <button id="themeToggle" class="text-gray-600 dark:text-gray-300 cursor-pointer" title="Toggle Dark Mode">
              <span id="themeIcon" data-lucide="moon"></span>
            </button>
          </div>
        </div>

        <!-- Welcome -->
        <p class="text-gray-500 dark:text-gray-400 mb-6">
          Welcome to the iFiLMS File Management System
        </p>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
          <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow">
            <div class="flex justify-between items-center">
              <p class="text-gray-500 text-sm">Total Documents</p>
              <i data-lucide="file-text" class="text-gray-400 w-5 h-5"></i>
            </div>
            <h2 class="text-2xl font-bold">{{ $totalDocuments }}</h2>
            <p class="text-green-600 text-xs font-medium">{{ $thisMonth }} added this month</p>
          </div>

          <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow">
            <div class="flex justify-between items-center">
              <p class="text-gray-500 text-sm">This Month</p>
              <i data-lucide="calendar" class="text-gray-400 w-5 h-5"></i>
            </div>
            <h2 class="text-2xl font-bold">{{ $thisMonth }}</h2>
            <p class="text-green-600 text-xs font-medium">Uploaded this month</p>
          </div>

          <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow">
            <div class="flex justify-between items-center">
              <p class="text-gray-500 text-sm">Categories</p>
              <i data-lucide="folder" class="text-gray-400 w-5 h-5"></i>
            </div>
            <h2 class="text-2xl font-bold">{{ $categories }}</h2>
            <p class="text-green-500 text-xs font-medium">Total categories</p>
          </div>

          <div class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow">
            <div class="flex justify-between items-center">
              <p class="text-gray-500 text-sm">Active Users</p>
              <i data-lucide="users" class="text-gray-400 w-5 h-5"></i>
            </div>
            <h2 class="text-2xl font-bold">{{ $activeUsers }}</h2>
            <p class="text-green-600 text-xs font-medium">Active in last 30 days</p>
          </div>
        </div>

        <!-- Two-column layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          
        <!-- Quick Actions -->
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
            <h3 class="font-semibold mb-4">Quick Actions</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Common tasks and shortcuts</p>
            <ul class="space-y-3">
              
              <!-- Upload Document -->
              <li>
                <a href="{{ route('mainsidebar.upload') }}"
                  class="flex items-center gap-3 p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-gray-700 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-blue-800/40 transition">
                  <i data-lucide="upload" class="w-5 h-5"></i>
                  <div>
                    <p class="font-medium">Upload Document</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Add new documents</p>
                  </div>
                </a>
              </li>

              <!-- Search Documents -->
              <li>
                <a href="{{ route('mainsidebar.documents') }}"
                  class="flex items-center gap-3 p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-gray-700 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-blue-800/40 transition">
                  <i data-lucide="search" class="w-5 h-5"></i>
                  <div>
                    <p class="font-medium">Search Documents</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Find documents quickly</p>
                  </div>
                </a>
              </li>

              <!-- View Categories -->
              <li>
                <a href="{{ route('mainsidebar.categories') }}"
                  class="flex items-center gap-3 p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-gray-700 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-blue-800/40 transition">
                  <i data-lucide="folder-open" class="w-5 h-5"></i>
                  <div>
                    <p class="font-medium">View Categories</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Browse by document type</p>
                  </div>
                </a>
              </li>

            </ul>
          </div>

          <!-- Recent Activity -->
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">
            <h3 class="font-semibold mb-4">Recent Activity</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Latest document actions</p>

            @if($recentActivity->isEmpty())
                <div class="flex items-center justify-center h-32 text-gray-400 dark:text-gray-500 text-sm italic">
                    No activities yet
                </div>
            @else
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($recentActivity as $activity)
                        @php
                            $uploadDate = \Carbon\Carbon::parse($activity->upload_date)->timezone(config('app.timezone'));
                            $isNew = $uploadDate->greaterThanOrEqualTo(now()->subDay()); // uploaded within last 24h
                        @endphp

                        <li class="py-2 text-sm flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <span>{{ $activity->title ?? 'Untitled Document' }}</span>
                                @if($isNew)
                                    <span class="ml-2 px-2 py-0.5 text-xs font-semibold text-white bg-green-500 rounded-full">
                                        NEW
                                    </span>
                                @endif
                            </div>

                            <span 
                                class="time-ago text-gray-500 dark:text-gray-400"
                                data-time="{{ $uploadDate->toIso8601String() }}"
                                title="{{ $uploadDate->format('M j, Y • g:i A') }}"
                            >
                                {{ $uploadDate->diffForHumans() }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
          </div>
        </div>
      </main>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 text-xs text-gray-400 dark:text-gray-500">
      © 2025 Bicol University Board of Regents • All rights reserved.
    </footer>


  <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/dayjs@1/plugin/relativeTime.js"></script>  
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

    dayjs.extend(dayjs_plugin_relativeTime);

    function refreshTimes() {
        document.querySelectorAll('.time-ago').forEach(function(el) {
            const timestamp = el.getAttribute('data-time');
            if (timestamp) {
                el.textContent = dayjs(timestamp).fromNow();
            }
        });
    }

    // Run immediately and then every 60s
    refreshTimes();
    setInterval(refreshTimes, 60000);
  </script>
  </body>
</html>
