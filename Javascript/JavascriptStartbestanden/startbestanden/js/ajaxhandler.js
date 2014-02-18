// JavaScript Document
//Ajax service

var ajaxHandler = function(){};

ajaxHandler.prototype = {
	
	request: function(opties){
				//options object met default waarden
				opties = {
					//method
					method:		opties.method || "GET",
					//url
					url:		opties.url || "",
					//timeout
					timeout:	opties.timeout || 5000,
					//callback object met twee methods: success en failure
					callback:	opties.callback || {success:function(){alert("success")},failure:function(){alert("failure")}},
					//params
					data:		opties.data || ""
				}
				//data
				if(opties.method=="GET"){
						opties.url 	+=  "?" + opties.data // querystring aan url plakken voor GET
						postVars = null;	
						}
				else if(opties.method=="POST"){
					postVars = opties.data;	//parameters doorgeven via postVars
					}
						
		
				var xhr = this.createXhrObject();
				
				xhr.open(opties.method,opties.url,true); // laatste argument: true = asynchroon
				
				xhr.onreadystatechange = function(){		
					
						//console.log(xhr.readyState)
					  	if(xhr.readyState!==4)return;
						//console.log(xhr.status)
					  	if(xhr.status>=200 && xhr.status<300) opties.callback.success(xhr.responseXML, xhr.responseText)
						else {opties.callback.failure(xhr.status)}
					
				
				};
				
				xhr.send(postVars);
		},
	createXhrObject:function(){
			//memoizing
			 var xmlhttp  = '';
			 if (window.XMLHttpRequest) {
				 //>IE7, Mozilla, Safari
				xmlhttp   = new XMLHttpRequest();
				//console.log('XMLHttpRequest')
			 }
			 else if (window.ActiveXObject) {
			  try {
			  	xmlhttp  = new ActiveXObject("Msxml2.XMLHTTP");
			  }
			  catch (e){
			  	try{
			 	 xmlhttp  = new ActiveXObject("Microsoft.XMLHTTP");
			  	}
			  	catch (e){}
			  }
			}
			 
			 this.createXhrObject = function() {
				 return xmlhttp ;
			 }
			 return xmlhttp ;

			
			//=================================
			//klassieke methode
			/*
			if (window.XMLHttpRequest) {
				xmlhttp  = new XMLHttpRequest();
			}
			else if (window.ActiveXObject) {
			  try {
			  xmlhttp  = new ActiveXObject("Msxml2.XMLHTTP");
			  }
			  catch (e){
			  	try{
			 	 xmlhttp  = new ActiveXObject("Microsoft.XMLHTTP");
			  	}
			  	catch (e){}
			  }
			}
			return xmlhttp ;
			
			*/
		}
};