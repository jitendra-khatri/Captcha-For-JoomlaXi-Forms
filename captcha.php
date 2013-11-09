<?php

class PlgSystemCaptcha extends JPlugin
{
	/*public function __construct(){
		
	}*/
	public function onJXiFormsViewBeforeRender($inputObject)
	{
		$app = JFactory::getApplication();
		
		$input = $app->input;
		
		$option = $input->get('option', false);
		$view 	= $input->get('view', false);
		$task	= $input->get('task', false);
		
		$inputId = $input->get('id', false);
		$jxifInputObject = JXiformsInput::getInstance($inputId);
		$showCaptcha	 = $jxifInputObject->getParam('captcha', false);
		
		if($app->isAdmin()){
			
			if($option != 'com_jxiforms' || $view != 'input' || !(in_array($task, array('new', 'edit')))){
				return false;
			}
?>
			<script type="text/javascript">
			jxiforms.jQuery(document).ready(function()
				{
					var first_div = jxiforms.jQuery('#jxiforms_form_input_actions').parent();
					var last_div  = first_div.parent();
					var html	  = '<div class="control-group">';
						html	  = html + '<div class="control-label">';
						html	  = html + '<label title="" class="required" for="jxiforms_form_captcha" id="jxiforms_form_captcha-lbl" title="&lt;strong&gt;Title&lt;/strong&gt;&lt;br /&gt;Select Yes, If want to use Captcha on this Form">Use Captcha</label>';
						html	  = html + '</div>';
						html	  = html + '<div class="controls">';
						html	  = html + '<div>';
						html	  = html + '<select id="jxiforms_form_captcha" name="jxiforms_form[params][captcha]">';
						html	  = html + '<option value="0" <?php if($showCaptcha == 0){ echo "selected"; }?> >No</option>';
						html	  = html + '<option value="1" <?php if($showCaptcha == 1){ echo "selected"; }?> >Yes</option>';
						html	  = html + '</select>';
						html	  = html + '</div>';
						html	  = html + '<div class="clr"></div>';
						html	  = html + '</div>';
						html	  = html + '</div>';
					
					last_div.append(html);
				});
			</script>
	<?php
			return true;
		}
		
		if($app->isSite()){
			$inputId = $input->get('input_id', false);
			$jxifInputObject = JXiformsInput::getInstance($inputId);
			$showCaptcha	 = $jxifInputObject->getParam('captcha', false);
			
			if($showCaptcha == false || $showCaptcha == 0){
				return false;
			}?>
			
			<script type="text/javascript">
				jxiforms.jQuery(document).ready(function()
				{
					var form = jxiforms.jQuery("form input:last-child").last().prepend("<div>Hello</div>");
					var a = 5;
				});
			</script>
		<?php }
	}
}

?>