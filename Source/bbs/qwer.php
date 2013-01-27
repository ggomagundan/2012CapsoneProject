<!DOCTYPE html>
<html>
  <head> 
  <style>
    #dropbox {
    margin: auto;
    width: 300px;
    height: 300px;
    border: 5px solid #3C2F2E;
    -moz-border-radius: 15px;
    margin-top: 30px;
  }
  </style>
  </head> 
  <body>         
    <div id="dropbox" ondragenter="onDragEnter(event)"  ondragover="onDragOver(event)"
       ondrop="onDrop(event)">           
    </div>           
  </body>
</html>
<script type="text/javascript">               
  var dropBox = document.getElementById("dropbox");         
  var dropImage = document.createElement("img");  
         
  function onDragEnter(event){   
      if (event.dataTransfer.dropEffect == "move")
        event.preventDefault();                   
    }   
  function onDragOver(event){
    if (event.dataTransfer.dropEffect == "move") {
      event.preventDefault();     
  }                 
  function onDrop(event){                               
    var file = event.dataTransfer.files[0];     
          
    var imageType = /image.*/;
    var textType = /text.*/;
    var isImage;
   
    if(file.type.match(imageType)){
      isImage = true;
    }
    else if(file.type.match(textType)){
      isImage = false;
    }
            
    var reader = new FileReader();   
   
    reader.onload = (function(aFile){return function(e) {        
        var result = e.target.result; 
        if(isImage){
          dropImage.src = result;                                                                           
          dropBox.appendChild(dropImage)
         }
         else{
           dropBox.innerHTML = result;
         }        
        };
      })(file);
     
    if(isImage){ reader.readAsDataURL(file); }
    else { reader.readAsText(file,"EUC-KR"); }
   
    event.stopPropagation();
    event.preventDefault();
  }                     
 
  dropImage.addEventListener("load", function(e) {
  	var span = document.createElement('span');
						span.innerHTML = ['<img class="inputimg" height="100" src="', e.target.result,'" title="', aFile.name, '"/>'].join('');
						document.getElementById('imgbox').insertBefore(span, null);
    //이미지 로딩 시 추가 처리할 로직 기입(사이즈 조절 등)           
  }, true);         
</script>