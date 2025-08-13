<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold py-3">Form Edit Lokasi</h5>
                    <div class="row">
                        <form action="<?php echo e(route('cabang.update', $cabang->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label for="nama_cabang" class="form-label">Nama Lokasi</label>
                                <input type="text" class="form-control" name="nama_cabang" value="<?php echo e($cabang->nama_cabang); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3"><?php echo e($cabang->alamat); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="kode_cabang" class="form-label">Kode Lokasi</label>
                                <input type="text" class="form-control" name="kode_cabang" value="<?php echo e($cabang->kode_cabang); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="<?php echo e(route('cabang.index')); ?>" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\cabang\edit.blade.php ENDPATH**/ ?>