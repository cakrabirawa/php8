
<div
    x-data="{ aiModalOpen: false }"
    x-init="
        // Global keyboard shortcut: Cmd/Ctrl + Shift + V for voice command
        document.addEventListener('keydown', (e) => {
            if ((e.metaKey || e.ctrlKey) && e.shiftKey && e.key.toLowerCase() === 'v') {
                e.preventDefault();
                aiModalOpen = true;
                $dispatch('ai-voice-activate');
            }
        });
    "
    @keydown.window.escape="aiModalOpen = false"
    @open-ai-modal.window="aiModalOpen = true"
>
    <?php if (isset($component)) { $__componentOriginal7875b222dc4d64f17fd6d2e345da8799 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7875b222dc4d64f17fd6d2e345da8799 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tooltip','data' => ['title' => ''.e(__('AI Agent')).' (⌘⇧V)','position' => 'bottom']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('AI Agent')).' (⌘⇧V)','position' => 'bottom']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <button
            @click="aiModalOpen = true"
            class="hover:text-dark-900 relative flex items-center justify-center rounded-full text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white p-2 group"
            aria-label="<?php echo e(__('Open AI Agent')); ?>"
        >
            
            <span class="relative">
                <iconify-icon
                    icon="lucide:sparkles"
                    width="22"
                    height="22"
                    class="transition-all duration-200 group-hover:text-purple-500"
                ></iconify-icon>
                
                <span class="absolute -top-0.5 -right-0.5 flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-purple-500"></span>
                </span>
            </span>
        </button>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7875b222dc4d64f17fd6d2e345da8799)): ?>
<?php $attributes = $__attributesOriginal7875b222dc4d64f17fd6d2e345da8799; ?>
<?php unset($__attributesOriginal7875b222dc4d64f17fd6d2e345da8799); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7875b222dc4d64f17fd6d2e345da8799)): ?>
<?php $component = $__componentOriginal7875b222dc4d64f17fd6d2e345da8799; ?>
<?php unset($__componentOriginal7875b222dc4d64f17fd6d2e345da8799); ?>
<?php endif; ?>

    
    <?php echo $__env->make('components.modals.ai-command', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php /**PATH D:\projects\php8\lara\resources\views/backend/layouts/partials/header/ai-command-button.blade.php ENDPATH**/ ?>