<?php
namespace Toast\Social;

use Toast\Social\SocialNavLink;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\ToggleCompositeField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

/**
 * Add additional variables to default siteconfig
 *
 * @author ilateral (http://www.ilateral.co.uk)
 * @package SocialNav
 */
class SocialNavSiteConfigExtension extends DataExtension
{

    private static $many_many = array(
        'SocialNavLinks' => SocialNavLink::class
    );

    public function updateCMSFields(FieldList $fields)
    {
        // Add config sets
        $fields->addFieldToTab('Root.Social', GridField::create(
            'SocialNavLinks',
            '',
            $this->owner->SocialNavLinks(),
            GridFieldConfig_RecordEditor::create()
        ));
    }
}
