const mix = require('laravel-mix')
const path = require('path')

const directory = path.basename(path.resolve(__dirname))
const source = 'platform/plugins/' + directory
const dist = 'public/vendor/core/plugins/' + directory

mix
    .js(`${source}/resources/js/home-grid-admin.js`, `${dist}/js`)
    .sass(`${source}/resources/sass/home-grid.scss`, `${dist}/css`)

if (mix.inProduction()) {
    mix
        .copy(`${dist}/js/home-grid-admin.js`, `${source}/public/js`)
        .copy(`${dist}/css/home-grid.css`, `${source}/public/css`)
}