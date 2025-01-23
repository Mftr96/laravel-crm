<?php

// Route::screen('/main', PlatformScreen::class)
//     ->name('platform.main');

// // Platform > Profile
// Route::screen('profile', UserProfileScreen::class)
//     ->name('platform.profile')
//     ->breadcrumbs(fn (Trail $trail) => $trail
//         ->parent('platform.index')
//         ->push(__('Profile'), route('platform.profile')));

// // Platform > System > Users > User
// Route::screen('users/{user}/edit', UserEditScreen::class)
//     ->name('platform.systems.users.edit')
//     ->breadcrumbs(fn (Trail $trail, $user) => $trail
//         ->parent('platform.systems.users')
//         ->push($user->name, route('platform.systems.users.edit', $user)));

// // Platform > System > Users > Create
// Route::screen('users/create', UserEditScreen::class)
//     ->name('platform.systems.users.create')
//     ->breadcrumbs(fn (Trail $trail) => $trail
//         ->parent('platform.systems.users')
//         ->push(__('Create'), route('platform.systems.users.create')));

// // Platform > System > Users
// Route::screen('users', UserListScreen::class)
//     ->name('platform.systems.users')
//     ->breadcrumbs(fn (Trail $trail) => $trail
//         ->parent('platform.index')
//         ->push(__('Users'), route('platform.systems.users')));

// // Platform > System > Roles > Role
// Route::screen('roles/{role}/edit', RoleEditScreen::class)
//     ->name('platform.systems.roles.edit')
//     ->breadcrumbs(fn (Trail $trail, $role) => $trail
//         ->parent('platform.systems.roles')
//         ->push($role->name, route('platform.systems.roles.edit', $role)));

// // Platform > System > Roles > Create
// Route::screen('roles/create', RoleEditScreen::class)
//     ->name('platform.systems.roles.create')
//     ->breadcrumbs(fn (Trail $trail) => $trail
//         ->parent('platform.systems.roles')
//         ->push(__('Create'), route('platform.systems.roles.create')));

// // Platform > System > Roles
// Route::screen('roles', RoleListScreen::class)
//     ->name('platform.systems.roles')
//     ->breadcrumbs(fn (Trail $trail) => $trail
//         ->parent('platform.index')
//         ->push(__('Roles'), route('platform.systems.roles')));

// // Example...
// Route::screen('example', ExampleScreen::class)
//     ->name('platform.example')
//     ->breadcrumbs(fn (Trail $trail) => $trail
//         ->parent('platform.index')
//         ->push('Example Screen'));

// Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
// Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
// Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
// Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

// Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
// Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
// Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
// Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');