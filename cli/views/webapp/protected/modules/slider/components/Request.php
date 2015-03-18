<?php 
/**
* 
*/
class Request extends CHttpRequest
{
	public function getBaseUrl($absolute=false)
	{
	    if($this->_baseUrl===null)
	        $this->_baseUrl=rtrim(dirname($this->getScriptUrl()),'\\/');
	    return $absolute ? $this->getHostInfo() . $this->_baseUrl : $this->_baseUrl;
	}
}