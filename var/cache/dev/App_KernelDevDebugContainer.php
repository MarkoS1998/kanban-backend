<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPljOeHh\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPljOeHh/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerPljOeHh.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerPljOeHh\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerPljOeHh\App_KernelDevDebugContainer([
    'container.build_hash' => 'PljOeHh',
    'container.build_id' => '14751f98',
    'container.build_time' => 1698587946,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerPljOeHh');