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
	
	
	
resetToDefaultColors()
{

var length= this.nameList.length;
for(var i =0; i<= length-1;i++)
{
	var color = getComputedStyle(document.documentElement).getPropertyValue('--'+this.nameList[i]);
	jQuery('#'+this.idList[i]).val(color.replace(/ /g, "").replace(/#/g, ""));
	jQuery('#'+this.idList[i]+'box').css('background-color',color);
}





}


seeColors(element,index)
    {
		var idList = this.idList;
		var color = getComputedStyle(document.documentElement).getPropertyValue('--'+element);
console.log(color);
jQuery('#'+this.idList[index]).val(color);


}



}
setTimeout(function(){ addColorListeners(); }, 500);

	function resetf()
	{
		
		
		var list1 = [];   
		var list2 = [];	
		jQuery('#tl_lb_branding fieldset :input').each(function(){

		list1.push(jQuery(this).prop('name'));
		list2.push(jQuery(this).prop('id'));

		});	


		const handler = new Reset(list1,list2);
		handler.resetToDefaultColors();


	}
	





function addColorListeners() {
	
	



	jQuery('<fieldset id="pal_reset_legend"class="tl_box"><legend onclick="AjaxRequest.toggleFieldset(this,  \'reset_legend\', \'tl_lb_branding\')">Auf Standard zurücksetzen</legend><div class="w50 widget"><button class="tl_submit" type="button"  onclick="resetf()">Zurücksetzen</button><p class="tl_help tl_tip" title="">Bitte speichern, um die Einstellungen zu übernehmen.</p></div></fieldset>').insertAfter('#pal_ui_legend');


	inputColor();

	jQuery('input.moor-okButton').on('click',function(){

	inputColor();

	});
}
function inputColor(){


		jQuery('input.tl_text').each(function(){
			if(jQuery("#"+jQuery(this).attr('id')+"box").length)
				{
				jQuery("#"+jQuery(this).attr('id')+"box").remove();
				}
			jQuery(this).next('img').after('<div id="'+jQuery(this).attr('id')+'box" style="background-color:#'+jQuery(this).val()+';border-radius: 2px; border: 1px solid #ccc ;height:29px; width:29px; float:left;" class="lb_colorbox"></div>');
			});



}


