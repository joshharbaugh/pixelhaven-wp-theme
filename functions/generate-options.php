<?php

class theme_options_page{

	//data members:
	var $options;
	var $file_name;
	var $page_title;
	
	//constructor:	
	function theme_options_page($info, $options){
	$this->info=$info;
	$this->file_name=$info['pagename']; //filename for the options page
	$this->page_title=$info['title']; //title, displayed near top of page
	$this->options=$options;
	
	add_action('admin_menu', array(&$this, 'theme_add_menu'));
	
	}
	
	//Add menu item
	function theme_add_menu(){

		if(!isset($this->info['sublevel'])){
			add_menu_page(THEME, THEME, 'administrator', $this->file_name, array(&$this, 'theme_generate_page'), get_bloginfo('template_directory').'/functions/img/icon.png');
		}
		else{			
			add_submenu_page(THEME_MAINMENU_NAME, $this->page_title, $this->page_title, 'administrator', $this->file_name, array(&$this, 'theme_generate_page'));
		}
	}
		
	//Generate functions page
	function theme_generate_page(){
		$this->save_options();

?>

	<form method="post" id="theme_options_form" class="theme_options_form">
	<input type="hidden" name="action" id="action" value="theme_save_options" />
		<div class="theme_section">
			
			<div class="theme_title clearfix">
					<div class="theme_title_image clearfix">
						<img src="<?php echo THEME_LOGO; ?>" alt="<?php echo THEME; ?>" />
						
						<div class="theme_meta">

							<div>Version: <?php echo THEME_VERSION; ?></div>
							<div><a href="<?php echo THEME_DOCS; ?>" target="_blank">View docs</a></div>
						</div><!-- //theme_meta -->
					</div><!-- //theme_title_image -->
					
					
				
					<div class="theme_title_text">
						<h3><?php echo $this->page_title; ?></h3>
						<span class="submit">

							<input name="save" type="submit" value="Save changes" />
						</span>
					</div><!-- //theme_title_text -->
			</div><!-- //theme_title -->

			
			
			<div class="theme_options">

<?php
		foreach ($this->options as $value){
		
			switch ( $value['type'] ){
				
				case "text": $this->display_text($value); break;
				
				case "textarea": $this->display_textarea($value); break;
				
				case "image": $this->display_image($value); break;
				
				case "checkbox": $this->display_checkbox($value); break;
				
				case "checkbox-nav": $this->display_checkbox_nav($value); break;
				
				case "radio": $this->display_radio($value); break;
				
				case "select": $this->display_select($value); break;
				
			
			}
			
		}
?>
				<div class="theme_input theme_save clearfix">
					<div class="label">Save Options</div>
					
					<div class="option_wrap">
						<div class="option_control">						
							<input type="submit" class="button" id="final_submit" name="final_submit" value="Save changes" />

	
						</div>
						<div class="description">Save the options</div>

					</div><!-- //option_wrap -->
				</div><!-- //theme_upload -->


				
			</div><!-- //theme_options -->
			
		</div><!-- //theme_section -->
	</form><!--//save form-->
		
<?php
	}




	function display_text($value){
?>
				<div class="theme_input theme_text clearfix">
					<div class="label"><?php echo $value['name']; ?></div>

					
					<div class="option_wrap">
						<div class="option_control">						
							<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if(get_option($value['id'])) echo esc_html(stripslashes(get_option($value['id'])));else echo $value['default']; ?>" />
						</div>
						<div class="description"><?php echo $value['desc']; ?></div>

					</div><!-- //option_wrap -->
				</div><!-- //theme_text -->



<?php
	}





	function display_textarea($value){
?>
				<div class="theme_input theme_textarea clearfix">
					<div class="label"><?php echo $value['name']; ?></div>
					
					<div class="option_wrap">

						<div class="option_control">
							<textarea rows="5" cols="25" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>"><?php
							if(get_option($value['id'])) 
								echo stripslashes(get_option($value['id'])) ;
							else 
								echo $value['default']; 
							?></textarea>
						</div>
						<div class="description"><?php echo $value['desc']; ?></div>

					</div><!-- /option_wrap -->
				</div><!-- //theme_textarea -->

<?php
	}




	function display_image($value){
?>
				<div class="theme_input theme_image clearfix">
					<div class="label"><?php echo $value['name']; ?></div>
					
					<div class="option_wrap">
						<div class="option_control">						
							<input type="text" value="<?php 
							if(get_option($value['id'])) echo stripslashes(get_option($value['id']));
						else 
							echo $value['default']; 
						?>" name="<?php echo $value['id']; ?>"/>
							<span id="<?php echo $value['id']; ?>" class="button upload theme_upload">Upload Image</span>
							<?php if(get_option($value['id'])) :?>
								<span class="button theme_remove" id="remove_<?php echo $value['id']; ?>">Remove Image</span>
							<?php endif; ?>
							
							<div class="theme_image_preview">
								<?php if(get_option($value['id'])):?>
								<img src="<?php echo get_option($value['id']); ?>" />
								<?php elseif($value['default'] != ""):?>
								<img src="<?php echo $value['default']; ?>" />
								<?php endif; ?>
							</div>

						</div>
						<div class="description"><?php echo $value['desc']; ?></div>

					</div><!-- //option_wrap -->
				</div><!-- //theme_upload -->
<?php
	}




	function display_checkbox($value){
?>
			
				<div class="theme_input theme_checkbox clearfix">
					<div class="label"><?php echo $value['name']; ?></div>
					
					<div class="option_wrap">
						<div class="option_control">
						<?php
						$ctr=-1;
						foreach($value['options'] as $cb_option):
							$ctr++;
							$checked='';
							if(get_option($value['id'][$ctr])){
								if(get_option($value['id'][$ctr]) == 'true') $checked=' checked="checked"';
								else $checked='';
							}
							else{
								if($value['default'][$ctr]=="checked") $checked=' checked="checked"';
							}
					?>	
							<input type="checkbox" id="<?php echo $value['id'][$ctr]; ?>"<?php echo $checked; ?> name="<?php echo $value['id'][$ctr]; ?>"><label for="<?php echo $value['id'][$ctr]; ?>"><?php echo $value['options'][$ctr]; ?></label><br/>
					<?php
						endforeach;
					?>
						</div>
						<div class="description"><?php echo $value['desc']; ?></div>

					</div><!-- //option_wrap -->
				</div><!-- //theme_checkbox -->
<?php
	}


	
	
	
	
		function display_checkbox_nav($value){
?>
			
				<div class="theme_input theme_checkbox_nav clearfix">
					<div class="label"><?php echo $value['name']; ?></div>
					
					<div class="option_wrap">
						<div class="option_control">
						<?php
						$ctr=-1;
						foreach($value['options'] as $cb_option):
							$ctr++;
							$checked='';
							if(get_option($value['id'][$ctr])){
								if(get_option($value['id'][$ctr]) == 'true') $checked=' checked="checked"';
								else $checked='';
							}
							else{
								if($value['default'][$ctr]=="checked") $checked=' checked="checked"';
							}
							
							$clearfix='';
							
							if($ctr%3==0 and $ctr!=0)
								$clearfix= ' style="clear:both"'; 
								
							$last='';
							
							if(($ctr+1)%3==0 )
								$last=' last'; 
							
					?>	
							<div class="checkbox-nav<?php echo $last; ?>"<?php echo $clearfix; ?>>
								<input class="theme_super_check" type="checkbox" id="<?php echo $value['id'][$ctr]; ?>"<?php echo $checked; ?> name="<?php echo $value['id'][$ctr]; ?>"><label for="<?php echo $value['id'][$ctr]; ?>"><?php echo $value['options'][$ctr]; ?></label>
							</div>
					<?php
						endforeach;
					?>
						</div>
						<div class="description"><?php echo $value['desc']; ?></div>

					</div><!-- //option_wrap -->
				</div><!-- //theme_checkbox -->
<?php
	}

	function display_radio($value){
?>
				<div class="theme_input theme_radio clearfix">
					<div class="label"><?php echo $value['name']; ?></div>

					
					<div class="option_wrap">
						<div class="option_control">
						<?php
						$ctr=-1;
						if(get_option($value['id'])) $default=get_option($value['id']);
						else $default = $value['default'];
						foreach($value['options'] as $rd_option):
							$ctr++;
							$checked='';
							if($value['values'][$ctr]==$default) $checked=' checked="checked"';
							
					?>
							<input type="radio" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" value="<?php echo $value['values'][$ctr]; ?>"<?php echo $checked; ?>><label for="<?php echo $value['id']; ?>"><?php echo $value['options'][$ctr]; ?></label><br/>
					<?php
						endforeach;
					?>
							
						</div>
						<div class="description"><?php echo $value['desc']; ?></div>

					</div><!-- //option_wrap -->
				</div><!-- //theme_radio -->
<?php
	}




	function display_select($value){
?>			
				<div class="theme_input theme_select clearfix">
					<div class="label"><?php echo $value['name']; ?></div>

					
					<div class="option_wrap">
						<div class="option_control">						
							<select id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>">
						<?php
							if(get_option($value['id'])) $default=get_option($value['id']);
							else $default = $value['default'];
							
							foreach($value['options'] as $sel_opt):								
								$selected='';							
								if($sel_opt == $default) $selected=' selected="selected"';
						?>						
								<option <?php echo $selected;?>><?php echo $sel_opt; ?></option>						
						<?php
							endforeach;
						?>
							</select>
						</div>
						<div class="description"><?php echo $value['desc']; ?></div>

					</div><!-- //option_wrap -->
				</div><!-- //theme_select -->
<?php
	}
	
	
	


	function save_options(){

		if (isset($_POST['action']) && $_POST['action'] == 'theme_save_options' ) {
							foreach ($this->options as $value) {
								$the_type=$value['type'];		
									
									if($the_type=="checkbox" or $the_type=="checkbox-nav"){
										$ctr=0;
										
										foreach( $value['options'] as $cbopt):
											$curr_id=$value['id'][$ctr];
											
											if(isset($_POST[$curr_id]))
												update_option($curr_id, 'true');
											
											else
												update_option($curr_id, 'false');
												
										$ctr++;		
										endforeach;
									}
									
									if($the_type!="checkbox" and $the_type!="checkbox-nav"){	
										update_option($value['id'], $_POST[ $value['id'] ]);
									}	
							
							}
					echo '<div id="message" class="updated fade"><p><strong>'.THEME.' settings saved.</strong></p></div>';
			
					}
			

			







	}	
	
	
	
	
	
}//end class
?>