<?php $__env->startSection('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Edit Berkas Pribadi</h4>

    <form action="<?php echo e(route('berkas.update', $berkas->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="file_cv" class="form-label">CV</label>
            <input type="file" class="form-control" name="file_cv">
        </div>

        <div class="mb-3">
            <label for="file_kk" class="form-label">KK</label>
            <input type="file" class="form-control" name="file_kk">
        </div>

        <div class="mb-3">
            <label for="file_ktp" class="form-label">KTP</label>
            <input type="file" class="form-control" name="file_ktp">
        </div>

        <div class="mb-3">
            <label for="file_akte" class="form-label">Akte</label>
            <input type="file" class="form-control" name="file_akte">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?php echo e(route('berkas.index')); ?>" class="btn btn-secondary">Back</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\berkas\edit.blade.php ENDPATH**/ ?>