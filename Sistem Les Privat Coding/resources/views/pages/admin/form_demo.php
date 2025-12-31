<?php $title = 'Tambah Murid Baru'; ?>

<?php ob_start(); ?>

<div class="max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold">Tambah Murid Baru</h2>
            <p class="text-sm text-gray-500">Isi formulir di bawah ini untuk mendaftarkan murid baru.</p>
        </div>
        <a href="/admin/accounts" class="btn btn-outline">
            Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-content">
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Info -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium mb-4">Informasi Pribadi</h3>
                    </div>

                    <div class="input-group">
                        <label class="label">Nama Lengkap</label>
                        <input type="text" class="input" placeholder="Contoh: John Doe">
                    </div>

                    <div class="input-group">
                        <label class="label">Email</label>
                        <input type="email" class="input" placeholder="contoh@email.com">
                    </div>

                    <div class="input-group">
                        <label class="label">Nomor Telepon</label>
                        <input type="tel" class="input" placeholder="08123456789">
                    </div>

                    <div class="input-group">
                        <label class="label">Tanggal Lahir</label>
                        <input type="date" class="input">
                    </div>

                    <div class="md:col-span-2">
                        <div class="input-group">
                            <label class="label">Alamat Lengkap</label>
                            <textarea class="input" rows="3" placeholder="Jl. Contoh No. 123..."></textarea>
                        </div>
                    </div>

                    <!-- Package Info -->
                    <div class="md:col-span-2 border-t border-gray-100 pt-6 mt-2">
                         <h3 class="text-lg font-medium mb-4">Pilihan Paket</h3>
                    </div>

                    <div class="input-group">
                        <label class="label">Paket Belajar</label>
                        <select class="input">
                            <option>Pilih Paket...</option>
                            <option value="basic">Paket Basic (Rp 500.000)</option>
                            <option value="premium">Paket Premium (Rp 1.200.000)</option>
                            <option value="bootcamp">Intensive Bootcamp (Rp 3.500.000)</option>
                        </select>
                    </div>

                     <div class="input-group">
                        <label class="label">Jadwal Preferensi</label>
                         <div class="flex flex-col gap-2 mt-2">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="accent-blue-600">
                                <span class="text-sm">Senin - Rabu (Sore)</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="accent-blue-600">
                                <span class="text-sm">Selasa - Kamis (Malam)</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="accent-blue-600">
                                <span class="text-sm">Sabtu - Minggu (Pagi)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" class="btn btn-ghost">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Murid</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php include __DIR__ . '/../../layouts/app.php'; ?>
