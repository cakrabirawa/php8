<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(config('app.demo_mode', false)): ?>
<?php if (isset($component)) { $__componentOriginal26ee8ce16f47ac5ad29f6592684ca76f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26ee8ce16f47ac5ad29f6592684ca76f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.popover','data' => ['position' => 'bottom','width' => 'w-[250px]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('popover'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['position' => 'bottom','width' => 'w-[250px]']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

     <?php $__env->slot('trigger', null, []); ?> 
        <span class="rounded-radius border border-warning bg-warning px-2 py-1 text-xs font-medium text-warning-500 dark:border-gray-900 dark:bg-gray-800 dark:text-warning-500 p-3 min-w-16 flex justify-center items-center gap-1 cursor-pointer">
            <iconify-icon icon="lucide:alert-triangle"></iconify-icon>
            <?php echo e(__("Demo")); ?>

        </span>
     <?php $__env->endSlot(); ?>

    <div class="w-[250px] p-4 font-normal">
        <h3 class="font-medium text-gray-700 dark:text-white mb-2">
            <?php echo e(__("Demo Mode Active")); ?>

        </h3>
        <p class="mb-2">
            <?php echo e(__("Demo mode is currently enabled for this site. Many features are disabled to prevent changes to the demo data.")); ?>

        </p>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26ee8ce16f47ac5ad29f6592684ca76f)): ?>
<?php $attributes = $__attributesOriginal26ee8ce16f47ac5ad29f6592684ca76f; ?>
<?php unset($__attributesOriginal26ee8ce16f47ac5ad29f6592684ca76f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26ee8ce16f47ac5ad29f6592684ca76f)): ?>
<?php $component = $__componentOriginal26ee8ce16f47ac5ad29f6592684ca76f; ?>
<?php unset($__componentOriginal26ee8ce16f47ac5ad29f6592684ca76f); ?>
<?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH D:\projects\php8\lara\resources\views/backend/layouts/partials/demo-mode-notice.blade.php ENDPATH**/ ?>