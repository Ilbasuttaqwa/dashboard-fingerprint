<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Human Resource</title>
    <link rel="shortcut icon"
        href="https://https://i.pinimg.com/736x/f9/94/e5/f994e55f17392b8d6e204be294ffc4dc.jpg"
        type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f3f4f6;
        }

        .header-title {
            background-color: #0077b6;
            color: white;
            padding: 20px 0;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card {
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .btn-primary {
            background-color: #0077b6;
            border: none;
        }

        .btn-primary:hover {
            background-color: #005f87;
        }

        button {
            align-content: center;
            align-items: center;
            text-align: center;
            justify-content: center;
            justify-items: center;
        }
    </style>

</head>

<body>
    <div class="container">
        <?php if(session('success')): ?>
            <div class="alert alert-success fade show" role="alert">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="header-title text-center mb-4">
            <h2>Gibran Gsnteng</h2>
        </div>

        <!-- Toast Untuk Success -->
        

        
        

        <section class="attendance-list">
            <div class="" id="absenMasukModal" tabindex="-1" aria-labelledby="absenMasukLabel" aria-hidden="true"
                data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="<?php echo e(route('welcome.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="modal-header">
                                <h5 class="modal-title" id="absenMasukLabel">Absen Masuk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_pegawai" value="<?php echo e(Auth::user()->id); ?>">
                                
                            </div>
                            <div class="mb-3">
                                <table class="table table-hover text-center">
                                    <td>
                                        <form action="<?php echo e(route('welcome.store')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-outline-primary">Simpan Absen
                                                Masuk</button>
                                        </form>
                                    </td>
                                    
                                    <td>
                                        <?php
                                            $today = \Carbon\Carbon::today('Asia/Jakarta')->format('Y-m-d');
                                            $absenPulangDisplayed = false; // variabel untuk melacak apakah tombol sudah ditampilkan
                                        ?>

                                        <?php $__currentLoopData = $absensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($data->tanggal_absen == $today && is_null($data->jam_keluar) && !$absenPulangDisplayed): ?>
                                                <form action="<?php echo e(route('welcome.update', $data->id)); ?>" method="POST"
                                                    onsubmit="disableButton(this)">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <button type="submit" class="btn btn-warning"
                                                        id="btnAbsenPulang-<?php echo e($data->id); ?>">Absen Pulang</button>
                                                </form>
                                                <?php
                                                    $absenPulangDisplayed = true; // set ke true setelah tombol ditampilkan
                                                ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php if($absenPulangDisplayed == false): ?>
                                            <button class="btn btn-secondary" disabled>Sudah Absen Pulang</button>
                                        <?php endif; ?>
                                    </td>

                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Daftar Absensi Card -->
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $absensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="text-center">
                            <td><?php echo e($loop->index + 1); ?></td>
                            <td><?php echo e($data->user->nama_pegawai); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($data->tanggal_absen)->translatedFormat('d F Y')); ?></td>
                            <td><?php echo e($data->jam_masuk); ?></td>
                            <td>
                                <?php echo e($data->jam_keluar ?? 'Belum Absen Pulang'); ?>

                            </td>
                            <td>
                                <?php if(is_null($data->jam_keluar)): ?>
                                    <form action="<?php echo e(route('welcome.update', $data->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <input type="hidden" name="test" id="" va lue="wdsaads">
                                        <button type="submit" class="btn btn-warning">Absen Pulang</button>
                                    </form>
                                <?php else: ?>
                                    <button class="btn btn-secondary" disabled>Sudah Absen Pulang</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <footer class="footer text-center mt-5">
        <p>© 2024 ITI - All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        function disableButton(form) {
            const button = form.querySelector('button[type="submit"]');
            button.disabled = true;
            button.innerHTML = 'Sedang diproses...'; // Ubah teks setelah klik
        }
    </script>

    <?php if(session('success')): ?>
        <script>
            Swal.fire({
                html: '<strong><?php echo e(session('success')); ?></strong>',
                icon: 'success',
                showConfirmButton: false,
                timer: 1200
            })
        </script>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <script>
            Swal.fire({
                html: '<strong><?php echo e(session('error')); ?></strong>',
                icon: 'error',
                showConfirmButton: false,
                timer: 1200
            })
        </script>
    <?php endif; ?>
    </script>
</body>

</html><?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\welcome.blade.php ENDPATH**/ ?>