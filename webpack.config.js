var Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // compiled assets directory
    .setOutputPath('public/build/')
    // compiled assets web path
    .setPublicPath('/build')

    /*
     * ENTRY CONFIG
     */
    .addEntry('app', './assets/js/app.js')
    .addEntry('home', './assets/js/home.js')

    .splitEntryChunks()
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })

    .enablePostCssLoader((options) => {
        options.config ={
            path: 'postcss.config.js'
        }
    })

    .enableSassLoader()

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
