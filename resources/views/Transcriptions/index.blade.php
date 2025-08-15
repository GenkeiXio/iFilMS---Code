<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Transcriptions • iFiLMS</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
    body { background: #f7f7f7; }
    .card-hover:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(0,0,0,.08); } -->

    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 border-r border-gray-200 dark:border-gray-700 bg-white dark:bg-[#181818] p-4 space-y-4">
      <!-- Logo -->
      <div class="mb-6 flex items-center space-x-2">
        <h1 class="text-[21px] font-extrabold uppercase tracking-wide">
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

    <main class="flex-1 p-6"> 
      <!-- Topbar -->
      <div class="flex justify-between items-center mb-6">
          <div class="flex items-center gap-3 text-lg font-semibold">
          <i data-lucide="layout-dashboard"></i> Dashboard / Transcriptions Folder
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
        <button class="pb-2 text-gray-400 dark:text-gray-500">List of All Transcriptions Folders</button>
      </div>

      <div class="container py-5">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h3 class="m-0">Transcriptions</h3>
          <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div>

        <div class="row g-4">
          <div class="col-md-4">
            <a href="{{ route('transcriptions.list', 'academic-council') }}" class="text-decoration-none">
              <div class="card card-hover h-100">
                <div class="card-body">
                  <h5 class="card-title">Academic Council Meetings</h5>
                  <p class="card-text text-muted">View and upload transcripts for Academic Council.</p>
                  <span class="btn btn-primary">Open</span>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-4">
            <a href="{{ route('transcriptions.list', 'administrative-council') }}" class="text-decoration-none">
              <div class="card card-hover h-100">
                <div class="card-body">
                  <h5 class="card-title">Administrative Council Meetings</h5>
                  <p class="card-text text-muted">View and upload transcripts for Administrative Council.</p>
                  <span class="btn btn-primary">Open</span>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-4">
            <a href="{{ route('transcriptions.list', 'board-meetings') }}" class="text-decoration-none">
              <div class="card card-hover h-100">
                <div class="card-body">
                  <h5 class="card-title">Board Meetings</h5>
                  <p class="card-text text-muted">View and upload transcripts for Board Meetings.</p>
                  <span class="btn btn-primary">Open</span>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

</html>
