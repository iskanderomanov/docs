document.addEventListener('submit', function (e) {
    let form = e.target;
    if (form.classList.contains('ajax')) {
        e.preventDefault();
        let formData = new FormData(form);
        let method = form.getAttribute('method');
        let url = form.getAttribute('action');
        if (e.submitter) {
            if (e.submitter.getAttribute('formaction')) {
                url = e.submitter.getAttribute('formaction');
            }
        }
        resetValidationState(form);
        ajaxRequest(url, method, formData, form)
    }
});

function blurFormInput(id)
{
    let form = document.getElementById(id);

    if (form.classList.contains('ajax')) {
        let formData = new FormData(form);
        let method = form.getAttribute('method');
        let url = form.getAttribute('action');
        resetValidationState(form);
        ajaxRequest(url, method, formData, form)
    }
}

function resetValidationState(form) {
    let allInputs = form.querySelectorAll(".form-control");
    let allInputs2 = form.querySelectorAll(".input-control");
    let select2Product = form.querySelector("#products");
    let invalidFeedback = form.querySelectorAll(".invalid-feedback");
    let successes = form.querySelectorAll('.invalid-success-feedback');
    select2Product?.classList.remove('is-invalid');

    allInputs.forEach(function (input) {
        input.classList.remove('is-invalid');
        input.nextSibling.textContent = '';
    });

    successes.forEach(function (input) {
        input.textContent = '';
    });

    allInputs2.forEach(function (input) {
        input.classList.remove('error');
    });

    invalidFeedback.forEach(function (input) {
        input.textContent = '';
    });
}

function handleInternalServerError(form, message = 'Внутренняя ошибка сервера') {
    form.querySelector('#error').textContent = message
}

function handleSuccessMessage(form, message) {
    form.querySelector('#success').textContent = message
}

function ajaxRequest(url, method = 'get', formData = null, form = null, returnResponse = false) {
    axios({
        method: method,
        url: url,
        data: formData,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    })
        .then(function (response) {
            // app.pageUnBusy();

            if (response.data.status === 'error') {
                handleInternalServerError(form, response.data.message);
            }

            if (true === returnResponse) {
                return response;
            }

            if (response.data.functions) {
                run(response.data.functions);
            }

            if(response.data.view_page){
                $('#view_page').html(response.data.view_page);
            }

            if (response.data.status === 'success') {
                handleSuccessMessage(form, response.data.message);
            }
        })
        .catch(function (error) {
            // app.pageUnBusy();
            if (error.response.status) {
                console.log('error')

                console.log(error)
                switch (error.response && error.response.status) {
                    case 422:
                        handleValidationErrors(form, error.response.data.errors)
                        break;

                    case 403:
                    case 400:
                    case 401:
                    case 409:
                        if (error.response.data.functions) {
                            run(error.response.data.functions);
                        }
                        break;
                    case 500:
                        handleInternalServerError(form)
                        break;
                }
            }

        })
}

function handleValidationErrors(form, errors) {
    for (let inputId in errors) {
        let field = document.getElementById(inputId);
        if (field && field.parentElement.classList.contains('input-control')) {
            field.parentElement.classList.add('error');
        }

        if (field && field.classList.contains('form-control')) {
            field.classList.add('is-invalid');
        }

        if (field) {
            let invalidFeedback = field.nextElementSibling;

            if (invalidFeedback && invalidFeedback.classList.contains("invalid-feedback")) {
                invalidFeedback.textContent = errors[inputId];
            }
        }

    }
}

let run = function (functionList) {
    for (let functionItem in functionList) {
        app.functions[functionItem](functionList[functionItem].params);

    }
}

let app = {
    pageBusy: function () {
        if (document.querySelector('.btn.btn-success')) {
            document.querySelector('.btn.btn-success').classList.add('disabled');
            document.querySelector('.btn.btn-success').setAttribute('disabled', 'disabled');
            document.querySelector('.btn.btn-success').innerHTML = 'Отправка<span class="animated-dots"></span>';
        }
    },

    pageUnBusy: function () {
        if (document.querySelector('.btn.btn-success')) {
            document.querySelector('.btn.btn-success').classList.remove('disabled');
            document.querySelector('.btn.btn-success').removeAttribute('disabled');
            document.querySelector('.btn.btn-success').innerHTML = 'Отправить';
        }
    },
    data: {
        modals: {
            small: 'modalSmall',
            regular: 'modalRegular',
            large: 'modalLarge',
            transactionDetails: 'transactionDetails'
        },
        quillToolbar: [
            [{'header': [1, 2, 3, false]}],
            ['bold', 'italic', 'underline', 'link'],
            [{'list': 'ordered'}, {'list': 'bullet'}],
            ['clean'],
            ['image']
        ],

        loader: '<div class="text-center"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',

    },
    functions: {
        ajaxRequest: function (url, method = 'get', formData = null, form = null, returnResponse = false) {
            app.pageBusy();

            axios({
                method: method,
                url: url,
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            })
                .then(function (response) {
                    app.pageUnBusy();
                    if (true === returnResponse) {
                        return response;
                    }

                    if (response.data.functions) {
                        run(response.data.functions);
                    }

                })
                .catch(function (error) {

                    app.pageUnBusy();
                    if (error.response.status) {
                        switch (error.response && error.response.status) {
                            case 422:
                                app.functions.handleValidationErrors(form, error.response.data.errors)
                                break;

                            case 403:
                            case 400:
                            case 401:
                                if (error.response.data.functions) {
                                    run(error.response.data.functions);
                                }
                                break;
                            case 500:
                                app.functions.alert({
                                    title: 'Ошибка',
                                    message: 'Внутренняя ошибка сервера',
                                    type: 'error'
                                })
                                break;
                        }
                    }

                });
        },

        alert: function (params) {
            Swal.fire(
                params.title,
                params.message,
                params.type
            )
        },

        ajaxConfirm: function (title, content = '', icon, confirmBtnText, denyBtnText, url, method) {
            Swal.fire({
                title: title,
                html: `<p class="text-center">` + content + `</p>`,
                icon: icon,
                confirmButtonText: confirmBtnText,
                denyButtonText: denyBtnText,
                showDenyButton: true,
                buttons: true,
            })
                .then((result) => {
                    if (result.isConfirmed) {
                        app.functions.ajaxRequest(url, method);
                    }

                });
        },

        handleValidationErrors: function (form, errors) {
            for (let inputId in errors) {

                let field = document.getElementById(inputId);

                if (field && field.parentElement.classList.contains('input-control')) {
                    field.parentElement.classList.add('error');
                }

                if (field && field.classList.contains('form-control')) {
                    field.classList.add('is-invalid');
                }

                app.functions.checkProductBlock(field, errors[inputId]);

                if (field) {
                    let invalidFeedback = field.nextElementSibling;

                    if (invalidFeedback && invalidFeedback.classList.contains("invalid-feedback")) {
                        invalidFeedback.textContent = errors[inputId];
                    }
                }

            }
        },
        checkProductBlock: function (field, errors) {
            if (field.id == 'products') {
                let productResult = app.functions.getNextSibling(field, ".product-result");

                if (productResult && productResult.childElementCount == 0) {
                    field.classList.add('is-invalid');
                    app.functions.getNextSibling(productResult, ".invalid-feedback")
                        .textContent = errors;
                }
            }
        },
        getNextSibling: function (elem, selector) {

            let sibling = elem.nextElementSibling;

            if (!selector) return sibling;

            while (sibling) {
                if (sibling.matches(selector)) return sibling;
                sibling = sibling.nextElementSibling
            }

        },
        loadModalContent: function (modalType, url) {

            if (modalType in app.data.modals) {

                let modalObject = document.getElementById(app.data.modals[modalType]);


                if (modalObject instanceof HTMLElement) {
                    modalObject.style.display = 'block';
                    url = url + '?response=modal&type=' + modalType;
                    app.functions.ajaxRequest(url);
                }
            }
        },

        updateModalBody: function (params) {
            let modalObject = document.getElementById(app.data.modals[params.type]);
            if (modalObject instanceof HTMLElement) {
                let title = modalObject.getElementsByClassName('modal-title').item(0);
                let body = modalObject.getElementsByClassName('modal-body').item(0);
                title.innerHTML = params.title;
                body.innerHTML = params.content;
            }
        },

        updateContent: function (params) {
            let contentBlock = document.getElementById(params.blockId);

            if (contentBlock) {
                contentBlock.innerHTML = params.content;
            }
        },

        removeElement: function (params) {
            let contentBlock = (params.parentId !== "") ? $(params.parentId).find('[data-id="' + params.id + '"]') : $(params.id);
            if (params.deleteBackground) {
                contentBlock = $('input[value=' + params.id + ']').closest('.preview-image')
            }
            if (params.updateChildEl) {
                contentBlock.remove();
                if (params.parentId !== '') {
                    let i = 0;
                    document.querySelectorAll('.preview-image').forEach(function (item) {
                        $(item).attr({'class': 'preview-image preview-show-' + i, 'data-id': i});
                        $(item).find('.order').val(i);
                        $(item).find('#image-cancel').attr('data-no', i);
                        $(item).find('.image_id').attr({id: 'pro_image_' + i, name: 'image_id[' + i + '][id]'});
                        $(item).find('.order').attr({id: 'order_' + i, name: 'image_id[' + i + '][order]'});
                        $(item).find('.pro-img').attr('id', 'pro-img-' + i);
                        $(item).find('.btn-open-image').attr({onclick: 'openImage(' + i + ')'});
                        i++;
                    })
                }
            } else {
                contentBlock.remove();
            }
        },

        showElement: function (params) {
            let contentBlock = document.getElementById(params.id);

            if (contentBlock) {
                contentBlock.style.display = 'block';
            }
        },

        redirect: function (params) {
            window.location = params.url;
        },
        resetValidationState: function (form) {
            let allInputs = form.querySelectorAll(".form-control");
            let allInputs2 = form.querySelectorAll(".input-control");
            let select2Product = form.querySelector("#products");
            let invalidFeedback = form.querySelectorAll(".invalid-feedback");

            select2Product?.classList.remove('is-invalid');

            allInputs.forEach(function (input) {
                input.classList.remove('is-invalid');
                input.nextSibling.textContent = '';
            });

            allInputs2.forEach(function (input) {
                input.classList.remove('error');
            });

            invalidFeedback.forEach(function (input) {
                input.textContent = '';
            });
        },
        toast: function (params) {
            Toastify({
                text: params.text,
                backgroundColor: params.color,
                className: params.className,
                close: true,
                gravity: "top",
                position: 'right',
                stopOnFocus: true,
            }).showToast();
        },

        initDateInput: function (params) {
            if (0 !== document.getElementsByClassName("date-input").length) {
                new Cleave('.date-input', {
                    date: true,
                    delimiter: '.',
                    datePattern: ['d', 'm', 'Y']
                });
            }
        },

        reload: function () {
            window.location.reload(params);
        },

        addOption: function (params) {
            let val = $(params.parentId).find('option[value*="' + params.value + '"]').val();
            if (!val) {
                $(params.parentId).append("<option value='" + params.value + "'>" + params.value + "</option>");
            }
        },
        frontSuccessMessage: function (params) {
            let block = $('#messagesSuccess')
            block.show();
            $('#messages').focus();
            document.getElementById("messageShowSuccess").innerHTML = params.message;

        },
        frontErrorMessage: function (params) {
            let block = $('#messagesError')
            block.show();
            block.focus();
            document.getElementById("messageShowError").innerHTML = params.message;
        },
    }
};

