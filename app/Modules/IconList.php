<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\KariezCore\Modules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class IconList {

    public static function fontello() {
        return [
            "icon-earphones" => "earphones",
            "icon-delivery" => "delivery",
            "icon-security" => "security",
            "icon-storage" => "storage",
            "icon-tracking" => "tracking",
            "icon-pricing" => "pricing",
            "icon-arrow-right" => "arrow-right",
            "icon-quote" => "quote",
            "icon-check" => "check",
            "icon-circle-check" => "check-circle",
            "icon-air-freight" => "air-freight",
            "icon-truck-1" => "truck",
            "icon-ship" => "ship",
            "icon-train" => "train",
            "icon-gps" => "gps",
            "icon-plus" => "plus",
            "icon-facebook" => "facebook",
            "icon-twitter" => "twitter",
            "icon-linked" => "linkedin",
            "icon-instragram" => "instagram",
            "icon-phone-fill" => "phone-fill",
            "icon-email-fill" => "email-fill",
            "icon-map-fill" => "map-fill",
            "icon-convert-3d-cube" => "convert-3d-cube",
            "icon-routing" => "routing",
        ];
    }

	public static function fontello_service() {
		return [
			" " => "Icon Empty",
			"icon-earphones" => "earphones",
			"icon-delivery" => "delivery",
			"icon-security" => "security",
			"icon-storage" => "storage",
			"icon-tracking" => "tracking",
			"icon-pricing" => "pricing",
            "icon-arrow-right" => "arrow-right",

		];
	}
}
