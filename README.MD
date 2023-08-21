# Task for WordPress developer position: Simple WordPress theme with custom ACF blocks

A theme is configured to work with Webpack and ACF blocks. It uses the [@wordpress/scripts](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/) npm package. The scss and js files from the `src` folder are minified and compiled automatically into the `build` folder.

## Installation

Download this folder, unzip it and upload it to the *themes* folder in your wordpress installation.
You can also install it via the WordPress dashboard (appearance=> themes => upload a theme).

## Development

Install node.js and npm, then run `npm i`

To enter development mode run `npm run start`

To prepare a production build run `npm run build`

To format js files run `npm run format:js`

## To do

- Add helper function to automatically import the ACF field groups from json files. For now just import the files from `acf-json` folder using ACF plugin tools.
- Improve Webpack configuration for multiple ACF blocks.
