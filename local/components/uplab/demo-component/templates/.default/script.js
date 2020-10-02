BX.ready(function () {

    BX.bindDelegate(document, 'submit', {attribute: {'data-action': 'addItem'}}, function (ev) {
        ev.preventDefault();

        const form = this;
        const input = BX.findChild(form, {
            attribute: {
                name: 'name'
            }
        }, true);

        const container = BX.findChild(document, {
            attribute: {
                'data-container': 'todo'
            }
        }, true);

        // BX.showWait();

        BX.ajax.runComponentAction('uplab:demo-component', 'addItem', {
            mode: 'class',
            data: {
                name: input.value
            },
            // signedParameters: window.OT.signedParameters || null,
        })
            .then(function (response) {
                BX.adjust(container, {
                    html: response.data.html
                });

                // BX.closeWait();
            })
            .catch(function (response) {

                // BX.closeWait();
            });
    });

    BX.bindDelegate(document, 'click', {attribute: {'data-action': 'deleteItem'}}, function (ev) {
        ev.preventDefault();

        const container = BX.findChild(document, {
            attribute: {
                'data-container': 'todo'
            }
        }, true);

        // BX.showWait();

        BX.ajax.runComponentAction('uplab:demo-component', 'deleteItem', {
            mode: 'class',
            data: {
                id: this.getAttribute('data-id')
            }
        })
            .then(function (response) {
                BX.adjust(container, {
                    html: response.data.html
                });

                // BX.closeWait();
            })
            .catch(function (response) {

                // BX.closeWait();
            });
    });

    BX.bindDelegate(document, 'click', {attribute: {'data-action': 'toggleItem'}}, function (ev) {
        ev.preventDefault();

        const container = BX.findChild(document, {
            attribute: {
                'data-container': 'todo'
            }
        }, true);

        // BX.showWait();

        BX.ajax.runComponentAction('uplab:demo-component', 'toggleItem', {
            mode: 'class',
            data: {
                id: this.getAttribute('data-id'),
            }
        })
            .then(function (response) {
                BX.adjust(container, {
                    html: response.data.html
                });

                // BX.closeWait();
            })
            .catch(function (response) {

                // BX.closeWait();
            });
    });

});
