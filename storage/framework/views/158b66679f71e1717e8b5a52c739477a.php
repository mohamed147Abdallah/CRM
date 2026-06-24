<nav x-data="{ open: false }" class="nx-nav sticky top-0 z-50">
    <?php
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $pendingInvite = \App\Models\Invitation::where('email', $user->email)
            ->where('accepted', false)->where('expires_at', '>', now())->first();
    ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Left: Logo + Links -->
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 group">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-all duration-300 group-hover:shadow-lg"
                         style="background: linear-gradient(135deg, #6366f1, #818cf8); box-shadow: 0 2px 8px rgba(99,102,241,0.35);">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="font-mono-nexus font-bold text-base tracking-wider" style="color: var(--text);">
                        NEXUS<span style="color: var(--accent);">_CRM</span>
                    </span>
                </a>

                <!-- Nav links (desktop) -->
                <div class="hidden sm:flex items-center gap-1">
                    <?php
                        $navLinks = [
                            ['route' => 'dashboard',       'match' => 'dashboard',    'label' => 'Dashboard'],
                            ['route' => 'customers.index', 'match' => 'customers.*',  'label' => 'Customers'],
                            ['route' => 'kanban',          'match' => 'kanban',       'label' => 'Pipeline'],
                        ];
                    ?>
                    <?php $__currentLoopData = $navLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $isActive = request()->routeIs($link['match']); ?>
                        <a href="<?php echo e(route($link['route'])); ?>"
                           class="px-3 py-1.5 rounded-lg text-sm font-medium font-mono-nexus tracking-wide transition-all duration-200"
                           style="<?php echo e($isActive
                               ? 'background: var(--accent-glow); color: var(--accent); font-weight: 700;'
                               : 'color: var(--text-2);'); ?>"
                           onmouseover="if(!this.classList.contains('nx-active')) { this.style.background='var(--bg-3)'; this.style.color='var(--text)'; }"
                           onmouseout="if(!this.classList.contains('nx-active')) { this.style.background='transparent'; this.style.color='var(--text-2)'; }"
                           <?php echo e($isActive ? 'class="nx-active"' : ''); ?>>
                            <?php echo e($link['label']); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($user && $user->isAdmin()): ?>
                        <?php $isActive = request()->is('personnel'); ?>
                        <a href="<?php echo e(url('/personnel')); ?>"
                           class="px-3 py-1.5 rounded-lg text-sm font-medium font-mono-nexus tracking-wide transition-all"
                           style="<?php echo e($isActive ? 'background: rgba(139,92,246,0.12); color: #8b5cf6; font-weight: 700;' : 'color: #8b5cf6;'); ?>"
                           onmouseover="this.style.background='rgba(139,92,246,0.12)'"
                           onmouseout="<?php echo e($isActive ? '' : "this.style.background='transparent'"); ?>">
                            Personnel
                        </a>
                    <?php endif; ?>

                    <?php if($pendingInvite && !$user->isAdmin()): ?>
                        <a href="<?php echo e(route('invitation.show', $pendingInvite->token)); ?>"
                           class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-bold font-mono-nexus tracking-widest animate-pulse"
                           style="background: rgba(59,130,246,0.1); color: #3b82f6; border: 1px solid rgba(59,130,246,0.25);">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-ping"></span>
                            New Invitation
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Theme toggle + User dropdown -->
            <div class="hidden sm:flex items-center gap-3">

                <!-- Theme Toggle -->
                <button id="theme-toggle" onclick="toggleTheme()"
                        class="w-9 h-9 flex items-center justify-center rounded-lg transition-all"
                        style="background: var(--bg-3); border: 1px solid var(--border); color: var(--text-2);"
                        onmouseover="this.style.borderColor='var(--accent)'; this.style.color='var(--accent)';"
                        onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--text-2)';"
                        title="Toggle theme">
                    <svg id="theme-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <!-- User dropdown -->
                <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => '52']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => '52']); ?>
                     <?php $__env->slot('trigger', null, []); ?> 
                        <button class="flex items-center gap-2.5 px-3 py-1.5 rounded-lg transition-all font-mono-nexus"
                                style="background: var(--bg-3); border: 1px solid var(--border); color: var(--text-2);"
                                onmouseover="this.style.borderColor='var(--border-2)'"
                                onmouseout="this.style.borderColor='var(--border)'">
                            <!-- Avatar -->
                            <div class="w-6 h-6 rounded-md flex items-center justify-center text-[11px] font-bold text-white"
                                 style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                                <?php echo e(substr($user->name, 0, 1)); ?>

                            </div>
                            <span class="text-xs font-bold tracking-wide" style="color: var(--text);"><?php echo e($user->name); ?></span>
                            <span class="text-[9px] font-bold tracking-widest px-1.5 py-0.5 rounded-sm"
                                  style="background: var(--accent-glow); color: var(--accent);">
                                <?php echo e(strtoupper($user->role)); ?>

                            </span>
                            <svg class="w-3 h-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                     <?php $__env->endSlot(); ?>

                     <?php $__env->slot('content', null, []); ?> 
                        <div class="py-1" style="background: var(--bg-2); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; min-width: 180px;">
                            <a href="<?php echo e(route('profile.edit')); ?>"
                               class="flex items-center gap-3 px-4 py-3 text-xs font-mono-nexus font-semibold tracking-wide transition-all"
                               style="color: var(--text-2);"
                               onmouseover="this.style.background='var(--bg-3)'; this.style.color='var(--text)';"
                               onmouseout="this.style.background='transparent'; this.style.color='var(--text-2)';">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--accent);">
                                    <path stroke-linecap="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile Settings
                            </a>
                            <div class="nx-divider mx-3"></div>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                        class="w-full flex items-center gap-3 px-4 py-3 text-xs font-mono-nexus font-semibold tracking-wide transition-all text-left"
                                        style="color: #ef4444;"
                                        onmouseover="this.style.background='rgba(239,68,68,0.06)'"
                                        onmouseout="this.style.background='transparent'">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                     <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
            </div>

            <!-- Mobile hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                        class="w-9 h-9 flex items-center justify-center rounded-lg transition-all"
                        style="border: 1px solid var(--border); color: var(--text-2);">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden"
         style="border-top: 1px solid var(--border); background: var(--bg-2); padding: 8px 16px 16px;">
        <div class="space-y-1 pt-2">
            <?php $__currentLoopData = $navLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $isActive = request()->routeIs($link['match']); ?>
                <a href="<?php echo e(route($link['route'])); ?>"
                   class="block px-3 py-2.5 rounded-lg text-sm font-mono-nexus font-semibold tracking-wide"
                   style="<?php echo e($isActive ? 'background: var(--accent-glow); color: var(--accent);' : 'color: var(--text-2);'); ?>">
                    <?php echo e($link['label']); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-4 pt-4 flex items-center justify-between" style="border-top: 1px solid var(--border);">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold text-white"
                     style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                    <?php echo e(substr($user->name, 0, 1)); ?>

                </div>
                <div>
                    <div class="text-sm font-bold font-mono-nexus" style="color: var(--text);"><?php echo e($user->name); ?></div>
                    <div class="text-[10px]" style="color: var(--text-3);"><?php echo e($user->email); ?></div>
                </div>
            </div>
            <button onclick="toggleTheme()" class="w-8 h-8 flex items-center justify-center rounded-lg"
                    style="background: var(--bg-3); border: 1px solid var(--border); color: var(--text-2);">
                <svg id="theme-icon-mobile" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>
        </div>
        <div class="mt-3 space-y-1">
            <a href="<?php echo e(route('profile.edit')); ?>" class="block px-3 py-2 rounded-lg text-sm font-mono-nexus" style="color: var(--text-2);">Profile Settings</a>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-sm font-mono-nexus" style="color: #ef4444;">Sign Out</button>
            </form>
        </div>
    </div>
</nav><?php /**PATH C:\Users\ASUS\OneDrive\Desktop\laravel\my-crm\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>