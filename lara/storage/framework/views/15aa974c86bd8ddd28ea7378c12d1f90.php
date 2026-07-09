<?php
    $breadcrumbs = $breadcrumbs ?? [];
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'disabled' => $breadcrumbs['disabled'] ?? false,
    'title' => $breadcrumbs['title'] ?? '',
    'items' => $breadcrumbs['items'] ?? [],
    'show_home' => $breadcrumbs['show_home'] ?? true,
    'show_current' => $breadcrumbs['show_current'] ?? true,
    'show_messages_after' => $breadcrumbs['show_messages_after'] ?? true,
    'back_url' => $breadcrumbs['back_url'] ?? null,
    'icon' => $breadcrumbs['icon'] ?? null,
    'action' => $breadcrumbs['action'] ?? null,
    'actions_before_data' => $breadcrumbs['actions_before'] ?? null,
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
    'disabled' => $breadcrumbs['disabled'] ?? false,
    'title' => $breadcrumbs['title'] ?? '',
    'items' => $breadcrumbs['items'] ?? [],
    'show_home' => $breadcrumbs['show_home'] ?? true,
    'show_current' => $breadcrumbs['show_current'] ?? true,
    'show_messages_after' => $breadcrumbs['show_messages_after'] ?? true,
    'back_url' => $breadcrumbs['back_url'] ?? null,
    'icon' => $breadcrumbs['icon'] ?? null,
    'action' => $breadcrumbs['action'] ?? null,
    'actions_before_data' => $breadcrumbs['actions_before'] ?? null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    // Determine back URL: use explicit back_url, or last item with URL
    // Note: We only show back arrow if there's a parent page (not just home)
    $backUrl = $back_url;
    if (!$backUrl && count($items) > 0) {
        // Find the last item with a URL
        for ($i = count($items) - 1; $i >= 0; $i--) {
            if (isset($items[$i]['url'])) {
                $backUrl = $items[$i]['url'];
                break;
            }
        }
    }
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$disabled): ?>
<div class="mb-6 w-full flex flex-nowrap items-center justify-between gap-3">
    <div class="flex items-center gap-x-2 min-w-0 flex-1">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($backUrl): ?>
                <a
                    href="<?php echo e($backUrl); ?>"
                    class="inline-flex items-center justify-center w-9 h-9 shrink-0 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-700 dark:hover:text-gray-200 transition-colors"
                    title="<?php echo e(__('Go back')); ?>"
                >
                    <iconify-icon icon="<?php echo e($icon); ?>" width="20" height="20"></iconify-icon>
                </a>
            <?php else: ?>
                <span class="inline-flex items-center justify-center w-9 h-9 shrink-0 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                    <iconify-icon icon="<?php echo e($icon); ?>" width="20" height="20"></iconify-icon>
                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <iconify-icon icon="lucide:chevron-right" width="16" height="16" class="text-gray-400 dark:text-gray-500 shrink-0"></iconify-icon>
        <?php elseif($backUrl): ?>
            <a
                href="<?php echo e($backUrl); ?>"
                class="inline-flex items-center justify-center w-9 h-9 shrink-0 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-700 dark:hover:text-gray-200 transition-colors"
                title="<?php echo e(__('Go back')); ?>"
            >
                <iconify-icon icon="lucide:arrow-left" width="18" height="18"></iconify-icon>
            </a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($title): ?>
            <h2 class="text-xl font-semibold text-gray-700 dark:text-white/90 flex items-center gap-2 min-w-0">
                <?php echo $title_before ?? ''; ?>

                <span class="truncate" title="<?php echo e(__($title)); ?>"><?php echo __($title); ?></span>
                <?php echo $title_after ?? ''; ?>

            </h2>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($action || isset($actions_before) || isset($actions_after) || $actions_before_data): ?>
        <div class="flex items-center gap-2 shrink-0">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($actions_before)): ?>
                <?php echo $actions_before; ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($actions_before_data): ?>
                <?php echo $actions_before_data; ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($action): ?>
                <?php
                    $isPill = is_array($action) && ($action['pill'] ?? false);
                    $btnClass = $isPill
                        ? 'btn-default flex items-center gap-2 rounded-full'
                        : 'btn-primary flex items-center gap-2';
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_array($action) && isset($action['url']) && isset($action['label'])): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!isset($action['permission']) || auth()->user()->can($action['permission'])): ?>
                        <a href="<?php echo e($action['url']); ?>" class="<?php echo e($btnClass); ?>">
                            <iconify-icon icon="<?php echo e($action['icon'] ?? 'feather:plus'); ?>" height="<?php echo e($isPill ? '14' : '16'); ?>"></iconify-icon>
                            <?php echo e(__($action['label'])); ?>

                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php elseif(is_array($action) && isset($action['click']) && isset($action['label'])): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!isset($action['permission']) || auth()->user()->can($action['permission'])): ?>
                        <button @click="<?php echo e($action['click']); ?>" type="button" class="<?php echo e($btnClass); ?>">
                            <iconify-icon icon="<?php echo e($action['icon'] ?? 'feather:plus'); ?>" height="<?php echo e($isPill ? '14' : '16'); ?>"></iconify-icon>
                            <?php echo e(__($action['label'])); ?>

                        </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <?php echo $action; ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($actions_after)): ?>
                <?php echo $actions_after; ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($show_messages_after): ?>
    <?php if (isset($component)) { $__componentOriginala357015bb12b9e55fb70db16bfbde37b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala357015bb12b9e55fb70db16bfbde37b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.messages','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('messages'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala357015bb12b9e55fb70db16bfbde37b)): ?>
<?php $attributes = $__attributesOriginala357015bb12b9e55fb70db16bfbde37b; ?>
<?php unset($__attributesOriginala357015bb12b9e55fb70db16bfbde37b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala357015bb12b9e55fb70db16bfbde37b)): ?>
<?php $component = $__componentOriginala357015bb12b9e55fb70db16bfbde37b; ?>
<?php unset($__componentOriginala357015bb12b9e55fb70db16bfbde37b); ?>
<?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH D:\projects\php8\lara\resources\views/components/breadcrumbs.blade.php ENDPATH**/ ?>