<?php
class Form{
				
	public static $config_form = array('method' => 'POST', 'action' => '');
	
	public static $config_options = array(
											'name' 		=> '',
											'type' 		=> 'text',
											'value' 	=> '',
											'id' 		=> '',
											'accept' 	=> '',
											'alt' 		=> 'Un champ formulaire',
											'checked' 	=> FALSE,
											'maxlength' => '',
											'size' 		=> '',
											'disabled' 	=> FALSE
										);
	
	public static $config_select = array(
											'order'	   	=> 'ASC',
											'check'	   	=> ''
										);
	
	public static $count_field = array(
											'input'    	=> '',
											'submit'   	=> '',
											'button'   	=> '',
											'textarea' 	=> '',
											'select'   	=> ''
										);
	   
	public static function open($options = array()) {
	
		$options = array_merge(self::$config_form, $options);
		
		echo '<FORM method="'.$options['method'].'" action="'.$options['action'].'" role="form">';
	}
	
	public static function close($options = null) {
	
		if($options['hidden'] != null) {
			
			$options = array_merge(self::$config_options, $options);
			
			$option = $options['hidden'];
			foreach($option as $key) {
				echo '<input type="hidden" name="'.$key['name'].'" value="'.$key['value'].'">';
			}
		}
		
		echo '</FORM>';
	}   
	   
	protected static function merge_array($options) {
		return array_merge(self::$config_options, $options);
	}
	   
	public static function input($options = array()) {
	
		$options = self::merge_array($options);
	
		if(empty($options['name'])) {
			self::$count_field['input'] = self::$count_field['input'] + 1;
			$name = 'input'.self::$count_field['input'];
			
			echo '<input type="'.$options['type'].'" name="'.$name.'" role="textbox" id="'.$name.'" ';
		}else{
			echo '<input type="'.$options['type'].'" name="'.$name.'" role="textbox" id="'.$options['id'].'" ';
		}
		
		if(!empty($options['value'])) {
			echo 'value="'.$options['value'].'" ';
		}
		
		if(strtolower($options['type']) == 'checkbox' and $options['checked'] == TRUE) {
			echo 'checked ';
		}
		
		if(strtolower($options['type']) == 'text' and !empty($options['maxlength'])) {
			echo 'maxlength="'.$options['maxlength'].'" ';
		}
		
		echo "/>";
	}

	public static function submit($options = array()) {
	
		$options = self::merge_array($options);
	
		if(empty($options['name'])) {
			self::$count_field['submit'] = self::$count_field['submit'] + 1;
			$name = 'input'.self::$count_field['submit'];
			
			echo '<input type="submit" name="'.$name.'" ';
		}else{
			echo '<input type="submit" name="'.$name.'" ';
		}
		
		if(!empty($options['value'])) {
			echo 'value="'.$options['value'].'" ';
		}
	
		if($options['disabled']) {
			echo 'disabled ';
		}
		
		echo "/>";
	}

	public static function button($options = array()) {
	
		$options = self::merge_array($options);
	
		if(empty($options['name'])) {
			self::$count_field['button'] = self::$count_field['button'] + 1;
			$name = 'input'.self::$count_field['button'];
			
			echo '<button type="submit" name="'.$name.'" ';
		}else{
			echo '<button type="submit" name="'.$name.'" ';
		}
		
		if(!empty($options['value'])) {
			echo 'value="'.$options['value'].'" ';
		}
	
		if($options['disabled']) {
			echo 'disabled ';
		}
		
		if(empty($options['value'])) {
			echo ">".$name."</button> ";
		}else{
			echo ">".$value."</button> ";
		}
	}

	public static function textarea($options = array()) {
	
		$options = self::merge_array($options);
	
		if(empty($options['name'])) {
			self::$count_field['textarea'] = self::$count_field['textarea'] + 1;
			$name = 'input'.self::$count_field['textarea'];
		
			echo '<textarea role="text" type="text" name="'.$name.'" aria-multiline="true" ';
		}else{
			echo '<textarea role="text" type="text" name="'.$name.'" aria-multiline="true" ';
		}
		
		if(empty($options['value'])) {
			echo ">".$name."</textarea>";
		}else{
			echo ">".$value."</textarea>";
		}
	}
	
	public static function select($name = null, $list, $options = array()) {
	
		$options = array_merge(self::$config_select, $options);
		
		if($name == null) {
			self::$count_field['select'] = self::$count_field['select'] + 1;
			$name = 'input'.self::$count_field['select'];
		}	
		
		if(strtolower($options['order']) == 'ASC'){
			array_multisort($list, SORT_ASC);
			
		}elseif(strtolower($options['order']) == 'DESC'){
			array_multisort($list, SORT_DESC);
			
		}
	
		echo '<select name="'.$name.'">';
		
		foreach($list as $key => $val){
		
			if(!empty($options['check']) and $val == $options['check']) {
				echo '<option value="'.$key.'" selected>'.$val.'</options>';
			}else{
				echo '<option value="'.$key.'">'.$val.'</options>';
			}
		}
			
		echo '</select>';
	
	}
}