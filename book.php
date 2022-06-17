<?php
session_start();
require_once('db.php');

switch ($_GET['action']) {
    case 'rows' :
        $rows = mysqli_query($conn,"SELECT * FROM buku");
        $r    = mysqli_num_rows($rows);
        echo $r;
        break;

    case 'latest' :
        $latest = mysqli_query($conn,"SELECT b.*, g.genre FROM buku b, genre g WHERE g.id_genre=b.id_genre ORDER BY b.tahun DESC LIMIT 4");
        $data   = [];
        while($d=mysqli_fetch_assoc($latest)){
            if(!file_exists('./assets/cover/'.$d['sampul'])||empty($d['sampul'])){$d['sampul'] = 'alt.jpg';}
            array_push($data,$d);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        break;

    case 'read' :
        $read = mysqli_query($conn,"SELECT b.*, g.genre FROM buku b, genre g WHERE g.id_genre=b.id_genre ORDER BY b.judul DESC LIMIT 0,12");
        $data   = [];
        while($d=mysqli_fetch_assoc($read)){
            if(!file_exists('./assets/cover/'.$d['sampul'])||empty($d['sampul'])){$d['sampul'] = 'alt.jpg';}
            array_push($data,$d);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        break;

    case 'page' :
        $page   = $_GET['page']; 
        if($page==0){$start = 0;}
        else{$start=($page*12);}
        $read = mysqli_query($conn,"SELECT ROW_NUMBER() OVER(ORDER BY b.judul) AS sort,  b.*, g.genre FROM buku b, genre g WHERE g.id_genre=b.id_genre ORDER BY b.judul LIMIT $start,12");
        $data   = [];
        while($d=mysqli_fetch_assoc($read)){
            if(!file_exists('./assets/cover/'.$d['sampul'])||empty($d['sampul'])){$d['sampul'] = 'alt.jpg';}
            array_push($data,$d);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        break;

    case 'search' :
        $query  = $_GET['query'];
        $read   = mysqli_query($conn,"SELECT b.*, g.genre FROM buku b, genre g WHERE g.id_genre=b.id_genre AND b.judul LIKE '%$query%'");
        $data   = [];
        while($d=mysqli_fetch_assoc($read)){
            if(!file_exists('./assets/cover/'.$d['sampul'])||empty($d['sampul'])){$d['sampul'] = 'alt.jpg';}
            array_push($data,$d);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        break;
    
    case 'detail' :
        if(empty($_GET['id'])){header('Location:index.php');}
        $id     = $_GET['id'];
        $detail = mysqli_query($conn,"SELECT b.*, a.author, p.pub, g.genre 
        FROM buku b, author a, publisher p, genre g 
        WHERE g.id_genre=b.id_genre AND a.id_author=b.id_author AND p.id_pub=b.id_pub AND b.id_buku='$id'");
        $data   = [];
        while($d=mysqli_fetch_assoc($detail)){
            if(!file_exists('./assets/cover/'.$d['sampul'])||empty($d['sampul'])){$d['sampul'] = 'alt.jpg';}
            array_push($data,$d);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        break;

    case 'genre' :
        $genre  = mysqli_query($conn,"SELECT * FROM genre ORDER BY genre");
        $data   = [];
        while($d=mysqli_fetch_assoc($genre)){
            array_push($data,$d);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        break;

    case 'author' :
        $author  = mysqli_query($conn,"SELECT * FROM author ORDER BY author");
        $data   = [];
        while($d=mysqli_fetch_assoc($author)){
            array_push($data,$d);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        break;
    
    case 'pub' :
        $pub  = mysqli_query($conn,"SELECT * FROM publisher ORDER BY pub");
        $data   = [];
        while($d=mysqli_fetch_assoc($pub)){
            array_push($data,$d);
        }
        header('Content-Type: application/json');
        echo json_encode($data);
        break;
    case 'delete' :
        if(empty($_GET['id'])){header('Location:index.php');}
        $id     = $_GET['id'];
        $find   = mysqli_query($conn,"SELECT * FROM buku WHERE id_buku='$id'");
        if(mysqli_num_rows($find)>0){
            $f      = mysqli_fetch_assoc($find);
            $sampul = $f['sampul'];
            unlink("./assets/cover/".$sampul);
            $delete = mysqli_query($conn,"DELETE FROM buku WHERE id_buku='$id'");
            if($delete){
                $data = array('success');
                header('Content-Type: application/json');
                echo json_encode($data);
                break;
            }
        }else{
            $data = array('nodata');
            header('Content-Type: application/json');
            echo json_encode($data);
            break;
        }
}
switch ($_POST['action']){
    case 'create' :
        $author = $_POST["author"];
        $publish = $_POST["publish"];
        $genre = $_POST["genre"];
        $judul = $_POST["judul"];
        $cover = $_FILES["cover"]['name'];
        $temp = $_FILES["cover"]['tmp_name'];
        $size = $_FILES["cover"]['size'];
        $harga = $_POST["harga"];
        $tahun = $_POST["tahun"];
        $halaman = $_POST["halaman"];
        $sinopsis = $_POST["sinopsis"];
        if(!empty($author)||!empty($publish)
        ||!empty($genre)||!empty($judul)
        ||!empty($cover)||!empty($harga)
        ||!empty($tahun)||!empty($halaman)
        ||!empty($sinopsis)){
            $upload   = './assets/cover/'.$cover;
            $x      = explode('.',$cover);
            $ext    = end($x);
            $valid  = array('jpg','jpeg','png');
            if(in_array($ext,$valid)){
                if($size<1000000){
                    move_uploaded_file($temp,$upload);
                    $query = "INSERT INTO buku (id_author,id_pub,id_genre,judul,sampul,harga,tahun,halaman,sinopsis)
                    VALUES ('$author','$publish','$genre','$judul','$cover','$harga','$tahun','$halaman','$sinopsis')";
                    $insert = mysqli_query($conn, $query);
                    if($insert){
                        $status = array('success');
                        header('Content-Type: application/json');
                        echo json_encode($status);
                        break;
                    }else{
                        $status = array('error');
                        header('Content-Type: application/json');
                        echo json_encode($status);
                        break;
                    }
                }else{
                    $status = array('toobig');
                    header('Content-Type: application/json');
                    echo json_encode($status);
                    break;
                }
            }else{
                $status = array('invalid');
                header('Content-Type: application/json');
                echo json_encode($status);
                break;
            }
        }else{
            $status = array('incomplete');
            header('Content-Type: application/json');
            echo json_encode($status);
            break;
        }
        
    case 'update' :
        $id = $_POST['id'];
        $author = $_POST["author"];
        $publish = $_POST["publish"];
        $genre = $_POST["genre"];
        $judul = $_POST["judul"];
        $cover = $_FILES["cover"]['name'];
        $temp = $_FILES["cover"]['tmp_name'];
        $size = $_FILES["cover"]['size'];
        $harga = $_POST["harga"];
        $tahun = $_POST["tahun"];
        $halaman = $_POST["halaman"];
        $sinopsis = $_POST["sinopsis"];
        if(!empty($author)||!empty($publish)
        ||!empty($genre)||!empty($judul)
        ||!empty($harga)||!empty($tahun)
        ||!empty($halaman)||!empty($sinopsis)){
            if(!empty($cover)){
                $upload   = './assets/cover/'.$cover;
                $x      = explode('.',$cover);
                $ext    = end($x);
                $valid  = array('jpg','jpeg','png');
                if(in_array($ext,$valid)){
                    if($size<1000000){
                        move_uploaded_file($temp,$upload);
                        $query = "UPDATE buku SET id_author='$author', id_pub='$publish', id_genre='$genre',
                        judul='$judul', cover='$cover',harga='$harga',tahun='$tahun',halaman='$halaman',sinopsis='$sinopsis'
                        WHERE id_buku='$id'";
                        $update = mysqli_query($conn, $query);
                        if($update){
                            $status = array('edit-success');
                            header('Content-Type: application/json');
                            echo json_encode($status);
                            break;
                        }else{
                            $status = array('error');
                            header('Content-Type: application/json');
                            echo json_encode($status);
                            break;
                        }
                    }else{
                        $status = array('toobig');
                        header('Content-Type: application/json');
                        echo json_encode($status);
                        break;
                    }
                }else{
                    $status = array('invalid');
                    header('Content-Type: application/json');
                    echo json_encode($status);
                    break;
                }
            }else{
                $query = "UPDATE buku SET id_author='$author', id_pub='$publish', id_genre='$genre',
                judul='$judul', harga='$harga',tahun='$tahun',halaman='$halaman',sinopsis='$sinopsis'
                WHERE id_buku='$id'";
                $update = mysqli_query($conn, $query);
                if($update){
                    $status = array('edit-success');
                    header('Content-Type: application/json');
                    echo json_encode($status);
                    break;
                }else{
                    $status = array('error');
                    header('Content-Type: application/json');
                    echo json_encode($status);
                    break;
                }
            }
        }else{
            $status = array('incomplete');
            header('Content-Type: application/json');
            echo json_encode($status);
            break;
        }
}