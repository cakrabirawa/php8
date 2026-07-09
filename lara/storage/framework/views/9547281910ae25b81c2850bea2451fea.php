<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id' => null,
    'title' => '',
    'description' => '',
    'position' => 'top', // top, bottom, left, right
    'width' => '',
    'maxWidth' => '280px',
    'arrowAlign' => 'center', // left, center, right,
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
    'id' => null,
    'title' => '',
    'description' => '',
    'position' => 'top', // top, bottom, left, right
    'width' => '',
    'maxWidth' => '280px',
    'arrowAlign' => 'center', // left, center, right,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$positions = [
    'top' => 'bottom-full mb-2 left-1/2 -translate-x-1/2',
    'bottom' => 'top-full mt-2 left-1/2 -translate-x-1/2',
    'left' => 'right-full mr-2 top-1/2 -translate-y-1/2',
    'right' => 'left-full ml-2 top-1/2 -translate-y-1/2',
];
$positionClass = $positions[$position] ?? $positions['top'];

$arrowPositions = [
    'top' => 'top-full -mt-1.5',
    'bottom' => 'bottom-full -mb-1.5',
    'left' => 'left-full -ml-1 top-1/2 -translate-y-1/2',
    'right' => 'right-full -mr-1 top-1/2 -translate-y-1/2',
];
$arrowPositionClass = $arrowPositions[$position] ?? $arrowPositions['top'];

$arrowAlignClass = [
    'left' => 'left-4',
    'center' => 'left-1/2 -translate-x-1/2',
    'right' => 'right-4',
][$arrowAlign] ?? 'left-1/2 -translate-x-1/2';

// Only apply horizontal alignment for top/bottom positions
$arrowAlignClass = in_array($position, ['top', 'bottom']) ? $arrowAlignClass : '';

$tooltipBg = 'bg-gray-900 text-white dark:bg-gray-700 dark:text-gray-100';
?>

<div
    x-data="{
        open: false,
        show() { this.open = true },
        hide() { this.open = false }
    }"
    class="relative inline-flex items-center <?php echo e(!$width ? 'w-fit' : ''); ?>"
    style="<?php echo e($width ? "width: {$width};" : ''); ?>"
>
    <!-- Trigger -->
    <div
        @mouseenter="show()"
        @mouseleave="hide()"
        @focus="show()"
        @blur="hide()"
        tabindex="0"
        aria-describedby="<?php echo e($id); ?>"
        class="outline-none inline-flex items-center"
    >
        <?php echo e($slot); ?>

    </div>

    <!-- Tooltip -->
    <div
        id="<?php echo e($id); ?>"
        x-show="open"
        x-transition.opacity.duration.250ms
        class="absolute z-50 px-3 py-2 text-sm rounded-md shadow-lg opacity-0 invisible transition-all duration-250 <?php echo e($tooltipBg); ?> <?php echo e($positionClass); ?>"
        :class="{ 'opacity-100 visible': open, 'opacity-0 invisible': !open }"
        role="tooltip"
        style="min-width: 200px; max-width: <?php echo e($maxWidth); ?>; width: max-content;"
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($title): ?>
            <span class="block text-sm font-medium text-center"><?php echo e($title); ?></span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($description): ?>
            <p class="text-xs opacity-90 mt-1 text-left leading-relaxed"><?php echo e($description); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Arrow -->
        <div
            x-show="open"
            x-transition.opacity.duration.150ms
            class="absolute w-2.5 h-2.5 rotate-45 z-[-1] <?php echo e($tooltipBg); ?> <?php echo e($arrowPositionClass); ?> <?php echo e($arrowAlignClass); ?>"
        >
        </div>
    </div>
</div>
<?php /**PATH D:\projects\php8\lara\resources\views/components/tooltip.blade.php ENDPATH**/ ?>