<?php $__env->startSection('title', 'Management Penggajian'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">
                        <i class="bi bi-cash-stack me-2"></i>Management Penggajian
                    </h4>
                    <small>Kelola data penggajian karyawan berdasarkan golongan</small>
                </div>
                <div class="card-body">
                    <!-- Filter Bulan dan Tahun -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form method="GET" action="<?php echo e(route('keuangan.penggajian')); ?>" class="d-flex align-items-end gap-3">
                                <div class="form-group">
                                    <label for="bulan">Bulan:</label>
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="01" <?php echo e($bulan == '01' ? 'selected' : ''); ?>>Januari</option>
                                        <option value="02" <?php echo e($bulan == '02' ? 'selected' : ''); ?>>Februari</option>
                                        <option value="03" <?php echo e($bulan == '03' ? 'selected' : ''); ?>>Maret</option>
                                        <option value="04" <?php echo e($bulan == '04' ? 'selected' : ''); ?>>April</option>
                                        <option value="05" <?php echo e($bulan == '05' ? 'selected' : ''); ?>>Mei</option>
                                        <option value="06" <?php echo e($bulan == '06' ? 'selected' : ''); ?>>Juni</option>
                                        <option value="07" <?php echo e($bulan == '07' ? 'selected' : ''); ?>>Juli</option>
                                        <option value="08" <?php echo e($bulan == '08' ? 'selected' : ''); ?>>Agustus</option>
                                        <option value="09" <?php echo e($bulan == '09' ? 'selected' : ''); ?>>September</option>
                                        <option value="10" <?php echo e($bulan == '10' ? 'selected' : ''); ?>>Oktober</option>
                                        <option value="11" <?php echo e($bulan == '11' ? 'selected' : ''); ?>>November</option>
                                        <option value="12" <?php echo e($bulan == '12' ? 'selected' : ''); ?>>Desember</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tahun">Tahun:</label>
                                    <select name="tahun" id="tahun" class="form-control">
                                        <?php for($i = date('Y'); $i >= date('Y') - 5; $i--): ?>
                                            <option value="<?php echo e($i); ?>" <?php echo e($tahun == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Navigation Tabs -->
                    <ul class="nav nav-tabs mb-4" id="penggajianTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="daftar-tab" data-bs-toggle="tab" data-bs-target="#daftar" type="button" role="tab">
                                <i class="bi bi-list-ul me-1"></i> Daftar Gaji
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="bonus-tab" data-bs-toggle="tab" data-bs-target="#bonus" type="button" role="tab">
                                <i class="bi bi-plus-circle me-1"></i> Bonus Gaji
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="potongan-tab" data-bs-toggle="tab" data-bs-target="#potongan" type="button" role="tab">
                                <i class="bi bi-dash-circle me-1"></i> Potongan Gaji
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="penggajianTabContent">
                        <!-- Daftar Gaji Tab -->
                        <div class="tab-pane fade show active" id="daftar" role="tabpanel">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h5>Daftar Gaji Karyawan</h5>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addGajiModal">
                                        <i class="bi bi-plus-circle me-1"></i> Tambah Gaji
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="gajiTable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Golongan</th>
                                            <th>Gaji Pokok</th>
                                            <th>Bonus</th>
                                            <th>Keterlambatan</th>
                                            <th>Potongan</th>
                                            <th>Total Gaji</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($penggajianData) && count($penggajianData) > 0): ?>
                                            <?php $__currentLoopData = $penggajianData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?></td>
                                                <td>
                                                    <strong><?php echo e($data['user']->nama_pegawai); ?></strong>
                                                    <br><small class="text-muted"><?php echo e($data['user']->email); ?></small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info"><?php echo e($data['user']->jabatan->nama_jabatan ?? '-'); ?></span>
                                                </td>
                                                <td>Rp <?php echo e(number_format($data['gaji_pokok'], 0, ',', '.')); ?></td>
                                                <td>
                                                    <span class="text-success">Rp <?php echo e(number_format($data['total_bonus'], 0, ',', '.')); ?></span>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <span class="badge bg-warning text-dark"><?php echo e($data['total_keterlambatan']); ?> menit</span>
                                                        <br><small class="text-danger">Rp <?php echo e(number_format($data['total_potongan_keterlambatan'], 0, ',', '.')); ?></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <span class="text-danger">Rp <?php echo e(number_format($data['total_potongan'], 0, ',', '.')); ?></span>
                                                        <br><small class="text-muted">(Manual: Rp <?php echo e(number_format($data['total_potongan_manual'], 0, ',', '.')); ?>)</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <strong class="text-primary">Rp <?php echo e(number_format($data['gaji_bersih'], 0, ',', '.')); ?></strong>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-sm btn-outline-primary" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-info" title="Detail Keterlambatan" onclick="showDetailKeterlambatan(<?php echo e($data['user']->id); ?>, '<?php echo e($data['user']->nama_pegawai); ?>')">
                                                            <i class="bi bi-clock-history"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="9" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="bi bi-inbox fs-1"></i>
                                                        <p class="mt-2">Belum ada data penggajian</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Bonus Gaji Tab -->
                        <div class="tab-pane fade" id="bonus" role="tabpanel">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h5>Management Bonus Gaji</h5>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBonusModal">
                                        <i class="bi bi-plus-circle me-1"></i> Tambah Bonus
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Golongan</th>
                                            <th>Jumlah Bonus</th>
                                            <th>Periode</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($bonusData) && count($bonusData) > 0): ?>
                                            <?php $__currentLoopData = $bonusData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bonus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?></td>
                                                <td><?php echo e($bonus->user->nama_pegawai); ?></td>
                                                <td>
                                                    <span class="badge bg-info"><?php echo e($bonus->user->jabatan->nama_jabatan ?? '-'); ?></span>
                                                </td>
                                                <td>
                                                    <span class="text-success fw-bold">Rp <?php echo e(number_format($bonus->jumlah_bonus, 0, ',', '.')); ?></span>
                                                </td>
                                                <td><?php echo e(date('F Y', strtotime($bonus->bulan_tahun))); ?></td>
                                                <td><?php echo e($bonus->keterangan ?? '-'); ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-sm btn-outline-primary" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="bi bi-inbox fs-1"></i>
                                                        <p class="mt-2">Belum ada data bonus</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Potongan Gaji Tab -->
                        <div class="tab-pane fade" id="potongan" role="tabpanel">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h5>Management Potongan Gaji</h5>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addPotonganModal">
                                        <i class="bi bi-dash-circle me-1"></i> Tambah Potongan
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Golongan</th>
                                            <th>Jumlah Potongan</th>
                                            <th>Periode</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($potonganData) && count($potonganData) > 0): ?>
                                            <?php $__currentLoopData = $potonganData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $potongan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key + 1); ?></td>
                                                <td><?php echo e($potongan->user->nama_pegawai); ?></td>
                                                <td>
                                                    <span class="badge bg-info"><?php echo e($potongan->user->jabatan->nama_jabatan ?? '-'); ?></span>
                                                </td>
                                                <td>
                                                    <span class="text-danger fw-bold">Rp <?php echo e(number_format($potongan->jumlah_potongan, 0, ',', '.')); ?></span>
                                                </td>
                                                <td><?php echo e(date('F Y', strtotime($potongan->bulan_tahun))); ?></td>
                                                <td><?php echo e($potongan->keterangan ?? '-'); ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-sm btn-outline-primary" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="bi bi-inbox fs-1"></i>
                                                        <p class="mt-2">Belum ada data potongan</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Add Gaji Modal -->
<div class="modal fade" id="addGajiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Gaji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('keuangan.store-penggajian')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Karyawan</label>
                        <select class="form-select" name="id_user" required>
                            <option value="">Pilih Karyawan</option>
                            <?php if(isset($users)): ?>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->nama_pegawai); ?> - <?php echo e($user->jabatan->nama_jabatan ?? '-'); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Periode</label>
                        <input type="month" class="form-control" name="periode" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Bonus Modal -->
<div class="modal fade" id="addBonusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Bonus Gaji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('keuangan.store-bonus-gaji')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Karyawan</label>
                        <select class="form-select" name="id_user" required>
                            <option value="">Pilih Karyawan</option>
                            <?php if(isset($users)): ?>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->nama_pegawai); ?> - <?php echo e($user->jabatan->nama_jabatan ?? '-'); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Bonus</label>
                        <input type="number" class="form-control" name="jumlah_bonus" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Periode</label>
                        <input type="month" class="form-control" name="bulan_tahun" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Potongan Modal -->
<div class="modal fade" id="addPotonganModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Potongan Gaji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('keuangan.store-potongan-gaji')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Karyawan</label>
                        <select class="form-select" name="id_user" required>
                            <option value="">Pilih Karyawan</option>
                            <?php if(isset($users)): ?>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->nama_pegawai); ?> - <?php echo e($user->jabatan->nama_jabatan ?? '-'); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Potongan</label>
                        <input type="number" class="form-control" name="jumlah_potongan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Periode</label>
                        <input type="month" class="form-control" name="bulan_tahun" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Keterlambatan -->
<div class="modal fade" id="detailKeterlambatanModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Keterlambatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="detailKeterlambatanContent">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat data...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize DataTable
$(document).ready(function() {
    $('#gajiTable').DataTable({
        responsive: true,
        language: {
            search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                zeroRecords: "Tidak ada data yang ditemukan",
                emptyTable: "Tidak ada data tersedia",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
        }
    });
});

// Function to show detail keterlambatan
function showDetailKeterlambatan(userId, namaKaryawan) {
    const bulan = '<?php echo e($bulan); ?>';
    const tahun = '<?php echo e($tahun); ?>';

    // Show modal
    $('#detailKeterlambatanModal').modal('show');

    // Update modal title
    $('.modal-title').text('Detail Keterlambatan - ' + namaKaryawan);

    // Fetch detail data
    $.ajax({
        url: `/admin/keuangan/detail-keterlambatan/${userId}`,
        method: 'GET',
        data: {
            bulan: bulan,
            tahun: tahun
        },
        success: function(response) {
            let content = `
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nama Karyawan:</strong> ${response.user.nama_pegawai}
                    </div>
                    <div class="col-md-6">
                        <strong>Golongan:</strong> ${response.user.jabatan.nama_jabatan}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Periode:</strong> ${getBulanNama(response.bulan)} ${response.tahun}
                    </div>
                    <div class="col-md-4">
                        <strong>Total Keterlambatan:</strong> <span class="badge bg-warning text-dark">${response.total_keterlambatan} menit</span>
                    </div>
                    <div class="col-md-4">
                        <strong>Total Potongan:</strong> <span class="text-danger">Rp ${formatRupiah(response.total_potongan_keterlambatan)}</span>
                    </div>
                </div>
                <hr>
                <h6>Detail Keterlambatan per Hari:</h6>
            `;

            if (response.detail_keterlambatan.length > 0) {
                content += `
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jam Standar</th>
                                    <th>Jam Masuk</th>
                                    <th>Terlambat</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                `;

                response.detail_keterlambatan.forEach((item, index) => {
                    content += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${formatTanggal(item.tanggal)}</td>
                            <td>${item.jam_standar}</td>
                            <td class="text-danger">${item.jam_masuk}</td>
                            <td><span class="badge bg-warning text-dark">${item.menit_terlambat} menit</span></td>
                            <td>${item.status || '-'}</td>
                            <td>${item.note || '-'}</td>
                        </tr>
                    `;
                });

                content += `
                            </tbody>
                        </table>
                    </div>
                `;
            } else {
                content += `
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-check-circle fs-1 text-success"></i>
                        <p class="mt-2">Tidak ada keterlambatan pada periode ini</p>
                    </div>
                `;
            }

            $('#detailKeterlambatanContent').html(content);
        },
        error: function() {
            $('#detailKeterlambatanContent').html(`
                <div class="text-center text-danger py-4">
                    <i class="bi bi-exclamation-triangle fs-1"></i>
                    <p class="mt-2">Gagal memuat data. Silakan coba lagi.</p>
                </div>
            `);
        }
    });
}

// Helper functions
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID').format(angka);
}

function formatTanggal(tanggal) {
    const date = new Date(tanggal);
    return date.toLocaleDateString('id-ID', {
        weekday: 'short',
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

function getBulanNama(bulan) {
    const namaBulan = [
        '', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    return namaBulan[parseInt(bulan)];
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\keuangan\penggajian.blade.php ENDPATH**/ ?>