
Ext.define('Shopware.apps.TechnologyPlugin.view.list.List', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.technology-plugin-listing-grid',
    region: 'center',

    configure: function() {
        return {
            detailWindow: 'Shopware.apps.TechnologyPlugin.view.detail.Window'
        };
    }
});
