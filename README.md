# TrackingOptOut Matomo Plugin

## Description
This plugin provides three API endpoints for Matomo. They can be used to replace the default iframe when opting out of tracking. Respects Do Not Track headers.

1. `isTracked`: Returns whether or not the client is currently being tracked.
2. `doIgnore`: Do not track the client (i.e. Matomo sets the `matomo_ignore` cookie).
3. `doTrack`: Track the client (i.e. Matomo removes the `matomo_ignore` cookie if present).

All calls to the API must be performed using JSONP requests, as the `matomo_ignore` cookie cannot be set over `XMLHttpRequest`s (due to CORS restrictions).

## License
Original work by Oliver Lippert, modified by Web Commissie. Licensed under [GPLv3](https://github.com/GEWIS/gewisweb-analytics-opt-out/blob/master/LICENSE).