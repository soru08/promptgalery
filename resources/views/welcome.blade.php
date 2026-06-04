<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PromptGallery - Koleksi prompt foto AI terbaik untuk Midjourney, DALL-E, Stable Diffusion. Buat foto keren dengan prompt yang telah dikurasi.">
    <title>PromptGallery — Koleksi Prompt Foto AI Terbaik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ===== DESIGN SYSTEM — PromptGallery × Invincible ===== */
        :root {
            /* Invincible Palette */
            --yellow:    #FFD200;  /* Invincible yellow — primary */
            --yellow-dk: #E6BD00;  /* Hover state */
            --yellow-lt: #FFFBE6;  /* Light yellow tint */
            --blue:      #00AACC;  /* Invincible blue — secondary */
            --blue-lt:   #E0F7FA;  /* Light blue tint */
            --blue-dk:   #0090AA;
            /* Structure */
            --navy:      #0F172A;
            --emerald:   #10B981;
            --orange:    #F97316;
            --red:       #EF4444;
            --white:     #FFFFFF;
            --bg:        #FEFDF5;  /* Warm ivory — not pure white */
            --bg-hero:   linear-gradient(135deg, #FFFBDE 0%, #E6F9FF 100%);
            --zinc:      #E2E8F0;
            --zinc-y:    rgba(255, 210, 0, 0.25);  /* Yellow-tinted border */
            --slate:     #475569;
            --stone:     #64748B;
            --slate-lt:  #334155;
            --cool-gray: #CBD5E1;
            --card-bg:   #FFFEF7;  /* Very subtle warm card */
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            background: var(--bg);
            color: var(--navy);
            min-height: 100vh;
            font-size: 19.2px;
            font-weight: 500;
            line-height: 1.4;
        }

        /* ===== NAVBAR ===== */
        nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(255, 253, 245, 0.96);
            backdrop-filter: blur(10px);
            border-bottom: 3px solid var(--yellow);
            box-shadow: rgba(0,0,0,0.1) 0px 20px 25px -5px, rgba(0,0,0,0.04) 0px 10px 10px -5px;
        }
        .nav-inner {
            max-width: 1200px; margin: 0 auto;
            display: flex; align-items: center; justify-content: space-between;
            height: 74px; padding: 12px 24px;
        }
        .nav-logo {
            display: flex; align-items: center; gap: 10px;
            font-size: 1.25rem; font-weight: 700; color: var(--navy);
            text-decoration: none;
        }
        .nav-logo-icon {
            width: 40px; height: 40px; border-radius: 12px;
            background: linear-gradient(135deg, var(--yellow), var(--blue));
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; color: var(--navy);
            box-shadow: rgba(255,210,0,0.35) 0px 4px 12px;
        }
        /* card image */
        .card-image {
            width: 100%; height: 180px; object-fit: cover;
            border-radius: 14px; margin-bottom: 14px;
            background: var(--zinc);
            display: block;
            transition: transform 0.3s ease;
        }
        .prompt-card:hover .card-image {
            transform: scale(1.02);
        }
        .card-image-wrap {
            border-radius: 14px; overflow: hidden;
            margin-bottom: 14px; flex-shrink: 0;
        }

        /* ===== HERO ===== */
        .hero {
            text-align: center; padding: 96px 24px 64px;
            background: var(--bg-hero);
            border-bottom: 1px solid var(--zinc);
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute; top: -80px; left: -80px;
            width: 320px; height: 320px; border-radius: 50%;
            background: radial-gradient(circle, rgba(255,210,0,0.18) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero::after {
            content: ''; position: absolute; bottom: -60px; right: -60px;
            width: 280px; height: 280px; border-radius: 50%;
            background: radial-gradient(circle, rgba(0,170,204,0.15) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 18px; border-radius: 25px;
            background: rgba(255,210,0,0.15); border: 2px solid var(--yellow);
            font-size: 14px; font-weight: 600; color: var(--navy);
            margin-bottom: 24px; position: relative; z-index: 1;
        }
        .hero h1 {
            font-size: clamp(2rem, 5vw, 40px);
            font-weight: 800; line-height: 1.2; color: var(--navy);
            margin-bottom: 16px; letter-spacing: 0; position: relative; z-index: 1;
        }
        .hero h1 span {
            background: linear-gradient(135deg, var(--yellow) 0%, var(--blue) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .hero p {
            font-size: 19.2px; color: var(--stone); font-weight: 500;
            max-width: 540px; margin: 0 auto 48px; line-height: 1.6;
        }
        .hero-stats {
            display: flex; justify-content: center; gap: 56px; margin-bottom: 48px;
        }
        .stat { text-align: center; }
        .stat-number {
            font-size: 2rem; font-weight: 800;
            background: linear-gradient(135deg, var(--yellow), var(--blue));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            display: block; line-height: 1.1;
        }
        .stat-label { font-size: 14px; color: var(--stone); font-weight: 400; margin-top: 4px; }

        /* ===== SEARCH ===== */
        .search-wrapper {
            max-width: 540px; margin: 0 auto;
            background: var(--white); border: 2px solid var(--zinc);
            border-radius: 14px; display: flex; align-items: center;
            padding: 12px 16px; gap: 10px;
            box-shadow: rgba(0,0,0,0.06) 0px 4px 12px;
            transition: all 0.2s; position: relative; z-index: 1;
        }
        .search-wrapper:focus-within {
            border-color: var(--yellow);
            box-shadow: 0 0 0 3px rgba(255,210,0,0.2), rgba(0,0,0,0.06) 0px 4px 12px;
        }
        .search-icon { color: var(--stone); font-size: 1rem; flex-shrink: 0; }
        .search-input {
            flex: 1; border: none; outline: none; background: transparent;
            font-family: Arial, sans-serif; font-size: 14.4px; font-weight: 500;
            color: var(--navy);
        }
        .search-input::placeholder { color: #94A3B8; }

        /* ===== MAIN LAYOUT ===== */
        .main-layout {
            max-width: 1200px; margin: 0 auto; padding: 64px 24px;
        }

        /* ===== FILTERS ===== */
        .filters-section { margin-bottom: 32px; }
        .filters-scroll {
            display: flex; gap: 8px; overflow-x: auto;
            padding-bottom: 8px; scrollbar-width: none; flex-wrap: wrap;
        }
        .filters-scroll::-webkit-scrollbar { display: none; }
        .filter-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9.6px 14px; border-radius: 11px; white-space: nowrap;
            border: none; background: var(--bg);
            color: var(--slate); font-family: 'Poppins', sans-serif;
            font-size: 14px; font-weight: 500; cursor: pointer;
            transition: all 0.2s; text-decoration: none; height: 42px;
        }
        .filter-btn:hover { background: var(--yellow-lt); color: var(--navy); border-color: var(--yellow); }
        .filter-btn.active {
            background: var(--yellow); color: var(--navy);
            box-shadow: rgba(255,210,0,0.3) 0px 4px 12px;
            border: 2px solid var(--yellow-dk);
        }
        .filter-count {
            font-size: 12px; padding: 1px 7px; border-radius: 20px;
            background: rgba(0,0,0,0.12);
        }
        .filter-btn:not(.active) .filter-count {
            background: var(--zinc); color: var(--stone);
        }

        /* ===== AI TOOL FILTER ===== */
        .ai-filter {
            display: flex; gap: 6px; align-items: center;
            margin-top: 12px; flex-wrap: wrap;
        }
        .ai-filter-label { font-size: 13px; color: var(--stone); font-weight: 500; }
        .ai-pill {
            padding: 4px 12px; border-radius: 25px; font-size: 12px; font-weight: 500;
            border: 1px solid var(--zinc); background: var(--white);
            color: var(--stone); cursor: pointer;
            font-family: 'Poppins', sans-serif; transition: all 0.2s;
            text-decoration: none;
        }
        .ai-pill:hover { background: var(--blue-lt); border-color: var(--blue); color: var(--blue-dk); }
        .ai-pill.active {
            border-color: var(--blue); color: var(--navy);
            background: var(--blue-lt);
            font-weight: 600;
        }

        /* ===== SECTION LABEL ===== */
        .section-label {
            font-size: 12px; font-weight: 700; color: var(--navy);
            text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 16px;
            display: flex; align-items: center; gap: 10px;
        }
        .section-label::before { content: ''; width: 24px; height: 3px; background: var(--yellow); border-radius: 2px; flex-shrink: 0; }
        .section-label::after { content: ''; flex: 1; height: 1px; background: var(--zinc); }

        /* ===== PROMPT GRID ===== */
        .prompts-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            margin-bottom: 48px;
        }

        /* ===== PROMPT CARD ===== */
        .prompt-card {
            background: var(--white); border: 1px solid var(--zinc);
            border-radius: 24px; padding: 24px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer; position: relative; overflow: hidden;
            box-shadow: rgba(0,0,0,0.1) 0px 4px 6px -1px;
            display: flex; flex-direction: column; min-height: 360px;
        }
        .prompt-card:hover {
            border-color: var(--yellow);
            box-shadow: rgba(255,210,0,0.2) 0px 8px 24px -4px, rgba(0,0,0,0.08) 0px 4px 12px -2px;
            transform: translateY(-4px);
        }
        .prompt-card.featured-card {
            border-color: rgba(255,210,0,0.4); border-width: 2px;
            box-shadow: rgba(255,210,0,0.15) 0px 4px 16px -2px;
        }
        .prompt-card.featured-card:hover {
            box-shadow: rgba(255,210,0,0.35) 0px 10px 30px -4px;
        }

        .card-header {
            display: flex; justify-content: space-between; align-items: flex-start;
            margin-bottom: 12px; gap: 8px;
        }
        .card-category {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 6px 12px; border-radius: 25px; font-size: 12px; font-weight: 500;
            background: var(--card-bg); color: var(--stone); border: 1px solid var(--zinc);
            white-space: nowrap;
        }
        .card-featured {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 12px; font-weight: 600; color: white;
            padding: 4px 12px; border-radius: 16px;
            background: var(--orange); white-space: nowrap; flex-shrink: 0;
        }
        .card-title {
            font-size: 17.6px; font-weight: 700; color: var(--navy);
            margin-bottom: 10px; line-height: 1.4; letter-spacing: 0;
        }
        .card-prompt {
            font-family: 'Fira Code', monospace; font-size: 13px;
            color: var(--stone); line-height: 1.65;
            display: -webkit-box; -webkit-line-clamp: 4;
            -webkit-box-orient: vertical; overflow: hidden;
            background: var(--bg); border-radius: 12px;
            padding: 12px; margin-bottom: 14px;
            border: 1px solid var(--zinc); flex: 1;
        }
        .card-tags {
            display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px;
        }
        .tag {
            font-size: 12px; font-weight: 500; padding: 4px 10px; border-radius: 25px;
            background: rgba(255,210,0,0.1); border: 1px solid rgba(255,210,0,0.3);
            color: var(--navy);
        }
        .card-footer {
            display: flex; justify-content: space-between; align-items: center;
            margin-top: auto;
        }
        .card-ai {
            display: flex; align-items: center; gap: 6px;
            font-size: 13px; color: var(--stone); font-weight: 400;
        }
        .ai-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--blue); flex-shrink: 0;
            box-shadow: 0 0 4px rgba(0,170,204,0.5);
        }
        .copy-count { color: var(--cool-gray); font-size: 12px; }
        .copy-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 20px; border-radius: 12px; height: 42px;
            background: var(--yellow);
            border: 2px solid var(--yellow-dk); color: var(--navy);
            font-family: Arial, sans-serif; font-size: 13.3333px; font-weight: 700;
            cursor: pointer; transition: all 0.2s;
            box-shadow: rgba(255,210,0,0.35) 0px 4px 15px 0px;
        }
        .copy-btn:hover {
            background: var(--yellow-dk);
            box-shadow: rgba(255,210,0,0.55) 0px 6px 20px 0px;
            transform: translateY(-1px);
        }
        .copy-btn:active { transform: scale(0.98); }
        .copy-btn.copied {
            background: var(--emerald); border-color: #059669; color: white;
            box-shadow: rgba(16,185,129,0.3) 0px 4px 15px 0px;
        }

        /* ===== PAGINATION ===== */
        .pagination-wrapper {
            display: flex; justify-content: center; gap: 8px; margin-top: 48px;
        }
        .page-link {
            padding: 10px 16px; border-radius: 12px; font-size: 14px; font-weight: 500;
            border: 1px solid var(--zinc); background: var(--white);
            color: var(--slate); text-decoration: none; transition: all 0.2s;
            min-width: 44px; min-height: 44px;
            display: inline-flex; align-items: center; justify-content: center;
        }
        .page-link:hover { background: var(--yellow-lt); border-color: var(--yellow); color: var(--navy); }
        .page-link.active {
            background: var(--yellow); border-color: var(--yellow-dk);
            color: var(--navy); font-weight: 700;
            box-shadow: rgba(255,210,0,0.3) 0px 4px 12px;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center; padding: 96px 24px; color: var(--stone);
        }
        .empty-state-icon { font-size: 3rem; margin-bottom: 16px; }
        .empty-state h3 { font-size: 19.2px; font-weight: 700; color: var(--navy); margin-bottom: 8px; }

        /* ===== TOAST ===== */
        .toast {
            position: fixed; bottom: 2rem; right: 2rem;
            background: var(--yellow); color: var(--navy);
            padding: 12px 20px; border-radius: 12px;
            font-size: 14px; font-weight: 700;
            font-family: 'Poppins', sans-serif;
            box-shadow: rgba(255,210,0,0.4) 0px 8px 24px;
            transform: translateY(80px); opacity: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 999;
        }
        .toast.show { transform: translateY(0); opacity: 1; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .prompts-grid { grid-template-columns: repeat(2, 1fr); gap: 24px; }
            .hero { padding: 64px 24px 48px; }
        }
        @media (max-width: 640px) {
            .prompts-grid { grid-template-columns: 1fr; gap: 16px; }
            .hero { padding: 48px 16px 32px; }
            .hero-stats { gap: 32px; }
            .main-layout { padding: 32px 16px; }
            .hero p { font-size: 16px; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav>
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="nav-logo">
            <div class="nav-logo-icon">✦</div>
            PromptGallery
        </a>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-badge">✦ Koleksi Prompt AI Terkurasi</div>
    <h1>Buat Foto <span>Menakjubkan</span><br>dengan Prompt Terbaik</h1>
    <p>Temukan ratusan prompt foto AI yang telah dikurasi untuk Midjourney, DALL-E, Stable Diffusion, dan lebih banyak lagi.</p>

    <div class="hero-stats">
        <div class="stat">
            <span class="stat-number">{{ \App\Models\Prompt::count() }}+</span>
            <div class="stat-label">Prompt Tersedia</div>
        </div>
        <div class="stat">
            <span class="stat-number">{{ \App\Models\Category::count() }}</span>
            <div class="stat-label">Kategori</div>
        </div>
        <div class="stat">
            <span class="stat-number">{{ number_format(\App\Models\Prompt::sum('copy_count')) }}</span>
            <div class="stat-label">Total Copy</div>
        </div>
    </div>

    <!-- SEARCH -->
    <form action="{{ route('home') }}" method="GET" id="search-form">
        @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
        @if(request('ai_tool')) <input type="hidden" name="ai_tool" value="{{ request('ai_tool') }}"> @endif
        <div class="search-wrapper">
            <span class="search-icon">🔍</span>
            <input id="search-input" type="text" name="search" class="search-input"
                   placeholder="Cari prompt... (landscape, cyberpunk, portrait...)"
                   value="{{ request('search') }}" autocomplete="off">
        </div>
    </form>
</section>

<!-- MAIN CONTENT -->
<div class="main-layout">
    <!-- CATEGORY FILTERS -->
    <div class="filters-section">
        <div class="filters-scroll">
            <a href="{{ route('home', array_filter(['search' => request('search'), 'ai_tool' => request('ai_tool')])) }}"
               class="filter-btn {{ !request('category') ? 'active' : '' }}">
                🌟 Semua <span class="filter-count">{{ \App\Models\Prompt::count() }}</span>
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('home', array_filter(['category' => $cat->slug, 'search' => request('search'), 'ai_tool' => request('ai_tool')])) }}"
               class="filter-btn {{ request('category') === $cat->slug ? 'active' : '' }}">
                {{ $cat->icon }} {{ $cat->name }}
                <span class="filter-count">{{ $cat->prompts_count }}</span>
            </a>
            @endforeach
        </div>

        <div class="ai-filter">
            <span class="ai-filter-label">AI Tool:</span>
            <a href="{{ route('home', array_filter(['category' => request('category'), 'search' => request('search')])) }}"
               class="ai-pill {{ !request('ai_tool') ? 'active' : '' }}">Semua</a>
            @foreach(['Midjourney', 'DALL-E 3', 'Stable Diffusion', 'Adobe Firefly', 'Leonardo AI', 'Ideogram', 'Flux'] as $tool)
            <a href="{{ route('home', array_filter(['category' => request('category'), 'search' => request('search'), 'ai_tool' => $tool])) }}"
               class="ai-pill {{ request('ai_tool') === $tool ? 'active' : '' }}">{{ $tool }}</a>
            @endforeach
        </div>
    </div>

    <!-- FEATURED SECTION -->
    @if($featuredPrompts->count() && !request('search') && !request('category') && !request('ai_tool'))
    <div style="margin-bottom: 48px;">
        <div class="section-label">⭐ Featured Prompts</div>
        <div class="prompts-grid">
            @foreach($featuredPrompts as $prompt)
            <div class="prompt-card featured-card">
                <div class="card-image-wrap">
                    <img
                        class="card-image"
                        src="{{ $prompt->image_path ? asset($prompt->image_path) : 'https://source.unsplash.com/400x220/?'.urlencode(strtolower($prompt->title)) }}"
                        alt="{{ $prompt->title }}"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='https://picsum.photos/seed/{{ $prompt->id }}/400/220'"
                    >
                </div>
                <div class="card-header">
                    <span class="card-category">{{ $prompt->category->icon }} {{ $prompt->category->name }}</span>
                    <span class="card-featured">🔥 Featured</span>
                </div>
                <div class="card-title">{{ $prompt->title }}</div>
                <div class="card-prompt">{{ $prompt->prompt_text }}</div>
                @if($prompt->style_tags)
                <div class="card-tags">
                    @foreach($prompt->style_tags_array as $tag)
                    <span class="tag">{{ $tag }}</span>
                    @endforeach
                </div>
                @endif
                <div class="card-footer">
                    <div class="card-ai">
                        <span class="ai-dot"></span>
                        {{ $prompt->ai_tool }}
                        <span class="copy-count" id="copy-count-{{ $prompt->id }}">· {{ number_format($prompt->copy_count) }}×</span>
                    </div>
                    <button class="copy-btn" onclick="copyPrompt({{ $prompt->id }}, this, {{ json_encode($prompt->prompt_text) }})">
                        📋 Copy
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="section-label">✨ Semua Prompt</div>
    @endif

    <!-- ALL PROMPTS -->
    @if($prompts->count())
    <div class="prompts-grid">
        @foreach($prompts as $prompt)
        <div class="prompt-card {{ $prompt->is_featured ? 'featured-card' : '' }}">
            <div class="card-image-wrap">
                <img
                    class="card-image"
                    src="{{ $prompt->image_path ? asset($prompt->image_path) : 'https://source.unsplash.com/400x220/?'.urlencode(strtolower($prompt->title)) }}"
                    alt="{{ $prompt->title }}"
                    loading="lazy"
                    onerror="this.onerror=null;this.src='https://picsum.photos/seed/{{ $prompt->id }}/400/220'"
                >
            </div>
            <div class="card-header">
                <span class="card-category">{{ $prompt->category->icon }} {{ $prompt->category->name }}</span>
                @if($prompt->is_featured)
                <span class="card-featured">🔥 Featured</span>
                @endif
            </div>
            <div class="card-title">{{ $prompt->title }}</div>
            <div class="card-prompt">{{ $prompt->prompt_text }}</div>
            @if($prompt->style_tags)
            <div class="card-tags">
                @foreach($prompt->style_tags_array as $tag)
                <span class="tag">{{ $tag }}</span>
                @endforeach
            </div>
            @endif
            <div class="card-footer">
                <div class="card-ai">
                    <span class="ai-dot"></span>
                    {{ $prompt->ai_tool }}
                    <span class="copy-count" id="copy-count-{{ $prompt->id }}">· {{ number_format($prompt->copy_count) }}×</span>
                </div>
                <button class="copy-btn" onclick="copyPrompt({{ $prompt->id }}, this, {{ json_encode($prompt->prompt_text) }})">
                    📋 Copy
                </button>
            </div>
        </div>
        @endforeach
    </div>

    @if($prompts->hasPages())
    <div class="pagination-wrapper">
        @if($prompts->onFirstPage())
        <span class="page-link" style="opacity:0.4;cursor:default">← Prev</span>
        @else
        <a href="{{ $prompts->previousPageUrl() }}" class="page-link">← Prev</a>
        @endif
        @foreach($prompts->getUrlRange(max(1, $prompts->currentPage()-2), min($prompts->lastPage(), $prompts->currentPage()+2)) as $page => $url)
        <a href="{{ $url }}" class="page-link {{ $page == $prompts->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach
        @if($prompts->hasMorePages())
        <a href="{{ $prompts->nextPageUrl() }}" class="page-link">Next →</a>
        @else
        <span class="page-link" style="opacity:0.4;cursor:default">Next →</span>
        @endif
    </div>
    @endif

    @else
    <div class="empty-state">
        <div class="empty-state-icon">🔭</div>
        <h3>Tidak ada prompt ditemukan</h3>
        <p>Coba kata kunci lain atau hapus filter yang aktif.</p>
        <a href="{{ route('home') }}" style="display:inline-block;margin-top:16px;color:var(--indigo);font-weight:600;text-decoration:none;">← Lihat semua prompt</a>
    </div>
    @endif
</div>

<!-- TOAST -->
<div class="toast" id="toast">✓ Prompt berhasil disalin!</div>

<script>
    let searchTimeout;
    document.getElementById('search-input').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => document.getElementById('search-form').submit(), 500);
    });

    function copyPrompt(promptId, btn, text) {
        navigator.clipboard.writeText(text).then(() => {
            btn.classList.add('copied');
            btn.innerHTML = '✓ Tersalin!';
            fetch(`/prompts/${promptId}/copy`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                // ✅ Real-time: update angka copy count langsung di DOM
                const countEl = document.getElementById(`copy-count-${promptId}`);
                if (countEl && data.count !== undefined) {
                    countEl.textContent = `· ${data.count.toLocaleString('id-ID')}×`;
                    countEl.style.color = 'var(--emerald)';
                    countEl.style.fontWeight = '600';
                    setTimeout(() => {
                        countEl.style.color = '';
                        countEl.style.fontWeight = '';
                    }, 2000);
                }
            });
            showToast();
            setTimeout(() => {
                btn.classList.remove('copied');
                btn.innerHTML = '📋 Copy';
            }, 2000);
        });
    }

    function showToast() {
        const toast = document.getElementById('toast');
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2500);
    }
</script>
</body>
</html>
