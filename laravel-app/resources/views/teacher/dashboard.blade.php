@extends('layouts.app', ['role' => 'teacher'])

@section('title', 'Dashboard Pengajar - Sistem Les Privat')
@section('header', 'Dashboard Pengajar')

@section('content')
<!-- Today's Stats -->
<div class="grid-stats" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 2rem;">
    <div class="card p-4 text-center">
        <p class="text-muted text-sm">Kelas Hari Ini</p>
        <h3 class="text-3xl font-bold">3</h3>
    </div>
    <div class="card p-4 text-center">
        <p class="text-muted text-sm">Total Jam Mengajar</p>
        <h3 class="text-3xl font-bold">4.5 <span class="text-sm font-normal text-muted">Jam</span></h3>
    </div>
    <div class="card p-4 text-center">
        <p class="text-muted text-sm">Pending Laporan</p>
        <h3 class="text-3xl font-bold text-danger">1</h3>
    </div>
</div>

<div class="card">
    <div class="card-header flex items-center justify-between">
        <h3 class="card-title">Jadwal Mengajar Hari Ini</h3>
        <span class="text-sm text-muted">{{ date('l, d F Y') }}</span>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Murid</th>
                    <th>Materi</th>
                    <th>Link Meeting</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Completed -->
                <tr style="background-color: #f8fafc;">
                    <td class="text-muted"><del>10:00 - 11:30</del></td>
                    <td class="text-muted">Andi Wijaya</td>
                    <td class="text-muted">Javascript Loops</td>
                    <td class="text-muted">-</td>
                    <td class="text-right">
                        <span class="badge badge-success">Selesai</span>
                    </td>
                </tr>
                <!-- Upcoming -->
                <tr style="background-color: #fff7ed; border-left: 4px solid var(--warning);">
                    <td class="font-bold">14:00 - 15:30</td>
                    <td><span class="font-bold">Budi Santoso</span></td>
                    <td>Python Variables</td>
                    <td><a href="#" class="text-primary hover:underline">Zoom Link ↗</a></td>
                    <td class="text-right">
                        <button class="btn btn-primary btn-sm">Input Kehadiran</button>
                    </td>
                </tr>
                <!-- Future -->
                <tr>
                    <td>19:00 - 20:30</td>
                    <td>Rudi Hartono</td>
                    <td>React Components</td>
                    <td><a href="#" class="text-primary hover:underline">Create Link</a></td>
                    <td class="text-right">
                        <button class="btn btn-outline btn-sm" disabled>Belum Mulai</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card mt-6">
    <div class="card-header">
        <h3 class="card-title">Input Cepat Kehadiran</h3>
    </div>
    <form class="grid-stats" style="display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 1rem; align-items: end;">
        <div class="form-group mb-0">
            <label class="form-label">Pilih Kelas</label>
            <select class="form-control">
                <option>Budi Santoso - 14:00 (Today)</option>
            </select>
        </div>
        <div class="form-group mb-0">
            <label class="form-label">Status Kehadiran</label>
            <select class="form-control">
                <option>Hadir</option>
                <option>Izin</option>
                <option>Sakit</option>
                <option>Alpha</option>
            </select>
        </div>
        <div class="form-group mb-0">
            <label class="form-label">Catatan Materi</label>
            <input type="text" class="form-control" placeholder="Materi yang dibahas...">
        </div>
        <button type="submit" class="btn btn-success" style="height: 42px;">Simpan</button>
    </form>
</div>
@endsection
