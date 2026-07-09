<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'href' => '#',
    'icon' => null,
    'label' => '',
    'onClick' => null,
    'class' => '',
    'type' => 'link', // link, button, or modal-trigger
    'modalTarget' => '',
    'closeDropdown' => true, // Auto-close parent dropdown
]));

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

foreach (array_filter(([
    'href' => '#',
    'icon' => null,
    'label' => '',
    'onClick' => null,
    'class' => '',
    'type' => 'link', // link, button, or modal-trigger
    'modalTarget' => '',
    'closeDropdown' => true, // Auto-close parent dropdown
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $baseClasses = 'flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 ' . $class;
    $closeAction = $closeDropdown ? 'isOpen = false; openedWithKeyboard = false;' : '';
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type === 'link'): ?>
    <a
        href="<?php echo e($href); ?>"
        <?php echo e($attributes->merge(['class' => $baseClasses])); ?>

        <?php if($closeDropdown): ?>
            x-on:click="isOpen = false; openedWithKeyboard = false"
        <?php endif; ?>
        role="menuitem"
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
            <iconify-icon icon="<?php echo e($icon); ?>" class="text-base"></iconify-icon>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php echo e($label); ?>

    </a>
<?php elseif($type === 'button'): ?>
    <button
        type="button"
        <?php echo e($attributes->merge(['class' => $baseClasses])); ?>

        <?php if($onClick): ?>
            x-on:click="<?php echo e($closeAction); ?> <?php echo e($onClick); ?>"
        <?php elseif($closeDropdown): ?>
            x-on:click="isOpen = false; openedWithKeyboard = false"
        <?php endif; ?>
        role="menuitem"
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
            <iconify-icon icon="<?php echo e($icon); ?>" class="text-base"></iconify-icon>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php echo e($label); ?>

    </button>
<?php elseif($type === 'modal-trigger'): ?>
    <button
        type="button"
        <?php echo e($attributes->merge(['class' => $baseClasses])); ?>

        <?php if($modalTarget): ?>
            x-on:click="<?php echo e($modalTarget); ?> = true; $nextTick(() => { isOpen = false; openedWithKeyboard = false; })"
        <?php endif; ?>
        role="menuitem"
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
            <iconify-icon icon="<?php echo e($icon); ?>" class="text-base"></iconify-icon>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php echo e($label); ?>

    </button>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH D:\projects\php8\lara\resources\views/components/buttons/action-item.blade.php ENDPATH**/ ?>