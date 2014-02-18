//javascript document
//KNIPOOG; widget om het figcaption element dynamisch te tonen

(function($){
$.widget("ui.knipoog",{
    options: {
        location:"top",
        color:"black",
        bgColor:"silver",
        speed:"slow",
        padding:4
    },
    _active:false,
    _destroyCalled:false,
    _create: function(){
        //init widget
        this.element.img=$('img', this.element);
        this.element.cap = $('figcaption',this.element);
        
        var o = this.options;
        //console.log(this.element[0].nodeName);
        
        //vaste eigenschappen
        this.element.css({position:'relative',height:'100px'});
        this.element.cap
        .hide()
        .css({
            position: 'absolute',
            left:0,
            width: this.element.img.width() - (o.padding * 2),
            height: '80px',
            opacity: '0.7',
            padding: o.padding
        });
        //aanpasbare eigenschappen
        this._CSStoepassen();
        //hover event handler voor het element
        this._setMouseHandler();
    },
    _CSStoepassen:function(){
        //alle aanpasbare eigenschappen hier
        this.element.cap.css({
            color: this.options.color,
            backgroundColor: this.options.bgColor,
        });
        //location speciaal
        switch(this.options.location){
            case "top":
                this.element.cap.css({top:0});
                break;
            case "bottom":
                this.element.cap.css({bottom:0});
                break;
        
            default:
                this.element.cap.css({top:0});
                break;
        
        }
        
    },
    _setMouseHandler: function(){
    //hover event handler
    var self= this;
    var o = self.options;
    self.element.hover(
        function(){
            //self.element.cap.show(o.speed);
            self._active=true;
            self.element.cap.show("slide",{direction:"left"},o.speed,function(){});
        },
        function(){
            //self.element.cap.hide(o.speed);
            self.element.cap.hide("slide",{direction:"right"},o.speed,function(){self._active=false;if(self._destroyCalled === true)self._vernietig();});
        });       
    },
    enable: function(){
        $.Widget.prototype.enable.apply(this, arguments);
        this._setMouseHandler();
    },
    disable: function(){
        $.Widget.prototype.disable.apply(this, arguments);
        this._removeMouseHandler();
    },
    _removeMouseHandler: function(){
        this.element.unbind('mouseenter mouseleave');
    },
    _setOption: function(option, value){
        $.Widget.prototype._setOption.apply(this, arguments);
        this._CSStoepassen();
    },
    destroy: function(){
        this._destroyCalled =true;
        if(this._active === false){
            this._vernietig();
            this._destroyCalled=false;
        }
           
    },
    _vernietig: function(){
        //call the base destroy function
        $.Widget.prototype.destroy.call(this, arguments);
        this._removeMouseHandler();
        this.element.css({height:'180px'});
        this.element.cap
        .css({
            position:'static',
            width:'auto',
            height:'auto',
            color:'inherit',
            backgroundColor:'inherit',
            opacity:'1',
            padding:0
        })
        .show();
    }        
    
    
})  ;//endof widget  
})(jQuery);