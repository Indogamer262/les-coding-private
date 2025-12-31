@extends('layouts.app', ['role' => 'student'])

@section('title', 'Dashboard Murid - Sistem Les Privat')
@section('header', 'Dashboard Saya')

@section('content')
<div class="flex flex-col gap-6">
    <!-- Active Package Card -->
    <div class="card bg-gradient-to-r from-blue-500 to-blue-600 text-white" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white;">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm opacity-90">Paket Aktif Saat Ini</p>
                <h2 class="text-2xl font-bold">Python Programming Basics</h2>
            </div>
            <div class="rounded-full bg-white/20 p-3" style="background: rgba(255,255,255,0.2);">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
            </div>
        </div>
        <div class="flex items-end justify-between">
            <div>
                <p class="text-3xl font-bold">8 <span class="text-lg font-normal opacity-75">/ 12 Pertemuan</span></p>
                <div style="width: 200px; height: 6px; background: rgba(255,255,255,0.3); border-radius: 99px; margin-top: 0.5rem; overflow: hidden;">
                    <div style="width: 66%; height: 100%; background: white;"></div>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm opacity-90">Pengajar</p>
                <p class="font-bold">Pak Eko</p>
            </div>
        </div>
    </div>

    <div class="grid-layout" style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
        <!-- Schedule -->
        <div class="card">
            <div class="card-header flex items-center justify-between">
                <h3 class="card-title">Jadwal Les Mendatang</h3>
                <a href="/student/schedule" class="btn btn-outline btn-sm" style="font-size: 0.75rem;">Lihat Semua</a>
            </div>
            <div class="flex flex-col gap-4">
                <!-- Item 1 -->
                <div class="flex items-center p-3 rounded border border-gray-100 bg-gray-50" style="border: 1px solid var(--border); background: #f8fafc;">
                    <div class="flex flex-col items-center justify-center p-2 bg-white rounded shadow-sm mr-4" style="width: 60px; height: 60px;">
                        <span class="text-xs font-bold text-danger">DES</span>
                        <span class="text-xl font-bold">31</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold">Python Variables & Types</h4>
                        <p class="text-sm text-muted">14:00 - 15:30 WIB • Online via Zoom</p>
                    </div>
                    <a href="#" class="btn btn-primary btn-sm">Join</a>
                </div>
                <!-- Item 2 -->
                <div class="flex items-center p-3 rounded border border-gray-100 bg-gray-50" style="border: 1px solid var(--border); background: #f8fafc;">
                    <div class="flex flex-col items-center justify-center p-2 bg-white rounded shadow-sm mr-4" style="width: 60px; height: 60px;">
                        <span class="text-xs font-bold text-muted">JAN</span>
                        <span class="text-xl font-bold text-main">02</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold">Control Flow (If/Else)</h4>
                        <p class="text-sm text-muted">16:00 - 17:30 WIB • Online via Zoom</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- History / Notes -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Materi</h3>
            </div>
            <ul class="relative border-l border-gray-200 ml-3" style="border-left: 2px solid var(--border); padding-left: 1.5rem; list-style: none;">
                <li class="mb-6 relative">
                    <span class="absolute w-3 h-3 bg-green-500 rounded-full -left-2.5 top-1.5" style="position: absolute; left: -1.95rem; top: 0.25rem; width: 0.8rem; height: 0.8rem; background: var(--success); border-radius: 50%;"></span>
                    <h4 class="font-medium">Intro to Python</h4>
                    <p class="text-xs text-muted mb-1">28 Des 2024 • Hadir</p>
                    <p class="text-sm text-gray-600">Instalasi Python, VS Code, dan Hello World.</p>
                </li>
                <li class="mb-6 relative">
                    <span class="absolute w-3 h-3 bg-green-500 rounded-full -left-2.5 top-1.5" style="position: absolute; left: -1.95rem; top: 0.25rem; width: 0.8rem; height: 0.8rem; background: var(--success); border-radius: 50%;"></span>
                    <h4 class="font-medium">Consultation</h4>
                    <p class="text-xs text-muted mb-1">25 Des 2024 • Hadir</p>
                    <p class="text-sm text-gray-600">Diskusi roadmap belajar.</p>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
