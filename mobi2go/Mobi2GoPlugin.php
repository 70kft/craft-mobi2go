<?php
namespace Craft;

class Mobi2GoPlugin extends BasePlugin
{

  public function getName()
  {
    return Craft::t('Mobi2Go');
  }

  public function getVersion()
  {
    return '1.0';
  }

  public function getDeveloper()
  {
    return '70kft';
  }

  public function getDeveloperUrl()
  {
    return 'http://70kft.com';
  }

  public function getSettingsUrl()
  {
    return UrlHelper::getUrl('/mobi2go/settings');
  }

  protected function defineSettings()
  {
    return array(
        'storeName'  => array(AttributeType::String, 'required' => true),
        'apiKey'    => array(AttributeType::String, 'required' => true)
      );
  }

  public function getSettingsHtml()
  {
    return craft()->templates->render('mobi2go/settings', array(
      'settings' => $this->getSettings()
    ));
  }

}