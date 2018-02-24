Sprout Active
===================

Simplify navigation and URL-based logic in your templates.

Sprout Active makes it simple to control the active classname in your navigation or conditional content based on your URL segments or your full URL.

----

## Usage

Sprout Active provides two Twig Filters, `active()` and `activeClass()`, to test for matching URL segments and output a class to make an element active.

By default, the activeClass() filter tests for the first URL segment against your matching copy, and outputs the string: `class="active"`

For example, the most simple version of these filters will match the first segment in the URL http://example.com/about-us. If no match is found, they will return blank.

``` twig
{{ active('about-us') }} {# Output if match: active #}

{{ activeClass('about-us') }} {# Output if match: class="active" #}

{{ activeClass(entry.slug) }}
```

See the [Sprout Active Documentation](https://sprout.barrelstrengthdesign.com/craft-plugins/active/docs) for more examples.

----

## Getting Started 

### Requirements

This plugin requires Craft CMS 3.0.0-RC1 or later.

### Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require barrelstrength/sprout-active

3. In the Control Panel, go to _Settings → Plugins_ and click the “Install” button for Sprout Active.
