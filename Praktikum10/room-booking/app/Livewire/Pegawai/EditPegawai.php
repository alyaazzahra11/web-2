<?php
 
namespace App\Livewire\Pegawai;
 
use App\Models\Pegawai;
use Livewire\Attributes\Validate;
use Livewire\Component;
 
class EditPegawai extends Component
{
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu nip
    #[Validate('required|string|max:10')]
    // Membuat property kode untuk menyimpan data pegawai yang akan ditambahkan
    public string $nip = '';
 
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu nama
    #[Validate('required|string|max:100')]
    // Membuat property nama untuk menyimpan data pegawai yang akan ditambahkan
    public $nama = '';
 
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu &unit_kerja_id
    #[Validate('required|integer|exists:unit_kerja,id')]
    // Membuat property $unit_kerja_id untuk menyimpan data pegawai yang akan ditambahkan
    public $unit_kerja_id = '';
 
    // Menambahkan property Pegawai yang akan menjadi model pegawai yang akan diedit
    public Pegawai $pegawai;
 
    // Mendefinisikan method mount untuk menginisialisasi property model pegawai pada saat komponen di-mount
    public function mount(Pegawai $pegawai)
    {
        $this->pegawai = $pegawai;
        $this->nip = $pegawai->nip;
        $this->nama = $pegawai->nama;
        $this->unit_kerja_id = $pegawai->unit_kerja_id;
    }
 
    // Mendefinisikan method save untuk menyimpan data pegawai yang diinputkan oleh user ke dalam database
    public function save()
    {
        // Melakukan validasi data yang diinputkan oleh user
        $this->validate();
 
        // Mengupdate data pegawai yang diinputkan oleh user ke dalam database
        $this->pegawai->update([
            'nip' => $this->nip,
            'nama' => $this->nama,
            'unit_kerja_id' => $this->unit_kerja_id,
        ]);
 
        // Menggunakan session untuk menyimpan pesan sukses setelah data pegawai berhasil diperbarui
        session()->flash('message', 'Pegawai berhasil diperbarui.');
 
        // Melakukan redirect ke halaman list pegawai setelah data pegawai berhasil diperbarui
        return redirect()->route('pegawai.index');
    }
 
    public function render()
    {
        return view('livewire.pegawai.edit-pegawai');
    }
}