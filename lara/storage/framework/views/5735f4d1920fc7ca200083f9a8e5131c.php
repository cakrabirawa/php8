<?php
    // Default quick-add links (WP-style "New" items)
    $defaultItems = [
        [
            'label' => __('Post'),
            'url' => route('admin.posts.create', 'post'),
            'icon' => 'lucide:file-text',
            'permission' => 'post.create',
        ],
        [
            'label' => __('Page'),
            'url' => route('admin.posts.create', 'page'),
            'icon' => 'lucide:layout',
            'permission' => 'post.create',
        ],
        [
            'label' => __('User'),
            'url' => route('admin.users.create'),
            'icon' => 'lucide:user-plus',
            'permission' => 'user.create',
        ],
        [
            'label' => __('Media'),
            'url' => route('admin.media.index'),
            'icon' => 'lucide:image-plus',
            'permission' => 'media.create',
        ],
    ];

    // Allow modules (CRM, etc.) to add their own quick-add items via filter hook
    $quickAddItems = Hook::applyFilters(AdminFilterHook::QUICK_ADD_DROPDOWN, $defaultItems);

    // Filter to only items the current user has permission for
    $visibleItems = array_filter($quickAddItems, function ($item) {
        return empty($item['permission']) || auth()->user()?->can($item['permission']);
    });
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($visibleItems) > 0): ?>
    <div class="relative" x-data="{ quickAddOpen: false }" @mouseenter="quickAddOpen = true" @mouseleave="quickAddOpen = false">
        <button
            class="hover:text-dark-900 relative flex items-center justify-center rounded-full text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white p-2"
            aria-label="<?php echo e(__('Create New')); ?>"
        >
            <iconify-icon icon="lucide:plus" width="22" height="22"></iconify-icon>
        </button>

        <div
            x-show="quickAddOpen"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute left-0 mt-2 w-48 rounded-md border bg-white dark:bg-gray-700 border-gray-200 dark:border-gray-800 shadow-lg z-100"
            style="display: none;"
        >
            <div class="py-1">
                <div class="px-3 py-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider border-b border-gray-200 dark:border-gray-600">
                    <?php echo e(__('Create New')); ?>

                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $visibleItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <a
                        href="<?php echo e($item['url']); ?>"
                        target="<?php echo e($item['target'] ?? '_self'); ?>"
                        class="group flex items-center gap-3 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600"
                        @click="quickAddOpen = false"
                    >
                        <iconify-icon
                            icon="<?php echo e($item['icon'] ?? 'lucide:plus-circle'); ?>"
                            width="18"
                            height="18"
                            class="text-gray-500 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-200"
                        ></iconify-icon>
                        <span><?php echo e($item['label']); ?></span>
                    </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH D:\projects\php8\lara\resources\views/backend/layouts/partials/header/quick-add-dropdown.blade.php ENDPATH**/ ?>