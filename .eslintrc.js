module.exports = {
    root: true,
    extends: [
        'plugin:@wordpress/eslint-plugin/recommended',
    ],
    env: {
        browser: true,
        jquery: true,
    },
    globals: {
        wp: 'readonly',
        screenly: 'writable',
    },
    rules: {
        // Add any custom rules here
    },
};