
Ext.define('Shopware.apps.VirtuaTechnology.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.virtua-technology-list-window',
    height: 450,
    title : '{s name=window_title}Virtua Technology{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.VirtuaTechnology.view.list.List',
            listingStore: 'Shopware.apps.VirtuaTechnology.store.Main'
        };
    }
});