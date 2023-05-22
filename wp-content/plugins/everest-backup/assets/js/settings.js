"use strict";
(function () {
    /**
     * SCript for settings page.
     */
    var SettingsPage = function () {
        HandleLoggerSpeedChange();
        function HandleLoggerSpeedChange() {
            var loggerSpeedRange = document.getElementById('logger_speed_range');
            if (!loggerSpeedRange) {
                return;
            }
            var loggerSpeedDisplay = document.getElementById('logger_speed_display');
            loggerSpeedRange.addEventListener('input', function () {
                loggerSpeedDisplay.innerText = this.value;
            });
        }
    }; // SettingsPage.
    /**
     * After document is fully loaded.
     */
    window.addEventListener("load", function () {
        SettingsPage();
    });
})();
//# sourceMappingURL=settings.js.map