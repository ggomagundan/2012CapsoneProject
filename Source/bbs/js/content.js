 function checkMaxLength(textareaID, maxLength){
 
 
 	
        currentLengthInTextarea = $("#"+textareaID).val().length;
       
        $("#remain").text(parseInt(maxLength) - parseInt(currentLengthInTextarea) + " remaining");
 
		if (currentLengthInTextarea > (maxLength)) { 
 
			// Trim the field current length over the maxlength.
			$("#remain").val($("#remain").val().slice(0, maxLength));
			$(remainingLengthTempId).text(0);
 
		} 
    }
		  