<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users Lists',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'barang' => [
        'name' => 'Barang',
        'index_title' => 'List Barang',
        'new_title' => 'New Barang',
        'create_title' => 'Create Barang',
        'edit_title' => 'Edit Barang',
        'show_title' => 'Show Barang',
        'inputs' => [
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'satuan' => 'Satuan',
            'harga_jual' => 'Harga Jual',
            'stock' => 'Stock',
            'ditarik' => 'Ditarik',
            'user_id' => 'User',
            'produk_id' => 'Produk',
        ],
    ],

    'produk' => [
        'name' => 'Produk',
        'index_title' => 'List Produk',
        'new_title' => 'New Produk',
        'create_title' => 'Create Produk',
        'edit_title' => 'Edit Produk',
        'show_title' => 'Show Produk',
        'inputs' => [
            'nama_produk' => 'Nama Produk',
        ],
    ],

    'pemasok' => [
        'name' => 'Pemasok',
        'index_title' => 'List Pemasok',
        'new_title' => 'New Pemasok',
        'create_title' => 'Create Pemasok',
        'edit_title' => 'Edit Pemasok',
        'show_title' => 'Show Pemasok',
        'inputs' => [
            'nama_pemasok' => 'Nama Pemasok',
        ],
    ],

    'pelanggan' => [
        'name' => 'Pelanggan',
        'index_title' => 'List Pelanggan',
        'new_title' => 'New Pelanggan',
        'create_title' => 'Create Pelanggan',
        'edit_title' => 'Edit Pelanggan',
        'show_title' => 'Show Pelanggan',
        'inputs' => [
            'kode_pelanggan' => 'Kode Pelanggan',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telp',
            'email' => 'Email',
        ],
    ],

    'pembelian' => [
        'name' => 'Pembelian',
        'index_title' => 'List Pembelian',
        'new_title' => 'New Pembelian',
        'create_title' => 'Create Pembelian',
        'edit_title' => 'Edit Pembelian',
        'show_title' => 'Show Pembelian',
        'inputs' => [
            'kode_masuk' => 'Kode Masuk',
            'tanggal_masuk' => 'Tanggal Masuk',
            'total' => 'Total',
            'pemasok_id' => 'Pemasok',
            'user_id' => 'User',
        ],
    ],

    'detail_pembelian' => [
        'name' => 'Detail Pembelian',
        'index_title' => 'Detail Pembelian',
        'new_title' => 'New Detail pembelian',
        'create_title' => 'Create DetailPembelian',
        'edit_title' => 'Edit DetailPembelian',
        'show_title' => 'Show DetailPembelian',
        'inputs' => [
            'barang_id' => 'Barang',
            'pembelian_id' => 'Pembelian',
            'harga_beli' => 'Harga Beli',
            'jumlah' => 'Jumlah',
            'sub_total' => 'Sub Total',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
