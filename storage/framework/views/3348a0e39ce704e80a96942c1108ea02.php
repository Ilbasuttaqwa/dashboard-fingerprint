<?php $__env->startSection('title', 'Laporan Potongan Gaji'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">
                        <i class="bi bi-file-earmark-text me-2"></i>Laporan Potongan Gaji
                    </h4>
                    <small>Laporan akumulasi potongan gaji berdasarkan keterlambatan dan bonus per bulan</small>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <form action="<?php echo e(route('keuangan.laporan-potongan-gaji')); ?>" method="GET" class="row g-3">
                                <div class="col-md-3">
                                    <label for="search" class="form-label">Nama Karyawan</label>
                                    <input type="text" class="form-control" id="search" name="search" 
                                           placeholder="Cari nama karyawan..." value="<?php echo e($search); ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="bulan" class="form-label">Bulan</label>
                                    <select class="form-select" id="bulan" name="bulan">
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
                                <div class="col-md-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <select class="form-select" id="tahun" name="tahun">
                                        <?php for($i = date('Y'); $i >= date('Y') - 5; $i--): ?>
                                            <option value="<?php echo e($i); ?>" <?php echo e($tahun == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="bi bi-search me-1"></i> Filter
                                    </button>
                                    <a href="<?php echo e(route('keuangan.laporan-potongan-gaji')); ?>" class="btn btn-outline-secondary me-2">
                                        <i class="bi bi-x-circle me-1"></i> Reset
                                    </a>
                                    <button type="button" class="btn btn-success" onclick="exportToPDF()">
                                        <i class="bi bi-file-pdf me-1"></i> Export PDF
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Total Karyawan</h6>
                                    <h4><?php echo e(count($laporanData)); ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Total Potongan</h6>
                                    <h4>Rp <?php echo e(number_format(array_sum(array_column($laporanData, 'total_potongan')), 0, ',', '.')); ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Total Bonus</h6>
                                    <h4>Rp <?php echo e(number_format(array_sum(array_column($laporanData, 'bonus_gaji')), 0, ',', '.')); ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-dark">
                                <div class="card-body">
                                    <h6 class="card-title">Periode</h6>
                                    <h4><?php echo e(DateTime::createFromFormat('!m', $bulan)->format('F')); ?> <?php echo e($tahun); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Table Section -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="laporanTable">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Nama Karyawan</th>
                                    <th width="15%">Golongan</th>
                                    <th width="15%">Lokasi (Cabang)</th>
                                    <th width="10%">Keterlambatan</th>
                                    <th width="12%">Potongan Gaji</th>
                                    <th width="12%">Bonus Gaji</th>
                                    <th width="11%">Total Bersih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($laporanData) > 0): ?>
                                    <?php $__currentLoopData = $laporanData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td>
                                            <strong><?php echo e($data['user']->nama_pegawai); ?></strong>
                                            <br><small class="text-muted"><?php echo e($data['user']->email); ?></small>
                                        </td>
                                        <td>
                                            <span class="badge bg-info text-dark">
                                                <?php echo e($data['user']->jabatan->nama_jabatan ?? '-'); ?>

                                            </span>
                                            <br><small class="text-muted">Gaji Pokok: Rp <?php echo e(number_format($data['user']->jabatan->gaji_pokok ?? 0, 0, ',', '.')); ?></small>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                <?php echo e($data['user']->cabang->nama_cabang ?? '-'); ?>

                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <?php if($data['keterlambatan'] > 0): ?>
                                                <span class="badge bg-warning text-dark"><?php echo e($data['keterlambatan']); ?>x</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">0x</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="text-danger">
                                                <strong>Rp <?php echo e(number_format($data['total_potongan'], 0, ',', '.')); ?></strong>
                                            </div>
                                            <?php if($data['potongan_keterlambatan'] > 0): ?>
                                                <small class="text-muted">Keterlambatan: Rp <?php echo e(number_format($data['potongan_keterlambatan'], 0, ',', '.')); ?></small><br>
                                            <?php endif; ?>
                                            <?php if($data['potongan_manual'] > 0): ?>
                                                <small class="text-muted">Manual: Rp <?php echo e(number_format($data['potongan_manual'], 0, ',', '.')); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($data['bonus_gaji'] > 0): ?>
                                                <span class="text-success">
                                                    <strong>Rp <?php echo e(number_format($data['bonus_gaji'], 0, ',', '.')); ?></strong>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-muted">Rp 0</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="fw-bold <?php echo e($data['gaji_bersih'] >= ($data['user']->jabatan->gaji_pokok ?? 0) ? 'text-success' : 'text-warning'); ?>">
                                                Rp <?php echo e(number_format($data['gaji_bersih'], 0, ',', '.')); ?>

                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="bi bi-inbox fs-1"></i>
                                                <p class="mt-2">Tidak ada data untuk periode yang dipilih</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <?php if(count($laporanData) > 0): ?>
                            <tfoot class="table-secondary">
                                <tr>
                                    <th colspan="5" class="text-end">TOTAL:</th>
                                    <th class="text-danger">Rp <?php echo e(number_format(array_sum(array_column($laporanData, 'total_potongan')), 0, ',', '.')); ?></th>
                                    <th class="text-success">Rp <?php echo e(number_format(array_sum(array_column($laporanData, 'bonus_gaji')), 0, ',', '.')); ?></th>
                                    <th class="text-primary">Rp <?php echo e(number_format(array_sum(array_column($laporanData, 'gaji_bersih')), 0, ',', '.')); ?></th>
                                </tr>
                            </tfoot>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function exportToPDF() {
    window.print();
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\laporan_potongan_gaji.blade.php ENDPATH**/ ?>