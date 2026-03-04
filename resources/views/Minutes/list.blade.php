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
      cursor: default !important;  /* Forces arrow pointer everywhere */
      user-select: none;  /* Blocks text selection/editing on non-inputs */
    }
    input, textarea {
      cursor: text !important;  /* Keeps I-beam in text fields */
      user-select: text;  /* Allows selection in inputs */
    }
    #pdfModal {
      backdrop-filter: blur(4px);
      transition: opacity 0.3s ease-in-out;
    }
    #pdfModal iframe {
      transition: transform 0.2s ease-in-out;
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

          <a href="{{ route('mainsidebar.recycle-bin') }}" class="flex items-center gap-2 w-full px-3 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-100 hover:bg-blue-100 dark:hover:bg-blue-800/40 transition">
            <i data-lucide="recycle"></i> Recycle Bin
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
            <i data-lucide="file-text" class="w-6 h-6 text-gray-600 dark:text-gray-300"></i>
            <h4 class="mb-0">{{ $title }}</h4>
          </div>
          <div class="flex items-center gap-2">
            <a href="{{ route('minutes.index') }}" 
              class="p-2 border border-gray-300 dark:border-gray-600 rounded-xl dark:bg-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition"title="Go Back">
              <i data-lucide="panel-right-open"></i>
            </a>
            <button id="themeToggle" class="text-gray-600 dark:text-gray-300 cursor-pointer" title="Toggle Dark Mode">
              <span id="themeIcon" data-lucide="moon"></span>
            </button>
          </div>
        </div>

        <!-- Filters and Search -->
        <div class="p-4 border border-gray-200 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-900 mb-6 shadow-sm">
          <form method="GET" action="" class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3"> 

            <!-- 🔍 Live Search Input (Auto Search on Typing) -->
            <div class="relative w-full sm:w-1/2 group">
              <input type="text" name="search"id="searchInput"value="{{ request('search') }}"placeholder="Search documents by title or tags..." class="pl-10 pr-12 py-2 w-full border border-gray-300 dark:border-gray-700 rounded-xl shadow-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-300 ease-in-out group-hover:shadow-md">

              <!-- Left Static Search Icon -->
              <i data-lucide="search" class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"></i>

              <!-- Right Loader -->
              <div id="searchLoader" class="absolute right-3 top-1/2 -translate-y-1/2 hidden text-xs text-blue-500 animate-pulse">
                Searching...
              </div>
            </div>

            <!-- Sort -->
            <div class="flex gap-2">
              <select name="sort" onchange="this.form.submit()"
                class="px-2 py-2 border border-gray-300 dark:border-gray-600 rounded-xl dark:bg-gray-800 dark:text-white text-sm">
                <option value="date" {{ request('sort') === 'date' ? 'selected' : '' }}>Sort by Date</option>
                <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Sort by Name</option>
              </select>
            </div>
          </form>
        </div>

        <!-- Results Table -->
        <div id="documentsTable" class="border border-gray-200 dark:border-gray-700 rounded-2xl bg-white dark:bg-gray-900 shadow-sm transition-opacity duration-300 ease-in-out">
          <table class="w-full text-sm border-collapse rounded-2xl overflow-hidden">
            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 uppercase text-xs font-semibold">
              <tr>
                <th class="px-6 py-3 text-left">Document Title</th>
                <th class="px-6 py-3 text-left">File Type</th>
                <th class="px-6 py-3 text-left">Date Uploaded</th>
                <th class="px-6 py-3 text-left">Uploaded By</th>
                <th class="px-6 py-3 text-center">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              @forelse ($documents as $document)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                  <td class="px-6 py-3">{{ $document->title }}</td>
                  <td class="px-6 py-3 uppercase">{{ $document->file_type }}</td>
                  <td class="px-6 py-3">{{ $document->upload_date }}</td>
                  <td class="px-6 py-3">{{ $document->staff->name ?? 'Unknown' }}</td>
                  <td class="px-6 py-3 text-center flex justify-center gap-2">
                    @if(auth('staff')->user()->canView())
                      <button onclick="openDocumentModal('{{ $document->document_id }}', '{{ strtolower($document->file_type) === 'pdf' ? 'pdf' : 'other' }}', '{{ addslashes($document->title) }}')" class="px-3 py-1 rounded-lg bg-blue-500 text-white hover:bg-blue-600">
                        View
                      </button>
                    @endif

                    @if(auth('staff')->user()->canDownload())
                      <a href="{{ route('documents.download', $document->document_id) }}"
                        class="px-3 py-1 rounded-lg bg-green-500 text-white hover:bg-green-600">
                        Download
                      </a>
                    @endif

                    @if(auth('staff')->user()->canDelete())
                      <button onclick="openDeleteModal('{{ route('documents.softDelete', $document->document_id) }}')"
                        class="px-3 py-1 rounded-lg bg-red-500 text-white hover:bg-red-600">
                        Delete
                      </button>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400 italic">
                    No documents yet
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal"
          class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
          <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg w-96 text-center">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
              Move to Recycle Bin?
            </h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
              Are you sure you want to move this document to the Recycle Bin?
            </p>

            <div class="flex justify-center gap-4">
              <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit"class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                  Yes
                </button>
              </form>
                <button type="button" onclick="closeDeleteModal()"class="px-4 py-2 rounded-lg bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                  No
                </button>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-4 text-sm text-gray-600 dark:text-gray-400">
          <!-- Rows per page -->
          <div>
            Rows Per Page 
            <form method="GET" class="inline">
              <!-- Keep filters/search -->
              <input type="hidden" name="search" value="{{ request('search') }}">
              <input type="hidden" name="sort" value="{{ request('sort') }}">

              <select name="per_page" onchange="this.form.submit()"
                class="ml-2 px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-800 dark:text-white">
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
              </select>
            </form>
          </div>

          <!-- Custom pagination -->
          <div class="flex items-center gap-2">
            @if ($documents->onFirstPage())
              <span class="px-2 py-1 border rounded-lg text-gray-400 cursor-not-allowed">&laquo;</span>
            @else
              <a href="{{ $documents->appends(request()->query())->previousPageUrl() }}" 
                class="px-2 py-1 border rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">&laquo;</a>
            @endif

            <span>
              Page {{ $documents->currentPage() }} of {{ $documents->lastPage() }}
            </span>

            @if ($documents->hasMorePages())
              <a href="{{ $documents->appends(request()->query())->nextPageUrl() }}" 
                class="px-2 py-1 border rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">&raquo;</a>
            @else
              <span class="px-2 py-1 border rounded-lg text-gray-400 cursor-not-allowed">&raquo;</span>
            @endif
          </div>
        </div>
        
        <!-- PDF Viewer Modal -->
        <div id="pdfModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
          <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg w-[90%] h-[90%] relative flex flex-col">
            <!-- Toolbar with title and Close -->
            <div class="flex items-center justify-between bg-gray-800 text-white p-3 rounded-t-2xl">
              <div class="flex items-center gap-3">
                <!-- Show the document title here -->
                <h3 id="pdfTitle" class="text-sm font-medium truncate max-w-[60vw]"></h3>
              </div>
              <div>
                <button onclick="closeDocumentModal()" class="hover:text-red-400 flex items-center gap-1">
                  <i data-lucide='x'></i>
                </button>
              </div>
            </div>

            <!-- PDF Viewer -->
            <iframe id="pdfFrame" src="" class="flex-1 w-full rounded-b-2xl"></iframe>
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

      function openDeleteModal(actionUrl) {
        document.getElementById('deleteForm').action = actionUrl;
        document.getElementById('deleteModal').classList.remove('hidden');
      }

      function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
      }

      document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('searchInput');
        const loader = document.getElementById('searchLoader');
        const documentsTable = document.getElementById('documentsTable');
        let typingTimer;
        const typingDelay = 400; // milliseconds

        // Trigger search after user stops typing
        searchInput.addEventListener('input', () => {
          clearTimeout(typingTimer);
          loader.classList.remove('hidden');
          typingTimer = setTimeout(performSearch, typingDelay);
        });

        function performSearch() {
          const value = searchInput.value.trim();
          const url = new URL(window.location.href);

          // Maintain existing filters (category, meeting_type, sort, etc.)
          const params = ['category', 'meeting_type', 'sort', 'per_page'];
          params.forEach(param => {
            const el = document.querySelector(`[name="${param}"]`);
            if (el && el.value && el.value !== 'all') url.searchParams.set(param, el.value);
          });

          // Add or clear search query
          if (value) url.searchParams.set('search', value);
          else url.searchParams.delete('search');

          // Animate fade out
          documentsTable.style.opacity = 0.3;

          fetch(url)
            .then(response => response.text())
            .then(html => {
              const parser = new DOMParser();
              const doc = parser.parseFromString(html, 'text/html');
              const newTable = doc.querySelector('#documentsTable');

              if (newTable) {
                documentsTable.innerHTML = newTable.innerHTML;

                // Fade-in animation
                documentsTable.style.opacity = 0;
                setTimeout(() => {
                  documentsTable.style.opacity = 1;
                }, 100);
              }

              loader.classList.add('hidden');
            })
            .catch(() => {
              loader.classList.add('hidden');
              documentsTable.style.opacity = 1;
            });
        }
      });
      let zoomScale = 1;
      let currentPDF = '';

      function openDocumentModal(id, type, title) {
        if (type === 'pdf') {
          currentPDF = `/documents/view/${id}`; // your route that returns inline PDF
          const modal = document.getElementById('pdfModal');
          const frame = document.getElementById('pdfFrame');
          const titleEl = document.getElementById('pdfTitle');

          // set title text (escape just in case)
          titleEl.textContent = title || 'Document Preview';

          // set iframe src only when opening so browser doesn't preload unnecessarily
          frame.src = currentPDF;

          // show modal
          modal.classList.remove('hidden');

          // redraw lucide icons (if needed)
          if (window.lucide && typeof lucide.createIcons === 'function') {
            lucide.createIcons();
          }
        } else {
          // non-pdf -> fallback: download / open in new tab using controller view() which will force download
          window.location.href = `/documents/view/${id}`;
        }
      }

      function closeDocumentModal() {
        const modal = document.getElementById('pdfModal');
        const frame = document.getElementById('pdfFrame');

        if (!modal) return;
        modal.classList.add('hidden');

        // blank the iframe to release PDF memory
        frame.src = 'about:blank';

        // reset zoomScale if you add zoom controls later
        zoomScale = 1;
      }

      // optional small helpers for zoom if you keep them later
      function zoomIn() {
        zoomScale = Math.min(3, zoomScale + 0.1);
        document.getElementById('pdfFrame').style.transform = `scale(${zoomScale})`;
      }
      function zoomOut() {
        zoomScale = Math.max(0.5, zoomScale - 0.1);
        document.getElementById('pdfFrame').style.transform = `scale(${zoomScale})`;
      }
    </script>
  </body>
</html>
