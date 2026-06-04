<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — PromptGallery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --yellow: #FFD200; --yellow-dk: #E6BD00; --yellow-lt: #FFFBE6;
            --blue: #00AACC;   --blue-lt: #E0F7FA;   --blue-dk: #0090AA;
            --navy: #0F172A; --emerald: #10B981; --orange: #F97316;
            --red: #EF4444;
            --white: #FFFFFF; --bg: #FEFDF5; --zinc: #E2E8F0;
            --slate: #475569; --stone: #64748B; --slate-lt: #334155;
            --cool-gray: #CBD5E1; --card-bg: #FFFEF7;
            --sidebar-w: 248px;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family:'Poppins',-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;
            background:var(--bg); color:var(--navy); display:flex; min-height:100vh;
            font-size:14px; font-weight:400; line-height:1.5;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width:var(--sidebar-w); min-height:100vh; background:var(--white);
            border-right:1px solid var(--zinc);
            display:flex; flex-direction:column;
            position:fixed; left:0; top:0; bottom:0; z-index:50;
            box-shadow: rgba(0,0,0,0.05) 4px 0px 16px;
            border-top: 4px solid var(--yellow);
        }
        .sidebar-logo {
            padding:20px 20px 16px; border-bottom:1px solid var(--zinc);
            display:flex; align-items:center; gap:10px;
        }
        .logo-icon {
            width:40px; height:40px; border-radius:12px;
            background:linear-gradient(135deg,var(--yellow),var(--blue));
            display:flex; align-items:center; justify-content:center;
            font-size:1rem; color:var(--navy);
            box-shadow:rgba(255,210,0,0.3) 0px 4px 12px;
        }
        .logo-text { font-size:1rem; font-weight:700; color:var(--navy); }
        .logo-badge {
            font-size:.65rem; font-weight:700; color:var(--navy);
            background:var(--yellow); padding:2px 8px;
            border-radius:20px; margin-top:2px; display:inline-block;
        }

        .sidebar-nav { flex:1; padding:16px 12px; overflow-y:auto; }
        .nav-section {
            font-size:.65rem; text-transform:uppercase; letter-spacing:.08em;
            color:var(--stone); padding:0 8px; margin:16px 0 6px; font-weight:500;
        }
        .nav-link {
            display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:11px;
            color:var(--slate); text-decoration:none; font-size:.875rem; font-weight:500;
            transition:all .2s; margin-bottom:2px; min-height:44px;
        }
        .nav-link:hover { background:var(--yellow-lt); color:var(--navy); }
        .nav-link.active {
            background:var(--yellow-lt); color:var(--navy);
            font-weight:700; border-left:3px solid var(--yellow);
            padding-left:9px;
        }
        .nav-link .icon { font-size:1.1rem; width:22px; text-align:center; }

        .sidebar-footer { padding:16px; border-top:1px solid var(--zinc); }
        .admin-info { display:flex; align-items:center; gap:10px; margin-bottom:12px; }
        .admin-avatar {
            width:38px; height:38px; border-radius:50%;
            background:linear-gradient(135deg,var(--yellow),var(--blue));
            display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:.95rem; color:var(--navy); flex-shrink:0;
        }
        .admin-name { font-size:.875rem; font-weight:600; color:var(--navy); }
        .admin-role { font-size:.7rem; color:var(--blue-dk); font-weight:600; }
        .logout-btn {
            display:flex; align-items:center; gap:8px; width:100%;
            padding:9px 12px; border-radius:11px; font-size:.8rem; font-weight:500;
            border:1px solid rgba(239,68,68,0.2); background:transparent;
            color:var(--red); cursor:pointer; font-family:'Poppins',sans-serif;
            transition:all .2s; min-height:44px;
        }
        .logout-btn:hover { background:rgba(239,68,68,0.05); border-color:rgba(239,68,68,0.4); }

        /* ===== MAIN ===== */
        .main { margin-left:var(--sidebar-w); flex:1; display:flex; flex-direction:column; }
        .topbar {
            padding:16px 32px; border-bottom:3px solid var(--yellow);
            background:rgba(255,253,245,0.97); backdrop-filter:blur(10px);
            position:sticky; top:0; z-index:40;
            display:flex; align-items:center; justify-content:space-between;
            box-shadow:rgba(0,0,0,0.04) 0px 2px 8px;
        }
        .page-title { font-size:1.1rem; font-weight:700; color:var(--navy); }
        .breadcrumb { font-size:.8rem; color:var(--stone); margin-top:2px; }
        .content { padding:32px; flex:1; }

        /* ===== CARDS ===== */
        .card {
            background:var(--white); border:1px solid var(--zinc);
            border-radius:24px; padding:24px;
            box-shadow:rgba(0,0,0,0.06) 0px 4px 6px -1px;
        }
        .card-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
        .card-title { font-size:1rem; font-weight:700; color:var(--navy); }

        /* ===== STAT CARDS ===== */
        .stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px; }
        .stat-card {
            background:var(--white); border:1px solid var(--zinc); border-radius:24px;
            padding:24px; position:relative; overflow:hidden;
            box-shadow:rgba(0,0,0,0.06) 0px 4px 6px -1px;
        }
        .stat-card::before {
            content:''; position:absolute; top:-20px; right:-20px;
            width:80px; height:80px; border-radius:50%;
            background:var(--stat-color,var(--indigo)); opacity:.08;
        }
        .stat-icon { font-size:1.5rem; margin-bottom:12px; }
        .stat-value { font-size:1.75rem; font-weight:800; color:var(--navy); margin-bottom:4px; }
        .stat-label { font-size:.8rem; color:var(--stone); font-weight:400; }

        /* ===== TABLE ===== */
        .table-wrapper { overflow-x:auto; }
        table { width:100%; border-collapse:collapse; }
        th {
            text-align:left; font-size:.72rem; text-transform:uppercase;
            letter-spacing:.06em; color:var(--stone);
            padding:10px 16px; border-bottom:2px solid var(--zinc); font-weight:600;
        }
        td { padding:14px 16px; font-size:.875rem; border-bottom:1px solid var(--zinc); color:var(--navy); }
        tr:hover td { background:var(--bg); }
        tr:last-child td { border-bottom:none; }

        /* ===== BADGES ===== */
        .badge {
            display:inline-flex; align-items:center; gap:4px;
            padding:4px 10px; border-radius:25px; font-size:.72rem; font-weight:500;
        }
        .badge-purple { background:rgba(255,210,0,.1); color:var(--navy); border:1px solid rgba(255,210,0,.35); }
        .badge-cyan { background:rgba(0,170,204,.08); color:var(--blue-dk); border:1px solid rgba(0,170,204,.2); }
        .badge-green { background:rgba(16,185,129,.08); color:var(--emerald); border:1px solid rgba(16,185,129,.2); }
        .badge-yellow { background:rgba(249,115,22,.08); color:var(--orange); border:1px solid rgba(249,115,22,.2); }
        .badge-red { background:rgba(239,68,68,.08); color:var(--red); border:1px solid rgba(239,68,68,.2); }

        /* ===== BUTTONS ===== */
        .btn {
            display:inline-flex; align-items:center; gap:8px;
            padding:10px 20px; border-radius:12px; font-size:13.3333px; font-weight:600;
            cursor:pointer; font-family:Arial,sans-serif; transition:all .2s; text-decoration:none;
            border:none; height:42px; white-space:nowrap;
        }
        .btn-primary { background:var(--yellow); color:var(--navy); font-weight:700; box-shadow:rgba(255,210,0,0.35) 0px 4px 15px; }
        .btn-primary:hover { background:var(--yellow-dk); box-shadow:rgba(255,210,0,0.5) 0px 6px 20px; }
        .btn-primary:active { transform:scale(0.98); }
        .btn-secondary { background:var(--bg); color:var(--slate); border:2px solid var(--zinc); }
        .btn-secondary:hover { background:var(--yellow-lt); color:var(--navy); border-color:var(--yellow); }
        .btn-danger { background:rgba(239,68,68,.06); color:var(--red); border:1px solid rgba(239,68,68,.2); }
        .btn-danger:hover { background:rgba(239,68,68,.12); }
        .btn-sm { padding:6px 14px; font-size:.775rem; height:36px; }

        /* ===== FORMS ===== */
        .form-group { margin-bottom:20px; }
        .form-label { display:block; font-size:.85rem; font-weight:600; margin-bottom:8px; color:var(--slate-lt); }
        .form-input, .form-select, .form-textarea {
            width:100%; padding:12px 16px; background:var(--white);
            border:1px solid var(--zinc); border-radius:12px;
            color:var(--navy); font-family:'Poppins',sans-serif; font-size:.9rem;
            outline:none; transition:all .2s; min-height:44px;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color:var(--yellow); box-shadow:0 0 0 3px rgba(255,210,0,0.15);
        }
        .form-input::placeholder { color:#94A3B8; }
        .form-textarea { resize:vertical; min-height:120px; }
        .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
        .form-error { font-size:.8rem; color:var(--red); margin-top:5px; }
        .form-hint { font-size:.78rem; color:var(--stone); margin-top:5px; }

        /* ===== TOGGLE ===== */
        .toggle-wrapper { display:flex; align-items:center; gap:12px; }
        .toggle {
            position:relative; width:44px; height:24px;
            background:var(--zinc); border:1px solid var(--cool-gray); border-radius:12px;
            cursor:pointer; transition:.2s;
        }
        .toggle input { opacity:0; width:0; height:0; position:absolute; }
        .toggle-slider {
            position:absolute; top:3px; left:3px; width:16px; height:16px;
            background:var(--cool-gray); border-radius:50%; transition:.2s;
        }
        .toggle input:checked ~ .toggle-slider { transform:translateX(20px); background:var(--navy); }
        .toggle:has(input:checked) { background:var(--yellow); border-color:var(--yellow-dk); }

        /* ===== ALERTS ===== */
        .alert {
            padding:12px 16px; border-radius:12px; margin-bottom:20px;
            display:flex; align-items:center; gap:10px; font-size:.875rem; font-weight:500;
        }
        .alert-success { background:rgba(16,185,129,.08); border:1px solid rgba(16,185,129,.2); color:#065f46; }
        .alert-error { background:rgba(239,68,68,.08); border:1px solid rgba(239,68,68,.2); color:#991b1b; }

        /* ===== SEARCH BAR ===== */
        .search-bar { display:flex; gap:10px; margin-bottom:20px; flex-wrap:wrap; align-items:center; }
        .search-bar .form-input { max-width:280px; }

        /* ===== PAGINATION ===== */
        .pagination { display:flex; gap:6px; justify-content:center; margin-top:24px; flex-wrap:wrap; }
        .pag-link {
            padding:8px 14px; border-radius:10px; font-size:.8rem; font-weight:500;
            border:1px solid var(--zinc); background:var(--white);
            color:var(--slate); text-decoration:none; transition:.2s;
            min-width:44px; min-height:44px; display:inline-flex; align-items:center; justify-content:center;
        }
        .pag-link:hover { background:var(--yellow-lt); border-color:var(--yellow); color:var(--navy); }
        .pag-link.active {
            border-color:var(--yellow); color:var(--navy); background:var(--yellow);
            font-weight:700; box-shadow:rgba(255,210,0,0.25) 0px 4px 12px;
        }

        .truncate { max-width:300px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

        @media(max-width:768px) {
            .sidebar { transform:translateX(-100%); }
            .main { margin-left:0; }
            .stats-grid { grid-template-columns:1fr 1fr; }
            .form-grid { grid-template-columns:1fr; }
            .content { padding:16px; }
        }
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">✦</div>
        <div>
            <div class="logo-text">PromptGallery</div>
            <div class="logo-badge">Admin Panel</div>
        </div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="icon">📊</span> Dashboard
        </a>
        <a href="{{ route('home') }}" class="nav-link" target="_blank">
            <span class="icon">🌐</span> Lihat Gallery
        </a>
        <div class="nav-section">Konten</div>
        <a href="{{ route('admin.prompts.index') }}" class="nav-link {{ request()->routeIs('admin.prompts.*') ? 'active' : '' }}">
            <span class="icon">✨</span> Kelola Prompt
        </a>
        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <span class="icon">🏷️</span> Kategori
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="admin-info">
            <div class="admin-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
            <div>
                <div class="admin-name">{{ Str::limit(auth()->user()->name, 16) }}</div>
                <div class="admin-role">Administrator</div>
            </div>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">🚪 Logout</button>
        </form>
    </div>
</aside>

<div class="main">
    <div class="topbar">
        <div>
            <div class="page-title">@yield('page-title', 'Dashboard')</div>
            <div class="breadcrumb">Admin / @yield('breadcrumb', 'Dashboard')</div>
        </div>
        <div>@yield('topbar-actions')</div>
    </div>
    <div class="content">
        @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-error">✗ {{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>
