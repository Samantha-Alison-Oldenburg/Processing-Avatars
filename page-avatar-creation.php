<?php
/**
 * Template Name: Avatar Creation
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
 
 
	$size = 598;
	$html_width = 'width = "' . $size . '" ';
	$html_height = 'height = "' . $size . '" ';
	
	$user_ID = get_current_user_id(); 
	$avatar_data = get_user_avatar_info($user_ID); 
	get_header();
 ?>
 <style type="text/css">
 .container {
	width: 80%;
	max-width: 1260px;/* a max-width may be desirable to keep this layout from getting too wide on a large monitor. This keeps line length more readable. IE6 does not respect this declaration. */
	min-width: 780px;/* a min-width may be desirable to keep this layout from getting too narrow. This keeps line length more readable in the side columns. IE6 does not respect this declaration. */
	background: #FFF;
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout. It is not needed if you set the .container's width to 100%. */
	overflow: hidden; /* this declaration makes the .container clear all floated columns within it. */
}

/* ~~ These are the columns for the layout. ~~ 

1) Padding is only placed on the top and/or bottom of the divs. The elements within these divs have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

2) No margin has been given to the columns since they are all floated. If you must add margin, avoid placing it on the side you're floating toward (for example: a right margin on a div set to float right). Many times, padding can be used instead. For divs where this rule must be broken, you should add a "display:inline" declaration to the div's rule to tame a bug where some versions of Internet Explorer double the margin.

3) Since classes can be used multiple times in a document (and an element can also have multiple classes applied), the columns have been assigned class names instead of IDs. For example, two sidebar divs could be stacked if necessary. These can very easily be changed to IDs if that's your preference, as long as you'll only be using them once per document.

4) If you prefer your nav on the right instead of the left, simply float these columns the opposite direction (all right instead of all left) and they'll render in reverse order. There's no need to move the divs around in the HTML source.

*/
.sidebar1 {
	float: left;
	width: 20%;
	padding-bottom: 10px;
}
.content {
	padding: 10px 0;
	width: 80%;
	float: left;
}

</style>
 <body>
 <div class="container">
  <div class="sidebar1">
  	<label for="avatar_color">Color</label><p>
    <select id="avatar_color" name="avatar_color" onChange="feature_changed(this.value, 8)">
      <option value="1">Blue</option>
      <option value="2">Grass Green</option>
      <option value="3">Orange</option>
	  <option value="4">Pink</option>
      <option value="5">Purple</option>
      <option value="6">Red</option>
      <option value="7">Space Gray</option>
	  <option value="8">Spartan Green</option>
      <option value="9">White</option>
	  <option value="10">Yellow</option>
    </select> </p>
    <p></p>
    <label for="avatar_eyes">Eyes</label><p>
    <select id="avatar_eyes" name="avatar_eyes" onChange="feature_changed(this.value, 4)">
      <option value="1">Simple 2</option>
      <option value="2">Simple 1</option>
      <option value="3">Cross-eyed</option>
	  <option value="4">Heads Up</option>
      <option value="5">Suspicious</option>
      <option value="6">Unassuming</option>
      <option value="7">What's that?</option>
	  <option value="8">Shocked</option>
      <option value="9">Sad</option>
	  <option value="10">Eccentric</option>
    </select></p>
    <p></p>
    <label for=avatar_eyelashes>Eyelashes</label><p>
    <select id=avatar_eyelashes name=avatar_eyelashes onChange="feature_changed(this.value, 6)">
      <option value="1">No Eyelashes</option>
      <option value="2">Eyelash 1</option>
      <option value="3">Eyelash 2</option>
	  <option value="4">Eyelash 3</option>
      <option value="5">Eyelash 4</option>
      <option value="6">Eyelash 5</option>
      <option value="7">Eyelash 6</option>
	  <option value="8">Eyelash 7</option>
      <option value="9">Eyelash 8</option>
	  <option value="10">Eyelash 9</option>
    </select></p>
    <p></p>
    <label for=avatar_eyebrows>Eyebrows</label><p>
    <select id=avatar_eyebrows name=avatar_eyebrows onChange="feature_changed(this.value, 5)">
      <option value="1">No Eyebrows</option>
      <option value="2">Eyebrow 1</option>
      <option value="3">Eyebrow 2</option>
	  <option value="4">Eyebrow 3</option>
      <option value="5">Eyebrow 4</option>
      <option value="6">Eyebrow 5</option>
      <option value="7">Eyebrow 6</option>
	  <option value="8">Eyebrow 7</option>
      <option value="9">Eyebrow 8</option>
	  <option value="10">Eyebrow 9</option>
    </select></p>
    <p></p>
    <label for=avatar_mouth>Mouth</label><p>
    <select id=avatar_mouth name=avatar_mouth onChange="feature_changed(this.value, 7)">
      <option value="1">Happy 1</option>
      <option value="2">Happy 2</option>
      <option value="3">Whistling</option>
	  <option value="4">Sad</option>
      <option value="5">Surprised 1</option>
      <option value="6">Silent</option>
      <option value="7">Smug</option>
	  <option value="8">Surprised 2</option>
      <option value="9">Happy 3</option>
	  <option value="10">Goofy</option>
    </select></p>
    <p><button name="save_button" onClick="save_avatar_arg()">Save</button></p>
    <!-- end .sidebar1 -->
  </div>
<div class="content">
<script src="http://localhost/WP5/wp-content/plugins/processing-js/js/processing-1.4.8.js"></script> 
 <canvas id="avatar-creation-sketch" name="avatar-creation-sketch" data-processing-sources="http://localhost/WP5/wp-content/processing/sketch_151226a/sketch_151226a.pde" <?php  
echo("$html_width  $html_height"); ?> tabindex=0> </canvas> 
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script> 
<script type="application/javascript">
		 var processingInstance;
		 var arg;
		 var user_id = <?php echo("$user_ID"); ?>;
		 load_avatar_arg();
		
		function feature_changed(val, f_index)
		{
			arg[f_index] = val;
            if (!processingInstance) {
               processingInstance = Processing.getInstanceById("avatar-creation-sketch");
	        }
			
			processingInstance.edit_AP(arg);
		}
		
		function load_avatar_arg()
		{
			arg = [0, 0, <?php echo("$size, $size ,  $avatar_data"); ?> ];
			document.getElementById("avatar_color").selectedIndex = arg[8]-1;
			document.getElementById("avatar_eyebrows").selectedIndex = arg[5]-1;
			document.getElementById("avatar_eyes").selectedIndex = arg[4]-1;
			document.getElementById("avatar_eyelashes").selectedIndex = arg[6]-1;
			document.getElementById("avatar_mouth").selectedIndex = arg[7]-1;
		}

		
		function save_avatar_arg()
		{
			
        	var avatar_data = String(arg[4]) + ", " + String(arg[5]) + ", " +  String(arg[6]) + ", " + String(arg[7]) + ", " +  String(arg[8])  + ", " +"0, 0, 0, 0, 0, 0";
			console.log("BEGIN")
			var req = jQuery.ajax({
				type: "POST",
				url: 'http://localhost/WP5/wp-content/plugins/avatar-creation-update.php',
				dataType: 'json',
				data: {functionName: 'update_avatar', avatardata: avatar_data, uid: user_id},
			
				success: function (obj) {
							  if( !('error' in obj) ) {
								  console.log("YAS");
								  console.long(obj);
								  
							  }
							  else {
								 	console.log(obj.error);
							  }
						}
					
			});
			console.log(req);
			console.log("EnD");
			//location.reload(true);
			return avatar_data;
    	}
 </script>
</div>
</div>
</body>