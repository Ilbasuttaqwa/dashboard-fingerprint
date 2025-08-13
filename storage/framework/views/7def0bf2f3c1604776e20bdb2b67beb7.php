<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <!-- Employee Profile Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar avatar-xl bg-gradient-primary rounded-circle mx-auto mb-3">
                        <span class="text-white font-weight-bold h4">
                            <?php echo e(strtoupper(substr($karyawan->name, 0, 2))); ?>

                        </span>
                    </div>
                    <h5 class="mb-1"><?php echo e($karyawan->name); ?></h5>
                    <p class="text-muted mb-2"><?php echo e($karyawan->jabatan->nama_jabatan ?? 'Tidak Ada Jabatan'); ?></p>
                    <p class="text-sm text-secondary mb-3"><?php echo e($karyawan->cabang->nama_cabang ?? 'Lokasi Tidak Diketahui'); ?></p>
                    
                    <?php if($karyawan->nip): ?>
                        <div class="border-top pt-3">
                            <small class="text-muted">NIP</small>
                            <p class="mb-0"><?php echo e($karyawan->nip); ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($karyawan->email): ?>
                        <div class="border-top pt-3 mt-3">
                            <small class="text-muted">Email</small>
                            <p class="mb-0"><?php echo e($karyawan->email); ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="border-top pt-3 mt-3">
                        <small class="text-muted">Bergabung Sejak</small>
                        <p class="mb-0"><?php echo e($karyawan->created_at->format('d M Y')); ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Attendance Statistics -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Statistik Kehadiran Bulan Ini</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-6">
                            <div class="text-center">
                                <h3 class="text-primary mb-0"><?php echo e($attendanceStats['total_days']); ?></h3>
                                <small class="text-muted">Total Hadir</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-center">
                                <h3 class="text-success mb-0"><?php echo e($attendanceStats['on_time_days']); ?></h3>
                                <small class="text-muted">Tepat Waktu</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-center">
                                <h3 class="text-warning mb-0"><?php echo e($attendanceStats['late_days']); ?></h3>
                                <small class="text-muted">Terlambat</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="text-center">
                                <h3 class="text-info mb-0"><?php echo e($attendanceStats['attendance_rate']); ?>%</h3>
                                <small class="text-muted">Tingkat Kehadiran</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="progress mt-3" style="height: 10px;">
                        <div class="progress-bar bg-gradient-success" 
                             style="width: <?php echo e($attendanceStats['attendance_rate']); ?>%"></div>
                    </div>
                </div>
            </div>
            
            <!-- Attendance History -->
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Riwayat Kehadiran (30 Hari Terakhir)</h6>
                        <a href="<?php echo e(route('user.karyawan.index')); ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if($attendanceHistory->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Masuk</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam Keluar</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $attendanceHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-2">
                                                        <i class="fas fa-calendar-day text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-sm"><?php echo e(\Carbon\Carbon::parse($attendance->tanggal_absen)->format('d M Y')); ?></h6>
                                                        <small class="text-xs text-muted"><?php echo e(\Carbon\Carbon::parse($attendance->tanggal_absen)->format('l')); ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if($attendance->jam_masuk): ?>
                                                    <span class="text-sm"><?php echo e(\Carbon\Carbon::parse($attendance->jam_masuk)->format('H:i')); ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted text-sm">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($attendance->jam_keluar): ?>
                                                    <span class="text-sm"><?php echo e(\Carbon\Carbon::parse($attendance->jam_keluar)->format('H:i')); ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted text-sm">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($attendance->note == 'Telat'): ?>
                                                    <span class="badge badge-sm bg-gradient-warning">Terlambat</span>
                                                <?php elseif($attendance->jam_masuk && $attendance->jam_keluar): ?>
                                                    <span class="badge badge-sm bg-gradient-success">Hadir</span>
                                                <?php elseif($attendance->jam_masuk): ?>
                                                    <span class="badge badge-sm bg-gradient-info">Masuk</span>
                                                <?php else: ?>
                                                    <span class="badge badge-sm bg-gradient-secondary">Tidak Hadir</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="text-sm"><?php echo e($attendance->note ?? '-'); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada data kehadiran</h5>
                            <p class="text-sm text-muted">Belum ada riwayat kehadiran dalam 30 hari terakhir</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Add any additional JavaScript functionality here
    document.addEventListener('DOMContentLoaded', function() {
        // You can add interactive features like charts or real-time updates here
        console.log('Employee detail page loaded');
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\user\karyawan\show.blade.php ENDPATH**/ ?>