<?php

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

    public static $has_many = array(
        'SocialNavLinks' => SocialNavLink::class
    );

    public function updateCMSFields(FieldList $fields)
    {
        // $fields->removeByName('SocialNavLinks');

        // // Setup compressed postage options
        // $socialnav_fields = ToggleCompositeField::create(
        //     'SocialNavFields',
        //     'Social Nav',
        //     array(
                
        //     )
        // );

        // Add config sets
        $fields->addFieldToTab('Root.Main', GridField::create(
            'SocialNavLinks',
            '',
            $this->owner->SocialNavLinks(),
            GridFieldConfig_RecordEditor::create()
        ));
    }
}
