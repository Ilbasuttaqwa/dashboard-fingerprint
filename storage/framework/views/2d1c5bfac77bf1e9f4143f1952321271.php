<?php $__env->startSection('title', 'Data Fingerprint Attendance'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Fingerprint Attendance</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" onclick="reprocessData()">
                            <i class="fas fa-sync"></i> Proses Ulang Data
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Filter Form -->
                    <form method="GET" action="<?php echo e(route('fingerprint-attendance.index')); ?>" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="date">Tanggal:</label>
                                <input type="date" name="date" id="date" class="form-control" value="<?php echo e(request('date')); ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="processed">Status:</label>
                                <select name="processed" id="processed" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="1" <?php echo e(request('processed') == '1' ? 'selected' : ''); ?>>Sudah Diproses</option>
                                    <option value="0" <?php echo e(request('processed') == '0' ? 'selected' : ''); ?>>Belum Diproses</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-info mr-2">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                                <a href="<?php echo e(route('fingerprint-attendance.index')); ?>" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Device User ID</th>
                                    <th>Nama Pegawai</th>
                                    <th>Cabang</th>
                                    <th>Waktu Absensi</th>
                                    <th>Tipe Absensi</th>
                                    <th>Device IP</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($attendances->firstItem() + $index); ?></td>
                                    <td><?php echo e($attendance->device_user_id); ?></td>
                                    <td>
                                        <?php if($attendance->user): ?>
                                            <?php echo e($attendance->user->nama_pegawai); ?>

                                        <?php else: ?>
                                            <span class="text-muted">User tidak ditemukan</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($attendance->cabang): ?>
                                            <?php echo e($attendance->cabang->nama_cabang); ?>

                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($attendance->attendance_time->format('d/m/Y H:i:s')); ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo e($attendance->attendance_type == 1 ? 'success' : ($attendance->attendance_type == 2 ? 'danger' : 'warning')); ?>">
                                            <?php echo e($attendance->attendance_type_name); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($attendance->device_ip); ?></td>
                                    <td>
                                        <?php if($attendance->is_processed): ?>
                                            <span class="badge badge-success">Sudah Diproses</span>
                                        <?php else: ?>
                                            <span class="badge badge-warning">Belum Diproses</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" onclick="showDetails(<?php echo e($attendance->id); ?>)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteRecord(<?php echo e($attendance->id); ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data fingerprint attendance</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        <?php echo e($attendances->appends(request()->query())->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Fingerprint Attendance</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function reprocessData() {
    if (confirm('Apakah Anda yakin ingin memproses ulang data fingerprint yang belum diproses?')) {
        $.ajax({
            url: '<?php echo e(route("fingerprint-attendance.reprocess")); ?>',
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 3000
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat memproses data'
                });
            }
        });
    }
}

function showDetails(id) {
    // Show loading
    $('#detailContent').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');
    $('#detailModal').modal('show');
    
    // Load detail data (you can implement this endpoint if needed)
    // For now, just show a placeholder
    setTimeout(() => {
        $('#detailContent').html('<p>Detail data akan ditampilkan di sini</p>');
    }, 1000);
}

function deleteRecord(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        $.ajax({
            url: '<?php echo e(url("admin/fingerprint-attendance")); ?>/' + id,
            type: 'DELETE',
            data: {
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 2000
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menghapus data'
                });
            }
        });
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\fingerprint-attendance\index.blade.php ENDPATH**/ ?>