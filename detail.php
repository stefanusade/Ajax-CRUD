<?php 
$page = 'Detail Buku';
include "header.php"; 
if(!isset($_GET['id'])){
    header('Location:index.php');
}
$id = $_GET['id'];
?>

    <section id="top">
        <div class="container-fluid py-5 hero text-white">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-4 col-6" id="gambar">

                    </div>
                    <div class="col-lg-9 col-12 pt-5 pb-3" id="meta">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">
            <h2>Sinopsis</h2>
            <p id="sinopsis"><p>
        </div>
        <hr>
        <div class="container my-5" id="detail">
            <h2 class="mb-3">Detail Buku</h2>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            $.ajax({
                type: 'GET',url: 'book.php',
                data: {action: 'detail', id:<?= $id; ?>},
                dataType: 'json',
                cache: false,
                success: function(data) {
                    $("#gambar").append("<img class='shadow' style='border-radius:10px; width:100%' src='./assets/cover/"+data[0]['sampul']+"'>");
                    $("#meta").append("<h1>"+data[0]['judul']+"</h1>");
                    $("#meta").append("<h5 class='mt-3'>"+data[0]['tahun']+"</h5>");
                    $("#meta").append("<h5><i class='fa-solid fa-pencil'></i> "+data[0]['author']+"</h5>");
                    $("#meta").append("<h5><i class='fa-solid fa-book'></i> "+data[0]['pub']+"</h5>");
                    $("#meta").append("<h5><i class='fa-solid fa-shapes'></i> "+data[0]['genre']+"</h5>");
                    $("#sinopsis").html(data[0]['sinopsis']);
                    $("#detail").append("<p class='m-0'>Harga: "+data[0]['harga']+"</p>");
                    $("#detail").append("<p class='m-0'>Halaman: "+data[0]['halaman']+"</p>");
                }
            });
        });
    </script>
<?php include "footer.php"; ?>