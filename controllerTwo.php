<?php
include("model/DB.php");
if (isset($_POST['products'])) {
    $datas = DB::query('SELECT * FROM products ORDER BY id DESC', array());
    foreach ($datas as $data) { 
      $piid = str_shuffle(time()."sifdslklsidwoeofks");
      $piidOne = str_shuffle(time()."sifdslklsidwoeofks");
      $piidTwo = str_shuffle(time()."sifdslklsidwoeofks");
      $piidThree = str_shuffle(time()."sifdslklsidwoeofks");
      $piidFour = str_shuffle(time()."sifdslklsidwoeofks");
      $piidFive = str_shuffle(time()."sifdslklsidwoeofks");
      $piidSix = str_shuffle(time()."sifdslklsidwoeofks");
      $piidSeven = str_shuffle(time()."sifdslklsidwoeofks");
      $piidEight = str_shuffle(time()."sifdslklsidwoeofks");
      $piidNine = str_shuffle(time()."sifdslklsidwoeofks");
      $piidTen = str_shuffle(time()."sifdslklsidwoeofks");
      $piidEleven = str_shuffle(time()."sifdslklsidwoeofks");
        echo "
        <div id='".$piid."' class='modal' >
        <div class='modalContent blockCenter centerText wid60 wid50Mobile'>
          <h3>{$data['description']}</h3>
          <span class='mdi mdi-close absolute biggerFont socialColorDeep modalClose' onclick='javascript: document.getElementById(\"{$piid}\").style.display =\"none\"'></span>
          <p><input type='text' class='INPUT' id='$piidTwo' value='{$data['productTitle']}'></p>
          <p><input type='text' class='INPUT' id='$piidThree' value='{$data['productType']}'></p>
          <p><input type='text' class='INPUT' id='$piidFour' value='{$data['description']}'></p>
          <p><input type='text' class='INPUT' id='$piidFive' value='{$data['price']}'></p>
          <p><button id='{$piidSix}' onclick ='javascript: $.ajax({url:\"../../controllerTwo.php\" , type:\"POST\" , data : {productId : \"{$data['id']}\" , productTitle : $(\"#{$piidTwo}\").val() , productType : $(\"#{$piidThree}\").val(), description : $(\"#{$piidFour}\").val(), price : $(\"#{$piidFive}\").val() } , success: (data)=>{ $(\"#{$piidSeven}\").html($(\"#{$piidTwo}\").val()) ; $(\"#{$piidEight}\").html($(\"#{$piidThree}\").val()); $(\"#{$piidNine}\").html($(\"#{$piidFour}\").val())}}); $(\"#{$piidTen}\").html($(\"#{$piidFive}\").val()); $(\"#{$piid}\").css(\"display\" , \"none\")'>Update Record</button></p>
           <br>
           </div>
           </div> 
        <tr>
        <td id='{$piidSeven}'>{$data['productTitle']}</td>
        <td id='{$piidEight}'>{$data['productType']}</td>
        <td id='{$piidNine}'>{$data['description']}</td>
        <td id='{$piidTen}'>{$data['price']}</td>
        <td><button id='{$piidOne}' onclick='javascript: document.getElementById(\"".$piid."\").style.display = \"block\";''>Edit</button></td>
      </tr>

        ";

    }
 
  }
  if (isset($_POST['productId'])) {
    $id = $_POST['productId'];
    $productTitle = $_POST['productTitle'];
    $productType = $_POST['productType'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    DB::query('UPDATE products SET productTitle = :productTitle , productType = :productType , description = :description , price = :price WHERE id = :id' , array(':id' => $id , ':productTitle' => $productTitle , ':productType' => $productType , ':description' => $description , ':price' => $price));
  }
?>