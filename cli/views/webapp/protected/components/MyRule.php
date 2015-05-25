<?php 
class MyRule extends CBaseUrlRule
{
    public function parseUrl($oManager, $oRequest, $sPathInfo, $sRawPathInfo)
    {
        if ($sPathInfo == "gii") {
            return false;
        }
        if ($sPathInfo != "") {
            $BR = BlogRoutes::model()->findAll('slug = :slug', array(':slug'=>$sPathInfo));
            foreach ($BR as $br) {
                if ($sPathInfo==$br->slug) {
                    return "$br->real_link";
                }                
            }
        }
        return false;
    }

    public function createUrl($oManager, $sRoute, $aParameters, $sAmpersand)
    {

    }
}