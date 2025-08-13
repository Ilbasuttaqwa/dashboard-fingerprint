<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Menu /</span> Berkas Pribadi</h4>

        
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="validationToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bi bi-cloud-arrow-up-fill me-2"></i>
                    <div class="me-auto fw-semibold">Success</div>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Data sudah ada!
                </div>
            </div>
        </div>


        <!-- Toast Untuk Success -->
        <?php if(session('success')): ?>
            <div class="bs-toast toast toast-placement-ex m-2 bg-success top-0 end-0 fade show toast-custom" role="alert"
                aria-live="assertive" aria-atomic="true" id="toastSuccess">
                <div class="toast-header">
                    <i class="bi bi-check-circle me-2"></i>
                    <div class="me-auto fw-semibold">Success</div>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?php echo e(session('success')); ?>

                </div>
            </div>
        <?php endif; ?>

        
        <?php if(session('error')): ?>
            <div class="bs-toast toast toast-placement-ex m-2 bg-danger top-0 end-0 fade show toast-custom" role="alert"
                aria-live="assertive" aria-atomic="true" id="toastError">
                <div class="toast-header">
                    <i class="bx bx-error me-2"></i>
                    <div class="me-auto fw-semibold">Error</div>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?php echo e(session('error')); ?>

                </div>
            </div>
        <?php endif; ?>


        
        <?php if(session('danger')): ?>
            <div class="bs-toast toast toast-placement-ex m-2 bg-danger top-0 end-0 fade show toast-custom" role="alert"
                aria-live="assertive" aria-atomic="true" id="toastError">
                <div class="toast-header">
                    <i class="bx bx-error me-2"></i>
                    <div class="me-auto fw-semibold">Danger</div>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?php echo e(session('danger')); ?>

                </div>
            </div>
        <?php endif; ?>

        
        <?php if(session('warning')): ?>
            <div class="bs-toast toast toast-placement-ex m-2 bg-warning top-0 end-0 fade show toast-custom" role="alert"
                aria-live="assertive" aria-atomic="true" id="toastError">
                <div class="toast-header">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <div class="me-auto fw-semibold">Warning</div>
                    <small>Just Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?php echo e(session('warning')); ?>

                </div>
            </div>
        <?php endif; ?>

        <div class="card mb-4 pb-2">
            <h5 class="card-header">
                <button type="button" class="btn rounded-pill btn-info" data-bs-toggle="modal"
                    data-bs-target="#createModal"
                    style="float: right; padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                    <i class="bi bi-person-fill-add" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left"
                        data-bs-html="true" title="Add berkas"></i>
                    Add Berkas
                </button>
                Add Berkas
            </h5>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>CV</th>
                            <th>KK</th>
                            <th>KTP</th>
                            <th>AKTE</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php if($berkas->isEmpty()): ?>
                            <tr>
                                <td colspan="7" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        <?php else: ?>
                            <?php $__currentLoopData = $berkas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->index + 1); ?></td>
                                    <td><?php echo e($data->pegawai->nama_pegawai); ?></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn rounded-pill btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#viewCVModal<?php echo e($data->id); ?>"
                                            style="padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                                            <i class="bx bx-search-alt" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                data-bs-placement="left" data-bs-html="true" title="Lihat CV"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn rounded-pill btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#viewKKModal<?php echo e($data->id); ?>"
                                            style="padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                                            <i class="bx bx-search-alt" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                data-bs-placement="left" data-bs-html="true" title="Lihat KK"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn rounded-pill btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#viewKTPModal<?php echo e($data->id); ?>"
                                            style="padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                                            <i class="bx bx-search-alt" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                data-bs-placement="left" data-bs-html="true" title="Lihat KTP"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn rounded-pill btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#viewAKTEModal<?php echo e($data->id); ?>"
                                            style="padding-left: 20px; padding-right: 20px; padding-top: 7px; padding-bottom: 7px">
                                            <i class="bx bx-search-alt" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                data-bs-placement="left" data-bs-html="true" title="Lihat AKTE"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" href="<?php echo e(route('berkas.edit', $data->id)); ?>">Edit</a>
                                        <button class="btn btn-danger btn-delete" data-id="<?php echo e($data->id); ?>">Delete</button>
                                        <form id="delete-form-<?php echo e($data->id); ?>" action="<?php echo e(route('berkas.destroy', $data->id)); ?>" method="POST" style="display: none;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deleteModal<?php echo e($data->id); ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus berkas ini?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="<?php echo e(route('berkas.destroy', $data->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal View CV -->
                            <div class="modal fade" id="viewCVModal<?php echo e($data->id); ?>" tabindex="-1"
                                aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Lihat CV - <?php echo e($data->pegawai->nama_pegawai); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="embed-responsive" style="height: 500px;">
                                                <embed src="<?php echo e(Storage::url($data->file_cv)); ?>" type="application/pdf"
                                                    width="100%" height="100%">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Lihat KK -->
                            <div class="modal fade" id="viewKKModal<?php echo e($data->id); ?>" tabindex="-1"
                                aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Lihat KK - <?php echo e($data->pegawai->nama_pegawai); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="embed-responsive" style="height: 500px;">
                                                <embed src="<?php echo e(Storage::url($data->file_kk)); ?>" type="application/pdf"
                                                    width="100%" height="100%">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Lihat KTP -->
                            <div class="modal fade" id="viewKTPModal<?php echo e($data->id); ?>" tabindex="-1"
                                aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Lihat KTP - <?php echo e($data->pegawai->nama_pegawai); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="embed-responsive" style="height: 500px;">
                                                <embed src="<?php echo e(Storage::url($data->file_ktp)); ?>" type="application/pdf"
                                                    width="100%" height="100%">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Lihat AKTE -->
                            <div class="modal fade" id="viewAKTEModal<?php echo e($data->id); ?>" tabindex="-1"
                                aria-hidden="true" data-bs-backdrop="static">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Lihat AKTE - <?php echo e($data->nama); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="embed-responsive" style="height: 500px;">
                                                <embed src="<?php echo e(Storage::url($data->file_akte)); ?>" type="application/pdf"
                                                    width="100%" height="100%">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Create berkas -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add berkas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('berkas.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row mt-3">
                            <div class="col mb-0 ">
                                <label for="nameBasic" class="form-label">Nama Pegawai</label>
                                <select name="id_user" class="form-control" required>
                                    <option selected disabled>-- Pilih Nama Pegawai --</option>
                                    <?php $__currentLoopData = $pegawai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($item->is_admin == 0): ?>
                                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->nama_pegawai); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col mb-0 mt-3">
                                <label for="nameBasic" class="form-label">Masukan CV (PDF)</label>
                                <input type="file" class="form-control" name="cv" required
                                    accept="application/pdf">
                            </div>
                            <div class="col mb-0 mt-3">
                                <label for="nameBasic" class="form-label">Masukan KK (PDF)</label>
                                <input type="file" class="form-control" name="kk" required
                                    accept="application/pdf">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col mb-0 mt-3">
                                <label for="nameBasic" class="form-label">Masukan KTP (PDF)</label>
                                <input type="file" class="form-control" name="ktp" required
                                    accept="application/pdf">
                            </div>
                            <div class="col mb-0 mt-3">
                                <label for="nameBasic" class="form-label">Masukan AKTE (PDF)</label>
                                <input type="file" class="form-control" name="akte" required
                                    accept="application/pdf">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.btn-delete');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const dataId = this.getAttribute('data-id');
                    
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${dataId}`).submit();
                        }
                    });
                });
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\berkas\index.blade.php ENDPATH**/ ?>