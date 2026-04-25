# Mageaustralia_Storefront — Maho module

Companion Maho-side module for the [Maho Storefront](https://github.com/mageaustralia/maho-storefront) (Cloudflare Workers, edge-rendered headless layer). Manages:

- Cloudflare Worker script deployment from Maho admin
- Cloudflare KV sync of CMS pages, blog posts, categories, products, store config, footer pages
- Admin dashboard with sync log + manual triggers
- Cron-based incremental sync between admin saves and the edge

## Unique / distinctive feature

A **fully admin-managed Cloudflare deployment + sync pipeline**. No CLI required. Configure your Cloudflare account ID + API token + worker script name in `System > Configuration > Storefront`, click **Test Connection**, click **Sync All**, and your storefront edge has the same content as Maho. Subsequent admin saves trigger incremental sync via observers. Most headless setups require dev-time CLI scripting and out-of-band data pipelines; this lives in admin.

## Status

Pre-1.0 / actively iterating. Schema is stable (see `sql/`); admin UX is functional but minimal. Production-tested at [staging.mageaustralia.com.au](https://staging.mageaustralia.com.au).

## Install

```bash
composer require mageaustralia/maho-storefront-module
php maho cache:flush
```

The install script creates the `mageaustralia_storefront_log` activity-log table. The 1.1.0 upgrade adds `storefront_origin` and `storefront_order_token` columns to `sales/order` (both nullable).

## Configure

In Maho admin, go to **System > Configuration > Service > Storefront**:

| Setting | Required | Notes |
|---|---|---|
| `Cloudflare > Account ID` | yes | Find at dash.cloudflare.com / your account / Account ID |
| `Cloudflare > API Token` | yes | Create at dash.cloudflare.com / My Profile / API Tokens. Required scopes: Workers Scripts (Edit), Workers KV Storage (Edit), Cache Purge (Purge), Zone (Read) |
| `Cloudflare > API Email` | only for legacy Global API Key | Leave blank for API Token auth |
| `Onboarding > Worker Script Name` | yes | The Cloudflare Worker that serves the storefront, e.g. `mageaustralia-storefront` or `maho-storefront-demo` |

After configuration, click **Test Connection** in the admin dashboard. If the credentials and scopes are right, you'll see the worker's KV namespaces and bindings.

## Sync

Initial bulk sync via admin dashboard **Sync All** button. Subsequent updates flow automatically via observers on:

- `catalog_product_save_after`
- `catalog_category_save_after`
- `cms_page_save_after`
- `cms_block_save_after`
- `core_store_save_after`
- and more (see `etc/config.xml`)

Cron does periodic delta verification per the `Sync Frequency` config (default 5 minutes).

## Compatibility

- Maho `>=26.0`
- PHP `>=8.3`
- Storefront repo: `mageaustralia/maho-storefront` `>=2026-01`

## License

[OSL-3.0](LICENSE) (matches Maho/Magento 1's traditional license).

## Contributing

This module is part of the Mageaustralia portfolio of Maho extensions. Issues and PRs welcome.
