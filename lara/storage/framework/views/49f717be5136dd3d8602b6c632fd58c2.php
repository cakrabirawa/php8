<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['enableLivewire' => false, 'placeholder' => null, 'widthClass' => null]));

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

foreach (array_filter((['enableLivewire' => false, 'placeholder' => null, 'widthClass' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $widthClass = $widthClass ?: ($enableLivewire
        ? 'min-w-full md:min-w-[280px]'
        : 'min-w-full md:min-w-80 lg:min-w-96 xl:min-w-130 2xl:min-w-150');
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($enableLivewire ?? false): ?>
    <div class="relative flex items-center justify-center <?php echo e($widthClass); ?>"
        wire:ignore.self
        x-data="{
            searchValue: $wire.search || '',
            isMac: navigator.platform.toUpperCase().indexOf('MAC') >= 0
        }"
        x-init="
            $watch('$wire.search', value => searchValue = value || '');
            window.addEventListener('keydown', (e) => {
                if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                    e.preventDefault();
                    $refs.searchInput.focus();
                }
            });
        "
    >
        <span class="pointer-events-none absolute left-4 flex">
            <iconify-icon icon="lucide:search" class="text-gray-500 dark:text-gray-400" width="20" height="20"></iconify-icon>
        </span>
        <input
            id="search-input"
            x-ref="searchInput"
            type="text"
            wire:model.live="search"
            x-model="searchValue"
            placeholder="<?php echo e($placeholder ?? __('Search...')); ?>"
            class="form-control !pl-12 !pr-14"
            autocomplete="off"
        />

        
        <button
            x-show="searchValue.length > 0"
            x-cloak
            @click="$wire.set('search', ''); searchValue = ''"
            class="absolute right-2.5 top-1/2 inline-flex -translate-y-1/2 items-center justify-center rounded-full p-1 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-gray-700 dark:hover:text-gray-300"
            aria-label="<?php echo e(__('Clear search')); ?>"
            type="button"
            title="<?php echo e(__('Clear search')); ?>"
        >
            <iconify-icon icon="lucide:x" width="18" height="18"></iconify-icon>
        </button>

        
        <span
            x-show="searchValue.length === 0"
            class="absolute right-2.5 top-1/2 inline-flex -translate-y-1/2 items-center gap-0.5 rounded-md border border-gray-200 bg-gray-50 px-2 py-[4.5px] text-xs -tracking-[0.2px] text-gray-500 dark:border-gray-800 dark:bg-white/3 dark:text-gray-300"
        >
            <template x-if="isMac">
                <iconify-icon icon="lucide:command" class="mr-0.5" width="14" height="14"></iconify-icon>
            </template>
            <template x-if="!isMac">
                <span class="mr-0.5 text-[11px]">Ctrl</span>
            </template>
            <span>K</span>
        </span>
    </div>
<?php else: ?>
    <form
        action="<?php echo e(url()->current()); ?>"
        method="GET"
        class="flex items-center"
        name="search"
        x-data="{
            searchValue: '<?php echo e(request('search')); ?>',
            isMac: navigator.platform.toUpperCase().indexOf('MAC') >= 0
        }"
        x-init="
            window.addEventListener('keydown', (e) => {
                if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                    e.preventDefault();
                    $refs.searchInput.focus();
                }
            });
        "
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = request()->except('search'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_array($value)): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subKey => $subValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <input type="hidden" name="<?php echo e($key); ?>[<?php echo e($subKey); ?>]" value="<?php echo e(is_array($subValue) ? json_encode($subValue) : $subValue); ?>">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php else: ?>
                <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e(is_array($value) ? json_encode($value) : $value); ?>">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        <div class="relative flex items-center justify-center <?php echo e($widthClass); ?>">
            <span class="pointer-events-none absolute left-4 flex">
                <iconify-icon icon="lucide:search" class="text-gray-500 dark:text-gray-400" width="20" height="20"></iconify-icon>
            </span>
            <input
                id="search-input"
                x-ref="searchInput"
                name="search"
                type="text"
                x-model="searchValue"
                placeholder="<?php echo e($placeholder ?? __('Search...')); ?>"
                class="form-control pl-12! pr-14!"
            />

            
            <button
                x-show="searchValue.length > 0"
                x-cloak
                @click.prevent="searchValue = ''; $nextTick(() => $el.closest('form').submit())"
                class="absolute right-2.5 top-1/2 inline-flex -translate-y-1/2 items-center justify-center rounded-full p-1 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                aria-label="<?php echo e(__('Clear search')); ?>"
                type="button"
                title="<?php echo e(__('Clear search')); ?>"
            >
                <iconify-icon icon="lucide:x" width="18" height="18"></iconify-icon>
            </button>

            
            <button
                x-show="searchValue.length === 0"
                class="absolute right-2.5 top-1/2 inline-flex -translate-y-1/2 items-center gap-0.5 rounded-md border border-gray-200 bg-gray-50 px-1.75 py-[4.5px] text-xs -tracking-[0.2px] text-gray-500 dark:border-gray-800 dark:bg-white/3 dark:text-gray-300"
                aria-label="<?php echo e(__('Search')); ?>"
                type="submit"
                title="<?php echo e(__('Search')); ?>"
            >
                <template x-if="isMac">
                    <iconify-icon icon="lucide:command" class="mr-0.5" width="14" height="14"></iconify-icon>
                </template>
                <template x-if="!isMac">
                    <span class="mr-0.5 text-[11px]">Ctrl</span>
                </template>
                <span>K</span>
            </button>
        </div>
    </form>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH D:\projects\php8\lara\resources\views/components/datatable/searchbar.blade.php ENDPATH**/ ?>