<!DOCTYPE html>
<html lang="en" class="transition-colors duration-300">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>iFiLMS Upload</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
    }
  </script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      cursor: default !important;  /* Forces arrow pointer everywhere */
      user-select: none;  /* Blocks text selection/editing on non-inputs */
    }
    input, textarea {
      cursor: text !important;  /* Keeps I-beam in text fields */
      user-select: text;  /* Allows selection in inputs */
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
    input, select {
      transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }
    input, textarea {
      cursor: text !important;  /* Keeps I-beam in text fields */
      user-select: text;  /* Allows selection in inputs */
    }
    /* 🔴 Red for empty fields */
    .field-error {
      border-color: #ef4444 !important; /* red */
      box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
    }

    .field-valid {
      border-color: #3b82f6 !important; /* blue */
      box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }

    #uploadingModal {
      animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    /* ✅ Bounce animation for checkmark */
    @keyframes bounceIn {
      0% { transform: scale(0.3); opacity: 0; }
      50% { transform: scale(1.1); opacity: 1; }
      70% { transform: scale(0.9); }
      100% { transform: scale(1); }
    }
    .bounce-check {
      animation: bounceIn 0.6s ease-out forwards;
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

          @auth('staff')
            @if(Auth::guard('staff')->user()->isAdmin())
              <a href="{{ route('mainsidebar.recycle-bin') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100 hover:bg-blue-100 dark:hover:bg-blue-800/40 transition">
                <i data-lucide="recycle"></i> Recycle Bin
              </a>
            @endif
          @endauth

          @auth('staff')
            @if(Auth::guard('staff')->user()->isAdmin())
              <a href="{{ route('admin.users') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100 hover:bg-blue-100 dark:hover:bg-blue-800/40 transition">
                <i data-lucide="users"></i> User Management
              </a>
            @endif
          @endauth

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
              Click the Choose File to browse and Upload Files. Supports PDF, DOCX, CSV, Excel, and TXT files.
            </p>

            <!--Form starts here -->
            <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
              @csrf

              <!-- Drag & Drop / File Picker -->
              <label for="file" 
                class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-10 text-center cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition block">
                <i data-lucide="upload-cloud" class="w-12 h-12 mx-auto text-gray-400"></i>
                <p class="mt-2 text-gray-600 dark:text-gray-300 font-medium">Upload files here</p>
                <p class="text-sm text-gray-400">Click to browse from your computer</p>
                <span class="mt-4 px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200 hover:bg-blue-100 dark:hover:bg-blue-600/50 transition inline-block">
                  Choose File
                </span>
                <input type="file" id="file" name="file" class="hidden" required>
              </label>

              <!-- File Preview -->
              <div id="filePreview" class="mt-4 hidden">
                <strong class="block text-sm mb-2 text-gray-600 dark:text-gray-300">Preview:</strong>
                <div id="previewContent"
                  class="flex items-center justify-between gap-3 p-3 border rounded-xl bg-blue-50 dark:bg-blue-900/30 border-blue-300 dark:border-blue-600 transition-all duration-300">
                  <div id="previewFileName" class="text-blue-800 dark:text-blue-100 font-medium truncate"></div>
                </div>
              </div>

              <!--Auto-Detected Information Section -->
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
              <div id="documentInfoSection" class="hidden border rounded-xl p-6 shadow-sm bg-white dark:bg-gray-800 dark:border-gray-700 transition-all duration-300">
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
                    <select name="meeting_type" id="meetingTypeSelect" required class="w-full px-4 py-2 border rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-400 text-sm">
                      <option value="">Select Meeting Type</option>
                      <option value="Academic Council Meeting">Academic Council Meeting</option>
                      <option value="Administrative Council Meeting">Administrative Council Meeting</option>
                      <option value="Board Meeting">Board Meeting</option>
                    </select>
                  </div>
                </div>

                <!-- Tags -->
                <div>
                  <label class="block text-sm font-medium mb-1 mt-4">Tags *</label>
                  <input type="text" id="tagsInput" name="tags" required placeholder="Enter tags separated by commas (e.g., board meeting, 2024, policy)" class="w-full px-4 py-2 border rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-400 text-sm">
                </div>
              </div>

              <!-- Actions -->
              <div class="flex justify-end gap-3 mt-4">
                @if(auth('staff')->user()->hasPermission('upload'))
                <button type="submit" class="px-4 py-2 border rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                    Upload Document
                </button>
                @endif
              </div>
            </form>
          </div>
        </section>

        <!-- Uploading Modal -->
        <div id="uploadingModal" class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden z-50">
          <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-2xl text-center w-80 transform scale-95 opacity-0 transition-all duration-300" id="uploadingContent">
            
            <!-- Uploading State -->
            <div id="uploadingState" class="flex flex-col items-center">
              <svg class="animate-spin h-10 w-10 text-blue-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
              </svg>
              <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Uploading...</h2>
              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-4">Please wait while we save your document.</p>

              <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                <div id="uploadProgressBar" class="bg-blue-600 h-2.5 w-0 transition-all duration-300"></div>
              </div>
              <p id="uploadProgressText" class="text-xs text-gray-500 dark:text-gray-400 mt-2">0%</p>
            </div>

            <!-- Success State -->
            <div id="successState" class="hidden flex flex-col items-center">
              <svg class="h-12 w-12 text-green-500 mb-4 bounce-check" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
              </svg>
              <h2 class="text-lg font-semibold text-green-600 dark:text-green-400">Upload Complete!</h2>
              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Redirecting...</p>
            </div>
          </div>
        </div>
      </main>
    </div>

    @if(isset($noUploadPermission) && $noUploadPermission)
    <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 w-96 text-center shadow-xl">
            <i data-lucide="lock" class="mx-auto w-12 h-12 text-red-500 mb-4"></i>

            <h2 class="text-lg font-semibold mb-2">
                Upload Restricted
            </h2>

            <p class="text-sm text-gray-500 mb-6">
                You do not have permission to upload documents.
                Please contact an administrator.
            </p>

            <a href="{{ route('dashboard') }}"
              class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                Go Back
            </a>
        </div>
    </div>
    @endif

    <!-- Footer -->
    <footer class="text-center py-4 text-xs text-gray-400 dark:text-gray-500">
      © 2025 Bicol University Board of Regents • All rights reserved.
    </footer>
    
  <script src="https://unpkg.com/lucide@latest"></script>
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
        const documentInfoSection = document.getElementById('documentInfoSection');
        const previewFileName = document.getElementById('previewFileName');
        const removeFileBtn = document.getElementById('removeFileBtn');

        // Helper: fade highlight for auto-detect area
        function animateHighlight() {
          autoSection.classList.remove('auto-highlight');
          void autoSection.offsetWidth;
          autoSection.classList.add('auto-highlight');
        }

        //Smooth show/hide for meeting type section
        function toggleMeetingWrapper(show) {
          if (show) {
            meetingWrapper.classList.remove('opacity-0', 'max-h-0', 'overflow-hidden');
            meetingWrapper.classList.add('opacity-100', 'max-h-40');
          } else {
            meetingWrapper.classList.remove('opacity-100', 'max-h-40');
            meetingWrapper.classList.add('opacity-0', 'max-h-0', 'overflow-hidden');
          }
        }

        //Manage meeting type visibility based on category
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

        // File Upload Auto-detection
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
          let category = "";
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

          // Apply values safely
          categorySelect.value = category && category !== "—" ? category : "";
          meetingSelect.value = meeting && meeting !== "—" ? meeting : "";

          // Auto tags
          const tags = cleanName.split(/\s+/).filter(w => w.length > 2).join(', ');
          tagsInput.value = tags;

          // Display detected info in Auto-Detected section
          autoSection.classList.remove('hidden');
          autoCategory.textContent = category || '—'; // shows "—" if not detected
          autoMeeting.textContent = meeting;
          autoTags.textContent = tags || '—';
          animateHighlight();

          // Sync dropdowns & transitions
          categorySelect.value = category && category !== "—" ? category : "";
          meetingSelect.value = meeting && meeting !== "—" ? meeting : "";
          handleMeetingTypeVisibility(category);

          //Highlight Category dropdown if manual selection is needed
          if (!category) {
            categorySelect.classList.add('ring-2', 'ring-blue-400');
            setTimeout(() => categorySelect.classList.remove('ring-2', 'ring-yellow-400'), 1200);
          }
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


        fileInput.addEventListener('change', function() {
          if (this.files && this.files.length > 0) {
            // Show document info section
            documentInfoSection.classList.remove('hidden');
            setTimeout(() => documentInfoSection.classList.add('opacity-100'), 50);
            documentInfoSection.classList.add('block');

            // Show file preview
            const fileName = this.files[0].name;
            previewContent.innerHTML = `<div class="text-gray-700 dark:text-gray-200">${fileName}</div>`;
            filePreview.classList.remove('hidden');
          } else {
            // Hide sections if no file selected
            documentInfoSection.classList.add('hidden');
            filePreview.classList.add('hidden');
          }
        });

        // Show sections when file is selected
        fileInput.addEventListener('change', function () {
          if (this.files && this.files.length > 0) {
            const fileName = this.files[0].name;
            previewFileName.textContent = fileName;

            // Show preview + sections
            filePreview.classList.remove('hidden');
            documentInfoSection.classList.remove('hidden');
            autoDetectSection.classList.remove('hidden');

            // Temporary highlight
            filePreview.classList.add('ring-2', 'ring-blue-400');
            setTimeout(() => filePreview.classList.remove('ring-2', 'ring-blue-400'), 800);
          } else {
            hideAllSections();
          }
        });

        // Helper function to hide sections when cleared
        function hideAllSections() {
          filePreview.classList.add('hidden');
          documentInfoSection.classList.add('hidden');
          autoDetectSection.classList.add('hidden');
          previewFileName.textContent = "";
        }
      });

      // Select all key fields
      document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('titleInput');
        const categorySelect = document.getElementById('categorySelect');
        const meetingSelect = document.getElementById('meetingTypeSelect');
        const tagsInput = document.getElementById('tagsInput');
        const fileInput = document.getElementById('file');
        const form = document.querySelector('form'); // get your form element

        function updateFieldHighlight(element) {
          const isRequired = element.hasAttribute('required');
          const value = element.value.trim();
          const isDisabled = element.disabled;
          const isValid = isDisabled || !isRequired || value !== "";

          if (isValid) {
            element.classList.remove('field-error');
            element.classList.add('field-valid');
          } else {
            element.classList.remove('field-valid');
            element.classList.add('field-error');
          }
        }

        // Add listeners for all key fields
        [titleInput, categorySelect, meetingSelect, tagsInput].forEach(field => {
          field.addEventListener('input', () => updateFieldHighlight(field));
          field.addEventListener('change', () => updateFieldHighlight(field));
        });

        // Run initial highlight on load
        setTimeout(() => {
          [titleInput, categorySelect, meetingSelect, tagsInput].forEach(updateFieldHighlight);
        }, 300);

        // Auto recheck on file upload (autofilled fields)
        if (fileInput) {
          fileInput.addEventListener('change', () => {
            setTimeout(() => {
              [titleInput, categorySelect, meetingSelect, tagsInput].forEach(updateFieldHighlight);
            }, 500);
          });
        }

        // Prevent form submission if tags are empty
        form.addEventListener('submit', (e) => {
          const fields = [titleInput, categorySelect, meetingSelect, tagsInput];
          let allValid = true;
          fields.forEach(field => {
            updateFieldHighlight(field);
            if (field.classList.contains('field-error')) allValid = false;
          });

          if (!allValid) {
            e.preventDefault();
            alert("Please fill out all required fields before uploading.");
          }
        });
      });

      document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form[action="{{ route('upload.store') }}"]');
        const submitBtn = form.querySelector('button[type="submit"]');
        const modal = document.getElementById('uploadingModal');
        const modalContent = document.getElementById('uploadingContent');
        const uploadingState = document.getElementById('uploadingState');
        const successState = document.getElementById('successState');
        const progressBar = document.getElementById('uploadProgressBar');
        const progressText = document.getElementById('uploadProgressText');

        form.addEventListener('submit', function (e) {
          e.preventDefault();
          submitBtn.disabled = true;
          submitBtn.textContent = 'Uploading...';

          // Show modal animation
          modal.classList.remove('hidden');
          setTimeout(() => {
            modalContent.classList.remove('opacity-0', 'scale-95');
            modalContent.classList.add('opacity-100', 'scale-100');
          }, 10);

          const formData = new FormData(form);
          const xhr = new XMLHttpRequest();
          xhr.open('POST', form.action, true);
          xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

          const token = document.querySelector('input[name="_token"]').value;
          xhr.setRequestHeader('X-CSRF-TOKEN', token);

          xhr.upload.addEventListener('progress', function (e) {
            if (e.lengthComputable) {
              const percent = Math.round((e.loaded / e.total) * 100);
              progressBar.style.width = percent + '%';
              progressText.textContent = percent + '%';
            }
          });

          xhr.onload = function () {
            if (xhr.status === 200) {
              progressBar.style.width = '100%';
              progressText.textContent = '100%';

              // Show success state with bounce animation
              setTimeout(() => {
                uploadingState.classList.add('hidden');
                successState.classList.remove('hidden');
              }, 500);

              // Fade out and redirect
              setTimeout(() => {
                modalContent.classList.remove('opacity-100', 'scale-100');
                modalContent.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                  window.location.href = "{{ route('mainsidebar.documents') }}";
                }, 400);
              }, 1800);
            } else {
              alert('Upload failed. Please try again.');
              resetUploadUI();
            }
          };

          xhr.onerror = function () {
            alert('An error occurred during upload.');
            resetUploadUI();
          };

          xhr.send(formData);

          function resetUploadUI() {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Upload Document';
            modalContent.classList.remove('opacity-100', 'scale-100');
            modalContent.classList.add('opacity-0', 'scale-95');
            setTimeout(() => modal.classList.add('hidden'), 300);
          }
        });
      });
    </script>   
  </body>
</html>
