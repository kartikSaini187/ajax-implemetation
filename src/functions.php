<?php
session_start();
include('config.php');
if(!isset($_SESSION['add'])){
    $_SESSION['add'] = array();
}
if(!isset($_SESSION['buynow'])){
    $_SESSION['buynow'] = array();
}
if(!isset($_SESSION['wish'])){
    $_SESSION['wish'] = array();
}
?>


<?php
 
if(isset($_POST)){
    $id= $_POST['id'];
    $name= $_POST['name'];
    $image= $_POST['image'];
    $price= $_POST['price'];
    $bid = $_POST['bid'];
    $wid = $_POST['wid'];
    $bcid =$_POST['bcid'];
    $bwid = $_POST['bwid'];
    $wbid = $_POST['wbid'];
    $wcid = $_POST['wcid'];
    $action= $_POST['action'];

switch($action){
    case 'add':
    {
        addTocart($id,$name,$image,$price);
    }
    break;
    

    case 'buynow':
        {
            addtobuynow($bid);
        }
    break;
    case 'carttowish':
        {
            carttowishlist($wid);
        }
    break;
    
    case 'buytocart':
        {
            buytocart($bcid);
        }
    break;
    case 'buytowish':
        {
            buytowish($bwid);
        }
    break;
    case 'wishtobuy':
        {
            wishtobuy($wbid);
        }
    break;
    case 'wishtocart':
        {
            wishtocart($wcid);
        }
    break;

}

} 
function addTocart($id,$name,$image,$price)
{   
    if(!isset($_SESSION['add'])){
        $_SESSION['add'] = array();
    }
  $nid = $id;
  $nname = $name;
  $nimage = $image;
  $nprice = $price;
  
  $data = array("id"=> $nid ,"name"=> $nname , "image" => $nimage , "price" => $nprice,"quantity" =>"1");
  array_push($_SESSION['add'], $data);
  echo json_encode($_SESSION['add']);    
}



function movetobuynow($mbid,$mbname,$mbimage,$mbprice)
{   
    if(!isset($_SESSION['buynow'])){
        $_SESSION['buynow'] = array();
    }
  $nid = $mbid;
  $nname = $mbname;
  $nimage = $mbimage;
  $nprice = $mbprice;
  
  $data = array("id"=> $nid ,"name"=> $nname , "image" => $nimage , "price" => $nprice,"quantity" =>"1");
  array_push($_SESSION['buynow'], $data);
  echo json_encode($_SESSION['buynow']);    
}





function addtobuynow($bid){
    
foreach($_SESSION['add'] as $key => $value){
    if($value['id'] == $bid){
       $bid = $value['id'];
       $bname = $value ['name'];
       $bimage = $value['image'];
       $bprice = $value['price'];
       $bquantity =  $value['quantity'];
      $bdata = array("id"=> $bid ,"name"=> $bname , "image" => $bimage , "price" => $bprice,"quantity" => $bquantity);
      array_push($_SESSION['buynow'],$bdata);
      array_splice($_SESSION['add'], $key ,1 );
    }
}
 echo json_encode($_SESSION['buynow']);
}


function carttowishlist($wid){
    
    foreach($_SESSION['add'] as $key => $value){
        if($value['id'] == $wid){
           $wid = $value['id'];
           $wname = $value ['name'];
           $wimage = $value['image'];
           $wprice = $value['price'];
           
          $wdata = array("id"=> $wid ,"name"=> $wname , "image" => $wimage , "price" => $wprice,"quantity" =>"1");
          array_push($_SESSION['wish'],$wdata);
          array_splice($_SESSION['add'], $key ,1 );
        }
    }
    echo json_encode($_SESSION['wish']);
    }


    function buytocart($bcid){
    
        foreach($_SESSION['buynow'] as $key => $value){
            if($value['id'] == $bcid){
               $bid = $value['id'];
               $bname = $value ['name'];
               $bimage = $value['image'];
               $bprice = $value['price'];
               $bquantity =  $value['quantity'];
              $bdata = array("id"=> $bid ,"name"=> $bname , "image" => $bimage , "price" => $bprice,"quantity" => $bquantity);
              array_push($_SESSION['add'],$bdata);
              array_splice($_SESSION['buynow'], $key ,1 );
            }
        }
         echo json_encode($_SESSION['add']);
        }



        function buytowish($bwid){
    
            foreach($_SESSION['buynow'] as $key => $value){
                if($value['id'] == $bwid){
                   $bid = $value['id'];
                   $bname = $value ['name'];
                   $bimage = $value['image'];
                   $bprice = $value['price'];
                   $bquantity =  $value['quantity'];
                  $bdata = array("id"=> $bid ,"name"=> $bname , "image" => $bimage , "price" => $bprice,"quantity" => $bquantity);
                  array_push($_SESSION['wish'],$bdata);
                  array_splice($_SESSION['buynow'], $key ,1 );
                }
            }
             echo json_encode($_SESSION['wish']);
            }

    function wishtobuy($wbid){
        foreach($_SESSION['wish'] as $key => $value){
            if($value['id'] == $wbid){
               $bid = $value['id'];
               $bname = $value ['name'];
               $bimage = $value['image'];
               $bprice = $value['price'];
               $bquantity =  $value['quantity'];
              $bdata = array("id"=> $bid ,"name"=> $bname , "image" => $bimage , "price" => $bprice,"quantity" => $bquantity);
              array_push($_SESSION['buynow'],$bdata);
              array_splice($_SESSION['wish'], $key ,1 );
            }
        }
         echo json_encode($_SESSION['buynow']);
    }
    function wishtocart($wcid){
        foreach($_SESSION['add'] as $key => $value){
            if($value['id'] == $wcid){
               $bid = $value['id'];
               $bname = $value ['name'];
               $bimage = $value['image'];
               $bprice = $value['price'];
               $bquantity =  $value['quantity'];
              $bdata = array("id"=> $bid ,"name"=> $bname , "image" => $bimage , "price" => $bprice,"quantity" => $bquantity);
              array_push($_SESSION['add'],$bdata);
              array_splice($_SESSION['wish'], $key ,1 );
            }
        }
         echo json_encode($_SESSION['add']);
    }
?>




