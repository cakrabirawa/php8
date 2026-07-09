<?php
    $currentLocale = app()->getLocale();
    $lang = get_languages()[$currentLocale] ?? [
        'code' => strtoupper($currentLocale),
        'name' => strtoupper($currentLocale),
        'icon' => '/images/flags/default.svg',
    ];

    $buttonClass = $buttonClass ?? 'hover:text-dark-900 relative flex p-2 items-center justify-center rounded-full text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white';

    $iconClass = $iconClass ?? 'text-gray-700 transition-colors hover:text-gray-800 dark:text-gray-300 dark:hover:text-white';

    $iconSize = $iconSize ?? '24';

    // When positioned at bottom of screen, dropdown should open upward
    $openUpward = $openUpward ?? false;
    $dropdownPositionClass = $openUpward ? 'bottom-full mb-2 origin-bottom-right' : 'mt-2 origin-top-right';
    $translateStart = $openUpward ? '-translate-y-1' : 'translate-y-1';
?>

<div x-data="{
    open: false,
    close() {
        this.open = false;
    }
}"
@click.away="close()"
@keydown.escape.window="close()"
class="relative">

    <button
        @click="open = !open"
        :aria-expanded="open"
        aria-haspopup="true"
        class="<?php echo e($buttonClass); ?>"
        type="button">
        <iconify-icon icon="prime:language" width="<?php echo e($iconSize); ?>" height="<?php echo e($iconSize); ?>" class="<?php echo e($iconClass); ?>"></iconify-icon>
    </button>

    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 <?php echo e($translateStart); ?>"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 <?php echo e($translateStart); ?>"
        x-trap.inert.noscroll="open"
        class="absolute right-0 z-50 <?php echo e($dropdownPositionClass); ?> w-56 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-gray-800 max-h-[200px] overflow-y-auto"
        role="menu"
        aria-orientation="vertical"
        tabindex="-1">
        
        <div class="py-1" role="none">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = get_languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <a href="<?php echo e(route('locale.switch', $code)); ?>"
                   @click="close()"
                   class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white <?php echo e($code === $currentLocale ? 'bg-gray-50 dark:bg-gray-700' : ''); ?>"
                   role="menuitem" 
                   tabindex="-1">
                    
                    <?php
                        $iconPath = public_path(ltrim($language['icon'], '/'));
                        $iconSrc = file_exists($iconPath) ? $language['icon'] : '/images/flags/default.svg';
                    ?>
                    
                    <img src="<?php echo e($iconSrc); ?>" 
                         alt="<?php echo e($language['name']); ?> flag" 
                         class="mr-3 h-5 w-5 flex-shrink-0 rounded-sm" />
                    
                    <span class="flex-1"><?php echo e($language['name']); ?></span>
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($code === $currentLocale): ?>
                        <iconify-icon icon="lucide:check" 
                                     class="ml-3 h-4 w-4 text-primary" 
                                     aria-hidden="true"></iconify-icon>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</div>

<?php /**PATH D:\projects\php8\lara\resources\views/backend/layouts/partials/locale-switcher.blade.php ENDPATH**/ ?>