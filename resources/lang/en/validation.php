<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pesan Validasi Bahasa Indonesia
    |--------------------------------------------------------------------------
    |
    | Baris berikut berisi pesan kesalahan default yang digunakan oleh
    | kelas validasi. Beberapa aturan memiliki versi khusus.
    |
    */

    'required' => ':attribute wajib diisi.',
    'unique' => ':attribute sudah digunakan.',
    'numeric' => ':attribute harus berupa angka.',
    'min' => [
        'numeric' => ':attribute minimal :min.',
    ],
    'max' => [
        'numeric' => ':attribute maksimal :max.',
    ],

    // Tambah aturan lain jika perlu...

    /*
    |--------------------------------------------------------------------------
    | Pesan Kustom Validasi
    |--------------------------------------------------------------------------
    |
    | Di sini kamu bisa menentukan pesan validasi khusus untuk atribut tertentu.
    |
    */

    'custom' => [
        'id_brg' => [
            'unique' => 'ID Barang sudah digunakan.',
        ],
        'id_jenis' => [
            'unique' => 'ID Jenis sudah digunakan.',
        ],
        'id_merk' => [
            'unique' => 'ID Merk sudah digunakan.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Nama Atribut
    |--------------------------------------------------------------------------
    |
    | Di sini kamu bisa mengganti nama atribut ke dalam bahasa yang lebih
    | ramah pengguna.
    |
    */

    'attributes' => [
        'id_brg' => 'ID Barang',
        'id_jenis' => 'ID Jenis',
        'id_merk' => 'ID Merk',
        'nm_brg' => 'Nama Barang',
        'harga_brg' => 'Harga Barang',
        'qty' => 'Jumlah',
    ],

];
