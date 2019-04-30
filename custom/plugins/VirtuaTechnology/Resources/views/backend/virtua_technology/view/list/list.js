
Ext.define('Shopware.apps.VirtuaTechnology.view.list.List', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.virtua-technology-listing-grid',
    region: 'center',

    configure: function() {
        return {
            detailWindow: 'Shopware.apps.VirtuaTechnology.view.detail.Window'
        };
    }
});
