<?php 
include("model/DB.php");
  if (isset($_POST['productTitle'])) {
      $image = $_FILES['files']['name'];
      $proTitle = $_POST['productTitle'];
      $proType = $_POST['productType'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $fileLocation = "imgUp/";
      $count = count($image);
      for ($i=0; $i < $count; $i++) { 
          $rename[$i] = "Impulse_".str_shuffle(time()."eoiildklkiwoerfiwpdxckc").".jpg";
      }
      foreach ($image as  $key => $value) {       
          $images = $image[$key];   
          move_uploaded_file($_FILES['files']['tmp_name'][$key] , $fileLocation.$rename[$key]);
           $imploded = implode("," , $rename);
           global $rename;
      }
      DB::query('INSERT INTO products VALUES( :id , :image , :productTitle , :productType , :description , :price)' , array(':id' => time() , ':image' => $imploded , ':productTitle' => $proTitle , ':productType' => $proType , ':description' => $description , ':price' => $price));
  }

  if (isset($_POST['fname'])) {
    $fname = $_POST['fname'];
    $post = $_POST['posts'];
    $guardId = substr(str_shuffle(time()."JKEIMSQWEROTLXMVS"), 0 , 12);
    
    DB::query('INSERT INTO guards VALUES( :id , :fname , :post , :guardid , NOW())' , array(':id' => time() , ':fname' => $fname , ':post' => $post , ':guardid' => $guardId));
}

if (isset($_POST['guard'])) {
   $guards = DB::query('SELECT * FROM guards ' , array());
   foreach ($guards as $guard) {
     echo "
            <tr>
                <td>{$guard['fname']}</td>
                <td>{$guard['post']}</td>
                <td>{$guard['guardid']}</td>
                <td>{$guard['registrationDate']}</td>
            </tr>
     ";
   }
}


  if (isset($_POST['show'])) {
    $page_number = $_POST['pageNum'];
    $item_count = $_POST['itemCount'];
    $from = $page_number*$item_count - ($item_count - 1);
    $to = $page_number*$item_count;
    $nums = DB::query('SELECT * FROM products', array());
    function timeline ($to , $nums) {
        if ($to <= $nums)
         return $to;
        else
          return $nums;
      }
     $datas = DB::query('SELECT * FROM products ORDER BY id DESC', array());
     $count = $from;
     while ($count <= timeline($to , $nums)) { 
         $piid = str_shuffle(time()."sifdslklsidwoeofks");
         $data = $datas[$count - 1];
        $image = explode("," , $data['image'])[0];
        $images = explode("," , $data['image']);
        $im = "";
        foreach ($images as $img) {
             $im .= "<img src='imgUp/$img' alt='' class='wid20' onclick='javascript: document.getElementById(\"image\").parentElement.style.display = \"block\"; document.getElementById(\"image\").src = this.src'>";
        }
        echo "
        <div class='modal' id='{$piid}'>
        <div class='modalContent blockCenter centerText wid50 wid50Mobile'>
          <h3>{$data['description']}</h3>
          <span class='mdi mdi-close absolute biggerFont socialColorDeep modalClose' onclick='javascript: document.getElementById(\"{$piid}\").style.display =\"none\"'></span>
          <div class='demoImg blockCenter'>
          <img src='imgUp/${image}' alt='' >
         </div><br>
         <div class='wid100 flex centerJustification'>
          $im
         </div>
          <div id='preview'></div>
          <ul class='centerText' style='list-style: none;'>
          <li class='black mediumFont'>NGN{$data['price']}</li>
          <li class='smallFont'><small> <span class='black'>For {$data['productType']}</span></small></li>
          <li><button class='btn bgGreenLight white'><a href=\"https://wa.me/+2349063545405?text=I'm%20interested%20in%20buying%20{$data['productTitle']}%20from%20Impulse%20at%20NGN%20{$data['price']}%20\" target=\"_blank\">Buy</a></button></li>
          </ul>
        </div><br><br><br><br><br><br>
    </div>



          <div id='myModal' class='modals'><br><br><br><br>
          <span class='close' id='close' onclick='javascript: document.getElementById(\"close\").parentElement.style.display = \"none\";'>&times;</span>
          <img class='modal-content' id='image'>
          <div id='caption'></div>
        </div>





        <div class='wid10 wid20Mobile marginLeftLittle3 '>
        <div class='demoImg blockCenter'>
           <img src='imgUp/${image}' alt=''>
        </div>
         <ul class='centerText' style='list-style: none;'>
             <li class='fadeBlack smallFont'>{$data['description']}</li>
             <li class='black mediumFont'>NGN{$data['price']}</li>
             <li class='smallFont'><small> <span class='black'>For {$data['productType']}</span></small></li>
             <li><button class='btn bgBlack white' onclick='javascript: document.getElementById(\"{$piid}\").style.display = \"block\"'>check details</button></li>
         </ul>
     </div> 
        ";
        $count = $count +1;

     }
  }

?>