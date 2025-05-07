# Cache Improvement Plugin for Shopware 6

Small changes to Shopware Core which improve the caches for your static assets.

## ✨ Features

- Removes query string parameters from images
- Removes query string parameters from js and css

## 🛠️ Use Case

Your webshop is using a CDN (like Fastly or Cloudflare) to cache the static assets. These do not get cached correctly
when the asset url contains a query parameter. By using this plugin you can remove the parameters, making the caching
of your static assets better.

## 🚀 Installation

```bash
composer require laenen/sw6-cache-improvement-plugin
bin/console plugin:install --activate LaenenCacheImprovement
```

## ✅ Compatibility

- Shopware 6.6+

## 🧩 Configuration

In the Plugin Configuration, enable or disable the functions:

- "Media url generation" for your CMS assets
- "Static Assets url generation" for js and css files

## 🧽 Notes

- Due to the generated urls not having a timestamp anymore, you will need to use a different method to bust the cache on
  file updates. For example a time-based folder structure for your Media, and/or cache clearing in your pipelines.