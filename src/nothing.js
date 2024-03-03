var bjsonArr;
$('#20').on('click',function(e){
    e.preventDefault();
    console.log('hello 20');
    var id=products[0]['id'];
    var n=products[0]['name'];
    var img=products[0]['image'];
    var price=products[0]['price'];
   $.ajax({
       url : 'functions.php',
       type : 'POST',
       datatype : 'JSON',
       data : {
           mbid:id,
           mbname: n,
           mbimage : img,
           mbprice : price,
           "action" : "mainbuynow"
        },
        success: alert("Success") 
   }).done(function(data){
    console.log('hello');
       console.log(data);
	   //bjsonArr = JSON.parse(data);
    // displaybuynow(bjsonArr);
   
}) 
});