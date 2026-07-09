<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasUpdate): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings.view')): ?>
            <?php
                $versionDisplay = str_starts_with($latestVersion, 'v') ? $latestVersion : 'v' . $latestVersion;
            ?>
            <?php if (isset($component)) { $__componentOriginal7875b222dc4d64f17fd6d2e345da8799 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7875b222dc4d64f17fd6d2e345da8799 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tooltip','data' => ['title' => ''.e(__('Update available')).': '.e($versionDisplay).'','position' => 'bottom']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Update available')).': '.e($versionDisplay).'','position' => 'bottom']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <a href="<?php echo e(route('admin.core-upgrades.index')); ?>"
                    class="relative flex p-2 items-center justify-center rounded-full transition-colors
                        <?php echo e($isCritical
                            ? 'text-red-600 hover:bg-red-100 hover:text-red-700 dark:text-red-400 dark:hover:bg-red-900/30 dark:hover:text-red-300'
                            : 'text-amber-600 hover:bg-amber-100 hover:text-amber-700 dark:text-amber-400 dark:hover:bg-amber-900/30 dark:hover:text-amber-300'); ?>">
                    <iconify-icon icon="lucide:arrow-up-circle" width="22" height="22"></iconify-icon>
                    <span class="absolute -top-0.5 -right-0.5 flex h-4 w-4 items-center justify-center rounded-full text-xs font-semibold
                        <?php echo e($isCritical
                            ? 'bg-red-500 text-white'
                            : 'bg-amber-500 text-white'); ?>">
                        !
                    </span>
                </a>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7875b222dc4d64f17fd6d2e345da8799)): ?>
<?php $attributes = $__attributesOriginal7875b222dc4d64f17fd6d2e345da8799; ?>
<?php unset($__attributesOriginal7875b222dc4d64f17fd6d2e345da8799); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7875b222dc4d64f17fd6d2e345da8799)): ?>
<?php $component = $__componentOriginal7875b222dc4d64f17fd6d2e345da8799; ?>
<?php unset($__componentOriginal7875b222dc4d64f17fd6d2e345da8799); ?>
<?php endif; ?>
        <?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH D:\projects\php8\lara\resources\views/livewire/components/core-upgrade-notification.blade.php ENDPATH**/ ?>