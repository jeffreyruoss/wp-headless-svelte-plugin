
# Headless WordPress / Svelte plugin
This plugin is a very basic boilerplate for a headless WordPress plugin with a Svelte frontend. It uses the [WP REST API](https://developer.wordpress.org/rest-api/) to fetch data from WordPress.

It sets up a pretty URL at your-site.com/wphsp which can get changed in the main plugin file. (Probably will need to resave permalinks in wp-admin: settings > permalinks)

## Installation
1. Install the plugin in your WordPress site
2. Activate the plugin
3. Probably need to resave permalinks in wp-admin: settings > permalinks

## Development
1. Clone the repo
2. Run `npm install` in the app directory
3. Run `npm run dev` in the app directory

## Production
1. Run `npm run build` in the app directory

## Configuration

### Local domain
When you use the localhost domain with npm run dev, the WP REST requests still need to be a non-locahost domain. To accomplish this hardcode your non-locahost domain into `VITE_WP_REST_DOMAIN` in `.env.local`.

`.env.local`
```
VITE_WP_REST_DOMAIN=https://my-local-domain.com
```

### Plugin base path
If you change the base path of the plugin, you will need to update the base path in `vite.config.js`

`vite.config.js`
```javascript
import { defineConfig } from 'vite'
import { svelte } from '@sveltejs/vite-plugin-svelte'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [svelte()],
  base: '/wp-content/plugins/my-custom-plugin/app/dist/',
})
```

## Permalinks
Probably need to resave permalinks in wp-admin: settings > permalinks. (It sets up a pretty URL at your-site.com/wphsp)