/*collapse expand single item
by Leo Charre & Jesse Fergusson
Internet Connection  2004 2005 ©
www.internetconnection.net


Usage:

place this in your HEAD tags:

	<script language="JavaScript" src="/WHEREINPATH/collapse_expand_single_item.js"></script>

Place this in your HTML

	<img src="/IMAGESDIR/u.gif" name="imgfirst" width="9" height="9" border="0" >
	<a  href="#first" onClick="shoh('first');" >Customer Support</a>

	<div style="display: none;" id="first" >
			
			With its friendly solutions-oriented 
			approach, our timely and knowledgeable Technical Support Staff are 
			completely at your disposal. Our Support Technicians are highly 
			trained on the inner workings of the Internet and its associated 
			technologies. Combined with effective troubleshooting techniques, 
			we can quickly identify and resolve technical issues whether they 
			are on our end or on the client end. 		      
	
	</div>


WHEREINPATH is where you are storing this script on your account
IMAGESDIR is where on your acoount you are storing the icons for (expanded collapsed)

*/

imgout=new Image(9,9);
imgin=new Image(9,9);

/////////////////BEGIN USER EDITABLE///////////////////////////////
	imgout.src= ttstoreexpand_object.imgurl;
	imgin.src= ttstoreexpand_object.imgurl;
///////////////END USER EDITABLE///////////////////////////////////

//this switches expand collapse icons
function filter(imagename,objectsrc){
	if (document.images){
		document.images[imagename].src=eval(objectsrc+".src");
	}
}

//show OR hide funtion depends on if element is shown or hidden
function shoh(id) { 
	
	if (document.getElementById) { // DOM3 = IE5, NS6
		if (document.getElementById(id).style.display == "block"){
			document.getElementById(id).style.display = 'none';
			filter(("img"+id),'imgout');			
		} else {
			filter(("img"+id),'imgin');
			document.getElementById(id).style.display = 'block';			
		}	
	} else { 
		if (document.layers) {	
			if (document.id.display == "block"){
				document.id.display = 'none';
				filter(("img"+id),'imgout');
			} else {
				filter(("img"+id),'imgin');	
				document.id.display = 'block';
			}
		} else {
			if (document.all.id.style.visibility == "block"){
				document.all.id.style.display = 'none';
			} else {
				filter(("img"+id),'imgout');
				document.all.id.style.display = 'block';
			}
		}
	}
}