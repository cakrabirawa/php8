<?php
    /** @var \App\Services\MenuService\AdminMenuItem $item */
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($item->htmlData)): ?>
    <div class="menu-item-html" style="<?php echo $item->itemStyles; ?>">
        <?php echo $item->htmlData; ?>

    </div>
<?php elseif(!empty($item->children)): ?>
    <?php
        $submenuId = $item->id ?? \Str::slug($item->label) . '-submenu';
        $isActive = $item->active ? 'menu-item-active' : '';
        $showSubmenu = app(\App\Services\MenuService\AdminMenuService::class)->shouldExpandSubmenu($item);
        $chevronIcon = $showSubmenu ? 'lucide:chevron-up' : 'lucide:chevron-right';
        $firstChildRoute = !empty($item->children) && isset($item->children[0]->route) ? $item->children[0]->route : null;
        
        // Check if current URL matches any child route to prevent unnecessary redirects.
        $currentUrl = request()->url();
        $isOnChildPage = false;
        if (!empty($item->children)) {
            foreach ($item->children as $child) {
                if (isset($child->route) && $child->route === $currentUrl) {
                    $isOnChildPage = true;
                    break;
                }
            }
        }
    ?>

    <li class="menu-item-<?php echo e($item->id); ?>" style="<?php echo $item->itemStyles; ?>">
        <button :style="`color: ${textColor}`" class="menu-item group w-full text-left <?php echo e($isActive); ?>" type="button" 
                onclick="handleMenuItemClick(this, '<?php echo e($submenuId); ?>', '<?php echo e($firstChildRoute); ?>', <?php echo e($showSubmenu ? 'true' : 'false'); ?>, <?php echo e($isOnChildPage ? 'true' : 'false'); ?>)">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item->iconImage)): ?>
                <img src="<?php echo e($item->iconImage); ?>" alt="" class="menu-item-icon w-[18px] h-[18px] object-contain shrink-0" aria-hidden="true">
            <?php elseif(!empty($item->icon)): ?>
                <iconify-icon icon="<?php echo e($item->icon); ?>" class="menu-item-icon" width="18" height="18"></iconify-icon>
            <?php elseif(!empty($item->iconClass)): ?>
                <iconify-icon icon="lucide:circle" class="menu-item-icon" width="18" height="18"></iconify-icon>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <span class="menu-item-text"><?php echo $item->label; ?></span>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->badge): ?>
                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full leading-none <?php echo e($item->badgeClass ?? 'bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400'); ?>"><?php echo e($item->badge); ?></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <iconify-icon icon="<?php echo e($chevronIcon); ?>" class="menu-item-arrow transition-all duration-300 w-4 h-4" style="transform: <?php echo e($showSubmenu ? 'rotate(180deg)' : 'rotate(0deg)'); ?>"></iconify-icon>
        </button>
        <ul id="<?php echo e($submenuId); ?>" class="submenu space-y-1 mt-1 overflow-hidden <?php echo e($showSubmenu ? 'submenu-expanded' : 'submenu-collapsed'); ?>">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <?php echo $__env->make('backend.layouts.partials.sidebar.menu-item', ['item' => $child], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </ul>
    </li>
<?php else: ?>
    <?php
        $isActive = $item->active ? 'menu-item-active' : 'menu-item-inactive';
        $target = !empty($item->target) ? ' target="' . e($item->target) . '"' : '';
    ?>

    <li class="menu-item-<?php echo e($item->id); ?>" style="<?php echo $item->itemStyles; ?>">
        <a :style="`color: ${textColor}`" href="<?php echo e($item->route ?? '#'); ?>" class="menu-item group <?php echo e($isActive); ?>" <?php echo $target; ?>

           @click="if(window.innerWidth < 1024) { sidebarToggle = false; }">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item->iconImage)): ?>
                <img src="<?php echo e($item->iconImage); ?>" alt="" class="menu-item-icon w-[18px] h-[18px] object-contain shrink-0" aria-hidden="true">
            <?php elseif(!empty($item->icon)): ?>
                <iconify-icon icon="<?php echo e($item->icon); ?>" class="menu-item-icon" width="18" height="18"></iconify-icon>
            <?php elseif(!empty($item->iconClass)): ?>
                <iconify-icon icon="lucide:circle" class="menu-item-icon" width="18" height="18"></iconify-icon>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <span class="menu-item-text"><?php echo $item->label; ?></span>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->badge): ?>
                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full leading-none <?php echo e($item->badgeClass ?? 'bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400'); ?>"><?php echo e($item->badge); ?></span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </a>
    </li>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($item->id)): ?>
    <?php echo Hook::applyFilters(AdminFilterHook::SIDEBAR_MENU_ITEM_AFTER->value . strtolower($item->id), ''); ?>

<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH D:\projects\php8\lara\resources\views/backend/layouts/partials/sidebar/menu-item.blade.php ENDPATH**/ ?>