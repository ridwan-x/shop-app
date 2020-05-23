<?php

return [
	'menu' => [
		// [
		// 	'name'			=> 'User',
		// 	'icon'  		=> 'fa fa-user',
		// 	'route' 		=> 'admin.user',
		// 	'set_active' 	=> ['admin.user','admin.user.create','admin.user.edit'],
		// 	'treeview'  	=> false
		// ],
		// [
		// 	'name'			=> 'Access',
		// 	'icon'  		=> 'fa fa-lock',
		// 	'set_active'	=> ['admin.roles','admin.permission'],
		// 	'treeview'  	=> true,
		// 	'tree-menu' 	=> [
		// 		'roles' => [
		// 			'name'	=> 'Roles',
		// 			'icon'  => 'fa fa-circle-o',
		// 			'route' => 'admin.roles',
		// 		],
		// 		'permission' => [
		// 			'name'	=> 'Permission',
		// 			'icon'  => 'fa fa-circle-o',
		// 			'route' => 'admin.permission',
		// 		]
		// 	]
		// ],
		[
			'name'			=> 'Produk',
			'icon'  		=> 'fa fa-folder-o',
			'route' 		=> 'produk.index',
			'set_active' 	=> ['produk.index','produk.create','produk.edit'],
			'treeview'  	=> false
		],
		[
			'name'			=> 'Kategori',
			'icon'  		=> 'fa fa-folder-o',
			'route' 		=> 'kategori.index',
			'set_active' 	=> ['kategori.index'],
			'treeview'  	=> false
		],
	]
];