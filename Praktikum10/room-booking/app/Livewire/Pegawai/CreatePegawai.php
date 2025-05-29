<?php
 
namespace App\Livewire\Pegawai;
 
use App\Models\Pegawai;
use Livewire\Attributes\Validate;
use Livewire\Component;
 
class CreatePegawai extends Component
{
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu nip
    #[Validate('required|string|max:10')]
    // Membuat property nip untuk menyimpan data pegawai yang akan ditambahkan
    public string $nip = '';
 
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu nama
    #[Validate('required|string|max:100')]
    // Membuat property nama untuk menyimpan data pegawai yang akan ditambahkan
    public $nama = '';
 
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu $unit_kerja_id
    #[Validate('required|string|max:50')]
    // Membuat property $unit_kerja_id untuk menyimpan data pegawai yang akan ditambahkan
    public $unit_kerja_id = '';
 
    // Mendefinisikan method save untuk menyimpan data pegawai yang diinputkan oleh user ke dalam database
    public function save()
    {
        // Melakukan validasi data yang diinputkan oleh user
        $this->validate();
 
        // Menggunakan model Pegawai untuk menyimpan data pegawai yang diinputkan oleh user ke dalam database
        Pegawai::create([
            'nip' => $this->nip,
            'nama' => $this->nama,
            'unit_kerja_id' => $this->unit_kerja_id,
        ]);
 
        // Menggunakan session untuk menyimpan pesan sukses setelah data pegawai berhasil ditambahkan
        session()->flash('message', 'Pegawai berhasil ditambahkan.');
 
        // Melakukan redirect ke halaman list pegawai setelah data pegawai berhasil ditambahkan
        $this->redirectRoute('pegawai.index');
    }
 
    public function render()
    {
        return view('livewire.pegawai.create-pegawai');
    }
}