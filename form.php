<?php 
$page = 'Kelola Data';
include "header.php";
require_once("db.php");

$id = 0;
if(isset($_GET['id'])){
    $id = $_GET['id'];  
    $heading = 'Ubah Data';
    $action = 'update';
}else{
    $heading = 'Tambahkan Data';
    $action = 'create';
}
?>

    <section id="top">
        <div class="container-fluid py-5 hero text-white">
            <div class="container">
                <br><br>
                <h1 class="text-center mt-5"><?= $heading; ?></h1>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">
            <form id="form" action="book.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-8 col-md-9 mx-auto">
                    <div class="mt-3">
                        <input type="hidden" id="id" value="<?= $id; ?>">
                        <label for="author">Author</label>
                        <select class="form-select mt-2" id="author" name="author" required><option value="">- PILIH SALAH SATU -</option></select>
                    </div>
                    <div class="mt-3">
                        <label for="publish">Publisher</label>
                        <select class="form-select mt-2" id="publish" name="publish" required><option value="">- PILIH SALAH SATU -</option></select>
                    </div>
                    <div class="mt-3">
                        <label for="genre">Genre</label>
                        <select class="form-select mt-2" id="genre" name="genre" required><option value="">- PILIH SALAH SATU -</option></select>
                    </div>
                    <div class="mt-3">
                        <label for="judul">Judul</label>
                        <input class="form-control mt-2" type="text" id="judul" name="judul" required>
                    </div>
                    <div class="mt-3">
                        <label for="cover">Cover</label>
                        <input class="form-control mt-2" type="file" id="cover" name="cover">
                    </div>
                    <div class="mt-3">
                        <label for="harga">Harga</label>
                        <input class="form-control mt-2" type="number" id="harga" name="harga" required>
                    </div>
                    <div class="mt-3">
                        <label for="tahun">Tahun</label>
                        <input class="form-control mt-2" type="number" id="tahun" name="tahun" required>
                    </div>
                    <div class="mt-3">
                        <label for="halaman">Halaman</label>
                        <input class="form-control mt-2" type="number" id="halaman" name="halaman" required>
                    </div>
                    <div class="mt-3">
                        <label for="sinopsis">Sinopsis</label>
                        <textarea class="form-control mt-2" type="text" id="sinopsis" rows="5" required></textarea>
                    </div>
                </div>
                <div class="offset-sm-2 col-sm-10 mt-3" style="margin-bottom:25px">
                    <button class="btn btn-primary" id="action" name="action" value="<?= $action; ?>"> <i class="bi bi-send-fill"></i> Simpan</button>
                    <a href="index.php" class="btn btn-outline-primary"><i class="bi bi-arrow-return-left"></i></i> Kembali</a>
                </div>
            </div>
            </form>
        </div>
    </section>
    <script>
        function alertku(type, title) {
            Swal.fire({
                icon: type,
                title: title,
                showConfirmButton: true
            })
        }
        function fill() {
            setTimeout(function(){
                $.ajax({
                    url: "book.php",method: "GET",cache: false,
                    dataType: 'json',
                    data: {action:'detail',id:<?= $id; ?>},
                    success: function(data) {
                        $.each(data, function(key, value){
                            $("#author").val(value.id_author);
                            $("#publish").val(value.id_pub);
                            $("#genre").val(value.id_genre);
                            $("#judul").val(value.judul);
                            $("#harga").val(value.harga);
                            $("#tahun").val(value.tahun);
                            $("#halaman").val(value.halaman);
                            $("#sinopsis").html(value.sinopsis);
                        });
                    }
                });
            }, 2000);
        }
        $(document).ready(function(){
            if($("#action").val()=='update'){
                fill()
            }
            $.ajax({
                url: "book.php",method: "GET",cache: false,
                dataType: 'json',
                data: {action:'author'},
                success: function(data) {
                    $.each(data, function(key, value){
                        $("#author").append("<option value='"+value.id_author+"'>"+value.author+"</option>");
                    });
                }
            });
            $.ajax({
                url: "book.php",method: "GET",cache: false,
                dataType: 'json',
                data: {action:'pub'},
                success: function(data) {
                    $.each(data, function(key, value){
                        $("#publish").append("<option value='"+value.id_pub+"'>"+value.pub+"</option>");
                    });
                }
            });
            $.ajax({
                url: "book.php",method: "GET",cache: false,
                dataType: 'json',
                data: {action:'genre'},
                success: function(data) {
                    $.each(data, function(key, value){
                        $("#genre").append("<option value='"+value.id_genre+"'>"+value.genre+"</option>");
                    });
                }
            });
            
            $("#form").on('submit',function (e) {
                e.preventDefault();
                    
                    const cover = $('#cover')[0].files[0];
                    var action = $('#action').val();
                    var author = $('#author').val();
                    var publish = $('#publish').val();
                    var genre = $('#genre').val();
                    var judul = $('#judul').val();
                    var harga = $('#harga').val();
                    var tahun = $('#tahun').val();
                    var halaman = $('#halaman').val();
                    var sinopsis = $('#sinopsis').val()
                    var formData = new FormData();
                    formData.append('action',action);
                    formData.append('cover',cover);
                    formData.append('author',author);
                    formData.append('publish',publish);
                    formData.append('judul',judul);
                    formData.append('harga',harga);
                    formData.append('tahun',tahun);
                    formData.append('halaman',halaman);
                    formData.append('sinopsis',sinopsis);
                    formData.append('genre',genre);
                    if($("#id").val()!=null){
                        formData.append('id',$("#id").val());
                    }
                $.ajax({
                    url: "book.php",
                    method: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    beforeSend: function() {
                        Swal.showLoading()
                    },
                    success: function(result) {
                        console.log(result);
                        if(result=='success'){
                            alertku('success','Berhasil Menambahkan Data');
                            $('#form').trigger("reset");
                        }else if(result=='edit-success'){
                            alertku('success','Berhasil Mengubah Data');
                            fill()
                        }else{
                            alertku('error','Gagal Menambahkan Data');
                        }
                    }
                });
            });
        });
    </script>
<?php include "footer.php"; ?>