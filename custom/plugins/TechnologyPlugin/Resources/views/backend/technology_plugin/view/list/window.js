
Ext.define('Shopware.apps.TechnologyPlugin.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.technology-plugin-list-window',
    height: 450,
    title : '{s name=window_title}Technology Plugin{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.TechnologyPlugin.view.list.List',
            listingStore: 'Shopware.apps.TechnologyPlugin.store.Main'
        };
    }
});