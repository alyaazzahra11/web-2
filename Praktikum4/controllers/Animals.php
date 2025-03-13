<?php
    class animal {
        public $animals = ["Kucing", "Harimau", "Kelinci", "Buaya", "Ular"];
        
        function index() {
            echo "<ol>";
            foreach ($this->animals as $key => $value) {
                echo "<li>$value</li>";
            }
            echo "</ol>";
        }

        function store($hewan){
            array_push($this->animals, $hewan);

            $this->index();
        }

        public function update($key, $value){
            if (isset($this->animals[$key])) {

                $this->animals[$key] = $value;
                
                $this->index();  // Memanggil method index
            }
            else {
                echo "Hewan tidak ditemukan <br>";
            }
        }

        public function destroy($key){
            if (isset($this->animals[$key])) {

                unset($this->animals[$key]);
                
                $this->index();  // Memanggil method index
            }
            else {
                echo "Hewan tidak ditemukan <br>";
            }
        }
        
    }

    $hewan = new animal ();

    echo "Index - Menampilkan seluruh data hewan <br>";
    $hewan -> index();

    echo "<br>";

    echo "Store - Menambahkan data hewan baru (Burung) <br>";
    $hewan -> store("Burung");
    
    echo "<br>";

    echo "Update - Mengubah data hewan <br>";
    $hewan -> update(0, "Kucing Anggora");

    echo "<br>";

    echo "Destroy - Menghapus data hewan <br>";
    $hewan -> destroy(1);

    echo "<br>";

?>