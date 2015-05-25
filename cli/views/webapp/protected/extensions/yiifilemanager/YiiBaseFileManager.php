<?php
/**
 *	File Manager Framework
 *
 *	Is the framework for derivated classes implementing file managers:
 * 	  YiiDiskFileManager,  YiiDbFileManager, YiiSessionFileManager etc.
 *
 * @author Christian Salazar H. <christiansalazarh@gmail.com>
 * @license http://opensource.org/licenses/bsd-license.php
 */
abstract class YiiBaseFileManager 
	extends CApplicationComponent 
		implements IYiiFileManager 
{
	/**
	  	Add files to repository.
	 
	 	@return	array an array of file_id (string)
	 */
	public function add_files($id, $local_file_path, $extra=array()){
		$file_ids = array();
		// ensure an array, inclusive when the local_file_path is not an array
		$_local_file_path = array();
		if(is_array($local_file_path)){
			$_local_file_path = $local_file_path;
		}else
			$_local_file_path[] = $local_file_path; // a single string
		// iterate over the files to be added
		foreach($_local_file_path as $file_path){
			$file_id = $this->create_file_id($id, $file_path, $extra);
			if(true===$this->on_file($id, $file_id,$file_path, $extra))
				$file_ids[] = $file_id;
		}
		return $file_ids;
	}

	/**
	 	returns an array containing stored {filedata} for a given ID.
		{filedata} fields are:
			"id", "file_id", "filename", "longfilename"
	*/
	public function list_files($id, $extra=array()){
		$files = array();
		foreach($this->get_file_list($id, $extra) as $filename){
			$file_id = $this->get_file_id($id, $filename, $extra);
			$files[] = array(
				"id" => $id,
				"file_id" => $file_id,
				"filename"=> $this->get_file_name($id, $filename, $extra),
				"longfilename"=> $filename,
			);
		}
		return $files;
	}

	public function remove_files($id, $file_ids, $extra=array()){
		// ensure an array, inclusive when the local_file_path is not an array
		$_file_ids = array();
		if(is_array($file_ids)){
			$_file_ids = $file_ids;
		}else
			$_file_ids[] = $file_ids; // single entry
		$list = $this->list_files($id, $extra);
		$removed_count=0;
		foreach($list as $existing)
			foreach($_file_ids as $file_id_to_be_removed)
				if($existing['file_id']==$file_id_to_be_removed)
					if(true===$this->do_remove_file($id, $existing, $extra))
						$removed_count++;
		return $removed_count;
	}

	public function get_file_info($id, $file_id, $extra=array()) {
		foreach($this->list_files($id, $extra) as $existing)
			if($existing['file_id']==$file_id)
				return $existing;
		return null;
	}

}
