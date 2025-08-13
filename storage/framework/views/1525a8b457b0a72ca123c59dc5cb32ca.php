<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Laporan Pegawai</h1>
    <p>
        Dari: <?php echo e(\Carbon\Carbon::parse(request('tanggal_awal'))->translatedFormat('d F Y')); ?> s/d
        <?php echo e(\Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d F Y')); ?>

    </p>
    <p>
        Tanggal Dibuat : <?php echo e(\Carbon\Carbon::now()->translatedFormat('d F Y')); ?>

    </p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Tanggal Masuk</th>
                <th>Umur</th>
                <th>Email</th>
                <th>Gaji</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
            ?>
            <?php $__currentLoopData = $pegawai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($item->is_admin == 0): ?>
                    <tr>
                        <td><?php echo e($no++); ?></td>
                        <td><?php echo e($item->nama_pegawai); ?></td>
                        <td><?php echo e($item->jabatan ? $item->jabatan->nama_jabatan : 'Tidak ada jabatan'); ?></td>
                        <td><?php echo e(\Carbon\Carbon::parse($item->tanggal_masuk)->translatedFormat('d F Y')); ?></td>
                        <td><?php echo e($item->umur); ?></td>
                        <td><?php echo e($item->email); ?></td>
                        <td><?php echo e(number_format($item->gaji, 2, ',', '.')); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>

</html>
<?php /**PATH C:\laragon\www\dashboard-fingerprint\resources\views\admin\laporan\pdf_pegawai.blade.php ENDPATH**/ ?>