<?php
    // Default core quick links
    $defaultLinks = [];

    // Only show "Visit Site" when a frontend theme is active (ADMIN_SITE_ONLY is false)
    $isAdminOnly = Hook::applyFilters(AdminFilterHook::ADMIN_SITE_ONLY, true);
    if (! $isAdminOnly) {
        $defaultLinks[] = [
            'label' => __('Visit Site'),
            'url' => config('app.url'),
            'icon' => 'lucide:globe',
            'target' => '_blank',
        ];
    }

    $defaultLinks[] = [
        'label' => __('Marketplace'),
        'url' => 'https://laradashboard.com/marketplace',
        'icon' => 'lucide:store',
        'target' => '_blank',
    ];

    // Allow modules to add more links via filter hook
    $quickLinks = Hook::applyFilters(AdminFilterHook::QUICK_LINKS_DROPDOWN, $defaultLinks);
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($quickLinks) > 0): ?>
    <div class="relative" x-data="{ quickLinksOpen: false }" @mouseenter="quickLinksOpen = true" @mouseleave="quickLinksOpen = false">
        <button
            class="hover:text-dark-900 relative flex items-center justify-center rounded-full text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white p-2"
            aria-label="<?php echo e(__('Quick Links')); ?>"
        >
            <iconify-icon icon="lucide:link" width="22" height="22"></iconify-icon>
        </button>

        <div
            x-show="quickLinksOpen"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute left-0 mt-2 w-56 rounded-md border bg-white dark:bg-gray-700 border-gray-200 dark:border-gray-800 shadow-lg z-100"
            style="display: none;"
        >
            <div class="py-1">
                <div class="px-3 py-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600">
                    <?php echo e(__('Quick Links')); ?>

                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $quickLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <?php
                        $hasPermission = empty($link['permission']) || auth()->user()?->can($link['permission']);
                    ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPermission): ?>
                        <a
                            href="<?php echo e($link['url']); ?>"
                            target="<?php echo e($link['target'] ?? '_blank'); ?>"
                            class="group flex items-center gap-3 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600"
                            @click="quickLinksOpen = false"
                        >
                            <iconify-icon
                                icon="<?php echo e($link['icon'] ?? 'lucide:external-link'); ?>"
                                width="18"
                                height="18"
                                class="text-gray-500 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-200"
                            ></iconify-icon>
                            <span><?php echo e($link['label']); ?></span>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH D:\projects\php8\lara\resources\views/backend/layouts/partials/header/quick-links-dropdown.blade.php ENDPATH**/ ?>