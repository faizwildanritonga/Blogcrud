<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Blog' }} — Tugas Rutin 10</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800">

  <header class="bg-white border-b border-slate-200">
    <nav class="max-w-3xl mx-auto px-6 h-16 flex items-center justify-between">
      <a href="{{ route('posts.index') }}" class="font-bold text-emerald-600">Blog CRUD</a>
      <a href="{{ route('posts.create') }}"
         class="text-sm font-medium bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700">
        + Tulis Postingan
      </a>
    </nav>
  </header>

  <main class="max-w-3xl mx-auto px-6 py-10">
    @if (session('flash_message'))
      <x-alert :type="session('flash_type', 'sukses')" :message="session('flash_message')" />
    @endif

    @yield('content')
  </main>

  <footer class="text-center text-sm text-slate-400 py-8">
    &copy; {{ date('Y') }} Blog CRUD — Tugas Rutin 10
  </footer>

</body>
</html>
