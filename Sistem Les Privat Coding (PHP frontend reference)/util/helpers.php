<?php

function base_path(string $path = ''): string
{
    $root = __DIR__ . '/..';
    $path = ltrim($path, '/');
    return $path === '' ? $root : $root . '/' . $path;
}

function asset(string $path): string
{
    // App is served from the project root (vanilla-style)
    return ltrim($path, '/');
}

function require_view(string $path): void
{
    $full = base_path($path);
    if (!file_exists($full)) {
        echo '<div class="flex flex-col items-center justify-center h-64 text-center">';
        echo '<div class="text-4xl font-bold text-gray-300 mb-4">WIP</div>';
        echo '<h2 class="text-xl font-semibold text-gray-700">Halaman Belum Tersedia</h2>';
        echo '<p class="text-gray-500 mt-2">File "' . htmlspecialchars($path) . '" tidak ditemukan.</p>';
        echo '</div>';
        return;
    }

    require $full;
}
