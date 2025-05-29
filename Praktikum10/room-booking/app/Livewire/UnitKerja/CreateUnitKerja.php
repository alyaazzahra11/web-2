<?php
 
namespace App\Livewire\UnitKerja;
 
use App\Models\UnitKerja;
use Livewire\Attributes\Validate;
use Livewire\Component;
 
class CreateUnitKerja extends Component
{
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu kode
    #[Validate('required|string|max:10')]
    // Membuat property kode untuk menyimpan data unit kerja yang akan ditambahkan
    public string $kode = '';
 
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu nama
    #[Validate('required|string|max:100')]
    // Membuat property nama untuk menyimpan data unit kerja yang akan ditambahkan
    public $nama = '';
 
    // Mendefinisikan method save untuk menyimpan data unit kerja yang diinputkan oleh user ke dalam database
    public function save()
    {
        // Melakukan validasi data yang diinputkan oleh user
        $this->validate();
 
        // Menggunakan model unit kerja untuk menyimpan data unit kerja yang diinputkan oleh user ke dalam database
        UnitKerja::create([
            'kode' => $this->kode,
            'nama' => $this->nama,
        ]);
 
        // Menggunakan session untuk menyimpan pesan sukses setelah data unit kerja berhasil ditambahkan
        session()->flash('message', 'Unit kerja berhasil ditambahkan.');
 
        // Melakukan redirect ke halaman list unit kerja setelah data unit kerja berhasil ditambahkan
        $this->redirectRoute('unitkerja.index');
    }
 
    public function render()
    {
        return view('livewire.unit-kerja.create-unit-kerja');
    }
}