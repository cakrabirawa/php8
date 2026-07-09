<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'filters' => [],
    'enableLivewire' => true,
    'hasActiveFilters' => false,
    'maxVisible' => 4,
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
    'filters' => [],
    'enableLivewire' => true,
    'hasActiveFilters' => false,
    'maxVisible' => 4,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $filterCount = count($filters);
    $activeFilterCount = collect($filters)->filter(fn($f) => !empty($f['selected']))->count();
    $visibleFilters = array_slice($filters, 0, $maxVisible);
    $hiddenFilters = array_slice($filters, $maxVisible);
    $hiddenCount = count($hiddenFilters);
    $hiddenActiveCount = collect($hiddenFilters)->filter(fn($f) => !empty($f['selected']))->count();
?>

<div class="flex items-center gap-2 flex-wrap w-full" style="justify-content: end;">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(method_exists($this, 'renderBeforeFilters')): ?>
        <?php echo e($this->renderBeforeFilters()); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Clear Filters Button -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasActiveFilters): ?>
        <button
            type="button"
            wire:click="clearFilters"
            class="text-sm text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 flex items-center gap-1 transition-colors duration-200"
            title="<?php echo e(__('Clear all filters')); ?>"
        >
            <iconify-icon icon="lucide:x-circle" class="text-base"></iconify-icon>
            <?php echo e(__('Clear')); ?>

        </button>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Desktop: Visible Filter Dropdowns -->
    <div class="hidden md:flex items-center gap-2">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $visibleFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div class="flex items-center justify-center relative" x-data="{ open: false }">
                <button
                    @click="open = !open"
                    class="btn-default flex items-center justify-center gap-2 whitespace-nowrap <?php echo e(!empty($filter['selected']) ? 'ring-2 ring-primary/50 bg-primary/5' : ''); ?>"
                    type="button"
                >
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter['icon'] ?? false): ?>
                        <iconify-icon icon="<?php echo e($filter['icon']); ?>"></iconify-icon>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php echo e($filter['filterLabel']); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filter['selected'])): ?>
                        <span class="inline-flex items-center justify-center w-2 h-2 rounded-full bg-primary"></span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <iconify-icon icon="lucide:chevron-down" class="transition-transform duration-200" :class="{'rotate-180': open}"></iconify-icon>
                </button>

                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition
                    class="absolute top-10 right-0 mt-2 w-56 rounded-md shadow bg-white dark:bg-gray-700 z-20 p-3 overflow-y-auto max-h-80"
                >
                    <ul class="space-y-2">
                        <li
                            class="cursor-pointer text-sm text-gray-700 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 px-2 py-1.5 rounded <?php echo e(empty($filter['selected']) ? 'bg-gray-200 dark:bg-gray-600 font-bold' : ''); ?>"
                            <?php if($enableLivewire): ?>
                                wire:click="$set('<?php echo e($filter['id']); ?>', ''); $dispatch('resetPage')"
                            <?php endif; ?>
                            @click="open = false"
                        >
                            <?php echo e($filter['allLabel'] ?? __('All')); ?>

                        </li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filter['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <?php
                                $isLabelValuePair = is_array($value) && isset($value['label']);
                                $optionValue = $isLabelValuePair ? $value['value'] : $key;
                                $optionLabel = $isLabelValuePair ? $value['label'] : $value;
                            ?>
                            <li
                                class="cursor-pointer text-sm text-gray-700 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 px-2 py-1.5 rounded <?php echo e($filter['selected'] == $optionValue ? 'bg-gray-200 dark:bg-gray-600 font-bold' : ''); ?>"
                                <?php if($enableLivewire): ?>
                                    wire:click="$set('<?php echo e($filter['id']); ?>', '<?php echo e($optionValue); ?>'); $dispatch('resetPage')"
                                <?php else: ?>
                                    onclick="window.location.href = '<?php echo e($filter['route'] ?? ''); ?>?<?php echo e($filter['id']); ?>=<?php echo e($optionValue); ?>';"
                                <?php endif; ?>
                                @click="open = false"
                            >
                                <?php echo ucfirst($optionLabel); ?>

                            </li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        <!-- Desktop: More Filters Dropdown (for hidden filters) -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hiddenCount > 0): ?>
            <div class="relative" x-data="{ moreOpen: false }">
                <button
                    @click="moreOpen = !moreOpen"
                    class="btn-default flex items-center justify-center gap-2 whitespace-nowrap <?php echo e($hiddenActiveCount > 0 ? 'ring-2 ring-primary/50 bg-primary/5' : ''); ?>"
                    type="button"
                >
                    <iconify-icon icon="lucide:sliders-horizontal"></iconify-icon>
                    <span><?php echo e(__('More')); ?></span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">(<?php echo e($hiddenCount); ?>)</span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hiddenActiveCount > 0): ?>
                        <span class="inline-flex items-center justify-center w-2 h-2 rounded-full bg-primary"></span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <iconify-icon icon="lucide:chevron-down" class="transition-transform duration-200" :class="{'rotate-180': moreOpen}"></iconify-icon>
                </button>

                <div
                    x-show="moreOpen"
                    @click.outside="moreOpen = false"
                    x-transition
                    class="absolute top-10 right-0 mt-2 w-80 rounded-md shadow-lg bg-white dark:bg-gray-700 z-30 p-4 max-h-[70vh] overflow-y-auto"
                >
                    <div class="space-y-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $hiddenFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <?php
                                $filterIcon = $filter['icon'] ?? null;
                            ?>
                            <div>
                                <label class="form-label flex items-center gap-1.5 mb-1.5">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filterIcon): ?>
                                        <iconify-icon icon="<?php echo e($filterIcon); ?>" class="text-sm"></iconify-icon>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php echo e($filter['filterLabel']); ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filter['selected'])): ?>
                                        <span class="inline-flex items-center justify-center w-2 h-2 rounded-full bg-primary"></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </label>
                                <select
                                    class="form-control w-full"
                                    <?php if($enableLivewire): ?>
                                        wire:model.live="<?php echo e($filter['id']); ?>"
                                    <?php else: ?>
                                        onchange="window.location.href = '<?php echo e($filter['route'] ?? ''); ?>?<?php echo e($filter['id']); ?>=' + this.value;"
                                    <?php endif; ?>
                                >
                                    <option value=""><?php echo e($filter['allLabel'] ?? __('All')); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filter['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        <?php
                                            $isLabelValuePair = is_array($value) && isset($value['label']);
                                            $optionValue = $isLabelValuePair ? $value['value'] : $key;
                                            $optionLabel = $isLabelValuePair ? $value['label'] : $value;
                                        ?>
                                        <option
                                            value="<?php echo e($optionValue); ?>"
                                            <?php echo e($filter['selected'] == $optionValue ? 'selected' : ''); ?>

                                        >
                                            <?php echo ucfirst($optionLabel); ?>

                                        </option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Mobile: Full-Screen Filter Panel -->
    <div class="md:hidden w-full" x-data="{ mobileFiltersOpen: false }">

        <!-- Trigger button -->
        <button
            @click="mobileFiltersOpen = true"
            class="btn-default flex items-center justify-center gap-2 w-full"
            type="button"
            :aria-expanded="mobileFiltersOpen"
            aria-controls="mobile-filter-panel"
        >
            <iconify-icon icon="lucide:filter"></iconify-icon>
            <span><?php echo e(__('Filters')); ?></span>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeFilterCount > 0): ?>
                <span class="inline-flex items-center justify-center min-w-5 h-5 px-1.5 text-xs font-medium rounded-full bg-primary text-white">
                    <?php echo e($activeFilterCount); ?>

                </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </button>

        <!-- Backdrop -->
        <div
            x-show="mobileFiltersOpen"
            x-transition.opacity
            x-cloak
            @click="mobileFiltersOpen = false"
            class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm"
            aria-hidden="true"
        ></div>

        <!-- Full-screen panel (slides up from bottom) -->
        <div
            id="mobile-filter-panel"
            x-show="mobileFiltersOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-250"
            x-transition:enter-start="opacity-0 translate-y-full"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-full"
            class="fixed inset-x-0 bottom-0 z-50 flex flex-col bg-white dark:bg-gray-800 rounded-t-2xl shadow-2xl max-h-[85vh]"
            role="dialog"
            aria-modal="true"
            aria-label="<?php echo e(__('Filters')); ?>"
        >
            <!-- Drag handle -->
            <div class="flex justify-center pt-3 pb-1 shrink-0">
                <div class="w-10 h-1 rounded-full bg-gray-300 dark:bg-gray-600"></div>
            </div>

            <!-- Panel header -->
            <div class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-gray-700 shrink-0">
                <h3 class="text-base font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                    <iconify-icon icon="lucide:filter" class="text-primary"></iconify-icon>
                    <?php echo e(__('Filters')); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeFilterCount > 0): ?>
                        <span class="inline-flex items-center justify-center min-w-5 h-5 px-1.5 text-xs font-medium rounded-full bg-primary text-white">
                            <?php echo e($activeFilterCount); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </h3>
                <div class="flex items-center gap-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasActiveFilters): ?>
                        <button
                            type="button"
                            wire:click="clearFilters"
                            @click="mobileFiltersOpen = false"
                            class="text-sm text-red-600 hover:text-red-700 dark:text-red-400 flex items-center gap-1 transition-colors"
                        >
                            <iconify-icon icon="lucide:x-circle"></iconify-icon>
                            <?php echo e(__('Clear all')); ?>

                        </button>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <button
                        @click="mobileFiltersOpen = false"
                        type="button"
                        class="p-1.5 rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-600 dark:hover:bg-gray-700 dark:hover:text-gray-200 transition-colors"
                        aria-label="<?php echo e(__('Close filters')); ?>"
                    >
                        <iconify-icon icon="lucide:x" width="20" height="20"></iconify-icon>
                    </button>
                </div>
            </div>

            <!-- Scrollable filter list -->
            <div class="flex-1 overflow-y-auto px-5 py-4">
                <div class="space-y-5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <?php $mobileFilterIcon = $filter['icon'] ?? null; ?>
                        <div>
                            <label class="form-label flex items-center gap-1.5 mb-1.5">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($mobileFilterIcon): ?>
                                    <iconify-icon icon="<?php echo e($mobileFilterIcon); ?>" class="text-sm"></iconify-icon>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php echo e($filter['filterLabel']); ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filter['selected'])): ?>
                                    <span class="inline-flex items-center justify-center w-2 h-2 rounded-full bg-primary"></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </label>
                            <select
                                class="form-control w-full"
                                <?php if($enableLivewire): ?>
                                    wire:model.live="<?php echo e($filter['id']); ?>"
                                <?php else: ?>
                                    onchange="window.location.href = '<?php echo e($filter['route'] ?? ''); ?>?<?php echo e($filter['id']); ?>=' + this.value;"
                                <?php endif; ?>
                            >
                                <option value=""><?php echo e($filter['allLabel'] ?? __('All')); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $filter['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <?php
                                        $isLabelValuePair = is_array($value) && isset($value['label']);
                                        $optionValue = $isLabelValuePair ? $value['value'] : $key;
                                        $optionLabel = $isLabelValuePair ? $value['label'] : $value;
                                    ?>
                                    <option
                                        value="<?php echo e($optionValue); ?>"
                                        <?php echo e($filter['selected'] == $optionValue ? 'selected' : ''); ?>

                                    >
                                        <?php echo ucfirst($optionLabel); ?>

                                    </option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>

            <!-- Sticky footer: Done button -->
            <div class="px-5 py-4 border-t border-gray-200 dark:border-gray-700 shrink-0">
                <button
                    @click="mobileFiltersOpen = false"
                    type="button"
                    class="btn-primary w-full flex items-center justify-center gap-2"
                >
                    <iconify-icon icon="lucide:check" width="16" height="16"></iconify-icon>
                    <?php echo e(__('Done')); ?>

                </button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\projects\php8\lara\resources\views/components/datatable/responsive-filters.blade.php ENDPATH**/ ?>