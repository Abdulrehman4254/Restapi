<?php
$servername="localhost";
$username="root";
$dbname="rest_api";

$conn=mysqli_connect($servername,$username,"",$dbname);
$request=$_SERVER['REQUEST_METHOD'];
$data=array();
echo $request;
switch($request){
    case 'GET':
        response(getdata());
    break;
    case 'POST':
        response(Adddata());
    break;
    // case 'PUT':
    //     response(updatedata());
    //     break;
     default:
    break;
           
}
//TO Get data GET
function getdata(){
    global $conn;
    
    if(@$_GET['Id']){
        @$id=$_GET['Id'];
        $where="where id=".$id;
    }
    else{
        $id=0;
        $where="";
    }
    $query=mysqli_query($conn,"select * from rest_api ".$where);
    while($row=mysqli_fetch_assoc($query)){
        $data[]=array("Id"=>$row['Id'],"Name"=>$row['Name'],"age"=>$row['age']);

    }
    return $data;
}
//TO add data POST
function Adddata(){
    global $conn;

    $query=mysqli_query($conn,"insert into rest_api(Name,age,Email)values('".$_POST['Name']."','".$_POST['age']."','".$_POST['Email']."')");
    if($query==true){
        $data[]=array("Message"=>"Created");
    }else{
        $data[]=array("Message"=>"Not Created");
    }
    return $data;

}
// //TO update data PUT
// function updatedata(){
//     parse_str(file_get_contents('php://rest_api').$_PUT);
//     global $conn;
//     if(@$_GET['Id']){
//         @$id=$_GET['Id'];
//         $where="where id=".$id;
//     }
//     else{
//         $id=0;
//         $where="";
//     }
   
    
//      $query=mysqli_query($conn,"update rest_api set Name='".$_PUT['Name']."',Email='".$_PUT['Email']."',age='".$_PUT['age']."'.$where");
//      if($query==true){
//         $data[]=array("Message"=>"update");
//     }else{
//         $data[]=array("Message"=>"Not update");
//     }
//     return $data;
// }

function response($data){
    echo json_encode($data);
}
?>