(function () {

    //console.log("amsive-analytics.js");

    // if isset amsive_preserve_utm_vars not defined exit
    if (typeof amsive_analytics_vars === 'undefined') {

        console.log("amsive_analytics_vars not defined");
        return;
    }

    //console.log("amsive_analytics_vars: ", amsive_analytics_vars);

    const checkForUTM = amsive_analytics_vars.check_for_utm;
    const cookieExpiration = parseInt(amsive_analytics_vars.cookie_expiration);
    let amsiveUTM = {};

    // Function to get URL parameters
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        const results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    // Check for UTM parameters and store them if present
    checkForUTM.forEach(function (param) {
        const value = getUrlParameter(param);
        if (value) {
            amsiveUTM[param] = value;
        }
    });

    // Function to set cookie
    function amsive_utm_setCookie(name, value, seconds) {

        const date = new Date();
        date.setTime(date.getTime() + (seconds * 1000)); // Convert seconds to milliseconds
        const expires = "expires=" + date.toUTCString();

        document.cookie = name + '=' + encodeURIComponent(JSON.stringify(value)) + '; expires=' + expires + '; path=/';
    }

    // Check if any UTM parameters were found and set them into a cookie
    if (Object.keys(amsiveUTM).length > 0) {
        // Set cookie for 30 days (you can change this value)
        amsive_utm_setCookie('amsive_utm', amsiveUTM, cookieExpiration);
    }

})();

/** --- UTM functions --- */

// Function to get cookie by name
function amsive_utm_getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) {
        // Decode the URL-encoded cookie value before returning
        return decodeURIComponent(parts.pop().split(';').shift());
    }
    return null;  // Return null if the cookie is not found
}

// Function to get UTM data from cookie
function amsive_utm_getUTMData() {
    const utmDataRaw = amsive_utm_getCookie("amsive_utm");
    console.log("UTM data raw: ", utmDataRaw);
    try {
        const utmData = JSON.parse(utmDataRaw);
        console.log("UTM data: ", utmData);
        return utmData;
    } catch (e) {
        console.error("Error parsing UTM data: ", e);
        return null;
    }
}

// Function to fill the form fields with UTM data
function amsive_utm_fillUTMFields(form) {
    //console.log("Form found in DOM: ", form);
    const utmData = amsive_utm_getUTMData();
    //console.log("UTM data: ", utmData);
    if (!utmData) return;

    const utmFields = ["utm_source", "utm_medium", "utm_campaign", "utm_content"];
    utmFields.forEach(field => {
        //console.log("Field: ", field);
        const input = form.querySelector(`input[name="${field}"]`);
        if (input) {
            input.value = utmData[field] || ""; // Only fill if the field exists in the cookie
        }
    });
}

