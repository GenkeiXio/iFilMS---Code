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

    /* === Auto Detect Animation === */
    /* Fade + slide animation for meeting type field */
    #meetingTypeWrapper {
      transition: all 0.3s ease;
    }

    .opacity-0 {
      opacity: 0 !important;
    }

    .opacity-100 {
      opacity: 1 !important;
    }

    .max-h-0 {
      max-height: 0 !important;
    }

    .max-h-40 {
      max-height: 10rem !important;
    }

    .overflow-hidden {
      overflow: hidden !important;
    }

    /* optional: glowing highlight for auto-detected section */
    .auto-highlight {
      animation: highlightFade 1.5s ease;
    }

    @keyframes highlightFade {
      0% { background-color: rgba(56,189,248,0.15); }
      100% { background-color: transparent; }
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

      <!-- Main Section -->
      <main class="flex-1 p-6">
        <!-- Topbar -->
        <div class="flex justify-between items-center mb-6">
          <div class="flex items-center gap-3 text-lg font-semibold">
            <i data-lucide="upload"></i> Upload Documents
          </div>
          <div class="flex items-center gap-3">
            <button id="themeToggle" class="text-gray-600 dark:text-gray-300 cursor-pointer" title="Toggle Dark Mode">
              <span id="themeIcon" data-lucide="moon"></span>
            </button>
          </div>
        </div>

        <!-- Upload Section -->
        <section class="space-y-6">
          <div class="border rounded-xl p-6 shadow-sm bg-white dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-lg font-semibold mb-2">File Upload</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
              Drag and drop files or click to browse. Supports PDF, DOCX, CSV, Excel, and TXT files.
            </p>

            <!-- ⚡ Form starts here -->
            <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
              @csrf

              <!-- Drag & Drop / File Picker -->
              <label for="file" 
                class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-10 text-center cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition block">
                <i data-lucide="upload-cloud" class="w-12 h-12 mx-auto text-gray-400"></i>
                <p class="mt-2 text-gray-600 dark:text-gray-300 font-medium">Upload files here</p>
                <p class="text-sm text-gray-400">or click to browse from your computer</p>
                <span class="mt-4 px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 hover:bg-blue-100 dark:hover:bg-blue-600/50 transition inline-block">
                  Choose File
                </span>
                <input type="file" id="file" name="file" class="hidden" required>
              </label>

              <!-- File Preview -->
              <div id="filePreview" class="mt-4 hidden">
                <strong class="block text-sm mb-2 text-gray-600 dark:text-gray-300">Preview:</strong>
                <div id="previewContent" class="flex items-center gap-3"></div>
              </div>

              <!-- 🔍 Auto-Detected Information Section -->
              <div id="autoDetectSection" class="hidden mt-6 border border-gray-200 dark:border-gray-700 rounded-xl p-4 bg-gray-50 dark:bg-gray-800/60 shadow-sm transition-all duration-300">
                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-100 mb-3">
                  Auto-Detected Information (Review Before Upload)
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                  <div>
                    <span class="block text-gray-500 dark:text-gray-400">Detected Category:</span>
                    <span id="autoCategory" class="font-medium text-gray-900 dark:text-gray-100">—</span>
                  </div>
                  <div>
                    <span class="block text-gray-500 dark:text-gray-400">Detected Meeting Type:</span>
                    <span id="autoMeeting" class="font-medium text-gray-900 dark:text-gray-100">—</span>
                  </div>
                  <div>
                    <span class="block text-gray-500 dark:text-gray-400">Generated Tags:</span>
                    <span id="autoTags" class="font-medium text-gray-900 dark:text-gray-100 break-words">—</span>
                  </div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">
                  *You can still edit or override these fields before uploading.
                </p>
              </div>

              <!-- Document Information -->
              <div class="border rounded-xl p-6 shadow-sm bg-white dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-lg font-semibold mb-2">Document Information</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                  Provide metadata to help organize and find this document later
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <!-- Title -->
                  <div>
                    <label class="block text-sm font-medium mb-1">Document Title *</label>
                    <input type="text" id="titleInput" name="title" placeholder="Enter document title"
                      class="w-full px-4 py-2 border rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-400 text-sm" required>
                  </div>

                  <!-- Category -->
                  <div>
                    <label class="block text-sm font-medium mb-1">Category *</label>
                    <select name="category" id="categorySelect" required
                      class="w-full px-4 py-2 border rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-400 text-sm">
                      <option value="">Select Category</option>
                      <option value="Transcriptions">Transcriptions</option>
                      <option value="Minutes">Minutes</option>
                      <option value="Excerpts">Excerpts</option>
                      <option value="Secretary's Certification">Secretary's Certification</option>
                      <option value="Referendum">Referendum</option>
                      <option value="Board Resolution">Board Resolution</option>
                    </select>
                  </div>

                  <!-- Meeting Type -->
                  <div id="meetingTypeWrapper">
                    <label class="block text-sm font-medium mb-1">Meeting Type *</label>
                    <select name="meeting_type" id="meetingTypeSelect"
                      class="w-full px-4 py-2 border rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-400 text-sm">
                      <option value="">Select Meeting Type</option>
                      <option value="Academic Council Meeting">Academic Council Meeting</option>
                      <option value="Administrative Council Meeting">Administrative Council Meeting</option>
                      <option value="Board Meeting">Board Meeting</option>
                    </select>
                  </div>
                </div>

                <!-- Tags -->
                <div>
                  <label class="block text-sm font-medium mb-1 mt-4">Tags</label>
                  <input type="text" id="tagsInput" name="tags"
                    placeholder="Enter tags separated by commas (e.g., board meeting, 2024, policy)"
                    class="w-full px-4 py-2 border rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-400 text-sm">
                </div>
              </div>

              <!-- Actions -->
              <div class="flex justify-end gap-3">
                <button type="submit" class="px-4 py-2 border rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                  Upload Document
                </button>
              </div>
            </form>
            <!-- ⚡ Form ends here -->
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

      // Replace span content each time
      const iconContainer = document.getElementById('themeIcon');
      iconContainer.innerHTML = "";
      iconContainer.setAttribute("data-lucide", isDark ? "sun" : "moon");
      lucide.createIcons();

      localStorage.theme = isDark ? 'dark' : 'light';
    });

    document.addEventListener('DOMContentLoaded', function () {
      const fileInput = document.getElementById('file');
      const titleInput = document.getElementById('titleInput');
      const categorySelect = document.getElementById('categorySelect');
      const meetingWrapper = document.getElementById('meetingTypeWrapper');
      const meetingSelect = document.getElementById('meetingTypeSelect');
      const tagsInput = document.getElementById('tagsInput');
      const filePreview = document.getElementById('filePreview');
      const previewContent = document.getElementById('previewContent');

      const autoSection = document.getElementById('autoDetectSection');
      const autoCategory = document.getElementById('autoCategory');
      const autoMeeting = document.getElementById('autoMeeting');
      const autoTags = document.getElementById('autoTags');

      // Helper: fade highlight for auto-detect area
      function animateHighlight() {
        autoSection.classList.remove('auto-highlight');
        void autoSection.offsetWidth;
        autoSection.classList.add('auto-highlight');
      }

      // ✅ Smooth show/hide for meeting type section
      function toggleMeetingWrapper(show) {
        if (show) {
          meetingWrapper.classList.remove('opacity-0', 'max-h-0', 'overflow-hidden');
          meetingWrapper.classList.add('opacity-100', 'max-h-40');
        } else {
          meetingWrapper.classList.remove('opacity-100', 'max-h-40');
          meetingWrapper.classList.add('opacity-0', 'max-h-0', 'overflow-hidden');
        }
      }

      // ✅ Manage meeting type visibility based on category
      function handleMeetingTypeVisibility(category) {
        const showDropdown = ['Transcriptions', 'Minutes'];
        const autoBoardOnly = ['Excerpts'];
        const hideAll = ["Secretary's Certification", 'Referendum', 'Board Resolution'];

        if (showDropdown.includes(category)) {
          toggleMeetingWrapper(true);
          meetingSelect.disabled = false;
          meetingSelect.value = '';
          autoMeeting.textContent = '—';
        } 
        else if (autoBoardOnly.includes(category)) {
          toggleMeetingWrapper(true);
          meetingSelect.value = 'Board Meeting';
          meetingSelect.disabled = true;
          autoMeeting.textContent = 'Board Meeting';
        } 
        else if (hideAll.includes(category)) {
          toggleMeetingWrapper(false);
          meetingSelect.value = '';
          meetingSelect.disabled = true;
          autoMeeting.textContent = '—';
        } 
        else {
          toggleMeetingWrapper(false);
          meetingSelect.value = '';
          meetingSelect.disabled = true;
          autoMeeting.textContent = '—';
        }
      }

      // === File Upload Auto-detection ===
      fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const name = file.name.split('.').slice(0, -1).join('.');
        const cleanName = name.replace(/[_-]+/g, ' ').trim();

        // Preview
        filePreview.classList.remove('hidden');
        previewContent.innerHTML = `
          <i data-lucide="file" class="w-5 h-5 text-gray-500"></i>
          <span class="text-sm text-gray-700 dark:text-gray-300">${file.name}</span>
        `;
        lucide.createIcons();

        // Auto title
        if (!titleInput.value) {
          titleInput.value = cleanName.charAt(0).toUpperCase() + cleanName.slice(1);
        }

        // Detect category & meeting type
        const lower = cleanName.toLowerCase();
        let category = "—";
        let meeting = "—";

        if (lower.includes('transcription')) category = 'Transcriptions';
        else if (lower.includes('minute')) category = 'Minutes';
        else if (lower.includes('excerpt')) category = 'Excerpts';
        else if (lower.includes('certification')) category = "Secretary's Certification";
        else if (lower.includes('referendum')) category = 'Referendum';
        else if (lower.includes('resolution')) category = 'Board Resolution';

        if (lower.includes('academic')) meeting = 'Academic Council Meeting';
        else if (lower.includes('administrative')) meeting = 'Administrative Council Meeting';
        else if (lower.includes('board')) meeting = 'Board Meeting';

        // Auto tags
        const tags = cleanName.split(/\s+/).filter(w => w.length > 2).join(', ');
        tagsInput.value = tags;

        // Display detected info
        autoSection.classList.remove('hidden');
        autoCategory.textContent = category;
        autoMeeting.textContent = meeting;
        autoTags.textContent = tags || '—';
        animateHighlight();

        // Sync dropdowns & transitions
        categorySelect.value = category;
        meetingSelect.value = meeting;
        handleMeetingTypeVisibility(category);
      });

      // === Manual Changes ===
      categorySelect.addEventListener('change', function () {
        const selectedCategory = categorySelect.value;
        autoCategory.textContent = selectedCategory || '—';
        handleMeetingTypeVisibility(selectedCategory);
        autoSection.classList.remove('hidden');
        animateHighlight();
      });

      meetingSelect.addEventListener('change', function () {
        autoMeeting.textContent = meetingSelect.value || '—';
        autoSection.classList.remove('hidden');
        animateHighlight();
      });

      tagsInput.addEventListener('input', function () {
        autoTags.textContent = tagsInput.value.trim() || '—';
        autoSection.classList.remove('hidden');
        animateHighlight();
      });
    });
  </script>   
  </body>
</html>
