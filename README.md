Sprout Active
===================

## Status

[![No Maintenance Intended](http://unmaintained.tech/badge.svg)](http://unmaintained.tech/)

In an effort to reduce the number of packages we publicly maintain, Sprout Active will not be migrated to Craft 4. If you'd like to take the helm or take responsibility over maintaining the repository please reach out: [sprout@barrelstrengthdesign.com](mailto:sprout@barrelstrengthdesign.com).

## Overview 

Simplify navigation and URL-based logic in your templates.

Sprout Active makes it simple to control the active classname in your navigation or conditional content based on your URL segments or your full URL.

## Usage

Sprout Active provides the `active` and `activeClass` Twig Filters to test for matching URL segments and output a class to make an element active.

The most simple version of these filters will match the first segment in the URL http://example.com/about-us. If no match is found, they will return blank.

``` twig
{{ active('about-us') }} {# Output if match: active #}

{{ activeClass('about-us') }} {# Output if match: class="active" #}

{{ activeClass(entry.slug) }}
```

See the documentation for more advanced use cases.

## Documentation

See the [Sprout Website](https://sprout.barrelstrengthdesign.com/craft-plugins/active/docs) for documentation, guides, and additional resources. 

## Support

- [Send a Support Ticket](https://sprout.barrelstrengthdesign.com/craft-plugins/request/support) via the Sprout Website.
- [Create an issue](https://github.com/barrelstrength/craft-sprout-active/issues) on Github.

<a href="https://sprout.barrelstrengthdesign.com" target="_blank">
  <img src="https://s3.amazonaws.com/sprout.barrelstrengthdesign.com-assets/content/plugins/sprout-icon.svg" width="72" align="right">
</a>
