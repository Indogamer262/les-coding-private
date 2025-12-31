@extends('layouts.app', ['role' => 'admin'])

@section('title', 'Kelola Akun - Admin')
@section('header', 'Kelola Akun')

@section('content')
<div class="flex items-center justify-between mb-4">
    <div class="flex gap-2">
        <button class="btn btn-primary">Murid</button>
        <button class="btn btn-outline">Pengajar</button>
    </div>
    <button class="btn btn-primary">
        + Tambah Baru
    </button>
</div>

<div class="card">
    <div class="card-header flex items-center justify-between">
        <h3 class="card-title">Daftar Murid</h3>
        <input type="search" placeholder="Cari nama..." class="form-control" style="width: 250px;">
    </div>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Paket Aktif</th>
                    <th>Sisa Pertemuan</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
                <tr>
                    <td>
                        <div class="font-medium">Budi Santoso</div>
                        <div class="text-xs text-muted">Joined Jan 2024</div>
                    </td>
                    <td>budi@example.com</td>
                    <td>Python Basic (12 Sesi)</td>
                    <td>8</td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td class="text-right">
                        <button class="btn btn-outline" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Edit</button>
                        <button class="btn btn-outline text-danger" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-color: transparent;">Hapus</button>
                    </td>
                </tr>
                <!-- Row 2 -->
                <tr>
                    <td>
                        <div class="font-medium">Siti Aminah</div>
                        <div class="text-xs text-muted">Joined Feb 2024</div>
                    </td>
                    <td>siti@example.com</td>
                    <td>Web Dev (24 Sesi)</td>
                    <td>20</td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td class="text-right">
                        <button class="btn btn-outline" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Edit</button>
                        <button class="btn btn-outline text-danger" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-color: transparent;">Hapus</button>
                    </td>
                </tr>
                <!-- Row 3 -->
                <tr>
                    <td>
                        <div class="font-medium">Andi Wijaya</div>
                        <div class="text-xs text-muted">Joined Mar 2024</div>
                    </td>
                    <td>andi@example.com</td>
                    <td>-</td>
                    <td>0</td>
                    <td><span class="badge badge-warning">Inactive</span></td>
                    <td class="text-right">
                        <button class="btn btn-outline" style="padding: 0.25rem 0.5rem; font-size: 0.75rem;">Edit</button>
                        <button class="btn btn-outline text-danger" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-color: transparent;">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Mock -->
    <div class="flex items-center justify-between mt-4 text-sm text-muted">
        <div>Menampilkan 1-3 dari 128 data</div>
        <div class="flex gap-2">
            <button class="btn btn-outline" disabled>Previous</button>
            <button class="btn btn-outline">Next</button>
        </div>
    </div>
</div>
@endsection
