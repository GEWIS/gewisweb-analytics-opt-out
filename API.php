<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\TrackingOptOut;

use Piwik\Plugins\PrivacyManager\DoNotTrackHeaderChecker;
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
     * @return array
     */
    public function isTracked()
    {
        $isTracked = !IgnoreCookie::isIgnoreCookieFound();
        $isDoNotTrackPresent = $this->isDoNotTrackPresent();

        return ["isTracked" => ($isTracked && !$isDoNotTrackPresent), "isDoNotTrackPresent" => $isDoNotTrackPresent];
    }

    /**
     * Sets the ignore cookie, so the user is not tracked any longer.
     *
     * Call: index.php?module=API&method=TrackingOptOut.doIgnore
     *
     * @return void
     */
    public function doIgnore()
    {
        // Do nothing if the cookie already is set.
        if (IgnoreCookie::isIgnoreCookieFound() || $this->isDoNotTrackPresent()) {
            return;
        }

        IgnoreCookie::setIgnoreCookie();
    }

    /**
     * Removes the ignore cookie, so the user is tracked from now on.
     *
     * Call: index.php?module=API&method=TrackingOptOut.doTrack
     *
     * @return void
     */
    public function doTrack()
    {
        IgnoreCookie::getIgnoreCookie()->delete();
    }

    /**
     * Returns whether or not a Do Not Track header is present.
     *
     * @return boolean
     */
    private function isDoNotTrackPresent()
    {
        return (new DoNotTrackHeaderChecker())->isDoNotTrackFound();
    }
}
