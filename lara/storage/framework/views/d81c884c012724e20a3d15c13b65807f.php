

<?php $__env->startSection('title'); ?>
    <?php echo $__env->yieldContent('test-title', $breadcrumbs['title'] ?? __('Test')); ?> | <?php echo e(__('Test')); ?> | <?php echo e(config('app.name')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    
    <?php if (isset($component)) { $__componentOriginal89bbc84933e1ad8b35a00953b63de4a9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal89bbc84933e1ad8b35a00953b63de4a9 = $attributes; } ?>
<?php $component = App\View\Components\ModuleStyles::resolve(['entrypoints' => ['modules/Test/resources/assets/css/app.css'],'build' => 'build-test'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-styles'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ModuleStyles::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal89bbc84933e1ad8b35a00953b63de4a9)): ?>
<?php $attributes = $__attributesOriginal89bbc84933e1ad8b35a00953b63de4a9; ?>
<?php unset($__attributesOriginal89bbc84933e1ad8b35a00953b63de4a9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal89bbc84933e1ad8b35a00953b63de4a9)): ?>
<?php $component = $__componentOriginal89bbc84933e1ad8b35a00953b63de4a9; ?>
<?php unset($__componentOriginal89bbc84933e1ad8b35a00953b63de4a9); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('admin-content'); ?>
    <div class="test-module container px-6 py-8 mx-auto min-h-[80vh]">
        <?php echo $__env->yieldContent('test-admin-content'); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->yieldPushContent('test-scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\projects\php8\lara\modules/test\resources/views/layouts/master.blade.php ENDPATH**/ ?>