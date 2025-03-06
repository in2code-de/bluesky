# Bluesky extension

## Introduction

Simple content element to show a bluesky feed by account name for TYPO3 13 or newer.

## Screenshots

Example output of posts in frontend:

![screenshot_frontend_plugin_list.png](Documentation/Images/screenshot_frontend_plugin_list.png "Example output of posts in frontend")

Example plugin settings in backend:

![screenshot_backend_plugin_list.png](Documentation/Images/screenshot_backend_plugin_list.png "Example plugin settings in backend")

## Howto

Do you want to change the html template of the list view? Sure, you want to change it.
You can do it simply via TypoScript setup:

```
plugin.tx_bluesky {
  view {
    templateRootPaths {
      1 = EXT:sitepackage/Resources/Private/ExtensionView/Plugins/Bluesky/Templates/
    }
  }
}
```

## Changelog

| Version | Date       | State   | Description                                                                             |
|---------|------------|---------|-----------------------------------------------------------------------------------------|
| 1.1.0   | 2025-03-05 | Feature | Autolink url in posts, don't use ascii characters as hashtags, ignore colon in hashtags |
| 1.0.1   | 2025-03-05 | Bugfix  | Use default values if FlexForm is empty                                                 |
| 1.0.0   | 2025-03-05 | Task    | Initial publish of the extension                                                        |
