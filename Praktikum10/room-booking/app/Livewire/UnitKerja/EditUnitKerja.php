<?php
 
namespace App\Livewire\UnitKerja;
 
use App\Models\UnitKerja;
use Livewire\Attributes\Validate;
use Livewire\Component;
 
class EditUnitKerja extends Component
{
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu kode
    #[Validate('required|string|max:10')]
    // Membuat property kode untuk menyimpan data unit kerja yang akan ditambahkan
    public string $kode = '';
 
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu nama
    #[Validate('required|string|max:100')]
    // Membuat property nama untuk menyimpan data unit kerja yang akan ditambahkan
    public $nama = '';
 
    // Menambahkan property unit kerja yang akan menjadi model unit kerja yang akan diedit
    public UnitKerja $unitkerja;
 
    // Mendefinisikan method mount untuk menginisialisasi property model unit kerja pada saat komponen di-mount
    public function mount(UnitKerja $unitkerja)
    {
        $this->unitkerja = $unitkerja;
        $this->kode = $unitkerja->kode;
        $this->nama = $unitkerja->nama;
    }
 
    // Mendefinisikan method save untuk menyimpan data unit kerja yang diinputkan oleh user ke dalam database
    public function save()
    {
        // Melakukan validasi data yang diinputkan oleh user
        $this->validate();
 
        // Mengupdate data unit kerja yang diinputkan oleh user ke dalam database
        $this->unitkerja->update([
            'kode' => $this->kode,
            'nama' => $this->nama,
        ]);
 
        // Menggunakan session untuk menyimpan pesan sukses setelah data unit kerja berhasil diperbarui
        session()->flash('message', 'Unit kerja berhasil diperbarui.');
 
        // Melakukan redirect ke halaman list unit kerja setelah data unit kerja berhasil diperbarui
        return redirect()->route('unitkerja.index');
    }
 
    public function render()
    {
        return view('livewire.unit-kerja.edit-unit-kerja');
    }
}