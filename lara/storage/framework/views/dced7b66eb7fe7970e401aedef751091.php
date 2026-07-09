<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['class' => '']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['class' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'flex-shrink-0 ' . $class])); ?>>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasLogo()): ?>
        <img
            src="<?php echo e($logoUrl); ?>"
            alt="<?php echo e($alt); ?>"
            class="<?php echo e($sizeClasses()); ?> rounded-lg object-contain"
        />
    <?php else: ?>
        <div class="<?php echo e($sizeClasses()); ?> rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
            <iconify-icon
                icon="<?php echo e($icon); ?>"
                class="<?php echo e($iconSizeClass()); ?> text-gray-500 dark:text-gray-300"
            ></iconify-icon>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH D:\projects\php8\lara\resources\views/components/module-logo.blade.php ENDPATH**/ ?>