# User Profile Plugin

This plugin allows you to easily implement user profile functionality for the front side of your WP project.

## Yet another one!?
There are a few hundred plugins out there which intend to solve the same problem: How to achieve user profile, login and registration outside the Admin area.

Many of them are amazing, but I did not yet find a solution that just provides the basics and allows me to do the rest.

I don't like plugins which push a bunch of CSS or JS files just to get some fancy out of the box appearance. I just want them to extend features in a clean way.

I created this plugin as a solid base to use in the different websites I work on and let the appearance and custom stuff be handled by the theme or even a complementary self-made plugin.

## How to use?

To use this plugin you just have to install it and create the following pages in your dashboard.

* **Login**: add the shortcode `[login]`
* **Registration**: add the shortcode `[registration]`
* **My profile**: add the shortcode `[show_my_profile]`
* **Edit profile**: add the shortcode `[edit_my_profile]`
* **Registration finished**: add whatever content you like.

Then go to the plugin settings page and add the pages ids where they correspond.

And that's it. Go to the login or registration page and see the magic happen.

You can easily extend the **Edit my profile** sections and fields thanks to the plugin filters.