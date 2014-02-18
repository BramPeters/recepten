//jquery.voornaam.utils.js


(function($){
   $.zegDankUTegen = function(wie){
       alert("DankUWel "+wie+" !");
   };
   $.vandaag = function(){
       var vandaag = new Date();
       return vandaag.toLocaleDateString();
   };
   
   $.fn.vulSelect = function(arrData, strFirstOption){
    //vult een select met gegevens uit een array, een optioneel eerste item is mogelijk
    return this.each(function(){
        if(this.tagName==='SELECT'){
            var eSelect = $(this);
            eSelect.leegSelect();
            if(strFirstOption !== null){
                eSelect.append("<option value='' selected='selected'>"+strFirstOption+"</option>");
            }
            //1d of 2d?
            if(!$.isArray(arrData[0])){
                $.each(arrData,function(index, data){
                    eSelect.append('<option value='+arrData[index]+'>'+arrData[index]+'</option>');
                });
            }else{
                $.each(arrData, function(index, data){
                   eSelect.append('<option value='+arrData[index][0]+'>'+arrData[index][1]+'</option>'); 
                });
            }
        }
    });//endof this.each
}//endof vulSelect
  
  $.fn.leegSelect = function(){
      return this.each(function(){
          if(this.tagName==='SELECT'){
              $(this).empty();
          }
      })};
   
   
})(jQuery)