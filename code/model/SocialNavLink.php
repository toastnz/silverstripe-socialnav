<?php
namespace Toast\Social;

use SilverStripe\Dev\Debug;
use Toast\Social\SocialNav;
use SilverStripe\Core\Convert;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\SiteConfig\SiteConfig;



/**
 * Represents an item in the Social Nav
 *
 * @author ilateral (http://www.ilateral.co.uk)
 * @package SocialNav
 */
class SocialNavLink extends DataObject
{

    private static $db = array(
        "Service" => "Varchar",
        "Title" => "Varchar",
        "URL" => "Varchar(255)",
        "ExtraClasses" => "Varchar"
    );

    private static $has_one = [
        'Parent' => SiteConfig::class,
    ];

    private static $casting = array(
        "ConvertedService" => "Varchar"
    );

    private static $summary_fields = array(
        "Service",
        "Title",
        "URL"
    );

    public function getConvertedService()
    {
        return Convert::raw2url($this->Service);
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName("ParentID");

        $service_names = SocialNav::config()->service_names;
        
        $service_field = DropdownField::create("Service")
            ->setSource($service_names)
            ->setEmptyString(_t("SocialNav.SelectService", "Select social media service"));

        $fields->replaceField("Service", $service_field);

        return $fields;
    }

    public function getCMSValidator()
    {
        return new RequiredFields(array(
            "Service",
            "URL"
        ));
    }
}
