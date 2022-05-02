<?php
$nombrearchivo=$_POST['nombrearchivo'];
if(is_array($_FILES) && count($_FILES)>0){

    if(move_uploaded_file($_FILES["f"]["tmp_name"],"imagenes-sistema/".$nombrearchivo)){
        echo 1;
    }else{
        echo 0;
    }

}else{
    echo 0;
}

?>