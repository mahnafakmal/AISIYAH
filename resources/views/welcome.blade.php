<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PT Ekonomi Aisyiyah Hasanah Makmur — Wastra, Busana &amp; Kriya Umat</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Fonts: Playfair Display & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            serif: ['"Playfair Display"', 'serif'],
          },
          colors: {
            brand: {
              50: '#f0fdf4',
              100: '#dcfce7',
              200: '#bbf7d0',
              300: '#86efac',
              400: '#4ade80',
              500: '#22c55e',
              600: '#16a34a',
              700: '#15803d',
              800: '#166534',
              900: '#14532d',
              950: '#0c2418',
            },
            sage: {
              50: '#f4f7f5',
              100: '#e9f0ec',
              200: '#d3e1d9',
            },
            gold: {
              400: '#facc15',
              500: '#eab308',
            }
          }
        }
      }
    };
  </script>
</head>
<body class="bg-white text-slate-800 font-sans antialiased selection:bg-brand-700 selection:text-white overflow-x-hidden">

  <!-- ==================== 1. BANNER PROMO ATAS (DINAMIS DARI ADMIN) ==================== -->
  <div id="storePromoBanner" class="bg-gradient-to-r from-brand-900 via-brand-800 to-brand-900 text-white border-b border-brand-700/60 transition-all">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-2.5 flex items-center justify-between gap-3">
      <div class="flex-1 flex flex-col sm:flex-row items-center justify-center gap-1.5 sm:gap-3 text-center text-xs sm:text-sm">
        <span id="promoBadgeTitle" class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-gold-400 text-brand-950 font-bold text-[11px] uppercase tracking-wider shrink-0">
          PROMO EKONOMI UMAT
        </span>
        <p id="promoBannerText" class="text-brand-50 font-medium">
          Diskon spesial hingga 20% untuk koleksi Wastra &amp; Kriya Pilihan!
        </p>
        <div class="flex items-center gap-2 shrink-0">
          <span class="text-brand-200 text-xs">Kode:</span>
          <button id="copyPromoCodeBtn" type="button" title="Klik untuk menyalin kode promo" class="px-2.5 py-0.5 rounded-md bg-white/15 hover:bg-white/25 border border-white/25 font-mono font-bold text-gold-400 text-xs transition-colors">
            AISYIYAH20
          </button>
          <span id="promoValidityText" class="hidden md:inline text-[11px] text-brand-200/80">
            · Berlaku s/d 31 Des 2026
          </span>
        </div>
      </div>
      <button id="dismissPromoBannerBtn" type="button" aria-label="Tutup sementara banner promo" class="p-1.5 rounded-lg text-brand-200 hover:text-white hover:bg-white/10 transition-colors shrink-0">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>

  <!-- ==================== 2. STICKY NAVBAR ==================== -->
  <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-sage-200 transition-all">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 h-20 flex items-center justify-between gap-4">
      <!-- Brand Logo Monogram -->
      <a href="#beranda" class="flex items-center gap-3 group min-w-0">
        <span id="navMonogramText" class="w-10 h-10 shrink-0 rounded-xl bg-brand-700 group-hover:bg-brand-800 text-white flex items-center justify-center font-serif font-bold text-base tracking-tight shadow-sm transition-colors">
          EA
        </span>
        <div class="min-w-0">
          <span id="navCompanyName" class="font-serif font-bold text-sm sm:text-base lg:text-lg text-slate-900 tracking-tight block leading-tight truncate">
            PT Ekonomi Aisyiyah Hasanah Makmur
          </span>
          <span id="navCompanyTagline" class="text-[10px] sm:text-[11px] font-semibold text-brand-700 tracking-widest uppercase block truncate">
            Wastra, Busana &amp; Kriya Umat
          </span>
        </div>
      </a>

      <!-- Desktop Menu -->
      <nav class="hidden lg:flex items-center gap-6 text-sm font-medium text-slate-600 shrink-0">
        <a href="#beranda" class="nav-link text-brand-700 font-semibold transition-colors">Beranda</a>
        <a href="#profil" class="nav-link hover:text-brand-700 transition-colors">Profil</a>
        <a href="#produk" class="nav-link hover:text-brand-700 transition-colors">Produk</a>
        <a href="#artikel" class="nav-link hover:text-brand-700 transition-colors">Artikel &amp; Berita</a>
        <a href="#kontak" class="nav-link hover:text-brand-700 transition-colors">Kontak</a>
      </nav>

      <!-- Action Buttons & Mobile Toggle -->
      <div class="flex items-center gap-2 shrink-0">
        <button id="adminNavBtn" type="button" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-brand-700 hover:bg-brand-800 text-white text-xs sm:text-sm font-semibold transition-all shadow-sm">
          <span id="adminStatusDot" class="hidden w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
          <svg id="adminLockIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
          </svg>
          <span id="adminNavBtnLabel">Login Admin</span>
        </button>

        <button id="mobileMenuBtn" type="button" aria-label="Buka Menu" class="lg:hidden p-2.5 rounded-xl text-slate-700 hover:bg-brand-50 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Dropdown -->
    <div id="mobileMenu" class="hidden lg:hidden bg-white border-b border-sage-200 px-4 py-4 space-y-1.5 shadow-lg">
      <a href="#beranda" class="mobile-link block px-4 py-2.5 rounded-xl text-sm font-semibold text-brand-700 bg-brand-50">Beranda</a>
      <a href="#profil" class="mobile-link block px-4 py-2.5 rounded-xl text-sm font-medium text-slate-700 hover:bg-sage-50">Profil</a>
      <a href="#produk" class="mobile-link block px-4 py-2.5 rounded-xl text-sm font-medium text-slate-700 hover:bg-sage-50">Produk</a>
      <a href="#artikel" class="mobile-link block px-4 py-2.5 rounded-xl text-sm font-medium text-slate-700 hover:bg-sage-50">Artikel &amp; Berita</a>
      <a href="#kontak" class="mobile-link block px-4 py-2.5 rounded-xl text-sm font-medium text-slate-700 hover:bg-sage-50">Kontak</a>
    </div>
  </header>

  <!-- ==================== 3. BERANDA (HERO SECTION) ==================== -->
  <section id="beranda" class="relative overflow-hidden bg-gradient-to-b from-brand-50/80 via-white to-white pt-12 pb-20 lg:py-24">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 grid lg:grid-cols-12 gap-12 items-center">
      <!-- Konten Kiri -->
      <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-100/90 text-brand-800 text-xs font-bold tracking-wide border border-brand-200">
          <span class="w-2 h-2 rounded-full bg-brand-600 animate-pulse"></span>
          <span id="heroBadgeText">Pemberdayaan Ekonomi Umat &amp; UMKM Binaan</span>
        </span>

        <h1 id="heroHeadlineText" class="font-serif text-4xl sm:text-5xl font-bold text-slate-900 leading-[1.15]">
          Karya Wastra, Busana &amp; Kriya Autentik untuk Kemandirian Ekonomi
        </h1>

        <p id="heroDescriptionText" class="text-slate-600 text-base sm:text-lg leading-relaxed">
          PT Ekonomi Aisyiyah Hasanah Makmur menghadirkan koleksi wastra Nusantara, busana muslimah dan etnik modern, aksesoris, hingga kerajinan tangan berkualitas hasil karya mitra pengrajin dan UMKM binaan.
        </p>

        <!-- Tombol CTA -->
        <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3.5 pt-1">
          <a id="heroPrimaryCtaBtn" href="#produk" class="px-7 py-3.5 rounded-full bg-brand-700 hover:bg-brand-800 text-white font-semibold text-sm transition-all shadow-md shadow-brand-700/15">
            Jelajahi Produk
          </a>
          <a id="heroSecondaryCtaBtn" href="#profil" class="px-7 py-3.5 rounded-full bg-white hover:bg-brand-50 text-brand-800 border border-brand-200 font-semibold text-sm transition-all">
            Tentang Perusahaan
          </a>
        </div>

        <!-- 3 Highlight Stats -->
        <div class="grid grid-cols-3 gap-4 pt-6 border-t border-sage-200">
          <div>
            <p id="heroStat1Val" class="font-serif text-2xl font-bold text-brand-800">100%</p>
            <p id="heroStat1Lbl" class="text-xs text-slate-500 mt-1">Karya Mitra &amp; Pengrajin</p>
          </div>
          <div>
            <p id="heroStat2Val" class="font-serif text-2xl font-bold text-brand-800">Terkurasi</p>
            <p id="heroStat2Lbl" class="text-xs text-slate-500 mt-1">Kualitas &amp; Ramah Alam</p>
          </div>
          <div>
            <p id="heroStat3Val" class="font-serif text-2xl font-bold text-brand-800">4.9 ★</p>
            <p id="heroStat3Lbl" class="text-xs text-slate-500 mt-1">Ulasan Pelanggan</p>
          </div>
        </div>
      </div>

      <!-- Gambar Utama Produk Wastra + Fallback SVG Elegan -->
      <div class="lg:col-span-6">
        <div class="relative rounded-3xl overflow-hidden shadow-xl border-4 border-white bg-sage-100 aspect-[4/3]">
          <img
            id="heroMainImage"
            src="https://images.unsplash.com/photo-1598033129183-c4f50c736f10?auto=format&fit=crop&w=1000&q=80"
            alt="Koleksi Wastra & Kriya PT Ekonomi Aisyiyah Hasanah Makmur"
            class="w-full h-full object-cover"
          />
          <!-- Fallback SVG jika gambar lambat/gagal dimuat -->
          <div id="heroSvgFallback" class="hidden w-full h-full bg-gradient-to-br from-brand-800 via-brand-700 to-emerald-600 flex flex-col items-center justify-center text-white p-8 text-center">
            <svg class="w-24 h-24 mb-4 text-brand-100" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2.5">
              <rect x="18" y="18" width="64" height="64" rx="14" />
              <path d="M18 50 L50 18 L82 50 L50 82 Z" />
              <circle cx="50" cy="50" r="12" />
            </svg>
            <p id="heroFallbackBrandName" class="font-serif text-2xl font-bold">PT Ekonomi Aisyiyah Hasanah Makmur</p>
            <p id="heroFallbackTagline" class="text-xs text-brand-100 mt-1">Wastra, Busana &amp; Kriya Autentik Nusantara</p>
          </div>

          <!-- Label Floating Bawah -->
          <div class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur-sm p-4 rounded-2xl border border-brand-100 shadow-sm flex items-center justify-between gap-3">
            <div>
              <p id="heroFloatingTag" class="text-[11px] font-bold text-brand-700 uppercase tracking-wider">Koleksi Unggulan</p>
              <p id="heroFloatingTitle" class="font-semibold text-slate-900 text-sm">Seri Wastra Alam, Busana &amp; Kriya Etnik</p>
            </div>
            <a id="heroFloatBtn" href="#produk" class="shrink-0 px-4 py-2 rounded-full bg-brand-700 hover:bg-brand-800 text-white text-xs font-semibold transition-colors">
              Lihat Katalog
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== 4. PROFIL PERUSAHAAN ==================== -->
  <section id="profil" class="py-20 bg-sage-50 border-t border-sage-200">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="max-w-2xl mb-12">
        <p id="profilEyebrow" class="text-xs font-bold tracking-widest text-brand-700 uppercase mb-2">Profil Perusahaan</p>
        <h2 id="profilTitle" class="font-serif text-3xl sm:text-4xl font-bold text-slate-900">Menggerakkan Ekonomi Umat, Melestarikan Karya Lokal</h2>
        <p id="profilIntro" class="text-slate-600 mt-3 leading-relaxed">
          PT Ekonomi Aisyiyah Hasanah Makmur hadir sebagai wadah kolaborasi usaha yang mengangkat potensi pengrajin lokal dan UMKM binaan melalui produk wastra, busana santun modern, dan kriya bernilai seni tinggi.
        </p>
      </div>

      <!-- Visi & Misi -->
      <div class="grid md:grid-cols-2 gap-6 mb-10">
        <div class="bg-white p-7 rounded-2xl border border-sage-200 shadow-sm">
          <span class="inline-block px-3.5 py-1 rounded-full bg-brand-50 text-brand-700 text-xs font-bold mb-3">Visi Perusahaan</span>
          <h3 id="visiTitle" class="font-serif text-xl font-bold text-slate-900 mb-2">Mewujudkan Kemandirian Ekonomi yang Berkemajuan &amp; Berkelanjutan</h3>
          <p id="visiDesc" class="text-sm text-slate-600 leading-relaxed">
            Menjadi perusahaan terpercaya dalam pengembangan dan pemasaran produk wastra, busana, serta kriya Nusantara yang berdaya saing tinggi dan membawa kemaslahatan bagi masyarakat.
          </p>
        </div>

        <div class="bg-white p-7 rounded-2xl border border-sage-200 shadow-sm">
          <span class="inline-block px-3.5 py-1 rounded-full bg-brand-50 text-brand-700 text-xs font-bold mb-3">Misi Perusahaan</span>
          <h3 id="misiTitle" class="font-serif text-xl font-bold text-slate-900 mb-2">Pemberdayaan Mitra UMKM &amp; Kurasi Kualitas</h3>
          <p id="misiDesc" class="text-sm text-slate-600 leading-relaxed">
            Mendampingi pengrajin tenun, pembatik, penjahit, dan perajin kriya dalam standarisasi mutu, inovasi desain kontemporer, serta perluasan akses pasar digital nasional.
          </p>
        </div>
      </div>

      <!-- 4 Pilar Keunggulan -->
      <div id="profilPillarsGrid" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5"></div>
    </div>
  </section>

  <!-- ==================== 5. BANNER PENCAPAIAN / STATISTIK (EMERALD GELAP & EMAS) ==================== -->
  <section id="pencapaian" class="relative overflow-hidden bg-brand-950 text-white py-16 sm:py-20 border-y border-brand-800/80">
    <img
      id="statsBgImage"
      src="https://images.unsplash.com/photo-1606760227091-3dd870d97f1d?auto=format&fit=crop&w=1600&q=80"
      alt="Suasana Workshop Pengrajin PT Ekonomi Aisyiyah Hasanah Makmur"
      onerror="this.style.display='none'"
      class="absolute inset-0 w-full h-full object-cover opacity-15 mix-blend-luminosity pointer-events-none"
    />
    <div class="absolute inset-0 bg-gradient-to-r from-brand-950 via-brand-950/90 to-brand-900/85 pointer-events-none"></div>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 grid lg:grid-cols-12 gap-10 items-center">
      <div class="lg:col-span-5 space-y-3">
        <div class="flex items-center gap-3">
          <span class="w-8 h-[2px] bg-gold-400"></span>
          <p id="statsSubtitle" class="text-[11px] sm:text-xs font-bold tracking-[0.18em] text-gold-400 uppercase">
            PENCAPAIAN PT EKONOMI AISYIYAH HASANAH MAKMUR
          </p>
        </div>
        <h2 id="statsHeadline" class="font-serif text-3xl sm:text-4xl font-bold text-white leading-tight">
          Tumbuh Bersama Karya yang Nyata
        </h2>
      </div>

      <div id="statsCountersGrid" class="lg:col-span-7 grid grid-cols-3 gap-4 sm:gap-8"></div>
    </div>
  </section>

  <!-- ==================== 6. KOLEKSI PRODUK UNGGULAN ==================== -->
  <section id="produk" class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
        <div>
          <p id="productSectionEyebrow" class="text-xs font-bold tracking-widest text-brand-700 uppercase mb-2">Katalog Pilihan</p>
          <h2 id="productSectionTitle" class="font-serif text-3xl sm:text-4xl font-bold text-slate-900">Koleksi Produk Unggulan</h2>
          <p id="productSectionSubtitle" class="text-slate-600 mt-2 max-w-xl">
            Pilih kategori di bawah ini dan pesan langsung melalui akun resmi PT Ekonomi Aisyiyah Hasanah Makmur di marketplace favorit Anda.
          </p>
        </div>

        <div id="categoryFilters" class="flex flex-wrap gap-2"></div>
      </div>

      <div id="productGrid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7"></div>
    </div>
  </section>

  <!-- ==================== 7. ARTIKEL & BERITA ==================== -->
  <section id="artikel" class="py-20 bg-sage-50 border-t border-sage-200">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
        <div>
          <p id="articleSectionEyebrow" class="text-xs font-bold tracking-widest text-brand-700 uppercase mb-2">Jurnal &amp; Kabar Terkini</p>
          <h2 id="articleSectionTitle" class="font-serif text-3xl sm:text-4xl font-bold text-slate-900">Artikel &amp; Berita Perusahaan</h2>
          <p id="articleSectionSubtitle" class="text-slate-600 mt-2 max-w-xl">
            Ikuti liputan kegiatan pemberdayaan ekonomi, kisah inspiratif para pengrajin binaan, serta tips merawat kain wastra dan produk kriya.
          </p>
        </div>

        <div id="articleCategoryFilters" class="flex flex-wrap gap-2"></div>
      </div>

      <div id="articleGrid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-7"></div>
    </div>
  </section>

  <!-- ==================== 8. KONTAK & AKUN MEDIA SOSIAL ==================== -->
  <section id="kontak" class="py-20 bg-brand-900 text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
      <div class="max-w-2xl mx-auto text-center mb-12">
        <p id="contactSectionEyebrow" class="text-xs font-bold tracking-widest text-brand-200 uppercase mb-2">Hubungi Kami</p>
        <h2 id="contactSectionTitle" class="font-serif text-3xl sm:text-4xl font-bold">Mari Terhubung &amp; Berkolaborasi</h2>
        <p id="contactSectionSubtitle" class="text-brand-100/85 text-sm sm:text-base mt-3 leading-relaxed">
          Punya pertanyaan seputar ketersediaan produk, pengadaan seragam/suvenir lembaga, atau kemitraan UMKM? Hubungi tim kami melalui kontak resmi berikut.
        </p>
      </div>

      <!-- 3 Kartu Informasi Kontak -->
      <div class="grid md:grid-cols-3 gap-6 mb-10">
        <div class="p-6 rounded-3xl bg-brand-800/70 border border-brand-700/70 text-center flex flex-col items-center">
          <div class="w-12 h-12 rounded-2xl bg-brand-700 text-brand-200 flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          <h3 class="font-bold text-white text-base">Workshop &amp; Galeri</h3>
          <p id="contactAddressText" class="text-sm text-brand-100/80 mt-2 leading-relaxed">
            Jl. K.H. Ahmad Dahlan No. 48, Yogyakarta 55122
          </p>
        </div>

        <div class="p-6 rounded-3xl bg-brand-800/70 border border-brand-700/70 text-center flex flex-col items-center">
          <div class="w-12 h-12 rounded-2xl bg-brand-700 text-brand-200 flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
          </div>
          <h3 class="font-bold text-white text-base">WhatsApp Layanan</h3>
          <p class="text-sm text-brand-100/80 mt-2 leading-relaxed">
            <span id="contactWhatsappDisplay">+62 812-3456-7890</span><br />
            <span id="contactHoursDisplay" class="text-xs text-brand-300">Senin – Sabtu, 08.30 – 17.00 WIB</span>
          </p>
        </div>

        <div class="p-6 rounded-3xl bg-brand-800/70 border border-brand-700/70 text-center flex flex-col items-center">
          <div class="w-12 h-12 rounded-2xl bg-brand-700 text-brand-200 flex items-center justify-center mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="font-bold text-white text-base">Email Resmi</h3>
          <p class="text-sm text-brand-100/80 mt-2 leading-relaxed">
            <span id="contactEmailDisplay">halo@aisyiyahhasanahmakmur.co.id</span><br />
            <span id="contactEmailSubDisplay" class="text-xs text-brand-300">Kemitraan &amp; Pengadaan Korporat</span>
          </p>
        </div>
      </div>

      <!-- Panel Akun Media Sosial Resmi -->
      <div class="bg-brand-950/70 border border-brand-800 rounded-3xl p-8 text-center">
        <p class="text-xs font-bold uppercase tracking-widest text-brand-200 mb-5">
          Ikuti &amp; Hubungi Akun Media Sosial Resmi Kami
        </p>
        <div class="flex flex-wrap items-center justify-center gap-3">
          <a id="socialInstagramLink" href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 hover:bg-white text-white hover:text-brand-900 border border-white/20 text-xs font-semibold transition-all">
            Instagram
          </a>
          <a id="socialTiktokLink" href="https://tiktok.com" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 hover:bg-white text-white hover:text-brand-900 border border-white/20 text-xs font-semibold transition-all">
            TikTok
          </a>
          <a id="socialFacebookLink" href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 hover:bg-white text-white hover:text-brand-900 border border-white/20 text-xs font-semibold transition-all">
            Facebook
          </a>
          <a id="socialYoutubeLink" href="https://youtube.com" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 hover:bg-white text-white hover:text-brand-900 border border-white/20 text-xs font-semibold transition-all">
            YouTube
          </a>
          <a id="socialWhatsappLink" href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-brand-500 hover:bg-brand-400 text-brand-950 text-xs font-bold transition-all shadow-sm">
            Chat WhatsApp
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== FOOTER ==================== -->
  <footer class="bg-brand-950 border-t border-brand-900 text-brand-200/75 py-8 px-4 text-center text-xs space-y-1.5">
    <p id="footerCopyrightText">&copy; 2026 PT Ekonomi Aisyiyah Hasanah Makmur. Seluruh hak cipta dilindungi.</p>
    <p id="footerTaglineText" class="text-[11px] text-brand-300/60">Membangun Kemandirian Ekonomi Umat Melalui Karya Wastra &amp; Kriya Nusantara.</p>
  </footer>

  <!-- ==================== MODAL PEMBACA ARTIKEL LENGKAP ==================== -->
  <div id="articleReaderModal" class="hidden fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm overflow-y-auto p-3 sm:p-6 flex items-center justify-center">
    <div class="bg-white rounded-3xl max-w-3xl w-full overflow-hidden shadow-2xl border border-sage-200 my-auto">
      <div class="relative aspect-[16/8] bg-sage-100">
        <img id="readerArticleImg" src="" alt="" class="w-full h-full object-cover" />
        <div id="readerArticleFallback" class="hidden w-full h-full bg-gradient-to-br from-brand-800 to-emerald-700 flex items-center justify-center text-white p-6">
          <span class="font-serif text-xl font-bold">Jurnal PT Ekonomi Aisyiyah Hasanah Makmur</span>
        </div>
        <button id="closeArticleReaderBtn" type="button" aria-label="Tutup Artikel" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/95 hover:bg-white text-slate-800 flex items-center justify-center shadow-md transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <div class="p-6 sm:p-8 space-y-4">
        <div class="flex flex-wrap items-center gap-3 text-xs">
          <span id="readerArticleCategory" class="px-3 py-1 rounded-full bg-brand-50 text-brand-700 font-bold">
            Berita Perusahaan
          </span>
          <span id="readerArticleDate" class="text-slate-500 font-medium">24 November 2026</span>
          <span class="text-slate-300">•</span>
          <span id="readerArticleAuthor" class="text-slate-600 font-semibold">Redaksi EA Hasanah</span>
        </div>

        <h3 id="readerArticleTitle" class="font-serif text-2xl sm:text-3xl font-bold text-slate-900 leading-snug">
          Judul Artikel
        </h3>

        <div id="readerArticleBody" class="text-slate-600 text-sm sm:text-base leading-relaxed space-y-4 pt-3 border-t border-sage-100"></div>

        <div class="pt-4 flex justify-end">
          <button id="closeArticleReaderBtn2" type="button" class="px-6 py-2.5 rounded-full bg-brand-700 hover:bg-brand-800 text-white text-xs sm:text-sm font-semibold transition-colors">
            Tutup Artikel
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- ==================== 9. MODAL LOGIN ADMIN ==================== -->
  <div id="adminLoginModal" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-7 sm:p-8 shadow-2xl border border-sage-200 relative">
      <button id="closeLoginModalBtn" type="button" aria-label="Tutup" class="absolute top-5 right-5 p-2 rounded-full text-slate-400 hover:text-slate-700 hover:bg-sage-50 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

      <div class="flex items-center gap-3 mb-5">
        <span id="loginModalMonogram" class="w-11 h-11 rounded-2xl bg-brand-700 text-white flex items-center justify-center font-serif font-bold text-lg">
          EA
        </span>
        <div>
          <h3 class="font-serif text-xl font-bold text-slate-900">Login Admin</h3>
          <p class="text-xs text-slate-500">Panel Pengelola Seluruh Konten Website</p>
        </div>
      </div>

      <div class="bg-brand-50 border border-brand-200 rounded-2xl p-3.5 mb-5 text-xs text-brand-900">
        <p class="font-bold text-brand-800 mb-1">Akun Demo Administrator:</p>
        <div class="flex items-center justify-between gap-2">
          <span>User: <code class="font-mono font-bold bg-white px-1.5 py-0.5 rounded border border-brand-200">admin</code></span>
          <span>Pass: <code class="font-mono font-bold bg-white px-1.5 py-0.5 rounded border border-brand-200">admin123</code></span>
          <button id="autoFillLoginBtn" type="button" class="text-brand-700 underline font-bold hover:text-brand-900">
            Isi Otomatis
          </button>
        </div>
      </div>

      <form id="adminLoginForm" class="space-y-4">
        <div>
          <label for="adminUsername" class="block text-xs font-bold text-slate-700 mb-1.5">Username</label>
          <input id="adminUsername" type="text" required placeholder="Masukkan username admin" class="w-full px-4 py-2.5 rounded-xl border border-sage-200 text-sm focus:outline-none focus:border-brand-600" />
        </div>
        <div>
          <label for="adminPassword" class="block text-xs font-bold text-slate-700 mb-1.5">Password</label>
          <input id="adminPassword" type="password" required placeholder="Masukkan password" class="w-full px-4 py-2.5 rounded-xl border border-sage-200 text-sm focus:outline-none focus:border-brand-600" />
        </div>
        <p id="loginErrorMsg" class="hidden text-xs font-semibold text-red-600 bg-red-50 border border-red-200 px-3.5 py-2 rounded-xl">
          Username atau password salah. Gunakan admin / admin123.
        </p>
        <button type="submit" class="w-full py-3 rounded-xl bg-brand-700 hover:bg-brand-800 text-white font-semibold text-sm transition-colors shadow-sm">
          Masuk ke Dashboard Admin
        </button>
      </form>
    </div>
  </div>

  <!-- ==================== DASHBOARD ADMIN LENGKAP (5 TAB) ==================== -->
  <div id="adminDashboardModal" class="hidden fixed inset-0 z-50 bg-slate-950/75 backdrop-blur-sm overflow-y-auto p-2 sm:p-6">
    <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-2xl border border-sage-200 overflow-hidden my-2">
      <!-- Top Bar Dashboard Admin -->
      <div class="bg-brand-900 text-white px-5 sm:px-6 py-5 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
          <span id="dashMonogram" class="w-10 h-10 rounded-xl bg-brand-700 text-gold-400 flex items-center justify-center font-serif font-bold text-lg border border-brand-600 shrink-0">
            EA
          </span>
          <div>
            <div class="flex items-center gap-2">
              <h2 class="font-serif text-lg sm:text-xl font-bold">Dashboard Admin Lengkap</h2>
              <span class="px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-[10px] font-bold uppercase">Kendali Penuh</span>
            </div>
            <p class="text-xs text-brand-200">Ubah kategori, produk, harga promo, artikel, beranda, profil, statistik, kontak &amp; footer secara real-time</p>
          </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
          <button id="adminLogoutBtn" type="button" class="px-3.5 py-2 rounded-xl bg-red-500/20 hover:bg-red-500/30 text-red-200 border border-red-400/30 text-xs font-semibold transition-colors">
            Logout
          </button>
          <button id="closeDashboardBtn" type="button" class="px-4 py-2 rounded-xl bg-white text-brand-900 hover:bg-brand-50 text-xs font-bold transition-colors">
            Tutup Panel
          </button>
        </div>
      </div>

      <!-- Navigasi 5 Tab Dashboard -->
      <div class="bg-sage-50 border-b border-sage-200 px-4 sm:px-6 pt-3 flex gap-1.5 overflow-x-auto">
        <button type="button" data-admin-tab="products" class="admin-tab-btn px-4 py-3 rounded-t-2xl text-xs sm:text-sm font-bold bg-white text-brand-800 border-t border-x border-sage-200 -mb-px whitespace-nowrap">
          1. Produk &amp; Kategori (<span id="adminProductCount">6</span>)
        </button>
        <button type="button" data-admin-tab="promo" class="admin-tab-btn px-4 py-3 rounded-t-2xl text-xs sm:text-sm font-semibold text-slate-600 hover:text-brand-800 whitespace-nowrap">
          2. Promo &amp; Diskon
        </button>
        <button type="button" data-admin-tab="articles" class="admin-tab-btn px-4 py-3 rounded-t-2xl text-xs sm:text-sm font-semibold text-slate-600 hover:text-brand-800 whitespace-nowrap">
          3. Artikel &amp; Berita (<span id="adminArticleCount">3</span>)
        </button>
        <button type="button" data-admin-tab="heroProfil" class="admin-tab-btn px-4 py-3 rounded-t-2xl text-xs sm:text-sm font-semibold text-slate-600 hover:text-brand-800 whitespace-nowrap">
          4. Beranda &amp; Profil
        </button>
        <button type="button" data-admin-tab="statsContact" class="admin-tab-btn px-4 py-3 rounded-t-2xl text-xs sm:text-sm font-semibold text-slate-600 hover:text-brand-800 whitespace-nowrap">
          5. Pencapaian, Kontak &amp; Footer
        </button>
      </div>

      <!-- ==================== TAB 1: PRODUK & KATEGORI ==================== -->
      <div id="adminTab-products" class="admin-tab-panel p-5 sm:p-6 space-y-6">
        <!-- Kelola Kategori Produk Dinamis -->
        <div class="bg-sage-50 border border-sage-200 rounded-2xl p-4 sm:p-5 space-y-3">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
              <h3 class="font-bold text-slate-900 text-sm sm:text-base">Kategori Produk Dinamis</h3>
              <p class="text-xs text-slate-500">Tambah atau hapus kategori produk yang tampil di filter katalog.</p>
            </div>
            <form id="addProductCategoryForm" class="flex gap-2">
              <input id="newProductCategoryInput" type="text" required placeholder="Nama kategori baru..." class="px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm focus:outline-none focus:border-brand-600" />
              <button type="submit" class="px-4 py-2 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs font-bold transition-colors shrink-0">
                + Kategori
              </button>
            </form>
          </div>
          <div id="adminProductCategoryBadges" class="flex flex-wrap gap-2 pt-1"></div>
        </div>

        <!-- Bar Tambah Barang -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-brand-50/70 border border-brand-200 p-4 rounded-2xl">
          <div>
            <h3 class="font-bold text-slate-900 text-base">Daftar Barang &amp; Harga</h3>
            <p class="text-xs text-slate-600 mt-0.5">Tambah barang baru, edit detail &amp; link marketplace, atau atur harga normal dan harga promo.</p>
          </div>
          <button id="openAddProductFormBtn" type="button" class="shrink-0 inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs sm:text-sm font-bold transition-colors shadow-sm">
            + Tambah Barang Baru
          </button>
        </div>

        <!-- Form Tambah / Edit Barang -->
        <div id="productEditorCard" class="hidden bg-sage-50 border border-brand-300 rounded-2xl p-6 shadow-inner">
          <div class="flex items-center justify-between mb-4 pb-3 border-b border-sage-200">
            <h4 id="productFormTitle" class="font-serif text-lg font-bold text-brand-900">Tambah Barang Baru</h4>
            <button id="cancelProductFormBtn" type="button" class="text-xs font-semibold text-slate-500 hover:text-slate-800">Batal ✕</button>
          </div>

          <form id="productEditorForm" class="space-y-4">
            <input type="hidden" id="editProductId" />

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Barang *</label>
                <input id="prodName" type="text" required placeholder="Nama produk" class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Kategori *</label>
                <select id="prodCategory" class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600"></select>
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Label Badge</label>
                <input id="prodBadge" type="text" placeholder="Contoh: Terlaris / Promo" class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600" />
              </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Harga Normal (Rp) *</label>
                <input id="prodPrice" type="number" min="1000" step="500" required placeholder="385000" class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600" />
              </div>
              <div>
                <label class="block text-xs font-bold text-brand-700 mb-1">Harga Promo (Rp) <span class="font-normal text-slate-500">(Kosongkan jika tidak promo)</span></label>
                <input id="prodPromoPrice" type="number" min="0" step="500" placeholder="320000" class="w-full px-3.5 py-2 rounded-xl border border-brand-300 bg-white text-sm focus:outline-none focus:border-brand-600" />
              </div>
            </div>

            <div>
              <div class="flex flex-wrap items-center justify-between gap-2 mb-1">
                <label class="block text-xs font-bold text-slate-700">URL Foto Barang</label>
                <div class="flex flex-wrap gap-1.5">
                  <span class="text-[11px] text-slate-500">Foto Contoh:</span>
                  <button type="button" data-sample-target="prodImage" data-sample-img="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=800&q=80" class="sample-img-btn text-[11px] px-2 py-0.5 rounded bg-brand-100 text-brand-800 font-semibold hover:bg-brand-200">Tenun</button>
                  <button type="button" data-sample-target="prodImage" data-sample-img="https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?auto=format&fit=crop&w=800&q=80" class="sample-img-btn text-[11px] px-2 py-0.5 rounded bg-brand-100 text-brand-800 font-semibold hover:bg-brand-200">Batik</button>
                  <button type="button" data-sample-target="prodImage" data-sample-img="https://images.unsplash.com/photo-1590874103328-eac38a683ce7?auto=format&fit=crop&w=800&q=80" class="sample-img-btn text-[11px] px-2 py-0.5 rounded bg-brand-100 text-brand-800 font-semibold hover:bg-brand-200">Tas Anyam</button>
                  <button type="button" data-sample-target="prodImage" data-sample-img="https://images.unsplash.com/photo-1610701596007-11502861dcfa?auto=format&fit=crop&w=800&q=80" class="sample-img-btn text-[11px] px-2 py-0.5 rounded bg-brand-100 text-brand-800 font-semibold hover:bg-brand-200">Kriya Kayu</button>
                </div>
              </div>
              <input id="prodImage" type="url" placeholder="https://..." class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600" />
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Barang *</label>
              <textarea id="prodDesc" rows="2" required placeholder="Tuliskan detail bahan, ukuran, dan keunggulan produk..." class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600"></textarea>
            </div>

            <div class="grid sm:grid-cols-3 gap-3">
              <div>
                <label class="block text-[11px] font-bold text-slate-600 mb-1">Link Shopee (Kosongkan = Default Toko)</label>
                <input id="prodShopee" type="url" placeholder="https://shopee.co.id/..." class="w-full px-3 py-1.5 rounded-xl border border-sage-200 bg-white text-xs" />
              </div>
              <div>
                <label class="block text-[11px] font-bold text-slate-600 mb-1">Link Tokopedia (Kosongkan = Default Toko)</label>
                <input id="prodTokopedia" type="url" placeholder="https://tokopedia.com/..." class="w-full px-3 py-1.5 rounded-xl border border-sage-200 bg-white text-xs" />
              </div>
              <div>
                <label class="block text-[11px] font-bold text-slate-600 mb-1">Link TikTok Shop (Kosongkan = Default Toko)</label>
                <input id="prodTiktok" type="url" placeholder="https://tiktok.com/..." class="w-full px-3 py-1.5 rounded-xl border border-sage-200 bg-white text-xs" />
              </div>
            </div>

            <div class="flex justify-end gap-2.5 pt-2">
              <button type="button" id="cancelProductFormBtn2" class="px-4 py-2.5 rounded-xl bg-white border border-sage-200 text-slate-700 text-xs font-semibold hover:bg-sage-50">Batal</button>
              <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs font-bold transition-colors shadow-sm">Simpan Barang</button>
            </div>
          </form>
        </div>

        <!-- Tabel Daftar Produk -->
        <div class="overflow-x-auto border border-sage-200 rounded-2xl">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-sage-50 border-b border-sage-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                <th class="py-3.5 px-4">Produk</th>
                <th class="py-3.5 px-4">Kategori</th>
                <th class="py-3.5 px-4">Harga Normal</th>
                <th class="py-3.5 px-4">Harga Promo</th>
                <th class="py-3.5 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody id="adminProductTableBody" class="divide-y divide-sage-100 text-sm"></tbody>
          </table>
        </div>
      </div>

      <!-- ==================== TAB 2: PROMO & DISKON ==================== -->
      <div id="adminTab-promo" class="admin-tab-panel hidden p-5 sm:p-6 space-y-6">
        <div class="grid lg:grid-cols-12 gap-6">
          <!-- Banner Pengumuman Promo -->
          <div class="lg:col-span-7 bg-white border border-sage-200 rounded-2xl p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-sage-100">
              <div>
                <h3 class="font-bold text-slate-900 text-base">Banner Pengumuman Promo Toko</h3>
                <p class="text-xs text-slate-500">Atur teks penawaran &amp; kode voucher di bar atas website.</p>
              </div>
              <label class="inline-flex items-center gap-2 cursor-pointer">
                <input id="promoActiveToggle" type="checkbox" checked class="w-5 h-5 accent-brand-700 rounded" />
                <span class="text-xs font-bold text-brand-800">Aktifkan Banner</span>
              </label>
            </div>

            <form id="promoSettingsForm" class="space-y-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Judul Badge Promo</label>
                <input id="inputPromoTitle" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 text-sm focus:outline-none focus:border-brand-600" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Teks Penawaran Promo</label>
                <input id="inputPromoDesc" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 text-sm focus:outline-none focus:border-brand-600" />
              </div>
              <div class="grid sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Kode Voucher</label>
                  <input id="inputPromoCode" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 font-mono text-sm uppercase focus:outline-none focus:border-brand-600" />
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Masa Berlaku</label>
                  <input id="inputPromoValidity" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 text-sm focus:outline-none focus:border-brand-600" />
                </div>
              </div>
              <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs font-bold transition-colors shadow-sm">
                Simpan Pengaturan Promo
              </button>
            </form>
          </div>

          <!-- Diskon Massal per Kategori atau Semua Barang -->
          <div class="lg:col-span-5 bg-brand-50/70 border border-brand-200 rounded-2xl p-6 space-y-4 flex flex-col justify-between">
            <div class="space-y-3">
              <span class="inline-block px-3 py-1 rounded-full bg-brand-100 text-brand-800 text-[11px] font-bold uppercase">Promo Cepat Katalog</span>
              <h3 class="font-bold text-slate-900 text-base">Diskon Persentase Massal</h3>
              <p class="text-xs text-slate-600 leading-relaxed">
                Terapkan potongan harga otomatis ke seluruh barang atau khusus pada kategori tertentu.
              </p>

              <div class="pt-1 space-y-3">
                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Target Kategori</label>
                  <select id="bulkDiscountCategory" class="w-full px-3.5 py-2 rounded-xl border border-brand-300 bg-white text-xs sm:text-sm font-semibold"></select>
                </div>

                <div>
                  <label class="block text-xs font-bold text-slate-700 mb-1">Persentase Diskon (%)</label>
                  <div class="flex gap-2">
                    <input id="bulkDiscountPercent" type="number" min="5" max="85" value="15" class="w-24 px-3.5 py-2 rounded-xl border border-brand-300 bg-white text-sm font-bold text-center" />
                    <button id="applyBulkDiscountBtn" type="button" class="flex-1 px-4 py-2 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs font-bold transition-colors">
                      Terapkan Diskon
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="pt-4 border-t border-brand-200">
              <button id="clearAllDiscountsBtn" type="button" class="w-full py-2.5 px-4 rounded-xl bg-white hover:bg-red-50 text-red-700 border border-red-200 text-xs font-bold transition-colors">
                Reset Semua Harga Promo Produk
              </button>
            </div>
          </div>
        </div>

        <!-- Link Marketplace Default Global -->
        <div class="bg-sage-50 border border-sage-200 rounded-2xl p-6">
          <h3 class="font-bold text-slate-900 text-base mb-1">Tautan Toko Marketplace Utama (Default Global)</h3>
          <p class="text-xs text-slate-500 mb-4">Digunakan sebagai link bawaan untuk produk yang tidak memiliki link marketplace khusus.</p>
          <form id="defaultMarketplacesForm" class="grid sm:grid-cols-3 gap-4 items-end">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">URL Toko Shopee</label>
              <input id="defaultShopeeUrl" type="url" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">URL Toko Tokopedia</label>
              <input id="defaultTokopediaUrl" type="url" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
            </div>
            <div class="flex gap-2">
              <div class="flex-1">
                <label class="block text-xs font-bold text-slate-700 mb-1">URL TikTok Shop</label>
                <input id="defaultTiktokUrl" type="url" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
              </div>
              <button type="submit" class="px-4 py-2 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs font-bold transition-colors shrink-0 h-[38px]">
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- ==================== TAB 3: ARTIKEL & BERITA ==================== -->
      <div id="adminTab-articles" class="admin-tab-panel hidden p-5 sm:p-6 space-y-6">
        <!-- Kelola Kategori Artikel Dinamis -->
        <div class="bg-sage-50 border border-sage-200 rounded-2xl p-4 sm:p-5 space-y-3">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
              <h3 class="font-bold text-slate-900 text-sm sm:text-base">Kategori Artikel &amp; Berita Dinamis</h3>
              <p class="text-xs text-slate-500">Tambah atau hapus kategori artikel pada portal berita perusahaan.</p>
            </div>
            <form id="addArticleCategoryForm" class="flex gap-2">
              <input id="newArticleCategoryInput" type="text" required placeholder="Nama kategori artikel..." class="px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm focus:outline-none focus:border-brand-600" />
              <button type="submit" class="px-4 py-2 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs font-bold transition-colors shrink-0">
                + Kategori
              </button>
            </form>
          </div>
          <div id="adminArticleCategoryBadges" class="flex flex-wrap gap-2 pt-1"></div>
        </div>

        <!-- Bar Tulis Artikel -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-brand-50/70 border border-brand-200 p-4 rounded-2xl">
          <div>
            <h3 class="font-bold text-slate-900 text-base">Daftar Artikel &amp; Berita</h3>
            <p class="text-xs text-slate-600 mt-0.5">Publikasikan berita kegiatan, kisah pengrajin binaan, atau tips perawatan wastra dan kriya.</p>
          </div>
          <button id="openAddArticleFormBtn" type="button" class="shrink-0 inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs sm:text-sm font-bold transition-colors shadow-sm">
            + Tulis Artikel / Berita Baru
          </button>
        </div>

        <!-- Form Tambah / Edit Artikel -->
        <div id="articleEditorCard" class="hidden bg-sage-50 border border-brand-300 rounded-2xl p-6 shadow-inner">
          <div class="flex items-center justify-between mb-4 pb-3 border-b border-sage-200">
            <h4 id="articleFormTitle" class="font-serif text-lg font-bold text-brand-900">Tulis Artikel Baru</h4>
            <button id="cancelArticleFormBtn" type="button" class="text-xs font-semibold text-slate-500 hover:text-slate-800">Batal ✕</button>
          </div>

          <form id="articleEditorForm" class="space-y-4">
            <input type="hidden" id="editArticleId" />

            <div class="grid sm:grid-cols-3 gap-4">
              <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Judul Artikel / Berita *</label>
                <input id="artTitle" type="text" required placeholder="Masukkan judul berita atau artikel" class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Kategori *</label>
                <select id="artCategory" class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600"></select>
              </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Publikasi *</label>
                <input id="artDate" type="text" required placeholder="Contoh: 25 November 2026" class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Penulis *</label>
                <input id="artAuthor" type="text" required placeholder="Redaksi EA Hasanah" class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600" />
              </div>
              <div>
                <div class="flex items-center justify-between gap-2 mb-1">
                  <label class="block text-xs font-bold text-slate-700">URL Foto Sampul</label>
                  <div class="flex gap-1">
                    <button type="button" data-sample-target="artImage" data-sample-img="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?auto=format&fit=crop&w=900&q=80" class="sample-img-btn text-[10px] px-1.5 py-0.5 rounded bg-brand-100 text-brand-800 font-semibold hover:bg-brand-200">Wastra</button>
                    <button type="button" data-sample-target="artImage" data-sample-img="https://images.unsplash.com/photo-1606760227091-3dd870d97f1d?auto=format&fit=crop&w=900&q=80" class="sample-img-btn text-[10px] px-1.5 py-0.5 rounded bg-brand-100 text-brand-800 font-semibold hover:bg-brand-200">Kriya</button>
                    <button type="button" data-sample-target="artImage" data-sample-img="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=900&q=80" class="sample-img-btn text-[10px] px-1.5 py-0.5 rounded bg-brand-100 text-brand-800 font-semibold hover:bg-brand-200">Acara</button>
                  </div>
                </div>
                <input id="artImage" type="url" placeholder="https://..." class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600" />
              </div>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Ringkasan Singkat (Excerpt) *</label>
              <textarea id="artExcerpt" rows="2" required placeholder="Ringkasan 1-2 kalimat yang muncul di kartu artikel..." class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600"></textarea>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Isi Lengkap Artikel / Berita * <span class="font-normal text-slate-500">(Pisahkan paragraf dengan Enter)</span></label>
              <textarea id="artContent" rows="5" required placeholder="Tuliskan isi berita atau artikel selengkapnya..." class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm focus:outline-none focus:border-brand-600"></textarea>
            </div>

            <div class="flex justify-end gap-2.5 pt-2">
              <button type="button" id="cancelArticleFormBtn2" class="px-4 py-2.5 rounded-xl bg-white border border-sage-200 text-slate-700 text-xs font-semibold hover:bg-sage-50">Batal</button>
              <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs font-bold transition-colors shadow-sm">Simpan Artikel</button>
            </div>
          </form>
        </div>

        <!-- Tabel Daftar Artikel -->
        <div class="overflow-x-auto border border-sage-200 rounded-2xl">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-sage-50 border-b border-sage-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                <th class="py-3.5 px-4">Judul Artikel / Berita</th>
                <th class="py-3.5 px-4">Kategori</th>
                <th class="py-3.5 px-4">Penulis &amp; Tanggal</th>
                <th class="py-3.5 px-4 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody id="adminArticleTableBody" class="divide-y divide-sage-100 text-sm"></tbody>
          </table>
        </div>
      </div>

      <!-- ==================== TAB 4: BERANDA & PROFIL ==================== -->
      <div id="adminTab-heroProfil" class="admin-tab-panel hidden p-5 sm:p-6">
        <form id="heroProfilForm" class="space-y-6">
          <!-- Identitas Brand & Navbar -->
          <div class="bg-sage-50/70 border border-sage-200 rounded-2xl p-5 space-y-4">
            <h3 class="font-serif text-lg font-bold text-brand-900 border-b border-sage-200 pb-2">Identitas Brand &amp; Navigasi Atas</h3>
            <div class="grid sm:grid-cols-12 gap-4">
              <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Monogram</label>
                <input id="editBrandMonogram" type="text" maxlength="4" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm font-serif font-bold text-center uppercase" />
              </div>
              <div class="sm:col-span-5">
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Perusahaan</label>
                <input id="editCompanyName" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm" />
              </div>
              <div class="sm:col-span-5">
                <label class="block text-xs font-bold text-slate-700 mb-1">Subjudul / Tagline Brand</label>
                <input id="editCompanyTagline" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm" />
              </div>
            </div>
          </div>

          <!-- Bagian Beranda / Hero -->
          <div class="bg-sage-50/70 border border-sage-200 rounded-2xl p-5 space-y-4">
            <h3 class="font-serif text-lg font-bold text-brand-900 border-b border-sage-200 pb-2">Pengaturan Beranda (Hero Section)</h3>

            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Badge Atas Hero</label>
                <input id="editHeroBadge" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm" />
              </div>
              <div>
                <div class="flex items-center justify-between mb-1">
                  <label class="block text-xs font-bold text-slate-700">URL Gambar Utama Hero</label>
                  <div class="flex gap-1">
                    <button type="button" data-sample-target="editHeroImage" data-sample-img="https://images.unsplash.com/photo-1598033129183-c4f50c736f10?auto=format&fit=crop&w=1000&q=80" class="sample-img-btn text-[10px] px-1.5 py-0.5 rounded bg-brand-100 text-brand-800 font-semibold">Wastra 1</button>
                    <button type="button" data-sample-target="editHeroImage" data-sample-img="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=1000&q=80" class="sample-img-btn text-[10px] px-1.5 py-0.5 rounded bg-brand-100 text-brand-800 font-semibold">Tenun 2</button>
                  </div>
                </div>
                <input id="editHeroImage" type="url" class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm" />
              </div>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Judul Utama Hero (Headline)</label>
              <input id="editHeroHeadline" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm" />
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Hero</label>
              <textarea id="editHeroDesc" rows="2" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm"></textarea>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-3">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Teks Tombol Utama</label>
                <input id="editHeroPrimaryCta" type="text" required class="w-full px-3 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Teks Tombol Kedua</label>
                <input id="editHeroSecondaryCta" type="text" required class="w-full px-3 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Tag Kartu Foto</label>
                <input id="editHeroFloatTag" type="text" class="w-full px-3 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Judul Kartu Foto</label>
                <input id="editHeroFloatTitle" type="text" class="w-full px-3 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Tombol Kartu Foto</label>
                <input id="editHeroFloatBtn" type="text" class="w-full px-3 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
              </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-3 pt-1">
              <div class="bg-white p-3 rounded-xl border border-sage-200 space-y-2">
                <p class="text-[11px] font-bold text-brand-700 uppercase">Highlight 1</p>
                <input id="editHeroStat1Val" type="text" placeholder="Nilai" class="w-full px-2.5 py-1.5 rounded-lg border border-sage-200 text-xs font-bold" />
                <input id="editHeroStat1Lbl" type="text" placeholder="Keterangan" class="w-full px-2.5 py-1.5 rounded-lg border border-sage-200 text-xs" />
              </div>
              <div class="bg-white p-3 rounded-xl border border-sage-200 space-y-2">
                <p class="text-[11px] font-bold text-brand-700 uppercase">Highlight 2</p>
                <input id="editHeroStat2Val" type="text" placeholder="Nilai" class="w-full px-2.5 py-1.5 rounded-lg border border-sage-200 text-xs font-bold" />
                <input id="editHeroStat2Lbl" type="text" placeholder="Keterangan" class="w-full px-2.5 py-1.5 rounded-lg border border-sage-200 text-xs" />
              </div>
              <div class="bg-white p-3 rounded-xl border border-sage-200 space-y-2">
                <p class="text-[11px] font-bold text-brand-700 uppercase">Highlight 3</p>
                <input id="editHeroStat3Val" type="text" placeholder="Nilai" class="w-full px-2.5 py-1.5 rounded-lg border border-sage-200 text-xs font-bold" />
                <input id="editHeroStat3Lbl" type="text" placeholder="Keterangan" class="w-full px-2.5 py-1.5 rounded-lg border border-sage-200 text-xs" />
              </div>
            </div>
          </div>

          <!-- Bagian Profil, Visi, Misi & 4 Pilar -->
          <div class="bg-sage-50/70 border border-sage-200 rounded-2xl p-5 space-y-4">
            <h3 class="font-serif text-lg font-bold text-brand-900 border-b border-sage-200 pb-2">Pengaturan Profil Perusahaan, Visi, Misi &amp; 4 Pilar</h3>

            <div class="grid sm:grid-cols-3 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Eyebrow Profil</label>
                <input id="editProfilEyebrow" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm" />
              </div>
              <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Judul Bagian Profil</label>
                <input id="editProfilTitle" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm" />
              </div>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Paragraf Pengantar Profil</label>
              <textarea id="editProfilIntro" rows="2" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm"></textarea>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
              <div class="bg-white p-4 rounded-xl border border-sage-200 space-y-2">
                <p class="text-xs font-bold text-brand-700">Kartu Visi Perusahaan</p>
                <input id="editVisiTitle" type="text" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs font-bold" />
                <textarea id="editVisiDesc" rows="2" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs"></textarea>
              </div>
              <div class="bg-white p-4 rounded-xl border border-sage-200 space-y-2">
                <p class="text-xs font-bold text-brand-700">Kartu Misi Perusahaan</p>
                <input id="editMisiTitle" type="text" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs font-bold" />
                <textarea id="editMisiDesc" rows="2" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs"></textarea>
              </div>
            </div>

            <div id="adminPillarsInputs" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-3"></div>
          </div>

          <div class="flex justify-end">
            <button type="submit" class="px-7 py-3 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs sm:text-sm font-bold transition-colors shadow-sm">
              Simpan Perubahan Beranda &amp; Profil
            </button>
          </div>
        </form>
      </div>

      <!-- ==================== TAB 5: PENCAPAIAN, KONTAK & FOOTER ==================== -->
      <div id="adminTab-statsContact" class="admin-tab-panel hidden p-5 sm:p-6 space-y-6">
        <form id="statsContactForm" class="space-y-6">
          <!-- Pengaturan Banner Pencapaian / Statistik (100% Editable + Tambah/Hapus Item) -->
          <div class="bg-brand-50/80 border-2 border-brand-300 rounded-2xl p-5 space-y-4 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-brand-200 pb-3">
              <div>
                <div class="flex items-center gap-2">
                  <span class="px-2.5 py-0.5 rounded-full bg-brand-950 text-gold-400 text-[10px] font-bold uppercase tracking-wider">Banner Pencapaian</span>
                  <h3 class="font-serif text-lg font-bold text-brand-950">Pengaturan Pencapaian &amp; Statistik</h3>
                </div>
                <p class="text-xs text-slate-600 mt-0.5">Ubah subjudul emas, judul utama, gambar latar, serta angka, akhiran (+), dan label statistik (500+ PRODUK, 100+ PROYEK, 1.000+ PELANGGAN).</p>
              </div>
              <button type="button" id="addStatItemBtn" class="shrink-0 px-3.5 py-2 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs font-bold transition-colors shadow-sm">
                + Tambah Statistik
              </button>
            </div>

            <div class="grid sm:grid-cols-3 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Subjudul Emas (Eyebrow)</label>
                <input id="editStatsSubtitle" type="text" required placeholder="PENCAPAIAN PT EKONOMI AISYIYAH HASANAH MAKMUR" class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Judul Banner Statistik</label>
                <input id="editStatsHeadline" type="text" required placeholder="Tumbuh Bersama Karya yang Nyata" class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm" />
              </div>
              <div>
                <div class="flex items-center justify-between mb-1">
                  <label class="block text-xs font-bold text-slate-700">URL Gambar Latar Statistik</label>
                  <button type="button" data-sample-target="editStatsBgImage" data-sample-img="https://images.unsplash.com/photo-1606760227091-3dd870d97f1d?auto=format&fit=crop&w=1600&q=80" class="sample-img-btn text-[10px] px-1.5 py-0.5 rounded bg-brand-100 text-brand-800 font-semibold hover:bg-brand-200">Workshop</button>
                </div>
                <input id="editStatsBgImage" type="url" placeholder="https://..." class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-sm" />
              </div>
            </div>

            <div id="adminStatsInputs" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4"></div>
          </div>

          <!-- Pengaturan Judul & Subjudul Seksi Produk, Artikel, Kontak -->
          <div class="bg-sage-50/70 border border-sage-200 rounded-2xl p-5 space-y-4">
            <h3 class="font-serif text-lg font-bold text-brand-900 border-b border-sage-200 pb-2">Judul &amp; Subjudul Seksi Produk, Artikel &amp; Kontak</h3>

            <div class="grid md:grid-cols-3 gap-4">
              <div class="bg-white p-4 rounded-xl border border-sage-200 space-y-2">
                <p class="text-xs font-bold text-brand-700">Seksi Katalog Produk</p>
                <input id="editProdSecEyebrow" type="text" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs" />
                <input id="editProdSecTitle" type="text" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs font-bold" />
                <textarea id="editProdSecSub" rows="2" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs"></textarea>
              </div>

              <div class="bg-white p-4 rounded-xl border border-sage-200 space-y-2">
                <p class="text-xs font-bold text-brand-700">Seksi Artikel &amp; Berita</p>
                <input id="editArtSecEyebrow" type="text" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs" />
                <input id="editArtSecTitle" type="text" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs font-bold" />
                <textarea id="editArtSecSub" rows="2" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs"></textarea>
              </div>

              <div class="bg-white p-4 rounded-xl border border-sage-200 space-y-2">
                <p class="text-xs font-bold text-brand-700">Seksi Kontak &amp; Media Sosial</p>
                <input id="editContactSecEyebrow" type="text" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs" />
                <input id="editContactSecTitle" type="text" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs font-bold" />
                <textarea id="editContactSecSub" rows="2" required class="w-full px-3 py-1.5 rounded-lg border border-sage-200 text-xs"></textarea>
              </div>
            </div>
          </div>

          <!-- Pengaturan Detail Kontak, Media Sosial & Footer -->
          <div class="bg-sage-50/70 border border-sage-200 rounded-2xl p-5 space-y-4">
            <h3 class="font-serif text-lg font-bold text-brand-900 border-b border-sage-200 pb-2">Detail Kontak, Akun Media Sosial &amp; Footer</h3>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Workshop &amp; Galeri</label>
                <input id="editContactAddress" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp Tampil</label>
                <input id="editContactWaDisplay" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Jam Operasional</label>
                <input id="editContactHours" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email Resmi</label>
                <input id="editContactEmail" type="email" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
              </div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-3">
              <div>
                <label class="block text-[11px] font-bold text-slate-600 mb-1">Link Instagram</label>
                <input id="editSocialIg" type="url" class="w-full px-3 py-1.5 rounded-xl border border-sage-200 bg-white text-xs" />
              </div>
              <div>
                <label class="block text-[11px] font-bold text-slate-600 mb-1">Link TikTok</label>
                <input id="editSocialTiktok" type="url" class="w-full px-3 py-1.5 rounded-xl border border-sage-200 bg-white text-xs" />
              </div>
              <div>
                <label class="block text-[11px] font-bold text-slate-600 mb-1">Link Facebook</label>
                <input id="editSocialFb" type="url" class="w-full px-3 py-1.5 rounded-xl border border-sage-200 bg-white text-xs" />
              </div>
              <div>
                <label class="block text-[11px] font-bold text-slate-600 mb-1">Link YouTube</label>
                <input id="editSocialYt" type="url" class="w-full px-3 py-1.5 rounded-xl border border-sage-200 bg-white text-xs" />
              </div>
              <div>
                <label class="block text-[11px] font-bold text-slate-600 mb-1">Link Chat WhatsApp</label>
                <input id="editSocialWaUrl" type="url" class="w-full px-3 py-1.5 rounded-xl border border-sage-200 bg-white text-xs" />
              </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4 pt-1">
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Teks Hak Cipta Footer</label>
                <input id="editFooterCopyright" type="text" required class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
              </div>
              <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Tagline Bawah Footer</label>
                <input id="editFooterTagline" type="text" class="w-full px-3.5 py-2 rounded-xl border border-sage-200 bg-white text-xs sm:text-sm" />
              </div>
            </div>
          </div>

          <div class="flex justify-end">
            <button type="submit" class="px-7 py-3 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs sm:text-sm font-bold transition-colors shadow-sm">
              Simpan Perubahan Pencapaian, Kontak &amp; Footer
            </button>
          </div>
        </form>

        <!-- Cadangkan (Export / Import JSON) & Reset Semua Data -->
        <div class="bg-brand-50/70 border border-brand-200 rounded-2xl p-5 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <div>
            <h4 class="font-bold text-slate-900 text-sm sm:text-base">Cadangkan, Pulihkan &amp; Reset Pengaturan Website</h4>
            <p class="text-xs text-slate-600 mt-0.5">Ekspor seluruh perubahan Anda ke file JSON, impor dari file cadangan, atau kembalikan ke pengaturan awal.</p>
          </div>
          <div class="flex flex-wrap items-center gap-2.5">
            <button id="exportBackupBtn" type="button" class="px-4 py-2.5 rounded-xl bg-white hover:bg-brand-50 text-brand-800 border border-brand-300 text-xs font-bold transition-colors">
              Ekspor Backup JSON
            </button>
            <label class="px-4 py-2.5 rounded-xl bg-white hover:bg-brand-50 text-brand-800 border border-brand-300 text-xs font-bold transition-colors cursor-pointer">
              Impor Backup JSON
              <input id="importBackupInput" type="file" accept=".json,application/json" class="hidden" />
            </label>
            <button id="resetAllDataBtn" type="button" class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs font-bold transition-colors">
              Reset Semua ke Awal
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- TOAST NOTIFIKASI INTERAKTIF -->
  <div id="toastNotification" class="fixed bottom-5 right-5 z-50 transform translate-y-20 opacity-0 pointer-events-none transition-all duration-300 bg-brand-950 text-white px-5 py-3 rounded-2xl shadow-xl border border-brand-700 flex items-center gap-2.5 text-xs sm:text-sm font-medium">
    <span class="w-2.5 h-2.5 rounded-full bg-gold-400"></span>
    <span id="toastMessage">Perubahan disimpan!</span>
  </div>

  <!-- ==================== JAVASCRIPT UTAMA & MANAJEMEN KONTEN ==================== -->
  <script>
    // ---------- 0. HELPER ESCAPE HTML, FORMAT RUPIAH & TOAST ----------
    function escapeHtml(str) {
      return String(str ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
    }

    function formatRupiah(angka) {
      return 'Rp ' + Number(angka || 0).toLocaleString('id-ID');
    }

    function capitalizeText(str) {
      if (!str) return '';
      return str.charAt(0).toUpperCase() + str.slice(1);
    }

    let toastTimer = null;
    function showToast(message) {
      const toast = document.getElementById('toastNotification');
      const toastMsg = document.getElementById('toastMessage');
      if (!toast || !toastMsg) return;
      toastMsg.textContent = message;
      toast.classList.remove('translate-y-20', 'opacity-0');
      clearTimeout(toastTimer);
      toastTimer = setTimeout(() => {
        toast.classList.add('translate-y-20', 'opacity-0');
      }, 3000);
    }

    // ---------- 1. KUNCI LOCALSTORAGE & DATA AWAL LENGKAP ----------
    const KEYS = {
      PRODUCTS: 'eahm_products_v3',
      PRODUCT_CATS: 'eahm_product_cats_v3',
      PROMO: 'eahm_promo_v3',
      ARTICLES: 'eahm_articles_v3',
      ARTICLE_CATS: 'eahm_article_cats_v3',
      SITE: 'eahm_site_content_v3',
      AUTH: 'eahm_admin_auth_v3'
    };

    const defaultProductCategories = ['pakaian', 'aksesoris', 'kerajinan'];
    const defaultArticleCategories = ['Berita Perusahaan', 'Kisah Pengrajin', 'Tips & Edukasi'];

    const defaultPromoSettings = {
      active: true,
      title: 'PROMO GEBYAR EKONOMI UMAT',
      description: 'Diskon spesial hingga 20% untuk koleksi Wastra & Kriya Pilihan!',
      code: 'AISYIYAH20',
      validity: 'Berlaku s/d 31 Des 2026',
      defaultShopee: 'https://shopee.co.id',
      defaultTokopedia: 'https://www.tokopedia.com',
      defaultTiktok: 'https://www.tiktok.com'
    };

    const defaultSiteContent = {
      brandMonogram: 'EA',
      companyName: 'PT Ekonomi Aisyiyah Hasanah Makmur',
      companyTagline: 'Wastra, Busana & Kriya Umat',
      heroBadge: 'Pemberdayaan Ekonomi Umat & UMKM Binaan',
      heroHeadline: 'Karya Wastra, Busana & Kriya Autentik untuk Kemandirian Ekonomi',
      heroDescription: 'PT Ekonomi Aisyiyah Hasanah Makmur menghadirkan koleksi wastra Nusantara, busana muslimah dan etnik modern, aksesoris, hingga kerajinan tangan berkualitas hasil karya mitra pengrajin dan UMKM binaan.',
      heroImage: 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?auto=format&fit=crop&w=1000&q=80',
      heroPrimaryCta: 'Jelajahi Produk',
      heroSecondaryCta: 'Tentang Perusahaan',
      heroFloatTag: 'Koleksi Unggulan',
      heroFloatTitle: 'Seri Wastra Alam, Busana & Kriya Etnik',
      heroFloatBtn: 'Lihat Katalog',
      heroStats: [
        { val: '100%', lbl: 'Karya Mitra & Pengrajin' },
        { val: 'Terkurasi', lbl: 'Kualitas & Ramah Alam' },
        { val: '4.9 ★', lbl: 'Ulasan Pelanggan' }
      ],
      profilEyebrow: 'Profil Perusahaan',
      profilTitle: 'Menggerakkan Ekonomi Umat, Melestarikan Karya Lokal',
      profilIntro: 'PT Ekonomi Aisyiyah Hasanah Makmur hadir sebagai wadah kolaborasi usaha yang mengangkat potensi pengrajin lokal dan UMKM binaan melalui produk wastra, busana santun modern, dan kriya bernilai seni tinggi.',
      visiTitle: 'Mewujudkan Kemandirian Ekonomi yang Berkemajuan & Berkelanjutan',
      visiDesc: 'Menjadi perusahaan terpercaya dalam pengembangan dan pemasaran produk wastra, busana, serta kriya Nusantara yang berdaya saing tinggi dan membawa kemaslahatan bagi masyarakat.',
      misiTitle: 'Pemberdayaan Mitra UMKM & Kurasi Kualitas',
      misiDesc: 'Mendampingi pengrajin tenun, pembatik, penjahit, dan perajin kriya dalam standarisasi mutu, inovasi desain kontemporer, serta perluasan akses pasar digital nasional.',
      pillars: [
        { title: 'Material Pilihan', desc: 'Serat alami seperti katun toyobo, tenun ikat asli, rotan, pandan, dan kayu jati berkelanjutan.' },
        { title: 'Pemberdayaan UMKM', desc: 'Setiap pembelian berkontribusi langsung pada kesejahteraan keluarga pengrajin mitra binaan.' },
        { title: 'Desain Modern & Santun', desc: 'Potongan elegan dan timeless yang nyaman dikenakan untuk acara resmi maupun aktivitas harian.' },
        { title: 'Transaksi Aman', desc: 'Tersedia di akun resmi Shopee, Tokopedia, dan TikTok Shop dengan jaminan keaslian produk.' }
      ],
      statsSubtitle: 'PENCAPAIAN PT EKONOMI AISYIYAH HASANAH MAKMUR',
      statsHeadline: 'Tumbuh Bersama Karya yang Nyata',
      statsBgImage: 'https://images.unsplash.com/photo-1606760227091-3dd870d97f1d?auto=format&fit=crop&w=1600&q=80',
      statsItems: [
        { num: 500, suffix: '+', label: 'PRODUK' },
        { num: 100, suffix: '+', label: 'PROYEK' },
        { num: 1000, suffix: '+', label: 'PELANGGAN' }
      ],
      productSectionEyebrow: 'Katalog Pilihan',
      productSectionTitle: 'Koleksi Produk Unggulan',
      productSectionSubtitle: 'Pilih kategori di bawah ini dan pesan langsung melalui akun resmi PT Ekonomi Aisyiyah Hasanah Makmur di marketplace favorit Anda.',
      articleSectionEyebrow: 'Jurnal & Kabar Terkini',
      articleSectionTitle: 'Artikel & Berita Perusahaan',
      articleSectionSubtitle: 'Ikuti liputan kegiatan pemberdayaan ekonomi, kisah inspiratif para pengrajin binaan, serta tips merawat kain wastra dan produk kriya.',
      contactSectionEyebrow: 'Hubungi Kami',
      contactSectionTitle: 'Mari Terhubung & Berkolaborasi',
      contactSectionSubtitle: 'Punya pertanyaan seputar ketersediaan produk, pengadaan seragam/suvenir lembaga, atau kemitraan UMKM? Hubungi tim kami melalui kontak resmi berikut.',
      contactAddress: 'Jl. K.H. Ahmad Dahlan No. 48, Yogyakarta 55122',
      contactWaDisplay: '+62 812-3456-7890',
      contactHours: 'Senin – Sabtu, 08.30 – 17.00 WIB',
      contactEmail: 'halo@aisyiyahhasanahmakmur.co.id',
      socialInstagram: 'https://instagram.com',
      socialTiktok: 'https://tiktok.com',
      socialFacebook: 'https://facebook.com',
      socialYoutube: 'https://youtube.com',
      socialWhatsappUrl: 'https://wa.me/6281234567890',
      footerCopyright: '© 2026 PT Ekonomi Aisyiyah Hasanah Makmur. Seluruh hak cipta dilindungi.',
      footerTagline: 'Membangun Kemandirian Ekonomi Umat Melalui Karya Wastra & Kriya Nusantara.'
    };

    const defaultProducts = [
      {
        id: 1,
        name: 'Outer Tenun Troso Jepara Modern',
        category: 'pakaian',
        badge: 'Promo Spesial',
        price: 385000,
        promoPrice: 325000,
        description: 'Outerwear potongan santun dan elegan berbahan tenun ikat Troso asli dengan kombinasi katun toyobo yang adem serta jatuh rapi untuk gaya sehari-hari.',
        image: 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?auto=format&fit=crop&w=800&q=80',
        links: { shopee: '', tokopedia: '', tiktok: '' }
      },
      {
        id: 2,
        name: 'Kemeja & Tunik Batik Tulis Kontemporer',
        category: 'pakaian',
        badge: 'Terlaris',
        price: 420000,
        promoPrice: 360000,
        description: 'Batik tulis motif parang kontemporer dengan pewarna alam sogan, dilengkapi furing katun halus yang nyaman untuk acara formal maupun kegiatan organisasi.',
        image: 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?auto=format&fit=crop&w=800&q=80',
        links: { shopee: '', tokopedia: '', tiktok: '' }
      },
      {
        id: 3,
        name: 'Tas Selempang Anyaman Pandan',
        category: 'aksesoris',
        badge: 'Favorit',
        price: 245000,
        promoPrice: null,
        description: 'Tas anyaman daun pandan laut karya pengrajin mitra, berlapis kain batik di bagian dalam dengan tali kulit sintetis premium yang kuat dan ringan.',
        image: 'https://images.unsplash.com/photo-1590874103328-eac38a683ce7?auto=format&fit=crop&w=800&q=80',
        links: { shopee: '', tokopedia: '', tiktok: '' }
      },
      {
        id: 4,
        name: 'Set Bros & Gelang Ukir Etnik',
        category: 'aksesoris',
        badge: 'Promo Hemat',
        price: 165000,
        promoPrice: 135000,
        description: 'Aksesoris logam kuningan ukir tangan motif flora Nusantara dengan lapisan pelindung anti-kusam, serasi dipadukan dengan busana muslimah maupun blazer.',
        image: 'https://images.unsplash.com/photo-1611591437281-460bfbe1220a?auto=format&fit=crop&w=800&q=80',
        links: { shopee: '', tokopedia: '', tiktok: '' }
      },
      {
        id: 5,
        name: 'Lampu Meja Anyaman Bambu',
        category: 'kerajinan',
        badge: 'Estetik',
        price: 290000,
        promoPrice: null,
        description: 'Kap lampu meja dari bilah bambu apus pilihan dengan finishing natural, memancarkan cahaya hangat yang menenangkan sudut ruang keluarga maupun kantor.',
        image: 'https://images.unsplash.com/photo-1513519245088-0e12902e5a38?auto=format&fit=crop&w=800&q=80',
        links: { shopee: '', tokopedia: '', tiktok: '' }
      },
      {
        id: 6,
        name: 'Set Nampan & Mangkuk Kayu Jati',
        category: 'kerajinan',
        badge: 'Food-Grade',
        price: 215000,
        promoPrice: 185000,
        description: 'Peralatan saji kayu jati solid berpelapis beeswax alami yang aman untuk makanan, tahan lembap, serta menonjolkan serat kayu eksotis.',
        image: 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?auto=format&fit=crop&w=800&q=80',
        links: { shopee: '', tokopedia: '', tiktok: '' }
      }
    ];

    const defaultArticles = [
      {
        id: 101,
        title: '5 Cara Merawat Kain Tenun & Batik Pewarna Alam Agar Tetap Awet',
        category: 'Tips & Edukasi',
        date: '18 November 2026',
        author: 'Tim Kurasi Wastra EA',
        image: 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?auto=format&fit=crop&w=900&q=80',
        excerpt: 'Kain wastra yang menggunakan pewarna alam memerlukan perawatan lembut agar serat kain dan warna sogan maupun indigo tetap terjaga bertahun-tahun.',
        content: 'Kain tenun dan batik pewarna alam merupakan warisan kriya bernilai tinggi yang dikerjakan dengan ketelatenan tangan pengrajin. Agar warna alami seperti sogan, tingi, maupun daun indigo tidak mudah pudar, hindari mencuci menggunakan deterjen kimia keras.\n\nGunakan lerak alami atau sampo bayi berformula lembut, kucek perlahan tanpa memeras kain terlalu kuat, lalu jemur di tempat teduh yang terkena angin tanpa paparan sinar matahari langsung.\n\nSaat menyetrika, atur suhu sedang dan lapisi kain wastra dengan selembar kain katun tipis di atasnya untuk menjaga kelembutan serat benang.'
      },
      {
        id: 102,
        title: 'Kisah Ibu-Ibu Pengrajin Tenun Mitra Binaan: Menjaga Tradisi di Tengah Arus Modern',
        category: 'Kisah Pengrajin',
        date: '10 November 2026',
        author: 'Redaksi EA Hasanah',
        image: 'https://images.unsplash.com/photo-1606760227091-3dd870d97f1d?auto=format&fit=crop&w=900&q=80',
        excerpt: 'Mengintip semangat para penenun perempuan mitra PT Ekonomi Aisyiyah Hasanah Makmur dalam memadukan motif klasik dengan palet warna modern.',
        content: 'Di balik setiap helai outer dan selendang tenun yang hadir di katalog PT Ekonomi Aisyiyah Hasanah Makmur, tersimpan dedikasi puluhan ibu rumah tangga pengrajin tenun alat tenun bukan mesin (ATBM).\n\nMelalui pendampingan desain dan akses pemasaran digital, para pengrajin kini mampu memproduksi motif tenun berpalet hijau sage dan warna bumi yang diminati generasi muda tanpa meninggalkan pakem tradisional.\n\nKolaborasi ini tidak hanya melestarikan warisan budaya lokal, tetapi juga memperkuat kemandirian ekonomi keluarga di desa sentra kerajinan.'
      },
      {
        id: 103,
        title: 'PT Ekonomi Aisyiyah Hasanah Makmur Hadirkan Koleksi Kapsul Wastra di Pameran Kriya Nasional',
        category: 'Berita Perusahaan',
        date: '02 November 2026',
        author: 'Humas & Kemitraan',
        image: 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=900&q=80',
        excerpt: 'Meluncurkan seri busana santun dan aksesoris anyaman ramah lingkungan yang mendapatkan sambutan hangat dari pengunjung pameran.',
        content: 'PT Ekonomi Aisyiyah Hasanah Makmur kembali berpartisipasi dalam ajang Pameran Kriya & Ekonomi Kreatif Nusantara dengan memperkenalkan lini koleksi terbaru bertajuk "Hasanah Alam".\n\nKoleksi ini memadukan potongan busana santun kontemporer berbahan katun organik dan tenun ikat dengan tas anyaman pandan serta perhiasan kuningan ukir.\n\nSeluruh koleksi hasil kurasi pameran kini dapat dipesan secara daring melalui toko resmi kami di Shopee, Tokopedia, dan TikTok Shop.'
      }
    ];

    // ---------- 2. LOAD & SAVE STATE ----------
    function loadJSON(key, fallback) {
      try {
        const raw = localStorage.getItem(key);
        return raw ? JSON.parse(raw) : JSON.parse(JSON.stringify(fallback));
      } catch (e) {
        return JSON.parse(JSON.stringify(fallback));
      }
    }

    function saveJSON(key, value) {
      try {
        localStorage.setItem(key, JSON.stringify(value));
      } catch (e) {}
    }

    let products = loadJSON(KEYS.PRODUCTS, defaultProducts);
    let productCategories = loadJSON(KEYS.PRODUCT_CATS, defaultProductCategories);
    let promoSettings = loadJSON(KEYS.PROMO, defaultPromoSettings);
    let articles = loadJSON(KEYS.ARTICLES, defaultArticles);
    let articleCategories = loadJSON(KEYS.ARTICLE_CATS, defaultArticleCategories);
    let siteContent = loadJSON(KEYS.SITE, defaultSiteContent);
    let isAdminLoggedIn = localStorage.getItem(KEYS.AUTH) === 'true';

    let currentProductCategory = 'all';
    let currentArticleCategory = 'all';
    let promoDismissedInSession = false;
    let resetConfirmPending = false;

    // ---------- 3. RENDER SEMUA BAGIAN WEBSITE ----------
    function renderPromoBanner() {
      const banner = document.getElementById('storePromoBanner');
      if (!banner) return;
      if (!promoSettings.active || promoDismissedInSession) {
        banner.classList.add('hidden');
        return;
      }
      banner.classList.remove('hidden');
      document.getElementById('promoBadgeTitle').textContent = promoSettings.title;
      document.getElementById('promoBannerText').textContent = promoSettings.description;
      document.getElementById('copyPromoCodeBtn').textContent = promoSettings.code;
      document.getElementById('promoValidityText').textContent = '· ' + promoSettings.validity;
    }

    document.getElementById('dismissPromoBannerBtn').addEventListener('click', () => {
      promoDismissedInSession = true;
      renderPromoBanner();
    });

    document.getElementById('copyPromoCodeBtn').addEventListener('click', () => {
      const code = promoSettings.code;
      const tempInput = document.createElement('input');
      tempInput.value = code;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand('copy');
      document.body.removeChild(tempInput);
      showToast('Kode voucher "' + code + '" berhasil disalin!');
    });

    function renderSiteContent() {
      // Brand & Navbar
      const mono = siteContent.brandMonogram || 'EA';
      document.getElementById('navMonogramText').textContent = mono;
      document.getElementById('loginModalMonogram').textContent = mono;
      document.getElementById('dashMonogram').textContent = mono;
      document.getElementById('navCompanyName').textContent = siteContent.companyName;
      document.getElementById('navCompanyTagline').textContent = siteContent.companyTagline;
      document.getElementById('heroFallbackBrandName').textContent = siteContent.companyName;
      document.getElementById('heroFallbackTagline').textContent = siteContent.companyTagline;

      // Hero Section
      document.getElementById('heroBadgeText').textContent = siteContent.heroBadge;
      document.getElementById('heroHeadlineText').textContent = siteContent.heroHeadline;
      document.getElementById('heroDescriptionText').textContent = siteContent.heroDescription;
      document.getElementById('heroPrimaryCtaBtn').textContent = siteContent.heroPrimaryCta || 'Jelajahi Produk';
      document.getElementById('heroSecondaryCtaBtn').textContent = siteContent.heroSecondaryCta || 'Tentang Perusahaan';
      document.getElementById('heroFloatingTag').textContent = siteContent.heroFloatTag;
      document.getElementById('heroFloatingTitle').textContent = siteContent.heroFloatTitle;
      document.getElementById('heroFloatBtn').textContent = siteContent.heroFloatBtn || 'Lihat Katalog';

      const heroImg = document.getElementById('heroMainImage');
      const heroFallback = document.getElementById('heroSvgFallback');
      if (siteContent.heroImage) {
        heroImg.src = siteContent.heroImage;
        heroImg.classList.remove('hidden');
        heroFallback.classList.add('hidden');
      } else {
        heroImg.classList.add('hidden');
        heroFallback.classList.remove('hidden');
      }

      if (siteContent.heroStats && siteContent.heroStats.length >= 3) {
        document.getElementById('heroStat1Val').textContent = siteContent.heroStats[0].val;
        document.getElementById('heroStat1Lbl').textContent = siteContent.heroStats[0].lbl;
        document.getElementById('heroStat2Val').textContent = siteContent.heroStats[1].val;
        document.getElementById('heroStat2Lbl').textContent = siteContent.heroStats[1].lbl;
        document.getElementById('heroStat3Val').textContent = siteContent.heroStats[2].val;
        document.getElementById('heroStat3Lbl').textContent = siteContent.heroStats[2].lbl;
      }

      // Profil Perusahaan
      document.getElementById('profilEyebrow').textContent = siteContent.profilEyebrow || 'Profil Perusahaan';
      document.getElementById('profilTitle').textContent = siteContent.profilTitle;
      document.getElementById('profilIntro').textContent = siteContent.profilIntro;
      document.getElementById('visiTitle').textContent = siteContent.visiTitle;
      document.getElementById('visiDesc').textContent = siteContent.visiDesc;
      document.getElementById('misiTitle').textContent = siteContent.misiTitle;
      document.getElementById('misiDesc').textContent = siteContent.misiDesc;

      const pillarsGrid = document.getElementById('profilPillarsGrid');
      pillarsGrid.innerHTML = (siteContent.pillars || []).map((pillar, idx) => `
        <div class="bg-white p-6 rounded-2xl border border-sage-200 shadow-sm">
          <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center font-bold text-sm mb-3.5">
            0${idx + 1}
          </div>
          <h4 class="font-bold text-slate-900 text-base mb-1.5">${escapeHtml(pillar.title)}</h4>
          <p class="text-xs text-slate-600 leading-relaxed">${escapeHtml(pillar.desc)}</p>
        </div>
      `).join('');

      // Banner Pencapaian / Statistik
      document.getElementById('statsSubtitle').textContent = siteContent.statsSubtitle;
      document.getElementById('statsHeadline').textContent = siteContent.statsHeadline;
      const statsBgImg = document.getElementById('statsBgImage');
      if (siteContent.statsBgImage) {
        statsBgImg.src = siteContent.statsBgImage;
        statsBgImg.style.display = '';
      } else {
        statsBgImg.style.display = 'none';
      }

      const statsGrid = document.getElementById('statsCountersGrid');
      const items = siteContent.statsItems || [];
      const colClass = items.length >= 4 ? 'grid-cols-2 sm:grid-cols-4' : items.length === 2 ? 'grid-cols-2' : items.length === 1 ? 'grid-cols-1' : 'grid-cols-3';
      statsGrid.className = `lg:col-span-7 grid ${colClass} gap-4 sm:gap-8`;
      statsGrid.innerHTML = items.map(item => {
        const num = Number(item.num) || 0;
        return `
          <div class="border-t border-white/20 pt-4">
            <p class="text-3xl sm:text-5xl font-bold text-gold-400 tracking-tight">
              <span class="stat-counter" data-target="${num}">${num.toLocaleString('id-ID')}</span>${escapeHtml(item.suffix || '')}
            </p>
            <p class="text-[11px] sm:text-xs font-semibold tracking-[0.2em] text-slate-300 uppercase mt-2">
              ${escapeHtml(item.label)}
            </p>
          </div>
        `;
      }).join('');
      animateCounters(true);

      // Judul Seksi Produk, Artikel & Kontak
      document.getElementById('productSectionEyebrow').textContent = siteContent.productSectionEyebrow;
      document.getElementById('productSectionTitle').textContent = siteContent.productSectionTitle;
      document.getElementById('productSectionSubtitle').textContent = siteContent.productSectionSubtitle;

      document.getElementById('articleSectionEyebrow').textContent = siteContent.articleSectionEyebrow;
      document.getElementById('articleSectionTitle').textContent = siteContent.articleSectionTitle;
      document.getElementById('articleSectionSubtitle').textContent = siteContent.articleSectionSubtitle;

      document.getElementById('contactSectionEyebrow').textContent = siteContent.contactSectionEyebrow;
      document.getElementById('contactSectionTitle').textContent = siteContent.contactSectionTitle;
      document.getElementById('contactSectionSubtitle').textContent = siteContent.contactSectionSubtitle;

      // Kontak & Media Sosial
      document.getElementById('contactAddressText').textContent = siteContent.contactAddress;
      document.getElementById('contactWhatsappDisplay').textContent = siteContent.contactWaDisplay;
      document.getElementById('contactHoursDisplay').textContent = siteContent.contactHours;
      document.getElementById('contactEmailDisplay').textContent = siteContent.contactEmail;

      document.getElementById('socialInstagramLink').href = siteContent.socialInstagram || 'https://instagram.com';
      document.getElementById('socialTiktokLink').href = siteContent.socialTiktok || 'https://tiktok.com';
      document.getElementById('socialFacebookLink').href = siteContent.socialFacebook || 'https://facebook.com';
      document.getElementById('socialYoutubeLink').href = siteContent.socialYoutube || 'https://youtube.com';
      document.getElementById('socialWhatsappLink').href = siteContent.socialWhatsappUrl || 'https://wa.me/6281234567890';

      // Footer
      document.getElementById('footerCopyrightText').textContent = siteContent.footerCopyright;
      document.getElementById('footerTaglineText').textContent = siteContent.footerTagline || '';
    }

    document.getElementById('heroMainImage').addEventListener('error', function () {
      this.classList.add('hidden');
      document.getElementById('heroSvgFallback').classList.remove('hidden');
    });

    // Animasi Count-Up Statistik
    function animateCounters(forceReset = false) {
      const counters = document.querySelectorAll('.stat-counter');
      counters.forEach(counter => {
        if (!forceReset && counter.dataset.animated === 'true') return;
        counter.dataset.animated = 'true';
        const target = parseInt(counter.dataset.target, 10) || 0;
        const duration = 1200;
        const startTime = performance.now();

        function step(now) {
          const progress = Math.min((now - startTime) / duration, 1);
          const eased = 1 - Math.pow(1 - progress, 3);
          const currentVal = Math.floor(eased * target);
          counter.textContent = currentVal.toLocaleString('id-ID');
          if (progress < 1) {
            requestAnimationFrame(step);
          } else {
            counter.textContent = target.toLocaleString('id-ID');
          }
        }
        requestAnimationFrame(step);
      });
    }

    const pencapaianSection = document.getElementById('pencapaian');
    if ('IntersectionObserver' in window && pencapaianSection) {
      const obs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) animateCounters(false);
        });
      }, { threshold: 0.25 });
      obs.observe(pencapaianSection);
    }

    // ---------- 4. RENDER PRODUK & KATEGORI DINAMIS ----------
    function renderProductCategoryFilters() {
      const container = document.getElementById('categoryFilters');
      const allCats = [...new Set([...productCategories, ...products.map(p => p.category)])];

      if (currentProductCategory !== 'all' && !allCats.includes(currentProductCategory)) {
        currentProductCategory = 'all';
      }

      container.innerHTML = [
        `<button type="button" data-filter="all" class="px-4 py-2 rounded-full text-sm font-semibold transition-all ${currentProductCategory === 'all' ? 'bg-brand-800 text-white shadow-sm' : 'bg-white text-slate-700 border border-sage-200 hover:border-brand-600'}">Semua Produk</button>`,
        ...allCats.map(cat => `
          <button type="button" data-filter="${escapeHtml(cat)}" class="px-4 py-2 rounded-full text-sm font-semibold transition-all ${currentProductCategory === cat ? 'bg-brand-800 text-white shadow-sm' : 'bg-white text-slate-700 border border-sage-200 hover:border-brand-600'}">
            ${escapeHtml(capitalizeText(cat))}
          </button>
        `)
      ].join('');

      container.querySelectorAll('button').forEach(btn => {
        btn.addEventListener('click', () => {
          currentProductCategory = btn.getAttribute('data-filter');
          renderProductCategoryFilters();
          renderProducts();
        });
      });
    }

    function renderProducts() {
      const grid = document.getElementById('productGrid');
      const filtered = currentProductCategory === 'all'
        ? products
        : products.filter(p => p.category === currentProductCategory);

      if (filtered.length === 0) {
        grid.innerHTML = `<div class="col-span-full text-center py-12 bg-sage-50 rounded-3xl border border-sage-200 text-slate-600">Belum ada produk pada kategori ini.</div>`;
        return;
      }

      grid.innerHTML = filtered.map(item => {
        const hasPromo = item.promoPrice && Number(item.promoPrice) > 0 && Number(item.promoPrice) < Number(item.price);
        const discountPct = hasPromo ? Math.round(((item.price - item.promoPrice) / item.price) * 100) : 0;

        const shopeeUrl = (item.links?.shopee || '').trim() || promoSettings.defaultShopee || 'https://shopee.co.id';
        const tokopediaUrl = (item.links?.tokopedia || '').trim() || promoSettings.defaultTokopedia || 'https://www.tokopedia.com';
        const tiktokUrl = (item.links?.tiktok || '').trim() || promoSettings.defaultTiktok || 'https://www.tiktok.com';

        return `
          <article class="group bg-white rounded-3xl border border-sage-200 overflow-hidden shadow-sm hover:shadow-lg hover:border-brand-300 transition-all duration-300 flex flex-col">
            <div class="relative aspect-[4/3] bg-sage-100 overflow-hidden">
              <img
                src="${escapeHtml(item.image || '')}"
                alt="${escapeHtml(item.name)}"
                loading="lazy"
                onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ${!item.image ? 'hidden' : ''}"
              />
              <!-- SVG Fallback Otomatis -->
              <div class="${item.image ? 'hidden' : ''} w-full h-full bg-gradient-to-br from-brand-800 to-emerald-700 flex flex-col items-center justify-center text-white p-6 text-center">
                <svg class="w-16 h-16 mb-2.5 text-brand-100" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="22" y="22" width="56" height="56" rx="14" />
                  <path d="M22 50 L50 22 L78 50 L50 78 Z" />
                  <circle cx="50" cy="50" r="10" />
                </svg>
                <span class="font-serif text-sm font-semibold text-white/95">${escapeHtml(item.name)}</span>
              </div>

              <span class="absolute top-3.5 left-3.5 px-3 py-1 rounded-full bg-white/95 text-slate-800 text-xs font-bold shadow-sm">
                ${escapeHtml(capitalizeText(item.category))}
              </span>

              <div class="absolute top-3.5 right-3.5 flex flex-col items-end gap-1.5">
                ${item.badge ? `
                  <span class="px-3 py-1 rounded-full ${hasPromo ? 'bg-gold-400 text-brand-950 font-bold' : 'bg-brand-800 text-white font-semibold'} text-xs shadow-sm">
                    ${escapeHtml(item.badge)}
                  </span>
                ` : ''}
                ${hasPromo ? `
                  <span class="px-2.5 py-0.5 rounded-full bg-brand-700 text-white text-[11px] font-bold shadow-sm">
                    Hemat ${discountPct}%
                  </span>
                ` : ''}
              </div>
            </div>

            <div class="p-6 flex-1 flex flex-col justify-between">
              <div>
                <h3 class="font-bold text-lg text-slate-900 leading-snug">${escapeHtml(item.name)}</h3>
                <div class="mt-1.5 flex flex-wrap items-baseline gap-2">
                  ${hasPromo ? `
                    <span class="text-brand-700 font-bold text-lg">${formatRupiah(item.promoPrice)}</span>
                    <span class="text-slate-400 line-through text-xs font-medium">${formatRupiah(item.price)}</span>
                  ` : `
                    <span class="text-brand-700 font-bold text-base">${formatRupiah(item.price)}</span>
                  `}
                </div>
                <p class="text-sm text-slate-600 mt-2.5 leading-relaxed">${escapeHtml(item.description)}</p>
              </div>

              <div class="pt-5 mt-5 border-t border-sage-100">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2.5">
                  Beli di Marketplace Resmi:
                </p>
                <div class="grid grid-cols-3 gap-2">
                  <a href="${escapeHtml(shopeeUrl)}" target="_blank" rel="noopener noreferrer"
                     class="text-center py-2 px-2 rounded-xl bg-orange-50 hover:bg-orange-100 text-orange-700 text-xs font-semibold transition-colors">
                    Shopee
                  </a>
                  <a href="${escapeHtml(tokopediaUrl)}" target="_blank" rel="noopener noreferrer"
                     class="text-center py-2 px-2 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-semibold transition-colors">
                    Tokopedia
                  </a>
                  <a href="${escapeHtml(tiktokUrl)}" target="_blank" rel="noopener noreferrer"
                     class="text-center py-2 px-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-semibold transition-colors">
                    TikTok Shop
                  </a>
                </div>
              </div>
            </div>
          </article>
        `;
      }).join('');
    }

    // ---------- 5. RENDER ARTIKEL & BERITA + MODAL PEMBACA ----------
    function renderArticleCategoryFilters() {
      const container = document.getElementById('articleCategoryFilters');
      const allCats = [...new Set([...articleCategories, ...articles.map(a => a.category)])];

      if (currentArticleCategory !== 'all' && !allCats.includes(currentArticleCategory)) {
        currentArticleCategory = 'all';
      }

      container.innerHTML = [
        `<button type="button" data-art-filter="all" class="px-4 py-2 rounded-full text-sm font-semibold transition-all ${currentArticleCategory === 'all' ? 'bg-brand-800 text-white shadow-sm' : 'bg-white text-slate-700 border border-sage-200 hover:border-brand-600'}">Semua Artikel</button>`,
        ...allCats.map(cat => `
          <button type="button" data-art-filter="${escapeHtml(cat)}" class="px-4 py-2 rounded-full text-sm font-semibold transition-all ${currentArticleCategory === cat ? 'bg-brand-800 text-white shadow-sm' : 'bg-white text-slate-700 border border-sage-200 hover:border-brand-600'}">
            ${escapeHtml(cat)}
          </button>
        `)
      ].join('');

      container.querySelectorAll('button').forEach(btn => {
        btn.addEventListener('click', () => {
          currentArticleCategory = btn.getAttribute('data-art-filter');
          renderArticleCategoryFilters();
          renderArticles();
        });
      });
    }

    function renderArticles() {
      const grid = document.getElementById('articleGrid');
      const filtered = currentArticleCategory === 'all'
        ? articles
        : articles.filter(a => a.category === currentArticleCategory);

      if (filtered.length === 0) {
        grid.innerHTML = `<div class="col-span-full text-center py-12 bg-white rounded-3xl border border-sage-200 text-slate-600">Belum ada artikel pada kategori ini.</div>`;
        return;
      }

      grid.innerHTML = filtered.map(art => `
        <article class="group bg-white rounded-3xl border border-sage-200 overflow-hidden shadow-sm hover:shadow-lg hover:border-brand-300 transition-all duration-300 flex flex-col">
          <div class="relative aspect-[16/10] bg-sage-100 overflow-hidden">
            <img
              src="${escapeHtml(art.image || '')}"
              alt="${escapeHtml(art.title)}"
              loading="lazy"
              onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden');"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ${!art.image ? 'hidden' : ''}"
            />
            <!-- SVG Fallback Otomatis -->
            <div class="${art.image ? 'hidden' : ''} w-full h-full bg-gradient-to-br from-brand-800 to-emerald-700 flex flex-col items-center justify-center text-white p-6 text-center">
              <svg class="w-14 h-14 mb-2 text-brand-100" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2.5">
                <rect x="20" y="18" width="60" height="64" rx="10" />
                <line x1="34" y1="36" x2="66" y2="36" />
                <line x1="34" y1="50" x2="66" y2="50" />
                <line x1="34" y1="64" x2="54" y2="64" />
              </svg>
              <span class="font-serif text-xs font-semibold">Jurnal Ekonomi Aisyiyah</span>
            </div>
          </div>

          <div class="p-6 flex-1 flex flex-col justify-between">
            <div>
              <div class="flex flex-wrap items-center gap-2 text-xs mb-3">
                <span class="px-3 py-1 rounded-full bg-brand-50 text-brand-700 font-bold">
                  ${escapeHtml(art.category)}
                </span>
                <span class="text-slate-400 font-medium">${escapeHtml(art.date)}</span>
              </div>

              <h3 class="font-serif font-bold text-lg text-slate-900 leading-snug group-hover:text-brand-700 transition-colors">
                ${escapeHtml(art.title)}
              </h3>

              <p class="text-sm text-slate-600 mt-2.5 leading-relaxed line-clamp-3">
                ${escapeHtml(art.excerpt)}
              </p>
            </div>

            <div class="pt-5 mt-5 border-t border-sage-100 flex items-center justify-between gap-2">
              <span class="text-[11px] font-medium text-slate-400 truncate">Oleh: ${escapeHtml(art.author || 'Redaksi EA')}</span>
              <button type="button" onclick="openArticleReader(${art.id})" class="inline-flex items-center gap-1.5 text-brand-700 hover:text-brand-900 font-bold text-xs sm:text-sm transition-colors shrink-0">
                <span>Baca Selengkapnya</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
              </button>
            </div>
          </div>
        </article>
      `).join('');
    }

    window.openArticleReader = function (id) {
      const art = articles.find(a => a.id === id);
      if (!art) return;

      const modal = document.getElementById('articleReaderModal');
      const img = document.getElementById('readerArticleImg');
      const fallback = document.getElementById('readerArticleFallback');

      if (art.image) {
        img.src = art.image;
        img.alt = art.title;
        img.classList.remove('hidden');
        fallback.classList.add('hidden');
        img.onerror = () => {
          img.classList.add('hidden');
          fallback.classList.remove('hidden');
        };
      } else {
        img.classList.add('hidden');
        fallback.classList.remove('hidden');
      }

      document.getElementById('readerArticleCategory').textContent = art.category;
      document.getElementById('readerArticleDate').textContent = art.date;
      document.getElementById('readerArticleAuthor').textContent = art.author || 'Redaksi EA Hasanah';
      document.getElementById('readerArticleTitle').textContent = art.title;

      const paragraphs = String(art.content || art.excerpt || '').split(/\n+/).filter(Boolean);
      document.getElementById('readerArticleBody').innerHTML = paragraphs
        .map(p => `<p>${escapeHtml(p)}</p>`)
        .join('');

      modal.classList.remove('hidden');
    };

    document.getElementById('closeArticleReaderBtn').addEventListener('click', () => {
      document.getElementById('articleReaderModal').classList.add('hidden');
    });
    document.getElementById('closeArticleReaderBtn2').addEventListener('click', () => {
      document.getElementById('articleReaderModal').classList.add('hidden');
    });

    // ---------- 6. LOGIN ADMIN & DASHBOARD 5 TAB ----------
    const adminNavBtn = document.getElementById('adminNavBtn');
    const adminNavBtnLabel = document.getElementById('adminNavBtnLabel');
    const adminStatusDot = document.getElementById('adminStatusDot');
    const adminLockIcon = document.getElementById('adminLockIcon');
    const adminLoginModal = document.getElementById('adminLoginModal');
    const adminDashboardModal = document.getElementById('adminDashboardModal');

    function updateAdminNavState() {
      if (isAdminLoggedIn) {
        adminNavBtnLabel.textContent = 'Dashboard Admin';
        adminStatusDot.classList.remove('hidden');
        adminLockIcon.classList.add('hidden');
        adminNavBtn.classList.remove('bg-brand-700', 'hover:bg-brand-800');
        adminNavBtn.classList.add('bg-brand-900', 'hover:bg-brand-800', 'ring-2', 'ring-emerald-400/70');
      } else {
        adminNavBtnLabel.textContent = 'Login Admin';
        adminStatusDot.classList.add('hidden');
        adminLockIcon.classList.remove('hidden');
        adminNavBtn.classList.remove('bg-brand-900', 'ring-2', 'ring-emerald-400/70');
        adminNavBtn.classList.add('bg-brand-700', 'hover:bg-brand-800');
      }
    }

    adminNavBtn.addEventListener('click', () => {
      if (isAdminLoggedIn) {
        openDashboardModal();
      } else {
        document.getElementById('loginErrorMsg').classList.add('hidden');
        adminLoginModal.classList.remove('hidden');
      }
    });

    document.getElementById('closeLoginModalBtn').addEventListener('click', () => {
      adminLoginModal.classList.add('hidden');
    });

    document.getElementById('autoFillLoginBtn').addEventListener('click', () => {
      document.getElementById('adminUsername').value = 'admin';
      document.getElementById('adminPassword').value = 'admin123';
    });

    document.getElementById('adminLoginForm').addEventListener('submit', (e) => {
      e.preventDefault();
      const user = document.getElementById('adminUsername').value.trim();
      const pass = document.getElementById('adminPassword').value.trim();

      if (user === 'admin' && pass === 'admin123') {
        isAdminLoggedIn = true;
        localStorage.setItem(KEYS.AUTH, 'true');
        updateAdminNavState();
        adminLoginModal.classList.add('hidden');
        openDashboardModal();
        showToast('Login berhasil! Selamat datang di Dashboard Admin.');
      } else {
        document.getElementById('loginErrorMsg').classList.remove('hidden');
      }
    });

    function openDashboardModal() {
      renderAdminProductCategories();
      renderAdminProductTable();
      populatePromoForm();
      renderAdminArticleCategories();
      renderAdminArticleTable();
      populateHeroProfilForm();
      populateStatsContactForm();
      resetConfirmPending = false;
      document.getElementById('resetAllDataBtn').textContent = 'Reset Semua ke Awal';
      adminDashboardModal.classList.remove('hidden');
    }

    document.getElementById('closeDashboardBtn').addEventListener('click', () => {
      adminDashboardModal.classList.add('hidden');
    });

    document.getElementById('adminLogoutBtn').addEventListener('click', () => {
      isAdminLoggedIn = false;
      localStorage.removeItem(KEYS.AUTH);
      updateAdminNavState();
      adminDashboardModal.classList.add('hidden');
      showToast('Anda telah keluar dari sesi Admin.');
    });

    // Navigasi 5 Tab Dashboard Admin
    const adminTabBtns = document.querySelectorAll('.admin-tab-btn');
    const adminTabPanels = document.querySelectorAll('.admin-tab-panel');

    adminTabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const targetTab = btn.getAttribute('data-admin-tab');
        adminTabBtns.forEach(b => {
          b.className = 'admin-tab-btn px-4 py-3 rounded-t-2xl text-xs sm:text-sm font-semibold text-slate-600 hover:text-brand-800 whitespace-nowrap';
        });
        btn.className = 'admin-tab-btn px-4 py-3 rounded-t-2xl text-xs sm:text-sm font-bold bg-white text-brand-800 border-t border-x border-sage-200 -mb-px whitespace-nowrap';

        adminTabPanels.forEach(panel => panel.classList.add('hidden'));
        document.getElementById('adminTab-' + targetTab).classList.remove('hidden');
      });
    });

    // Tombol Foto Contoh 1-Klik
    document.querySelectorAll('.sample-img-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const targetInputId = btn.getAttribute('data-sample-target');
        const imgUrl = btn.getAttribute('data-sample-img');
        const inputEl = document.getElementById(targetInputId);
        if (inputEl) inputEl.value = imgUrl;
      });
    });

    // ---------- TAB 1 LOGIC: KATEGORI DINAMIS & CRUD PRODUK ----------
    function renderAdminProductCategories() {
      const badgeContainer = document.getElementById('adminProductCategoryBadges');
      const selectEl = document.getElementById('prodCategory');
      const bulkSelectEl = document.getElementById('bulkDiscountCategory');

      badgeContainer.innerHTML = productCategories.map(cat => `
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white border border-sage-200 text-xs font-bold text-slate-700">
          <span>${escapeHtml(capitalizeText(cat))}</span>
          ${productCategories.length > 1 ? `
            <button type="button" onclick="handleDeleteProductCategory('${escapeHtml(cat)}')" title="Hapus kategori" class="text-slate-400 hover:text-red-600 font-bold ml-0.5">✕</button>
          ` : ''}
        </span>
      `).join('');

      const currentVal = selectEl.value;
      selectEl.innerHTML = productCategories.map(cat => `
        <option value="${escapeHtml(cat)}">${escapeHtml(capitalizeText(cat))}</option>
      `).join('');
      if (productCategories.includes(currentVal)) selectEl.value = currentVal;

      if (bulkSelectEl) {
        bulkSelectEl.innerHTML = [
          `<option value="all">Semua Barang (${products.length} produk)</option>`,
          ...productCategories.map(cat => {
            const count = products.filter(p => p.category === cat).length;
            return `<option value="${escapeHtml(cat)}">Kategori: ${escapeHtml(capitalizeText(cat))} (${count} produk)</option>`;
          })
        ].join('');
      }
    }

    document.getElementById('addProductCategoryForm').addEventListener('submit', (e) => {
      e.preventDefault();
      const input = document.getElementById('newProductCategoryInput');
      const val = input.value.trim().toLowerCase();
      if (!val) return;
      if (productCategories.includes(val)) {
        showToast('Kategori tersebut sudah tersedia.');
        return;
      }
      productCategories.push(val);
      saveJSON(KEYS.PRODUCT_CATS, productCategories);
      input.value = '';
      renderAdminProductCategories();
      renderProductCategoryFilters();
      showToast('Kategori produk "' + capitalizeText(val) + '" ditambahkan!');
    });

    window.handleDeleteProductCategory = function (cat) {
      if (productCategories.length <= 1) return;
      productCategories = productCategories.filter(c => c !== cat);
      const fallbackCat = productCategories[0];
      products = products.map(p => (p.category === cat ? { ...p, category: fallbackCat } : p));
      saveJSON(KEYS.PRODUCT_CATS, productCategories);
      saveJSON(KEYS.PRODUCTS, products);
      renderAdminProductCategories();
      renderProductCategoryFilters();
      renderProducts();
      renderAdminProductTable();
      showToast('Kategori "' + capitalizeText(cat) + '" dihapus.');
    };

    const productEditorCard = document.getElementById('productEditorCard');
    const productEditorForm = document.getElementById('productEditorForm');

    function openProductEditor(item = null) {
      renderAdminProductCategories();
      productEditorCard.classList.remove('hidden');
      if (item) {
        document.getElementById('productFormTitle').textContent = 'Edit Barang: ' + item.name;
        document.getElementById('editProductId').value = item.id;
        document.getElementById('prodName').value = item.name;
        document.getElementById('prodCategory').value = item.category;
        document.getElementById('prodBadge').value = item.badge || '';
        document.getElementById('prodPrice').value = item.price;
        document.getElementById('prodPromoPrice').value = item.promoPrice || '';
        document.getElementById('prodImage').value = item.image || '';
        document.getElementById('prodDesc').value = item.description;
        document.getElementById('prodShopee').value = item.links?.shopee || '';
        document.getElementById('prodTokopedia').value = item.links?.tokopedia || '';
        document.getElementById('prodTiktok').value = item.links?.tiktok || '';
      } else {
        document.getElementById('productFormTitle').textContent = 'Tambah Barang Baru';
        productEditorForm.reset();
        document.getElementById('editProductId').value = '';
      }
      productEditorCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function closeProductEditor() {
      productEditorCard.classList.add('hidden');
      productEditorForm.reset();
      document.getElementById('editProductId').value = '';
    }

    document.getElementById('openAddProductFormBtn').addEventListener('click', () => openProductEditor(null));
    document.getElementById('cancelProductFormBtn').addEventListener('click', closeProductEditor);
    document.getElementById('cancelProductFormBtn2').addEventListener('click', closeProductEditor);

    productEditorForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const idVal = document.getElementById('editProductId').value;
      const normalPrice = Number(document.getElementById('prodPrice').value);
      const rawPromo = document.getElementById('prodPromoPrice').value;
      const promoPriceVal = rawPromo && Number(rawPromo) > 0 && Number(rawPromo) < normalPrice ? Number(rawPromo) : null;

      const data = {
        id: idVal ? Number(idVal) : Date.now(),
        name: document.getElementById('prodName').value.trim(),
        category: document.getElementById('prodCategory').value,
        badge: document.getElementById('prodBadge').value.trim() || (promoPriceVal ? 'Promo' : 'Baru'),
        price: normalPrice,
        promoPrice: promoPriceVal,
        image: document.getElementById('prodImage').value.trim(),
        description: document.getElementById('prodDesc').value.trim(),
        links: {
          shopee: document.getElementById('prodShopee').value.trim(),
          tokopedia: document.getElementById('prodTokopedia').value.trim(),
          tiktok: document.getElementById('prodTiktok').value.trim()
        }
      };

      if (idVal) {
        products = products.map(p => (p.id === Number(idVal) ? data : p));
        showToast('Barang "' + data.name + '" berhasil diperbarui!');
      } else {
        products = [data, ...products];
        showToast('Barang "' + data.name + '" berhasil ditambahkan!');
      }

      saveJSON(KEYS.PRODUCTS, products);
      renderProductCategoryFilters();
      renderProducts();
      renderAdminProductCategories();
      renderAdminProductTable();
      closeProductEditor();
    });

    function renderAdminProductTable() {
      document.getElementById('adminProductCount').textContent = products.length;
      const tbody = document.getElementById('adminProductTableBody');
      tbody.innerHTML = products.map(item => {
        const hasPromo = item.promoPrice && Number(item.promoPrice) > 0 && Number(item.promoPrice) < Number(item.price);
        return `
          <tr class="hover:bg-sage-50/70">
            <td class="py-3.5 px-4">
              <div class="flex items-center gap-3">
                <img src="${escapeHtml(item.image || '')}" alt="" onerror="this.style.display='none'" class="w-11 h-11 rounded-xl object-cover bg-sage-100 shrink-0 border border-sage-200" />
                <div>
                  <p class="font-bold text-slate-900 text-xs sm:text-sm">${escapeHtml(item.name)}</p>
                  <span class="inline-block mt-0.5 px-2 py-0.5 rounded-full text-[10px] font-bold ${hasPromo ? 'bg-gold-400/30 text-brand-900' : 'bg-brand-50 text-brand-700'}">
                    ${escapeHtml(item.badge || 'Reguler')}
                  </span>
                </div>
              </div>
            </td>
            <td class="py-3.5 px-4 text-xs font-semibold text-slate-600">${escapeHtml(capitalizeText(item.category))}</td>
            <td class="py-3.5 px-4 text-xs sm:text-sm font-semibold ${hasPromo ? 'line-through text-slate-400' : 'text-slate-800'}">${formatRupiah(item.price)}</td>
            <td class="py-3.5 px-4 text-xs sm:text-sm font-bold text-brand-700">${hasPromo ? formatRupiah(item.promoPrice) : '<span class="text-slate-400 font-normal">-</span>'}</td>
            <td class="py-3.5 px-4 text-right whitespace-nowrap">
              <button type="button" onclick="handleEditProduct(${item.id})" class="px-3 py-1.5 rounded-lg bg-brand-50 hover:bg-brand-100 text-brand-800 text-xs font-bold mr-1.5">Edit</button>
              <button type="button" onclick="handleDeleteProduct(${item.id})" class="px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-700 text-xs font-bold">Hapus</button>
            </td>
          </tr>
        `;
      }).join('');
    }

    window.handleEditProduct = function (id) {
      const found = products.find(p => p.id === id);
      if (found) openProductEditor(found);
    };

    window.handleDeleteProduct = function (id) {
      const target = products.find(p => p.id === id);
      if (!target) return;
      products = products.filter(p => p.id !== id);
      saveJSON(KEYS.PRODUCTS, products);
      renderProductCategoryFilters();
      renderProducts();
      renderAdminProductCategories();
      renderAdminProductTable();
      showToast('Barang "' + target.name + '" dihapus.');
    };

    // ---------- TAB 2 LOGIC: PROMO, DISKON & MARKETPLACE DEFAULT ----------
    function populatePromoForm() {
      document.getElementById('promoActiveToggle').checked = Boolean(promoSettings.active);
      document.getElementById('inputPromoTitle').value = promoSettings.title;
      document.getElementById('inputPromoDesc').value = promoSettings.description;
      document.getElementById('inputPromoCode').value = promoSettings.code;
      document.getElementById('inputPromoValidity').value = promoSettings.validity;

      document.getElementById('defaultShopeeUrl').value = promoSettings.defaultShopee || 'https://shopee.co.id';
      document.getElementById('defaultTokopediaUrl').value = promoSettings.defaultTokopedia || 'https://www.tokopedia.com';
      document.getElementById('defaultTiktokUrl').value = promoSettings.defaultTiktok || 'https://www.tiktok.com';
      renderAdminProductCategories();
    }

    document.getElementById('promoSettingsForm').addEventListener('submit', (e) => {
      e.preventDefault();
      promoSettings.active = document.getElementById('promoActiveToggle').checked;
      promoSettings.title = document.getElementById('inputPromoTitle').value.trim();
      promoSettings.description = document.getElementById('inputPromoDesc').value.trim();
      promoSettings.code = document.getElementById('inputPromoCode').value.trim().toUpperCase();
      promoSettings.validity = document.getElementById('inputPromoValidity').value.trim();

      promoDismissedInSession = false;
      saveJSON(KEYS.PROMO, promoSettings);
      renderPromoBanner();
      showToast('Pengaturan Banner Promo Toko berhasil disimpan!');
    });

    document.getElementById('defaultMarketplacesForm').addEventListener('submit', (e) => {
      e.preventDefault();
      promoSettings.defaultShopee = document.getElementById('defaultShopeeUrl').value.trim();
      promoSettings.defaultTokopedia = document.getElementById('defaultTokopediaUrl').value.trim();
      promoSettings.defaultTiktok = document.getElementById('defaultTiktokUrl').value.trim();
      saveJSON(KEYS.PROMO, promoSettings);
      renderProducts();
      showToast('Tautan marketplace default berhasil disimpan!');
    });

    document.getElementById('applyBulkDiscountBtn').addEventListener('click', () => {
      const targetCat = document.getElementById('bulkDiscountCategory').value;
      const pct = Number(document.getElementById('bulkDiscountPercent').value);
      if (!pct || pct <= 0 || pct >= 90) return;

      products = products.map(p => {
        if (targetCat !== 'all' && p.category !== targetCat) return p;
        return {
          ...p,
          promoPrice: Math.round((p.price * (100 - pct)) / 100 / 1000) * 1000,
          badge: `Promo ${pct}%`
        };
      });
      saveJSON(KEYS.PRODUCTS, products);
      renderProducts();
      renderAdminProductTable();
      const targetText = targetCat === 'all' ? 'semua barang' : 'kategori ' + capitalizeText(targetCat);
      showToast(`Diskon ${pct}% berhasil diterapkan ke ${targetText}!`);
    });

    document.getElementById('clearAllDiscountsBtn').addEventListener('click', () => {
      products = products.map(p => ({
        ...p,
        promoPrice: null,
        badge: p.badge && p.badge.toLowerCase().includes('promo') ? 'Unggulan' : p.badge
      }));
      saveJSON(KEYS.PRODUCTS, products);
      renderProducts();
      renderAdminProductTable();
      showToast('Semua harga promo produk telah direset.');
    });

    // ---------- TAB 3 LOGIC: KATEGORI DINAMIS & CRUD ARTIKEL ----------
    function renderAdminArticleCategories() {
      const badgeContainer = document.getElementById('adminArticleCategoryBadges');
      const selectEl = document.getElementById('artCategory');

      badgeContainer.innerHTML = articleCategories.map(cat => `
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white border border-sage-200 text-xs font-bold text-slate-700">
          <span>${escapeHtml(cat)}</span>
          ${articleCategories.length > 1 ? `
            <button type="button" onclick="handleDeleteArticleCategory('${escapeHtml(cat)}')" title="Hapus kategori" class="text-slate-400 hover:text-red-600 font-bold ml-0.5">✕</button>
          ` : ''}
        </span>
      `).join('');

      const currentVal = selectEl.value;
      selectEl.innerHTML = articleCategories.map(cat => `
        <option value="${escapeHtml(cat)}">${escapeHtml(cat)}</option>
      `).join('');
      if (articleCategories.includes(currentVal)) selectEl.value = currentVal;
    }

    document.getElementById('addArticleCategoryForm').addEventListener('submit', (e) => {
      e.preventDefault();
      const input = document.getElementById('newArticleCategoryInput');
      const val = input.value.trim();
      if (!val) return;
      if (articleCategories.some(c => c.toLowerCase() === val.toLowerCase())) {
        showToast('Kategori artikel tersebut sudah tersedia.');
        return;
      }
      articleCategories.push(val);
      saveJSON(KEYS.ARTICLE_CATS, articleCategories);
      input.value = '';
      renderAdminArticleCategories();
      renderArticleCategoryFilters();
      showToast('Kategori artikel "' + val + '" ditambahkan!');
    });

    window.handleDeleteArticleCategory = function (cat) {
      if (articleCategories.length <= 1) return;
      articleCategories = articleCategories.filter(c => c !== cat);
      const fallbackCat = articleCategories[0];
      articles = articles.map(a => (a.category === cat ? { ...a, category: fallbackCat } : a));
      saveJSON(KEYS.ARTICLE_CATS, articleCategories);
      saveJSON(KEYS.ARTICLES, articles);
      renderAdminArticleCategories();
      renderArticleCategoryFilters();
      renderArticles();
      renderAdminArticleTable();
      showToast('Kategori artikel "' + cat + '" dihapus.');
    };

    const articleEditorCard = document.getElementById('articleEditorCard');
    const articleEditorForm = document.getElementById('articleEditorForm');

    function openArticleEditor(item = null) {
      renderAdminArticleCategories();
      articleEditorCard.classList.remove('hidden');
      if (item) {
        document.getElementById('articleFormTitle').textContent = 'Edit Artikel: ' + item.title;
        document.getElementById('editArticleId').value = item.id;
        document.getElementById('artTitle').value = item.title;
        document.getElementById('artCategory').value = item.category;
        document.getElementById('artDate').value = item.date;
        document.getElementById('artAuthor').value = item.author || 'Redaksi EA Hasanah';
        document.getElementById('artImage').value = item.image || '';
        document.getElementById('artExcerpt').value = item.excerpt;
        document.getElementById('artContent').value = item.content;
      } else {
        document.getElementById('articleFormTitle').textContent = 'Tulis Artikel / Berita Baru';
        articleEditorForm.reset();
        document.getElementById('editArticleId').value = '';
        document.getElementById('artDate').value = '25 November 2026';
        document.getElementById('artAuthor').value = 'Redaksi EA Hasanah';
      }
      articleEditorCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function closeArticleEditor() {
      articleEditorCard.classList.add('hidden');
      articleEditorForm.reset();
      document.getElementById('editArticleId').value = '';
    }

    document.getElementById('openAddArticleFormBtn').addEventListener('click', () => openArticleEditor(null));
    document.getElementById('cancelArticleFormBtn').addEventListener('click', closeArticleEditor);
    document.getElementById('cancelArticleFormBtn2').addEventListener('click', closeArticleEditor);

    articleEditorForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const idVal = document.getElementById('editArticleId').value;
      const data = {
        id: idVal ? Number(idVal) : Date.now(),
        title: document.getElementById('artTitle').value.trim(),
        category: document.getElementById('artCategory').value,
        date: document.getElementById('artDate').value.trim(),
        author: document.getElementById('artAuthor').value.trim() || 'Redaksi EA Hasanah',
        image: document.getElementById('artImage').value.trim(),
        excerpt: document.getElementById('artExcerpt').value.trim(),
        content: document.getElementById('artContent').value.trim()
      };

      if (idVal) {
        articles = articles.map(a => (a.id === Number(idVal) ? data : a));
        showToast('Artikel berhasil diperbarui!');
      } else {
        articles = [data, ...articles];
        showToast('Artikel baru berhasil dipublikasikan!');
      }

      saveJSON(KEYS.ARTICLES, articles);
      renderArticleCategoryFilters();
      renderArticles();
      renderAdminArticleTable();
      closeArticleEditor();
    });

    function renderAdminArticleTable() {
      document.getElementById('adminArticleCount').textContent = articles.length;
      const tbody = document.getElementById('adminArticleTableBody');
      tbody.innerHTML = articles.map(art => `
        <tr class="hover:bg-sage-50/70">
          <td class="py-3.5 px-4">
            <div class="flex items-center gap-3">
              <img src="${escapeHtml(art.image || '')}" alt="" onerror="this.style.display='none'" class="w-12 h-10 rounded-xl object-cover bg-sage-100 shrink-0 border border-sage-200" />
              <p class="font-bold text-slate-900 text-xs sm:text-sm line-clamp-1">${escapeHtml(art.title)}</p>
            </div>
          </td>
          <td class="py-3.5 px-4">
            <span class="px-2.5 py-1 rounded-full bg-brand-50 text-brand-700 text-xs font-bold">${escapeHtml(art.category)}</span>
          </td>
          <td class="py-3.5 px-4 text-xs text-slate-500 whitespace-nowrap">${escapeHtml(art.author || 'Redaksi')} · ${escapeHtml(art.date)}</td>
          <td class="py-3.5 px-4 text-right whitespace-nowrap">
            <button type="button" onclick="handleEditArticle(${art.id})" class="px-3 py-1.5 rounded-lg bg-brand-50 hover:bg-brand-100 text-brand-800 text-xs font-bold mr-1.5">Edit</button>
            <button type="button" onclick="handleDeleteArticle(${art.id})" class="px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-700 text-xs font-bold">Hapus</button>
          </td>
        </tr>
      `).join('');
    }

    window.handleEditArticle = function (id) {
      const found = articles.find(a => a.id === id);
      if (found) openArticleEditor(found);
    };

    window.handleDeleteArticle = function (id) {
      articles = articles.filter(a => a.id !== id);
      saveJSON(KEYS.ARTICLES, articles);
      renderArticleCategoryFilters();
      renderArticles();
      renderAdminArticleTable();
      showToast('Artikel berhasil dihapus.');
    };

    // ---------- TAB 4 LOGIC: BERANDA & PROFIL ----------
    function populateHeroProfilForm() {
      document.getElementById('editBrandMonogram').value = siteContent.brandMonogram || 'EA';
      document.getElementById('editCompanyName').value = siteContent.companyName;
      document.getElementById('editCompanyTagline').value = siteContent.companyTagline;

      document.getElementById('editHeroBadge').value = siteContent.heroBadge;
      document.getElementById('editHeroImage').value = siteContent.heroImage;
      document.getElementById('editHeroHeadline').value = siteContent.heroHeadline;
      document.getElementById('editHeroDesc').value = siteContent.heroDescription;
      document.getElementById('editHeroPrimaryCta').value = siteContent.heroPrimaryCta || 'Jelajahi Produk';
      document.getElementById('editHeroSecondaryCta').value = siteContent.heroSecondaryCta || 'Tentang Perusahaan';
      document.getElementById('editHeroFloatTag').value = siteContent.heroFloatTag;
      document.getElementById('editHeroFloatTitle').value = siteContent.heroFloatTitle;
      document.getElementById('editHeroFloatBtn').value = siteContent.heroFloatBtn || 'Lihat Katalog';

      document.getElementById('editHeroStat1Val').value = siteContent.heroStats[0].val;
      document.getElementById('editHeroStat1Lbl').value = siteContent.heroStats[0].lbl;
      document.getElementById('editHeroStat2Val').value = siteContent.heroStats[1].val;
      document.getElementById('editHeroStat2Lbl').value = siteContent.heroStats[1].lbl;
      document.getElementById('editHeroStat3Val').value = siteContent.heroStats[2].val;
      document.getElementById('editHeroStat3Lbl').value = siteContent.heroStats[2].lbl;

      document.getElementById('editProfilEyebrow').value = siteContent.profilEyebrow || 'Profil Perusahaan';
      document.getElementById('editProfilTitle').value = siteContent.profilTitle;
      document.getElementById('editProfilIntro').value = siteContent.profilIntro;
      document.getElementById('editVisiTitle').value = siteContent.visiTitle;
      document.getElementById('editVisiDesc').value = siteContent.visiDesc;
      document.getElementById('editMisiTitle').value = siteContent.misiTitle;
      document.getElementById('editMisiDesc').value = siteContent.misiDesc;

      const pillarsContainer = document.getElementById('adminPillarsInputs');
      pillarsContainer.innerHTML = siteContent.pillars.map((p, idx) => `
        <div class="bg-white p-3.5 rounded-xl border border-sage-200 space-y-2">
          <p class="text-[11px] font-bold text-brand-700 uppercase">Pilar 0${idx + 1}</p>
          <input type="text" data-pillar-title="${idx}" value="${escapeHtml(p.title)}" required class="w-full px-2.5 py-1.5 rounded-lg border border-sage-200 text-xs font-bold" />
          <textarea rows="2" data-pillar-desc="${idx}" required class="w-full px-2.5 py-1.5 rounded-lg border border-sage-200 text-xs">${escapeHtml(p.desc)}</textarea>
        </div>
      `).join('');
    }

    document.getElementById('heroProfilForm').addEventListener('submit', (e) => {
      e.preventDefault();
      siteContent.brandMonogram = document.getElementById('editBrandMonogram').value.trim().toUpperCase() || 'EA';
      siteContent.companyName = document.getElementById('editCompanyName').value.trim();
      siteContent.companyTagline = document.getElementById('editCompanyTagline').value.trim();

      siteContent.heroBadge = document.getElementById('editHeroBadge').value.trim();
      siteContent.heroImage = document.getElementById('editHeroImage').value.trim();
      siteContent.heroHeadline = document.getElementById('editHeroHeadline').value.trim();
      siteContent.heroDescription = document.getElementById('editHeroDesc').value.trim();
      siteContent.heroPrimaryCta = document.getElementById('editHeroPrimaryCta').value.trim();
      siteContent.heroSecondaryCta = document.getElementById('editHeroSecondaryCta').value.trim();
      siteContent.heroFloatTag = document.getElementById('editHeroFloatTag').value.trim();
      siteContent.heroFloatTitle = document.getElementById('editHeroFloatTitle').value.trim();
      siteContent.heroFloatBtn = document.getElementById('editHeroFloatBtn').value.trim();

      siteContent.heroStats = [
        { val: document.getElementById('editHeroStat1Val').value.trim(), lbl: document.getElementById('editHeroStat1Lbl').value.trim() },
        { val: document.getElementById('editHeroStat2Val').value.trim(), lbl: document.getElementById('editHeroStat2Lbl').value.trim() },
        { val: document.getElementById('editHeroStat3Val').value.trim(), lbl: document.getElementById('editHeroStat3Lbl').value.trim() }
      ];

      siteContent.profilEyebrow = document.getElementById('editProfilEyebrow').value.trim();
      siteContent.profilTitle = document.getElementById('editProfilTitle').value.trim();
      siteContent.profilIntro = document.getElementById('editProfilIntro').value.trim();
      siteContent.visiTitle = document.getElementById('editVisiTitle').value.trim();
      siteContent.visiDesc = document.getElementById('editVisiDesc').value.trim();
      siteContent.misiTitle = document.getElementById('editMisiTitle').value.trim();
      siteContent.misiDesc = document.getElementById('editMisiDesc').value.trim();

      siteContent.pillars = siteContent.pillars.map((p, idx) => ({
        title: document.querySelector(`[data-pillar-title="${idx}"]`).value.trim(),
        desc: document.querySelector(`[data-pillar-desc="${idx}"]`).value.trim()
      }));

      saveJSON(KEYS.SITE, siteContent);
      renderSiteContent();
      showToast('Identitas, Beranda & Profil Perusahaan berhasil diperbarui!');
    });

    // ---------- TAB 5 LOGIC: PENCAPAIAN, KONTAK, FOOTER & BACKUP ----------
    function renderAdminStatsInputs() {
      const statsInputs = document.getElementById('adminStatsInputs');
      statsInputs.innerHTML = siteContent.statsItems.map((s, idx) => `
        <div class="bg-white p-4 rounded-xl border border-brand-200 space-y-2.5 shadow-sm">
          <div class="flex items-center justify-between">
            <p class="text-[11px] font-bold text-brand-800 uppercase">Item Statistik #${idx + 1}</p>
            ${siteContent.statsItems.length > 1 ? `
              <button type="button" onclick="handleDeleteStatItem(${idx})" class="text-[11px] font-bold text-red-600 hover:text-red-800">Hapus</button>
            ` : ''}
          </div>
          <div class="flex gap-2">
            <div class="w-2/3">
              <label class="block text-[10px] font-semibold text-slate-500 mb-0.5">Angka</label>
              <input type="number" data-stat-num="${idx}" value="${s.num}" required class="w-full px-2.5 py-1.5 rounded-lg border border-sage-200 text-xs font-bold" />
            </div>
            <div class="w-1/3">
              <label class="block text-[10px] font-semibold text-slate-500 mb-0.5">Akhiran</label>
              <input type="text" data-stat-suffix="${idx}" value="${escapeHtml(s.suffix)}" placeholder="+" class="w-full px-2 py-1.5 rounded-lg border border-sage-200 text-xs font-bold text-center" />
            </div>
          </div>
          <div>
            <label class="block text-[10px] font-semibold text-slate-500 mb-0.5">Label Keterangan</label>
            <input type="text" data-stat-label="${idx}" value="${escapeHtml(s.label)}" required placeholder="PRODUK / PROYEK / PELANGGAN" class="w-full px-2.5 py-1.5 rounded-lg border border-sage-200 text-xs uppercase font-semibold" />
          </div>
        </div>
      `).join('');
    }

    function syncDraftStatsFromInputs() {
      siteContent.statsItems = siteContent.statsItems.map((s, idx) => {
        const numEl = document.querySelector(`[data-stat-num="${idx}"]`);
        const sufEl = document.querySelector(`[data-stat-suffix="${idx}"]`);
        const lblEl = document.querySelector(`[data-stat-label="${idx}"]`);
        if (!numEl || !sufEl || !lblEl) return s;
        return {
          num: Number(numEl.value) || 0,
          suffix: sufEl.value.trim(),
          label: lblEl.value.trim()
        };
      });
    }

    document.getElementById('addStatItemBtn').addEventListener('click', () => {
      syncDraftStatsFromInputs();
      siteContent.statsItems.push({ num: 50, suffix: '+', label: 'MITRA UMKM' });
      renderAdminStatsInputs();
    });

    window.handleDeleteStatItem = function (idx) {
      if (siteContent.statsItems.length <= 1) return;
      syncDraftStatsFromInputs();
      siteContent.statsItems.splice(idx, 1);
      renderAdminStatsInputs();
    };

    function populateStatsContactForm() {
      document.getElementById('editStatsSubtitle').value = siteContent.statsSubtitle;
      document.getElementById('editStatsHeadline').value = siteContent.statsHeadline;
      document.getElementById('editStatsBgImage').value = siteContent.statsBgImage || '';

      renderAdminStatsInputs();

      document.getElementById('editProdSecEyebrow').value = siteContent.productSectionEyebrow;
      document.getElementById('editProdSecTitle').value = siteContent.productSectionTitle;
      document.getElementById('editProdSecSub').value = siteContent.productSectionSubtitle;

      document.getElementById('editArtSecEyebrow').value = siteContent.articleSectionEyebrow;
      document.getElementById('editArtSecTitle').value = siteContent.articleSectionTitle;
      document.getElementById('editArtSecSub').value = siteContent.articleSectionSubtitle;

      document.getElementById('editContactSecEyebrow').value = siteContent.contactSectionEyebrow;
      document.getElementById('editContactSecTitle').value = siteContent.contactSectionTitle;
      document.getElementById('editContactSecSub').value = siteContent.contactSectionSubtitle;

      document.getElementById('editContactAddress').value = siteContent.contactAddress;
      document.getElementById('editContactWaDisplay').value = siteContent.contactWaDisplay;
      document.getElementById('editContactHours').value = siteContent.contactHours;
      document.getElementById('editContactEmail').value = siteContent.contactEmail;

      document.getElementById('editSocialIg').value = siteContent.socialInstagram;
      document.getElementById('editSocialTiktok').value = siteContent.socialTiktok;
      document.getElementById('editSocialFb').value = siteContent.socialFacebook;
      document.getElementById('editSocialYt').value = siteContent.socialYoutube;
      document.getElementById('editSocialWaUrl').value = siteContent.socialWhatsappUrl;

      document.getElementById('editFooterCopyright').value = siteContent.footerCopyright;
      document.getElementById('editFooterTagline').value = siteContent.footerTagline || '';
    }

    document.getElementById('statsContactForm').addEventListener('submit', (e) => {
      e.preventDefault();
      siteContent.statsSubtitle = document.getElementById('editStatsSubtitle').value.trim();
      siteContent.statsHeadline = document.getElementById('editStatsHeadline').value.trim();
      siteContent.statsBgImage = document.getElementById('editStatsBgImage').value.trim();

      siteContent.statsItems = siteContent.statsItems.map((s, idx) => ({
        num: Number(document.querySelector(`[data-stat-num="${idx}"]`).value) || 0,
        suffix: document.querySelector(`[data-stat-suffix="${idx}"]`).value.trim(),
        label: document.querySelector(`[data-stat-label="${idx}"]`).value.trim()
      }));

      siteContent.productSectionEyebrow = document.getElementById('editProdSecEyebrow').value.trim();
      siteContent.productSectionTitle = document.getElementById('editProdSecTitle').value.trim();
      siteContent.productSectionSubtitle = document.getElementById('editProdSecSub').value.trim();

      siteContent.articleSectionEyebrow = document.getElementById('editArtSecEyebrow').value.trim();
      siteContent.articleSectionTitle = document.getElementById('editArtSecTitle').value.trim();
      siteContent.articleSectionSubtitle = document.getElementById('editArtSecSub').value.trim();

      siteContent.contactSectionEyebrow = document.getElementById('editContactSecEyebrow').value.trim();
      siteContent.contactSectionTitle = document.getElementById('editContactSecTitle').value.trim();
      siteContent.contactSectionSubtitle = document.getElementById('editContactSecSub').value.trim();

      siteContent.contactAddress = document.getElementById('editContactAddress').value.trim();
      siteContent.contactWaDisplay = document.getElementById('editContactWaDisplay').value.trim();
      siteContent.contactHours = document.getElementById('editContactHours').value.trim();
      siteContent.contactEmail = document.getElementById('editContactEmail').value.trim();

      siteContent.socialInstagram = document.getElementById('editSocialIg').value.trim();
      siteContent.socialTiktok = document.getElementById('editSocialTiktok').value.trim();
      siteContent.socialFacebook = document.getElementById('editSocialFb').value.trim();
      siteContent.socialYoutube = document.getElementById('editSocialYt').value.trim();
      siteContent.socialWhatsappUrl = document.getElementById('editSocialWaUrl').value.trim();

      siteContent.footerCopyright = document.getElementById('editFooterCopyright').value.trim();
      siteContent.footerTagline = document.getElementById('editFooterTagline').value.trim();

      saveJSON(KEYS.SITE, siteContent);
      renderSiteContent();
      showToast('Pengaturan Pencapaian, Seksi, Kontak & Footer berhasil disimpan!');
    });

    // Ekspor Backup JSON
    document.getElementById('exportBackupBtn').addEventListener('click', () => {
      const payload = {
        exportedAt: new Date().toISOString(),
        products,
        productCategories,
        promoSettings,
        articles,
        articleCategories,
        siteContent
      };
      const blob = new Blob([JSON.stringify(payload, null, 2)], { type: 'application/json' });
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = 'backup-pt-ekonomi-aisyiyah-hasanah-makmur.json';
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      URL.revokeObjectURL(url);
      showToast('File backup JSON berhasil diunduh!');
    });

    // Impor Backup JSON
    document.getElementById('importBackupInput').addEventListener('change', (e) => {
      const file = e.target.files && e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = (ev) => {
        try {
          const parsed = JSON.parse(ev.target.result);
          if (Array.isArray(parsed.products)) products = parsed.products;
          if (Array.isArray(parsed.productCategories)) productCategories = parsed.productCategories;
          if (parsed.promoSettings) promoSettings = { ...defaultPromoSettings, ...parsed.promoSettings };
          if (Array.isArray(parsed.articles)) articles = parsed.articles;
          if (Array.isArray(parsed.articleCategories)) articleCategories = parsed.articleCategories;
          if (parsed.siteContent) siteContent = { ...defaultSiteContent, ...parsed.siteContent };

          saveJSON(KEYS.PRODUCTS, products);
          saveJSON(KEYS.PRODUCT_CATS, productCategories);
          saveJSON(KEYS.PROMO, promoSettings);
          saveJSON(KEYS.ARTICLES, articles);
          saveJSON(KEYS.ARTICLE_CATS, articleCategories);
          saveJSON(KEYS.SITE, siteContent);

          renderPromoBanner();
          renderSiteContent();
          renderProductCategoryFilters();
          renderProducts();
          renderArticleCategoryFilters();
          renderArticles();
          openDashboardModal();
          showToast('Data website berhasil dipulihkan dari file backup!');
        } catch (err) {
          showToast('File backup JSON tidak valid.');
        }
        e.target.value = '';
      };
      reader.readAsText(file);
    });

    // Reset Semua Data (2-klik konfirmasi tanpa window.confirm)
    document.getElementById('resetAllDataBtn').addEventListener('click', function () {
      if (!resetConfirmPending) {
        resetConfirmPending = true;
        this.textContent = 'Klik Sekali Lagi untuk Konfirmasi Reset';
        showToast('Klik tombol Reset sekali lagi untuk mengembalikan seluruh data awal.');
        return;
      }

      resetConfirmPending = false;
      this.textContent = 'Reset Semua ke Awal';

      products = JSON.parse(JSON.stringify(defaultProducts));
      productCategories = [...defaultProductCategories];
      promoSettings = { ...defaultPromoSettings };
      articles = JSON.parse(JSON.stringify(defaultArticles));
      articleCategories = [...defaultArticleCategories];
      siteContent = JSON.parse(JSON.stringify(defaultSiteContent));

      saveJSON(KEYS.PRODUCTS, products);
      saveJSON(KEYS.PRODUCT_CATS, productCategories);
      saveJSON(KEYS.PROMO, promoSettings);
      saveJSON(KEYS.ARTICLES, articles);
      saveJSON(KEYS.ARTICLE_CATS, articleCategories);
      saveJSON(KEYS.SITE, siteContent);

      promoDismissedInSession = false;
      renderPromoBanner();
      renderSiteContent();
      renderProductCategoryFilters();
      renderProducts();
      renderArticleCategoryFilters();
      renderArticles();

      openDashboardModal();
      closeProductEditor();
      closeArticleEditor();
      showToast('Seluruh data website berhasil dikembalikan ke pengaturan awal!');
    });

    // ---------- 7. MENU MOBILE & SCROLL SPY ----------
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
    document.querySelectorAll('.mobile-link').forEach(link => {
      link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
    });

    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    window.addEventListener('scroll', () => {
      let currentId = 'beranda';
      sections.forEach(sec => {
        if (window.scrollY >= sec.offsetTop - 130) {
          currentId = sec.getAttribute('id');
        }
      });
      navLinks.forEach(link => {
        link.classList.remove('text-brand-700', 'font-semibold');
        if (link.getAttribute('href') === '#' + currentId) {
          link.classList.add('text-brand-700', 'font-semibold');
        }
      });
    });

    // ---------- 8. INISIALISASI HALAMAN ----------
    updateAdminNavState();
    renderPromoBanner();
    renderSiteContent();
    renderProductCategoryFilters();
    renderProducts();
    renderArticleCategoryFilters();
    renderArticles();
  </script>
</body>
</html>