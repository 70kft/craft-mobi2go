<?php
namespace Craft;
class Mobi2GoVariable {
  /**
   * @var bool
   */
  public $enabled;
  
  /**
   * @var array
   */
  public $settings;
  

  /**
   * Assigns some plugin properties to properties.
   */
  public function __construct() {
    $this->settings = craft()->plugins->getPlugin('Mobi2Go')->getSettings();
  }


  /**
   * Returns the attributes of the plugin's settings model
   *
   * @return array
   */
  public function getSettings() {
    return $this->settings->attributes;
  }


  /**
  * Creates div with id which will be the target of the embed js of Mobi2Go store.
  *
  * @return string
  */
  public function mobi2GoContainer() {

    $data = "<div id=\"mobi2go-container\"></div>
    <script>
      document.getElementsByTagName('head')[0].appendChild(function(s){
        var d=document,
        m2g=d.createElement('script'),
        l=function(){
          Mobi2Go.load(s.container,s.ready);
        },
        jq=window.jQuery&&+window.jQuery.fn.jquery.substring(0,3)>=1.7,
        qs=window.location.search.substring(1),
        re='=(.*?)(?:;|$)',
        c=d.cookie.match('MOBI2GO_SESSIONID'+re),
        w=window.innerWidth;

        m2g.src='https://www.mobi2go.com/store/embed/" . $this->settings->storeName .
        ".js?'+qs+(jq?'&no_jquery':'')+(c?'&s='+c[1]:'')+'&device_width='+w;
        
        if(m2g.onload!==undefined)m2g.onload=l;
        else m2g.onreadystatechange=function(){
          if(m2g.readyState!=='loaded'&&m2g.readyState!=='complete')
            return;m2g.onreadystatechange=null;l();
          }
        return m2g;
      }({
          container: 'mobi2go-container',
          ready: function() {}
      }));
    </script>";

    return TemplateHelper::getRaw($data);
  }
}