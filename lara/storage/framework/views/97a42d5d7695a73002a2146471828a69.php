<?php
    $headerClass = isset($headerDescription) ? ('flex-col items-start ' . ($headerClass ?? '')) : ($headerClass ?? '');
?>

<div
    x-data="{ loading: <?php echo \Illuminate\Support\Js::from($skeleton ?? false)->toHtml() ?> }"
    class="rounded-md border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] <?php echo e($class ?? ''); ?>"
>
    <template x-if="loading">
        <?php if (isset($component)) { $__componentOriginal23cd756a3c663fba42de7accb186d7c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23cd756a3c663fba42de7accb186d7c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.card-skeleton','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.card-skeleton'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23cd756a3c663fba42de7accb186d7c3)): ?>
<?php $attributes = $__attributesOriginal23cd756a3c663fba42de7accb186d7c3; ?>
<?php unset($__attributesOriginal23cd756a3c663fba42de7accb186d7c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23cd756a3c663fba42de7accb186d7c3)): ?>
<?php $component = $__componentOriginal23cd756a3c663fba42de7accb186d7c3; ?>
<?php unset($__componentOriginal23cd756a3c663fba42de7accb186d7c3); ?>
<?php endif; ?>
    </template>
    <template x-if="!loading">
        <div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($header)): ?>
                <div class="py-4 px-4 md:px-8 space-y-6 sm:p-4 border-b border-gray-200 dark:border-gray-800 font-semibold flex justify-between items-center <?php echo e($headerClass); ?>">
                    <div class="w-full flex justify-between mb-0 items-center <?php echo e(isset($headerTitleClass) ? $headerTitleClass : ''); ?>">
                        <?php echo $header; ?>


                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($headerRight)): ?>
                            <div class="<?php echo e($headerRightClass ?? ''); ?>">
                                <?php echo $headerRight; ?>

                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($headerDescription)): ?>
                        <p class="mt-2 text-sm text-gray-500 font-normal dark:text-gray-400 <?php echo e($headerDescriptionClass ?? ''); ?>">
                            <?php echo $headerDescription; ?>

                        </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="py-8 md:px-8 space-y-6 p-4 <?php echo e(isset($footer) ? 'border-b border-gray-200 dark:border-gray-800' : ''); ?> <?php echo e($bodyClass ?? ''); ?>">
                <?php echo e($slot); ?>

            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($footer)): ?>
            <div class="py-4 md:px-8 space-y-6 p-4 flex justify-between items-center <?php echo e($footerClass ?? ''); ?>">
                <?php echo e($footer); ?>

            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </template>
</div><?php /**PATH D:\projects\php8\lara\resources\views/components/card/card.blade.php ENDPATH**/ ?>