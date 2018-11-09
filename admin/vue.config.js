// vue.config.js
module.exports = {
    lintOnSave: true,
    outputDir: './../public/admin_panel',
    baseUrl: process.env.NODE_ENV === "production" ? 'admin_panel': '/',
}
