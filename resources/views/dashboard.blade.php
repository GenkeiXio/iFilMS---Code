<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>iFiLMS Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="logo">
                <span class="blue">BICOL</span> <span class="orange">UNIVERSITY</span>
            </div>
            <ul class="nav">
                <li><strong>Dashboard</strong></li>
                <li>
                    <span>📁 Transcriptions</span>
                    <ul>
                        <li>Academic Council</li>
                        <li>Administrative Council</li>
                        <li>Board Meetings</li>
                    </ul>
                </li>
                <li>
                    <span>📄 Minutes</span>
                    <ul>
                        <li>Academic Council</li>
                        <li>Administrative Council</li>
                        <li>Board Meetings</li>
                    </ul>
                </li>
                <li>📚 Excerpts</li>
                <li>📝 Secretary's Certification</li>
                <li>🗳️ Referendum</li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">📤 LogOut</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <li>⚙️ Settings</li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="header">
                <h2>Dashboard</h2>
                <input type="text" placeholder="🔍 Search" class="search-bar">
                <div class="icons">🌙 🔔 👤</div>
            </div>

            <div class="documents">
                <div class="tabs">
                    <button class="tab active">Active</button>
                    <button class="tab">List of All Documents</button>
                </div>

                <table class="doc-table">
                    <thead>
                        <tr>
                            <th>Document Title</th>
                            <th>File Type</th>
                            <th>Date Uploaded</th>
                            <th>Uploaded By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td colspan="5" style="text-align:center;">No records yet</td></tr>
                    </tbody>
                </table>

                <div class="pagination">
                    <label>Rows Per Page
                        <select>
                            <option>10</option>
                            <option>25</option>
                        </select>
                    </label>
                    <span>Page 1 of 1</span>
                    <button>⏪</button>
                    <button>◀️</button>
                    <button>▶️</button>
                    <button>⏩</button>
                </div>
            </div>
        </main>
    </div>

    <footer class="footer">
        <p>© 2025 Bicol University Board of Regents • All rights reserved.</p>
    </footer>
</body>
</html>
