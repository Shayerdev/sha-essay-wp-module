const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');
const path = require('path');

module.exports = {
    ...defaultConfig,
    ...{
        entry: {
            'js/main': path.resolve(process.cwd(), 'assets/js', 'main.js'),
            'css/main': path.resolve(process.cwd(), 'assets/style', 'main.scss')
        },
        plugins: [
            ...defaultConfig.plugins,
            new RemoveEmptyScriptsPlugin({
                stage: RemoveEmptyScriptsPlugin.STAGE_AFTER_PROCESS_PLUGINS
            })
        ]
    }
};
