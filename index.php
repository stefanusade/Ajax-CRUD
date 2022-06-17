<?php 
$page = 'Beranda';
include "header.php"; 
?>  
    <input type="hidden" id="show" value="12">

    <section id="top">
        <div class="container-fluid py-5 hero text-white">
            <h1 class="text-center mt-5">Ayo Baca Buku!</h1>
            <div class="row new">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <table class="table table-borderless mt-3" style="background-color: white; border-radius:100px">
                        <tbody>
                            <tr>
                                <td><input type="text" class="search" id="judul" placeholder="Cari judul..."></td>
                                <td class="right"><button class="search-btn" id="search"><i class="fa-solid fa-magnifying-glass"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
    </section>
    <section>
        <div class="container">
            <div class="card rounded shadow" style="margin-top: -30px;">
                <div class="card-body">
                    <h4 class="mt-2" id="baru">Buku Terbaru</h4>
                    <div class="row g-2" id="new">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="koleksi">
        <div class="container my-5">
                <h2 class="d-inline text-left" id="heading">Koleksi Buku</h2>
                <a href="form.php" type="button" class="d-inline text-right btn btn-outline-primary mb-2 mx-3" > <i class="bi bi-plus-square mx-1"></i> Create </a>
                <div class="btn-group" id="sort">
                <span ><button type="button" class="btn btn-outline-dark mb-2 border-0" id="asc"><i class="bi bi-sort-alpha-up"></i>Judul A-Z</button></span>
                <span ><button type="button" class="btn btn-outline-dark mb-2 border-0" id="desc"><i class="bi bi-sort-alpha-up"></i>Judul Z-A</button></span>
                </div>
            <div class="row g-3 mt-4" id="list">

            </div>
            <div class="btn-group mt-4 me-2" id="pagination"></div>
        </div>
    </section>

    <!-- Page JS -->
    <script>
        $(document).ready(function(){
            var show = parseInt($("#show").val());
            $("#judul").keyup(function(event){
                if (event.keyCode === 13) {
                    $("#search").click();
                }
            });
            $.ajax({
                type: 'GET', url: 'book.php', data: {action: 'rows'},
                success: function(data) {
                    let page = Math.ceil(data/show);
                    let i = 1
                    while(i<=page){
                        $("#pagination").append("<button type='button' class='page btn btn-secondary' id='"+(i-1)+"'>"+i+"</button>");
                        i++;
                    }
                    $(".page").click(function(){
                        let select = parseInt($(this).attr("id"));
                        $.ajax({
                            type: 'GET', url: 'book.php',
                            data: {action:'page',page: select},
                            dataType: 'json',
                            cache: false,
                            success: function(data) {
                                $("#list").empty();
                                $.each(data, function(key, value){
                                    var id = value.id_buku;
                                    $("#list").append("<div class='sort col-6 col-md-4 col-lg-3' data-sort='"+value.sort+"'><a class='card-link' href='detail.php?id="+value.id_buku+"'><div class='card bg-white text-dark book' style='height:100%'><img class='card-img-top' src='./assets/cover/"+value.sampul+"'><div class='card-body'><h6 class='card-title text-dark'>"+value.judul+"</h6></a><a href='form.php?id="+value.id_buku+"' class='text-primary me-2'><i class='fa-solid fa-pen-to-square'></i></a><a href='"+value.id_buku+"' class='delete text-danger'><i class='fa-solid fa-trash'</a></div></div></div>");
                                });
                                $("#asc").click();
                                $('.delete').click(function(e){
                                    e.preventDefault();
                                    var idd = $(this).attr('href');
                                    Swal.fire({
                                        title: 'Peringatan',
                                        icon: 'warning',
                                        text: 'Anda yakin untuk menghapus data ini?',
                                        showDenyButton: true,
                                        confirmButtonText: 'Hapus',
                                        denyButtonText: 'Batal',
                                        }).then((result) => {
                                        if (result.isConfirmed) {
                                            $.ajax({
                                                type: 'GET', url: 'book.php',
                                                data: {action:'delete',id:idd},
                                                dataType: 'json',
                                                cache: false,
                                                success: function(data) {
                                                    if(data=='success'){
                                                        Swal.fire({title: 'Berhasil',text: 'Berhasil menghapus data',icon: 'success',confirmButtonText: 'OK'});
                                                    }else if(data=='nodata'){
                                                        Swal.fire({title: 'Gagal',text: 'Data tidak ditemukan',icon: 'error',confirmButtonText: 'OK'});
                                                    }
                                                }
                                            });
                                        } else if (result.isDenied) {
                                            Swal.fire('Berhasil Dibatalkan', 'Batal menghapus data', 'info')
                                        }
                                    });
                                });
                            }
                        });
                    });
                }
            });
            setTimeout(function(){
                $("#0.page").click();
            }, 1000);
            setTimeout(function(){
                $("#asc").click();
            }, 1500);
            $("#asc").click(function(){
                $(".sort").sort(function (a, b) {
                    var contentA =parseInt( $(a).data('sort'));
                    var contentB =parseInt( $(b).data('sort'));
                    return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
                }).appendTo("#list");
            });
            $("#desc").click(function(){
                $(".sort").sort(function (a, b) {
                    var contentA =parseInt( $(a).data('sort'));
                    var contentB =parseInt( $(b).data('sort'));
                    return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
                }).appendTo("#list");
            });
            $.ajax({
                type: 'GET',url: 'book.php',
                data: {action: 'latest'},
                dataType: 'json',
                cache: false,
                success: function(data) {
                    $.each(data, function(key, value){
                        $("#new").append("<div class='col-3'><a class='card-link' href='detail.php?id="+value.id_buku+"'><div class='card bg-dark text-white' style='height:100%'><img class='card-img' src='./assets/cover/"+value.sampul+"'><div class='card-img-overlay p-2'><span class='badge rounded-pill text-bg-info text-white mb-2'>"+value.genre+"</span><h6 class='card-title'>"+value.judul+"</h6></div></div></a></div>");
                    });
                }
            });
            $("#search").click(function(){
                var keyword = $("#judul").val();
                $("#sort").empty();
                if(keyword.length>2){
                    $("#list").empty();
                    $.ajax({
                        type: 'GET',url: 'book.php',
                        data: {action: 'search', query: $("#judul").val()},
                        dataType: 'json',cache: false,
                        success: function(data) {
                            $.each(data, function(key, value){
                                $("#list").append("<div class='col-6 col-md-4 col-lg-3'><a class='card-link' href='detail.php?id="+value.id_buku+"'><div class='card bg-white text-dark book' style='height:100%'><img class='card-img-top' src='./assets/cover/"+value.sampul+"'><div class='card-body'><h6 class='card-title text-dark'>"+value.judul+"</h6></a><a href='form.php?id="+value.id_buku+"' class='text-primary me-2'><i class='fa-solid fa-pen-to-square'></i></a><a href='"+value.id_buku+"' class='delete text-danger'><i class='fa-solid fa-trash'</a></div></div></div>");
                            });
                            $('#pagination').empty();
                            $('.delete').click(function(e){
                                e.preventDefault();
                                var idd = $(this).attr('href');
                                Swal.fire({
                                    title: 'Peringatan',
                                    icon: 'warning',
                                    text: 'Anda yakin untuk menghapus data ini?',
                                    showDenyButton: true,
                                    confirmButtonText: 'Hapus',
                                    denyButtonText: 'Batal',
                                    }).then((result) => {
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            type: 'GET', url: 'book.php',
                                            data: {action:'delete',id:idd},
                                            dataType: 'json',
                                            cache: false,
                                            success: function(data) {
                                                if(data=='success'){
                                                    Swal.fire({title: 'Berhasil',text: 'Berhasil menghapus data',icon: 'success',confirmButtonText: 'OK'});
                                                }else if(data=='nodata'){
                                                    Swal.fire({title: 'Gagal',text: 'Data tidak ditemukan',icon: 'error',confirmButtonText: 'OK'});
                                                }
                                            }
                                        });
                                    } else if (result.isDenied) {
                                        Swal.fire('Berhasil Dibatalkan', 'Batal menghapus data', 'info')
                                    }
                                });
                            });
                            $("#heading").html("Hasil Pencarian '"+keyword+"'");
                            $("html, body").animate({scrollTop: $("#koleksi").offset().top}, 100)
                        }
                    });
                }else if(keyword.length==0){
                    location.reload();
                }else{
                    alert('Masukkan minimal 3 karakter ke dalam kolom pencarian');
                }
            });
        });
    </script>
<?php include "footer.php"; ?>