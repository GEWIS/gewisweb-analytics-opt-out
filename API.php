<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\TrackingOptOut;

use Piwik\Tracker\IgnoreCookie;

/**
 * API for plugin TrackingOptOut
 * @method static API getInstance()
 */
class API extends \Piwik\Plugin\API {


    /**
     * This method will return whether the user is tracked or not.
     *
     * Call: index.php?module=API&method=TrackingOptOut.isTracked
     *
     * @return int
     */
    public function isTracked () {
        $ret = !IgnoreCookie::isIgnoreCookieFound();

        return $ret;
    }


    /**
     * Sets the ignore cookie, so the user is not tracked through piwik any longer.
     *
     * Call: index.php?module=API&method=TrackingOptOut.doIgnore
     *
     * @return void
     */
    public function doIgnore () {
        // Do nothing if the cookie already is set.
        if (IgnoreCookie::isIgnoreCookieFound()) {
            return;
        }

        IgnoreCookie::setIgnoreCookie();
    }


    /**
     * removes the ignore cookie, so the user is tracked through piwik from now on.
     *
     * Call: index.php?module=API&method=TrackingOptOut.doTrack
     *
     * @return void
     */
    public function doTrack () {
        IgnoreCookie::getIgnoreCookie()->delete();
    }


}
