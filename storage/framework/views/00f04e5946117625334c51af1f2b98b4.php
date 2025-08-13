<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Data Karyawan - <?php echo e($currentBranch->nama_cabang ?? 'Lokasi Tidak Diketahui'); ?></h6>
                            <p class="text-sm mb-0">Daftar karyawan yang bekerja di lokasi yang sama dengan Anda</p>
                        </div>
                        <div class="badge badge-info">
                            Total: <?php echo e($karyawan->total()); ?> Karyawan
                        </div>
                    </div>
                </div>
                
                <!-- Filter Section -->
                <div class="card-body">
                    <form method="GET" action="<?php echo e(route('user.karyawan.index')); ?>" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-search me-1"></i>Cari Karyawan
                                </label>
                                <input type="text" class="form-control" name="search" 
                                       placeholder="Nama, Email, atau NIP..." 
                                       value="<?php echo e(request('search')); ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-briefcase me-1"></i>Filter Jabatan
                                </label>
                                <select class="form-select" name="jabatan">
                                    <option value="">Semua Jabatan</option>
                                    <?php $__currentLoopData = $jabatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($j->id); ?>" <?php echo e(request('jabatan') == $j->id ? 'selected' : ''); ?>>
                                            <?php echo e($j->nama_jabatan); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-filter me-1"></i>Filter
                                </button>
                                <a href="<?php echo e(route('user.karyawan.index')); ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i>Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Employee Cards -->
                    <div class="row">
                        <?php $__empty_1 = true; $__currentLoopData = $karyawan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="avatar avatar-lg bg-gradient-primary rounded-circle me-3">
                                                <span class="text-white font-weight-bold">
                                                    <?php echo e(strtoupper(substr($employee->name, 0, 2))); ?>

                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0"><?php echo e($employee->name); ?></h6>
                                                <p class="text-sm text-muted mb-0"><?php echo e($employee->jabatan->nama_jabatan ?? 'Tidak Ada Jabatan'); ?></p>
                                                <?php if($employee->nip): ?>
                                                    <small class="text-xs text-secondary">NIP: <?php echo e($employee->nip); ?></small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="row text-center mb-3">
                                            <div class="col-4">
                                                <div class="border-end">
                                                    <h6 class="text-primary mb-0"><?php echo e($employee->attendance_stats['total_days']); ?></h6>
                                                    <small class="text-xs text-muted">Total Hadir</small>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="border-end">
                                                    <h6 class="text-success mb-0"><?php echo e($employee->attendance_stats['on_time_days']); ?></h6>
                                                    <small class="text-xs text-muted">Tepat Waktu</small>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <h6 class="text-warning mb-0"><?php echo e($employee->attendance_stats['late_days']); ?></h6>
                                                <small class="text-xs text-muted">Terlambat</small>
                                            </div>
                                        </div>
                                        
                                        <div class="progress mb-3" style="height: 6px;">
                                            <div class="progress-bar bg-gradient-success" 
                                                 style="width: <?php echo e($employee->attendance_stats['attendance_rate']); ?>%"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">Tingkat Kehadiran: <?php echo e($employee->attendance_stats['attendance_rate']); ?>%</small>
                                            <a href="<?php echo e(route('user.karyawan.show', $employee->id)); ?>" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i>Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Tidak ada karyawan ditemukan</h5>
                                    <p class="text-sm text-muted">
                                        <?php if(request('search') || request('jabatan')): ?>
                                            Coba ubah filter pencarian Anda
                                        <?php else: ?>
                                            Belum ada karyawan lain di lokasi ini
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Pagination -->
                    <?php if($karyawan->hasPages()): ?>
                        <div class="d-flex justify-content-center mt-4">
                            <?php echo e($karyawan->appends(request()->query())->links()); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Auto-submit form when filter changes
    document.querySelector('select[name="jabatan"]').addEventListener('change', function() {
        this.form.submit();
    });
    
    // Add loading state to filter button
    document.querySelector('form').addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memuat...';
        btn.disabled = true;
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\user\karyawan\index.blade.php ENDPATH**/ ?>