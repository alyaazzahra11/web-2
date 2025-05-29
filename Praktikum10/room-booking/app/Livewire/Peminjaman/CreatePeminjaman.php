<?php
 
namespace App\Livewire\Peminjaman;
 
use App\Models\Peminjaman;
use Livewire\Attributes\Validate;
use Livewire\Component;
 
class CreatePeminjaman extends Component
{
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu $ruang_id
    #[Validate('required|string|max:10')]
    // Membuat property kode untuk menyimpan data peminjaman yang akan ditambahkan
    public string $ruang_id = '';
 
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu $pegawai_id
    #[Validate('required|string|max:100')]
    // Membuat property nama untuk menyimpan data peminjaman yang akan ditambahkan
    public $pegawai_id = '';
 
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu tanggal
    #[Validate('required|string|max:50')]
    // Membuat property tanggal untuk menyimpan data peminjaman yang akan ditambahkan
    public $tanggal = '';

     // Menambahkan atribut untuk validasi data yang diinputkan yaitu jam mulai
    #[Validate('required|string|max:50')]
    // Membuat property jam mulai untuk menyimpan data peminjaman yang akan ditambahkan
    public $jam_mulai = '';

     // Menambahkan atribut untuk validasi data yang diinputkan yaitu jam akhir
    #[Validate('required|string|max:50')]
    // Membuat property jam akhir untuk menyimpan data peminjaman yang akan ditambahkan
    public $jam_akhir = '';

     // Menambahkan atribut untuk validasi data yang diinputkan yaitu keterangan
    #[Validate('required|string|max:50')]
    // Membuat property keterangan untuk menyimpan data peminjaman yang akan ditambahkan
    public $keterangan = '';
 
    // Mendefinisikan method save untuk menyimpan data peminjaman yang diinputkan oleh user ke dalam database
    public function save()
    {
        // Melakukan validasi data yang diinputkan oleh user
        $this->validate();
 
        // Menggunakan model Peminjaman untuk menyimpan data peminjaman yang diinputkan oleh user ke dalam database
        Peminjaman::create([
            'ruang_id' => $this->ruang_id,
            'pegawai_id' => $this->pegawai_id,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'keterangan' => $this->keterangan,
        ]);
 
        // Menggunakan session untuk menyimpan pesan sukses setelah data peminjaman berhasil ditambahkan
        session()->flash('message', 'Peminjaman ruang berhasil ditambahkan.');
 
        // Melakukan redirect ke halaman list peminjaman setelah data peminjaman berhasil ditambahkan
        $this->redirectRoute('peminjaman.index');
    }
 
    public function render()
    {
        return view('livewire.peminjaman.create-peminjaman');
    }
}