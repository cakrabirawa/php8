<?php if (isset($component)) { $__componentOriginal8aaf9779783cdf64609094123653a0b9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8aaf9779783cdf64609094123653a0b9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.datatable','data' => ['searchbarPlaceholder' => $searchbarPlaceholder,'filters' => $filters,'customFilters' => $customFilters,'perPageOptions' => $perPageOptions,'headers' => $headers,'enableCheckbox' => $enableCheckbox,'enableBulkActions' => $enableBulkActions,'enableNewResourceLink' => $showCreateButton,'noResultsMessage' => $noResultsMessage,'customNoResultsMessage' => $customNoResultsMessage,'data' => $data,'newResourceLinkPermission' => $newResourceLinkPermission,'newResourceLinkRouteName' => $newResourceLinkRouteName,'customNewResourceLink' => $this->getCustomNewResourceLink(),'newResourceLinkRouteUrl' => $this->getCreateRouteUrl(),'newResourceLinkLabel' => $newResourceLinkLabel]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datatable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['searchbarPlaceholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($searchbarPlaceholder),'filters' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filters),'customFilters' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($customFilters),'perPageOptions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($perPageOptions),'headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($headers),'enableCheckbox' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($enableCheckbox),'enableBulkActions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($enableBulkActions),'enableNewResourceLink' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($showCreateButton),'noResultsMessage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($noResultsMessage),'customNoResultsMessage' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($customNoResultsMessage),'data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data),'newResourceLinkPermission' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($newResourceLinkPermission),'newResourceLinkRouteName' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($newResourceLinkRouteName),'customNewResourceLink' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getCustomNewResourceLink()),'newResourceLinkRouteUrl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getCreateRouteUrl()),'newResourceLinkLabel' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($newResourceLinkLabel)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8aaf9779783cdf64609094123653a0b9)): ?>
<?php $attributes = $__attributesOriginal8aaf9779783cdf64609094123653a0b9; ?>
<?php unset($__attributesOriginal8aaf9779783cdf64609094123653a0b9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8aaf9779783cdf64609094123653a0b9)): ?>
<?php $component = $__componentOriginal8aaf9779783cdf64609094123653a0b9; ?>
<?php unset($__componentOriginal8aaf9779783cdf64609094123653a0b9); ?>
<?php endif; ?>
<?php /**PATH D:\projects\php8\lara\resources\views/backend/livewire/datatable/datatable.blade.php ENDPATH**/ ?>