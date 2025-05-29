<?php
 
namespace App\Livewire\Peminjaman;
 
use App\Models\Peminjaman;
use Livewire\Attributes\Validate;
use Livewire\Component;
 
class EditPeminjaman extends Component
{
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu $ruang_id
    #[Validate('required|string|max:10')]
    // Membuat property $ruang_id untuk menyimpan data peminjamna yang akan ditambahkan
    public string $ruang_id = '';
 
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu $pegawai_id
    #[Validate('required|string|max:100')]
    // Membuat property $pegawai_id untuk menyimpan data peminjaman yang akan ditambahkan
    public $pegawai_id = '';
 
    // Menambahkan atribut untuk validasi data yang diinputkan yaitu tanggal
    #[Validate('required|string|max:50')]
    // Membuat property tanggal untuk menyimpan data peminjaman yang akan ditambahkan
    public $tanggal = '';

     // Menambahkan atribut untuk validasi data yang diinputkan yaitu $jam_mulai
    #[Validate('required|string|max:50')]
    // Membuat property $jam_mulai untuk menyimpan data peminjaman yang akan ditambahkan
    public $jam_mulai = '';

     // Menambahkan atribut untuk validasi data yang diinputkan yaitu $jam_akhir
    #[Validate('required|string|max:50')]
    // Membuat property $jam_akhir untuk menyimpan data peminjaman yang akan ditambahkan
    public $jam_akhir = '';

     // Menambahkan atribut untuk validasi data yang diinputkan yaitu keterangan
    #[Validate('required|string|max:50')]
    // Membuat property keterangan untuk menyimpan data peminjaman yang akan ditambahkan
    public $keterangan = '';

    // Menambahkan property peminjaman yang akan menjadi model peminjaman yang akan diedit
    public Peminjaman $peminjaman;
 
    // Mendefinisikan method mount untuk menginisialisasi property model peminjaman pada saat komponen di-mount
    public function mount(Peminjaman $peminjaman)
    {
        $this->peminjaman = $peminjaman;
        $this->ruang_id = $peminjaman->ruang_id;
        $this->pegawai_id = $peminjaman->pegawai_id;
        $this->tanggal = $peminjaman->tanggal;
        $this->jam_mulai = $peminjaman->jam_mulai;
        $this->jam_akhir = $peminjaman->jam_akhir;
        $this->keterangan = $peminjaman->keterangan;
    }
 
    // Mendefinisikan method save untuk menyimpan data peminjaman yang diinputkan oleh user ke dalam database
    public function save()
    {
        // Melakukan validasi data yang diinputkan oleh user
        $this->validate();
 
        // Mengupdate data peminjaman yang diinputkan oleh user ke dalam database
        $this->peminjaman->update([
            'ruang_id' => $this->ruang_id,
            'pegawai_id' => $this->pegawai_id,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'keterangan' => $this->keterangan,
        ]);
 
        // Menggunakan session untuk menyimpan pesan sukses setelah data peminjaman berhasil diperbarui
        session()->flash('message', 'Peminjaman ruang berhasil diperbarui.');
 
        // Melakukan redirect ke halaman list peminjaman setelah data peminjaman berhasil diperbarui
        return redirect()->route('peminjaman.index');
    }
 
    public function render()
    {
        return view('livewire.peminjaman.edit-peminjaman');
    }
}