# tarteaucitron.js for Contao 4
Add the tarteaucitron.js script to Contao 4
# What is this script?
The european cookie law regulates the management of cookies and you should ask your visitors their consent before exposing them to third party services.

Clearly this script will:
- Disable all services by default,
- Display a banner on the first page view and a small one on other pages,
- Display a panel to allow or deny each services one by one,
- Activate services on the second page view if not denied,
- Store the consent in a cookie for 365 days.

Bonus:
- Load service when user click on Allow (without reload of the page),
- Incorporate a fallback system (display a link instead of social button and a static banner instead of advertising).

More info : [Visit opt-out.ferank.eu](https://opt-out.ferank.eu/)

# How to use
This bundle add options to configure the script on every root page.
- You have a checkbox to enable the script and you must choose at least one service.
- You have to modify the template(s) for the service(s) : Add your Google Analytics ID for example
- Do not add a analytics template in your page layout.
- You can remove tarteaucitron.js for specific page if needed in the page settings.

Exemple : If you choose the Google Analytics (gtag.js), you need to modifiy the gtag.html5 template with your Google Analytics Id.