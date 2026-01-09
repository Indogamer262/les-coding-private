<?php

function base_path(string $path = ''): string
{
    $root = __DIR__ . '/..';
    $path = ltrim($path, '/');
    return $path === '' ? $root : $root . '/' . $path;
}

function view_path(string $path = ''): string
{
    $path = ltrim($path, '/');
    return $path === '' ? base_path('views') : base_path('views/' . $path);
}

function asset(string $path): string
{
    // App is served from the project root (vanilla-style)
    return ltrim($path, '/');
}

function require_view(string $path): void
{
    // Prefer new views/ directory, but keep a fallback to the old path
    // to avoid breaking any legacy includes during migration.
    $full = view_path($path);
    if (!file_exists($full)) {
        $legacy = base_path($path);
        if (file_exists($legacy)) {
            require $legacy;
            return;
        }

        echo '<div class="flex flex-col items-center justify-center h-64 text-center">';
        echo '<div class="text-4xl font-bold text-gray-300 mb-4">WIP</div>';
        echo '<h2 class="text-xl font-semibold text-gray-700">Halaman Belum Tersedia</h2>';
        echo '<p class="text-gray-500 mt-2">File "' . htmlspecialchars($path) . '" tidak ditemukan.</p>';
        echo '</div>';
        return;
    }

    require $full;
}
