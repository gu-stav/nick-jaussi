module.exports = {
    plugins: [
        require('autoprefixer')({
          browsers: [
            'Firefox ESR',
            'last 2 Chrome versions',
            'last 2 Firefox versions',
            'Safari >= 7',
            'iOS 7',
          ],
        }),
        require('cssnano')({
            preset: 'default',
        }),
    ],
};
