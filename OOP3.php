<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            display: grid;
            justify-content: center;
        }
        .Box{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="Box">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        class Motor {
            protected $name;
            protected $waktu;
            protected $jenis; 
            protected $ppn;
            protected $data_harga = [
                "Scoopy" => 150000,
                "Beat" => 160000,
                "Mio" => 180000,
                "Vario" => 170000,
                "Supra" => 200000
            ];

            protected $daftar_member = [
                "Fredy",
                "Galih",
                "Jeno",
                "Kensai",
                "Marvel"
            ];

            public function __construct($name,$waktu,$jenis,$ppn) {
                $this->name = $name;
                $this->waktu = $waktu;
                $this->jenis = $jenis;
                $this->ppn = $ppn;
            }

            public function getNama(){
                return $this->name;
            }
            public function getWaktu() {
                return $this->waktu; 
            }

            public function getJenis() {
                return $this->jenis; 
            }
            
            public function getHarga() {
                return $this->data_harga[$this->jenis];
            }
            public function isRegisteredMember($name) {
                return in_array($name, $this->daftar_member);
            }
        }
        
        class Rental extends Motor {
            public function getTotal() {
                $total = $this->waktu * $this->data_harga[$this->jenis] + $this->ppn;
                if ($this->isRegisteredMember($this->name)) {
                    $total = $total - ( $total * 0.05);
                    echo "------------------------------------------------------------------<br>";
                    echo $this->name. " Terdaftar dalam member dan mendapatkan diskon 5% <br>";
                } else {
                    echo "------------------------------------------------------------------<br>";
                }
                return $total;
            }

        }
        $Rental = new Rental($_POST['nama'],$_POST['Waktu'],$_POST['jenis'], $_POST['ppn']);

        $total = $Rental->getTotal();
        echo "Nama : " . $Rental->getNama() . "<br>";
        echo "Jenis Motor yang dirental adalah ".$Rental->getJenis(). "<br>" ;
        echo "Dengan Waktu : ". $Rental->getWaktu() ." Hari <br>";
        echo "Harga Rental Perhari : Rp. ". number_format($Rental->getharga(),0,',','.') . "<br>";
        echo "Total yang harus anda bayar Rp. ". number_format($total,0,',','.') . "<br>";
        echo "------------------------------------------------------------------<br>";
    }
    ?>
    </div> 
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <table class="form">
                <tr>
                    <td>
                        <label for="nama" >Nama Pelanggan </label>
                    </td>
                    <td>
                        <label for="nama">:</label>
                    </td>
                    <td class="input">
                        <input type="text" id="nama" name="nama" pattern="[A-Za-z]{1,}" title="Hanya boleh menggunakan huruf" ><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Waktu">Lama Waktu Rental (per hari) </label>
                    </td>
                    <td>
                        <label for="Waktu">:</label>
                    </td>
                    <td class="input">
                        <input type="number" id="number" name="Waktu" min="1" required><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="jenis">Jenis Motor </label>
                    </td>
                    <td>
                        <label for="jenis">:</label>
                    </td>
                    <td>
                        <select name="jenis">
                            <option value="Scoopy">Scoopy</option>
                            <option value="Mio">Mio</option>
                            <option value="Beat">Beat</option>
                            <option value="Vario">Vario</option>
                            <option value="Supra">Supra</option>
                        </select><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Beli">
                    </td>
                </tr>
        <input type="hidden" name="ppn" value="10000">
    </form>
</body>
</html>