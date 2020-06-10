jQuery.noConflict();
/*
jQuery( document ).ready(addColorListeners());

function addColorListeners()
{
	jQuery('input.tl_text').on('click',function(event){
		var element = jQuery(this);
		if(!jQuery('#kb_selected_color').length){
				jQuery('#tl_lb_branding').append('<input type="color" id="kb_selected_color">');
		}


					// Farbe aus ColorPicker auslesen
					var theInput = document.getElementById("kb_selected_color");

					var theColor = theInput.value;


					theInput.addEventListener("input", function handleInput() {

					// Farcode (Hex) schreiben

					jQuery(element).val(theInput.value);
		theInput.removeEventListener("input", handleInput);

			jQuery('#kb_selected_color').remove();
					}, false);
						jQuery('#kb_selected_color').trigger('click');

			});



}
*/

class Reset {
	
	
	constructor(nameList,idList) {
		
   this.nameList=nameList;
   this.idList=idList;
	}
	
	
	
resetToDefault()
{

	var length= this.nameList.length;
	for(var i =0; i<= length-1;i++)
	{
		var font = getComputedStyle(document.documentElement).getPropertyValue('--'+this.nameList[i]).match(/['"]([A-Za-z ])*['"]/g)[0].replace(/"/g,'').replace(/'/g,'');
		var selected1 = font.replace(/ /g, "");

		jQuery('#'+this.idList[i]).val(font);
		jQuery('#font-container'+(i+1)).removeClass();
		jQuery('#'+this.idList[i]).removeClass();
		jQuery('#'+this.idList[i]).addClass('tl_select');
		jQuery('#font-container'+(i+1)).addClass(selected1);
		jQuery('#'+this.idList[i]).addClass(selected1);
	
		
		

		

		var selected1T =  font;
		var license1;
		 var count;
		 var match; 
		jQuery.when(jQuery.get("../bundles/branding/css/lb_be_font.css"))
	    .done(function(response) {
	    	
	        match = new RegExp(selected1T,'g');
	        count = (response.match(match) || []).length;
	        
	        if(count<=2)
	        	{
	        	  
	        	jQuery('.boldbox'+(i+1)).hide();
	        	
	        	}
	        else
        	{
	        	
        	jQuery('.boldbox'+(i+1)).show();
        	}

	    });
		if(count<=2)
    	{
    	  
    	jQuery('.boldbox'+(i+1)).hide();
    	
    	}
    else
	{
    	
	jQuery('.boldbox'+(i+1)).show();
	}
		jQuery('#font-container'+(i+1)+' h1').text(font);
		jQuery.ajax({
		    url:'https://'+location.host+'/files/theme_lb_demoshop/fonts/'+selected1+'/OFL.txt',
		    type:'HEAD',
		    async:false,
		    error: function()
		    {
		    	license1="LICENSE.txt";

		    },
		    success: function()
		    {
		    	license1="OFL.txt" ;

		    }
		});
		jQuery('#lizenz'+(i+1)).prop('href','/files/theme_lb_demoshop/fonts/'+selected1+'/'+license1);
		
		
		
		
		
		
		
		
		
		
	}





}




}
setTimeout(function(){ addFontListeners(); }, 500);

	function resetf()
	{
		
		
		var list1 = ['theme-font-1','theme-font-2'];   
		var list2 = [];	
		jQuery('#pal_primary_legend select').each(function(){

		
		list2.push(jQuery(this).prop('id'));

		});	


		const handler = new Reset(list1,list2);
		handler.resetToDefault();


	}
	
	


function addFontListeners() {

	jQuery('<fieldset id="pal_reset_legend"class="tl_box"><legend onclick="AjaxRequest.toggleFieldset(this,  \'reset_legend\', \'tl_lb_font\')">Auf Standard zurücksetzen</legend><div class="w50 widget"><button class="tl_submit" type="button"  onclick="resetf()">Zurücksetzen</button><p class="tl_help tl_tip" title="">Bitte speichern, um die Einstellungen zu übernehmen.</p></div></fieldset>').insertAfter('#pal_primary_legend');
	
	jQuery('#ctrl_font1 option').each(function(){
		
		
		if(jQuery(this).text().substring(0,2)=='--')
			{
			
			
			jQuery(this).prop('disabled',true);
			}
		else
			{
			jQuery(this).addClass(jQuery(this).text().replace(/ /g, ""));
			}
		
		
		
		});

		var selected1 = jQuery('#ctrl_font1').children("option:selected").val().replace(/ /g, "");
		var selected1T =  jQuery('#ctrl_font1').children("option:selected").val();
		var license1;

		jQuery.ajax({
		    url:'https://'+location.host+'/files/theme_lb_demoshop/fonts/'+selected1+'/OFL.txt',
		    type:'HEAD',
		    async:false,
		    error: function()
		    {
		    	license1="LICENSE.txt";

		    },
		    success: function()
		    {
		    	license1="OFL.txt" ;

		    }
		});
		

		
		jQuery('<div id="font-container1" class="'+selected1+'"><h1>'+selected1T+'</h1><p><h2>Regular</h2><p style="font-size: 29px;font-weight:normal;">The quick brown fox jumps over the lazy dog</p><h2 class="boldbox1">Bold</h2><p class="boldbox1" style="font-weight:bold;font-size: 29px;">The quick brown fox jumps over the lazy dog</p></p><a style="text-decoration: underline;" target="_blank" rel="noopner" id="lizenz1" href="/files/theme_lb_demoshop/fonts/'+selected1+'/'+license1+'">Lizenz lesen</a></div>').insertAfter('#ctrl_font1');
		jQuery.when(jQuery.get("../bundles/branding/css/lb_be_font.css"))
	    .done(function(response) {
	        
	        var match = new RegExp(selected1T,'g');
	        var count = (response.match(match) || []).length;
  
	        if(count<=2)
	        	{
	        	jQuery('.boldbox1').hide();
	        	
	        	}
	        else
	        	{
	        	jQuery('.boldbox1').show();
	        	}
	        
	    });
		jQuery('#ctrl_font1').addClass(selected1);
	jQuery('#ctrl_font1').change(function(){
		
		jQuery('#font-container1').removeClass();
		jQuery('#ctrl_font1').removeClass();
		jQuery('#ctrl_font1').addClass('tl_select');
		var selected1 = jQuery(this).children("option:selected").val().replace(/ /g, "");
		var selected1T =  jQuery(this).children("option:selected").val();
		jQuery.when(jQuery.get("../bundles/branding/css/lb_be_font.css"))
	    .done(function(response) {
	        
	        var match = new RegExp(selected1T,'g');
	        var count = (response.match(match) || []).length;
  
	        if(count<=2)
	        	{
	        	jQuery('.boldbox1').hide();
	        	
	        	}
	        else
        	{
        	jQuery('.boldbox1').show();
        	}

	    });
		jQuery('#ctrl_font1').addClass(selected1);
		jQuery('#font-container1').addClass(selected1);
		jQuery('#font-container1 h1').text(selected1T);
		jQuery.ajax({
		    url:'https://'+location.host+'/files/theme_lb_demoshop/fonts/'+selected1+'/OFL.txt',
		    type:'HEAD',
		    async:false,
		    error: function()
		    {
		    	license1="LICENSE.txt";

		    },
		    success: function()
		    {
		    	license1="OFL.txt" ;

		    }
		});
		jQuery('#lizenz1').prop('href','/files/theme_lb_demoshop/fonts/'+selected1+'/'+license1);
		
	});
//NR2
	jQuery('#ctrl_font2 option').each(function(){
		
		
		if(jQuery(this).text().substring(0,2)=='--')
			{
			
			
			jQuery(this).prop('disabled',true);
			}
		else
			{
			jQuery(this).addClass(jQuery(this).text().replace(/ /g, ""));
			}
		
	
	
	});
		

		var selected2 = jQuery('#ctrl_font2').children("option:selected").val().replace(/ /g, "");
		var selected2T =  jQuery('#ctrl_font2').children("option:selected").val();
		var license2;
		jQuery.ajax({
		    url:'https://'+location.host+'/files/theme_lb_demoshop/fonts/'+selected2+'/OFL.txt',
		    type:'HEAD',
		    async:false,
		    error: function()
		    {
		    	license2="LICENSE.txt";

		    },
		    success: function()
		    {
		    	license2="OFL.txt" ;

		    }
		});
		var count=0;
		jQuery('<div id="font-container2" class="'+selected2+'"><h1>'+selected2T+'</h1><p><h2>Regular</h2><p style="font-size: 29px;font-weight:normal;">The quick brown fox jumps over the lazy dog</p><h2 class="boldbox2" >Bold</h2><p class="boldbox2" style="font-weight:bold;font-size: 29px;">The quick brown fox jumps over the lazy dog</p></p><a style="text-decoration: underline;" target="_blank" rel="noopner" id="lizenz2" href="/files/theme_lb_demoshop/fonts/'+selected2+'/'+license2+'">Lizenz lesen</a></div>').insertAfter('#ctrl_font2');
		
		jQuery.when(jQuery.get("../bundles/branding/css/lb_be_font.css"))
	    .done(function(response) {
	        
	        var match = new RegExp(selected2T,'g');
	        var count = (response.match(match) || []).length;
  
	        if(count<=2)
	        	{
	        	jQuery('.boldbox2').hide();
	        	
	        	}
	        else
        	{
        	jQuery('.boldbox2').show();
        	}

	    });
		
		jQuery('#ctrl_font2').addClass(selected2);
	jQuery('#ctrl_font2').change(function(){
		jQuery('#font-container2').removeClass();
		jQuery('#ctrl_font2').removeClass();
		jQuery('#ctrl_font2').addClass('tl_select');
		var selected2 = jQuery(this).children("option:selected").val().replace(/ /g, "");
		var selected2T =  jQuery(this).children("option:selected").val();
		jQuery.when(jQuery.get("../bundles/branding/css/lb_be_font.css"))
	    .done(function(response) {
	        
	        var match = new RegExp(selected2T,'g');
	        var count = (response.match(match) || []).length;

	        if(count<=2)
	        	{
	        	jQuery('.boldbox2').hide();
	        	
	        	}
	        else
        	{
        	jQuery('.boldbox2').show();
        	}

	    });
		jQuery('#ctrl_font2').addClass(selected2);
		jQuery('#font-container2').addClass(selected2);
		jQuery('#font-container2 h1').text(selected2T);
		jQuery.ajax({
		    url:'https://'+location.host+'/files/theme_lb_demoshop/fonts/'+selected2+'/OFL.txt',
		    type:'HEAD',
		    async:false,
		    error: function()
		    {
		    	license2="LICENSE.txt";

		    },
		    success: function()
		    {
		    	license2="OFL.txt" ;

		    }
		});
		jQuery('#lizenz2').prop('href','/files/theme_lb_demoshop/fonts/'+selected2+'/'+license2);
				});
	
	
}

