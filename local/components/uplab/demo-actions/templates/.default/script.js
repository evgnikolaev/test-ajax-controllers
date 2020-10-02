BX.ready(function () {

    BX.bindDelegate(document, 'click', {attribute: {'id': 'action-1'}}, function (ev) {
        ev.preventDefault();

        const responseContainer = BX('response');


       // BX.ajax.runComponentAction('название компонента','action', объект конфиуграции {}) - по умолчанию шлет POST-запрос

        BX.ajax.runComponentAction('uplab:demo-actions', 'testSimple', {
            mode: 'class',//для компонента, описан в class.php или ajax.php
            //method:'GET'
        })
            //успешный ответ
            .then(function (response) {
                BX.adjust(responseContainer, {
                    html: JSON.stringify(response, null, 4).trim()
                });

                console.log('then: ', response);
            })
            //ошибка
            .catch(function (response) {
                BX.adjust(responseContainer, {
                        html: JSON.stringify(response, null, 4).trim()
                    }
                );

                console.log('catch: ', response);
            });
    });









    BX.bindDelegate(document, 'click', {attribute: {'id': 'action-2'}}, function (ev) {
        ev.preventDefault();

        const responseContainer = BX('response');

        BX.ajax.runComponentAction('uplab:demo-actions', 'testFilters', {
            mode: 'class',
            // method: 'GET'
        })
            .then(function (response) {
                BX.adjust(responseContainer, {
                    html: JSON.stringify(response, null, 4).trim()
                });

                console.log('then: ', response);
            })
            .catch(function (response) {
                BX.adjust(responseContainer, {
                        html: JSON.stringify(response, null, 4).trim()
                    }
                );

                console.log('catch: ', response);
            });
    });








    BX.bindDelegate(document, 'click', {attribute: {'id': 'action-3'}}, function (ev) {
        ev.preventDefault();

        const responseContainer = BX('response');

        //передача аргументов, автоваринг - переменные здесь и в обработчике должны совпадать
        BX.ajax.runComponentAction('uplab:demo-actions', 'testArguments', {
            mode: 'class',
            data: {
                argtt: {'hello':'aaa'},
                arg2: 'world'
            },
        })
            .then(function (response) {
                BX.adjust(responseContainer, {
                    html: JSON.stringify(response, null, 4).trim()
                });

                console.log('then: ', response);
            })
            .catch(function (response) {
                BX.adjust(responseContainer, {
                        html: JSON.stringify(response, null, 4).trim()
                    }
                );

                console.log('catch: ', response);
            });
    });







    BX.bindDelegate(document, 'click', {attribute: {'id': 'action-4'}}, function (ev) {
        ev.preventDefault();

        const responseContainer = BX('response');

        BX.ajax.runComponentAction('uplab:demo-actions', 'testParameters', {
            mode: 'class',
            signedParameters: window.signedParameters
        })
            .then(function (response) {
                BX.adjust(responseContainer, {
                    html: JSON.stringify(response, null, 4).trim()
                });

                console.log('then: ', response);
            })
            .catch(function (response) {
                BX.adjust(responseContainer, {
                        html: JSON.stringify(response, null, 4).trim()
                    }
                );

                console.log('catch: ', response);
            });
    });





    //Для ошибок для примера отправим на ajax.php

    BX.bindDelegate(document, 'click', {attribute: {'id': 'action-5'}}, function (ev) {
        ev.preventDefault();

        const responseContainer = BX('response');

        BX.ajax.runComponentAction('uplab:demo-actions', 'testErrors', {
            mode: 'ajax',
        })
            .then(function (response) {
                BX.adjust(responseContainer, {
                    html: JSON.stringify(response, null, 4).trim()
                });

                console.log('then: ', response);
            })
            .catch(function (response) {
                BX.adjust(responseContainer, {
                        html: JSON.stringify(response, null, 4).trim()
                    }
                );

                console.log('catch: ', response);
            });
    });







    BX.bindDelegate(document, 'click', {attribute: {'id': 'action-6'}}, function (ev) {
        ev.preventDefault();

        const responseContainer = BX('response');

        BX.ajax.runComponentAction('uplab:demo-actions', 'testExceptions', {
            mode: 'ajax',
        })
            .then(function (response) {
                BX.adjust(responseContainer, {
                    html: JSON.stringify(response, null, 4).trim()
                });

                console.log('then: ', response);
            })
            .catch(function (response) {
                BX.adjust(responseContainer, {
                        html: JSON.stringify(response, null, 4).trim()
                    }
                );

                console.log('catch: ', response);
            });
    });







});
