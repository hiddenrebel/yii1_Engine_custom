<?php
/***
 * Interface for all YiiFileManager descendent services.
 *
 *
 * @author Christian Salazar H. <christiansalazarh@gmail.com>
 * @license http://opensource.org/licenses/bsd-license.php
 */
interface IYiiFileManager {
	public function add_files($id, $local_file_path, $extra=array());
	public function list_files($id, $extra=array());
	public function remove_files($id, $file_id, $extra=array());
	public function get_file_path($id, $file_id, $extra=array());
	public function get_file_info($id, $file_id, $extra=array());
	public function can_read($id, $file_id, $extra=array());
	public function rename_file($id, $file_id, $name, $extra=array());

	function on_file($id, $file_id, $file_path, $extra=array());
	function get_file_list($id, $extra=array());
	function create_file_id($id, $file_path, $extra=array());
	function get_file_id($id, $filename, $extra=array());
	function get_file_name($id, $filename, $extra=array());
	function do_remove_file($id, $filedata, $extra=array()); // filedata: see list_files
} 
