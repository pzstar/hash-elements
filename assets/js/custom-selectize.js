var selectizeItemView = elementor.modules.controls.BaseData.extend({
    onReady: function () {
        var self = this;
        self.ui.select.selectize({
            plugins: ['remove_button', 'drag_drop'],
            delimiter: ',',
            persist: false,
            //maxItems: 8
        });
    }
});

elementor.addControlView('hash-elements-selectize', selectizeItemView);