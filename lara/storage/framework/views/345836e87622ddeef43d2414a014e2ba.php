

<?php $__env->startSection('test-admin-content'); ?>
    <div class="space-y-6">
        <div>
            <?php echo e($slot); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('test::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\projects\php8\lara\modules/test\resources/views/layouts/admin.blade.php ENDPATH**/ ?>