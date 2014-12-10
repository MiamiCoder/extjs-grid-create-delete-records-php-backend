Ext.application({
    name: 'App',
    models: ['ModelCar', 'Vendor'],
    stores: ['ModelCars', 'Vendors'],
    views: ['Viewport', 'ViewportController'],
    autoCreateViewport: true,    
    launch: function () {
    }
});