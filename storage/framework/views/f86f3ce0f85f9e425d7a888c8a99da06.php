<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans text-gray-900 antialiased">

    <div class="min-h-screen flex items-center justify-center bg-cover bg-center px-4"
         style="background-image: url('<?php echo e(App\Helpers\CloudinaryHelper::static('danse.jpg')); ?>');">

        <!-- Cadre formulaire -->
        <div class="w-full sm:max-w-md bg-white rounded-2xl shadow-xl p-6">
            <?php echo e($slot); ?>

        </div>

    </div>

</body>
</html>

<?php /**PATH C:\wamp64\www\culture\resources\views\layouts\guest.blade.php ENDPATH**/ ?>