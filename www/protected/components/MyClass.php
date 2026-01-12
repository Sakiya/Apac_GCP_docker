<?php
class MyClass extends CApplicationComponent {
 
	public function renameFile($filename){
		$rand = md5(rand());
		$extname = $this->file_extension($filename);
		$name = pathinfo($filename, PATHINFO_FILENAME);
		//$newFile = date('YmdHis') . '_' . preg_replace('/\W+/', '',preg_replace('/\s+/', '',$name)).'.' . $extname;
		//if (mb_strlen($newFile, "utf-8") > 30){
			$newFile = date('YmdHis') . '_' . substr($rand,0,6) . '.' . $extname;
		//}
		
		return $newFile;
	} 
	function file_extension($filename) {
		$explode = explode(".", $filename);
		$file = end($explode);
	    return $file;
	}
}

