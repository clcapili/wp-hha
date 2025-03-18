document.addEventListener("DOMContentLoaded", function () {
    
    // Start the mutation observer to watch for new forms added to the DOM
    const observer = new MutationObserver(mutations => {

        // Loop through each mutation
        mutations.forEach(mutation => {
            
            // Check for new forms added to the DOM
            mutation.addedNodes.forEach(node => {

                // Specifically check for HubSpot form using updated selectors
                if (node.nodeType === 1 && (node.classList.contains('hs-form') || node.querySelector('.hs-form'))) {

                    // Fill the form fields with UTM data
                    amsive_utm_fillUTMFields(node);
                }
            });
        });
    });

    // Start the mutation observer
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Log that the observer has started
    // console.log("Observer started");
});