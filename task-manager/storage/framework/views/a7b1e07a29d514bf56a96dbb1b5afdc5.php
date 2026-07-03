<?php if($notes->count() > 0): ?>
<div class="cu-notes-grid">
    <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="cu-note-card" data-note-id="<?php echo e($note->id); ?>">
        <div class="cu-note-accent"></div>

        
        <div class="cu-note-head">
            <h3 class="cu-note-title"><?php echo e($note->title); ?></h3>
            <button class="cu-fav-btn <?php echo e($note->is_favorite ? 'active' : ''); ?>" data-note-id="<?php echo e($note->id); ?>" title="Toggle favourite">
                <i class="bi bi-star-fill"></i>
            </button>
        </div>

        
        <?php if($note->category || ($note->tags && count($note->tags))): ?>
        <div class="cu-note-badges">
            <?php if($note->category): ?>
                <span class="cu-cat-badge"><i class="bi bi-tag me-1" style="font-size:10px;"></i><?php echo e($note->category); ?></span>
            <?php endif; ?>
            <?php if($note->tags): ?>
                <?php $tags = is_array($note->tags) ? $note->tags : (json_decode($note->tags, true) ?? []); ?>
                <?php $__currentLoopData = array_slice($tags, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="cu-tag-pill"><?php echo e($tag); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(count($tags) > 3): ?>
                    <span class="cu-tag-pill">+<?php echo e(count($tags) - 3); ?></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        
        <div class="cu-note-excerpt"><?php echo e($note->excerpt); ?></div>

        
        <div class="cu-note-footer">
            <div class="cu-note-meta">
                <i class="bi bi-clock" style="font-size:10px;"></i>
                <?php echo e($note->created_at->diffForHumans()); ?>

                &middot; <?php echo e($note->word_count); ?> words
            </div>
            <div class="cu-note-actions">
                <a href="<?php echo e(route('notes.edit', $note->id)); ?>" class="cu-note-btn edit" onclick="event.stopPropagation()">
                    <i class="bi bi-pencil"></i>
                </a>
                <button class="cu-note-btn copy" data-note-id="<?php echo e($note->id); ?>" title="Duplicate">
                    <i class="bi bi-files"></i>
                </button>
                <form action="<?php echo e(route('notes.destroy', $note->id)); ?>" method="POST"
                      onsubmit="return confirm('Delete this note?');" style="display:inline;">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="cu-note-btn del" onclick="event.stopPropagation()">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php else: ?>
<div class="cu-notes-grid">
    <div class="cu-empty">
        <i class="bi bi-journal-text"></i>
        <p>No notes found. Create your first one!</p>
        <a href="<?php echo e(route('notes.create')); ?>"><i class="bi bi-plus-lg"></i> New Note</a>
    </div>
</div>
<?php endif; ?>
<?php /**PATH D:\projects\php8\task-manager\resources\views/notes/partials/notes-grid.blade.php ENDPATH**/ ?>