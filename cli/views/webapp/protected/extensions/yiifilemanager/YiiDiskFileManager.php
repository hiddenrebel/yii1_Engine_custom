<?php
/***
 * A disk file manager.  Stores files under a given ID sub directory.
 *	requires a base directory to save files.
 *
 * @author Christian Salazar H. <christiansalazarh@gmail.com>
 * @license http://opensource.org/licenses/bsd-license.php
 */
class YiiDiskFileManager extends YiiBaseFileManager {
	public $storage_path;


	/**
    	query if the given ID (identitity) -can read- the given file -file_id-

    	by default, this implementation returns TRUE only if the given ID
    	is the same as the file_id repo owner.

    	@return bool true|false
     */
    public function can_read($id, $file_id, $extra=array()){
		return (parent::get_file_info($id, $file_id) != null);
    }

	private function get_storage_path($id){
		$local_path = rtrim(trim($this->storage_path),"/");
		@mkdir($local_path);
		$storage_path = rtrim(sprintf("%s/%s",$local_path,$id),"/");
		@mkdir($storage_path);
		return $storage_path;
	}

	/**
	 	called by the framework whenever a unique file_id is required
		 when calling:  Yii::app()->fileman->add_files(...);

	 	@return string a unique file id
	 */
	function create_file_id($id, $file_path, $extra=array()){
		return hash("crc32", $id.basename($file_path).time());
	}

	/**
	 	called by the framework whenever a call to list_files() is performed.
			when removing a file the list_files() method is invoked too.
	 	@return string the file_id for a given file.
	 */
	function get_file_id($id, $filename, $extra=array()){
		// returns the file_id previously saved at the beginning of the filename
		// and before the @ symbol. ie:  "1878s8718x@my large document name"
		return rtrim(strrev(strstr(strrev($filename),"@")),"@");
	}

	/**
	 	called by the framework whenever a call to list_files() is performed.
			when removing a file the list_files() method is invoked too.
	 	@return string the single file_name for a given file.
	 */
	function get_file_name($id, $filename, $extra=array()){
		return ltrim(strstr($filename,"@"),"@");
	}

	/**
	 	called by the framework because a call to
			Yii::app()->fileman->add_files( ... );
	 	@return bool true|false
	 */
	function on_file($id, $file_id, $file_path, $extra=array()){
		if(!file_exists($file_path))
			return false;
		$final_path = sprintf("%s/%s@%s", $this->get_storage_path($id),
			$file_id,basename($file_path));
		copy($file_path, $final_path);	
		return true;
	}

	/**
	 	called by the framework whenever a file list must be recovered
		from the repository depending on an ID (the identity).
		@return array a string array having filenames (names only)
	 */
	function get_file_list($id, $extra=array()){
		$list = array();
		foreach(scandir($this->get_storage_path($id)) as $filename)
			if (($filename != ".") && ($filename != ".."))
				$list[] = $filename;
		return $list;
	}

	/**
	 	called by the framework whenever a file must be removed because
		a call to:  Yii::app()->fileman->remove_files(...);

		@return bool true|false
	 */
	function do_remove_file($id, $filedata, $extra=array()){
		$real_path = sprintf("%s/%s",
			$this->get_storage_path($id), $filedata['longfilename']);
		unlink($real_path);
		return true;	
	}
	
	public function get_file_path($id, $file_id, $extra=array()) {
		$info = parent::get_file_info($id, $file_id, $extra);
		if($info != null)
			return sprintf("%s/%s",$this->get_storage_path($id),
				$info['longfilename']);
		return null;
	}

	public function rename_file($id, $file_id, $name, $extra=array()){
		$filedata = $this->get_file_info($id, $file_id, $extra);
		if($filedata['filename']==$name)
			return true;
		$current_path = $this->get_file_path($id, $file_id, $extra);
		$new_path = sprintf("%s/%s@%s",
			$this->get_storage_path($id), $file_id, $name);
		copy($current_path,$new_path);
		if(file_exists($new_path)){
			unlink($current_path);
			return true;
		}else
		return false;
	}
}
