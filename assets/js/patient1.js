$(document).ready(function () {

    var prefix = 'contactDetail';
    var handler = {
        handle: function (response, _cb) {
            if (response.success) {
                _cb(response);
            } else {
                console.log(response.message);
            }
        },
        callback_contact_add: function (response, contact_id) {
            handler.handle(response, function (r) {
                let list = $('ul.patient-contacts-list');
                list.append(r.html);
                list.find('li.not-found').addClass('d-none');
            });
        },
        callback_contact_update: function (response, contact_id) {
            handler.handle(response, function (r) {
                let list = $('ul.patient-contacts-list').find('li#row-contact-' + contact_id);
                list.replaceWith(r.html);
            });
        },
        callback_contact_email_address_add: function (response, contact_id) {
            handler.handle(response, function (r) {
                let list = $('div.collapse#' + prefix + contact_id).find('div.emails-list');
                list.append(r.html);
                list.find('div.not-found').addClass('d-none');
            });
        },
        callback_contact_email_address_update: function (response, contact_id) {
            handler.handle(response, function (r) {
                var id = $(r.html).data('id');
                let div = $('div.collapse#' + prefix + contact_id).find('div.emails-list').find('#row-email-' + id);
                div.replaceWith(r.html);
            });
        },
        callback_contact_address_add: function (response, contact_id) {
            handler.handle(response, function (r) {
                let list = $('div.collapse#' + prefix + contact_id).find('div.address-list');
                list.append(r.html);
                list.find('div.not-found').addClass('d-none');
            });
        },
        callback_contact_phone_number_add: function (response, contact_id) {
            handler.handle(response, function (r) {
                let list = $('div.collapse#' + prefix + contact_id).find('div.phones-list');
                list.append(r.html);
                list.find('div.not-found').addClass('d-none');
            });
        },
        callback_contact_phone_number_update: function (response, contact_id) {
            handler.handle(response, function (r) {
                var id = $(r.html).data('id');
                let div = $('div.collapse#' + prefix + contact_id).find('div.phones-list').find('#row-phone-' + id);
                div.replaceWith(r.html);
            });
        },
        callback_contact_address_update: function (response, contact_id) {
            handler.handle(response, function (r) {
                var id = $(r.html).data('id');
                let div = $('div.collapse#' + prefix + contact_id).find('div.address-list').find('#row-address-' + id);
                div.replaceWith(r.html);
            });
        },
        callback_delete_email: function (response, $el) {
            handler.handle(response, function (r) {
                let $parent = $el.parent();
                $el.remove();
                if ($parent.find('div.single-email').length == 0) {
                    $parent.find('div.not-found').removeClass('d-none');
                }
            });
        },
        callback_delete_address: function (response, $el) {
            handler.handle(response, function (r) {
                let $parent = $el.parent();
                $el.remove();
                if ($parent.find('div.single-address').length == 0) {
                    $parent.find('div.not-found').removeClass('d-none');
                }
            });
        },
        callback_delete_phone: function (response, $el) {
            handler.handle(response, function (r) {
                let $parent = $el.parent();
                $el.remove();
                if ($parent.find('div.single-phone').length == 0) {
                    $parent.find('div.not-found').removeClass('d-none');
                }
            });
        },
        callback_delete_contact: function (response, $el) {
            handler.handle(response, function (r) {
                let $parent = $el.parent();
                $el.remove();
                if ($parent.find('li.single-contact').length == 0) {
                    $parent.find('li.not-found').removeClass('d-none');
                }
            });
        },
        delete_email: function (modal, $el, contact_id) {
            let email_id = $el.data('id');
            let token = $('input[name="csrf_token"]').eq(0).val();

            make_call(
                '/my-account/ajax',
                $.param([{
                    name: 'email_id',
                    value: email_id
                }, {
                    name: 'contact_id',
                    value: contact_id
                }, {
                    name: "action",
                    value: "patient_contact_email_delete"
                }, {
                    name: 'csrf_token',
                    value: token
                }]),
                function (response) {
                    handler['callback_delete_email'](response, $el);
                },
                function (response) {
                    callback_delete_fail(response, modal);
                }
            );
        },
        delete_address: function (modal, $el, contact_id) {
            let address_id = $el.data('id');
            let token = $('input[name="csrf_token"]').eq(0).val();

            make_call(
                '/my-account/ajax',
                $.param([{
                    name: 'address_id',
                    value: address_id
                }, {
                    name: 'contact_id',
                    value: contact_id
                }, {
                    name: "action",
                    value: "patient_contact_address_delete"
                }, {
                    name: 'csrf_token',
                    value: token
                }]),
                function (response) {
                    handler['callback_delete_address'](response, $el);
                },
                function (response) {
                    callback_delete_fail(response, modal);
                }
            );
        },
        delete_phone: function (modal, $el, contact_id) {
            let phone_id = $el.data('id');
            let token = $('input[name="csrf_token"]').eq(0).val();

            make_call(
                '/my-account/ajax',
                $.param([{
                    name: 'phone_id',
                    value: phone_id
                }, {
                    name: 'contact_id',
                    value: contact_id
                }, {
                    name: "action",
                    value: "patient_contact_phone_delete"
                }, {
                    name: 'csrf_token',
                    value: token
                }]),
                function (response) {
                    handler['callback_delete_phone'](response, $el);
                },
                function (response) {
                    callback_delete_fail(response, modal);
                }
            );
        },
        delete_contact: function (modal, $el, contact_id) {
            let token = $('input[name="csrf_token"]').eq(0).val();
            make_call(
                '/my-account/ajax',
                $.param([{
                    name: 'contact_id',
                    value: contact_id
                }, {
                    name: "action",
                    value: "patient_contact_delete"
                }, {
                    name: 'csrf_token',
                    value: token
                }]),
                function (response) {
                    handler['callback_delete_contact'](response, $el);
                },
                function (response) {
                    callback_delete_fail(response, modal);
                }
            );
        },
        submit_form: function (modal, callback) {
            var form = modal.find('form');
            var contact_id = form.find('input[name="contact_id"]').val();
            if (form[0].checkValidity() === false) {
                display_errors(form[0]);
            } else {
                make_call(
                    '/my-account/ajax',
                    $.param(form.serializeArray()),
                    function (response) {
                        if (!!handler[callback]) {
                            handler[callback](response, contact_id);
                        }
                        callback_after_success(response, modal);
                    },
                    function (response) {
                        callback_fail(response, modal);
                    }
                )
            }
        },
        prepare_contact: function (data) {
            let modal = $('div.modal#contactUpdateModal');
            modal.find('input[name="contact_id"]').val(data.id);
            modal.find('input[name="salutation"]').val(data.salutation);
            modal.find('input[name="first_name"]').val(data.first_name);
            modal.find('input[name="middle_name"]').val(data.middle_name);
            modal.find('input[name="last_name"]').val(data.last_name);
            modal.find('select[name="relation"]').val(data.relation);
            modal.modal('show');
        },
        prepare_email: function (data) {
            let modal = $('div.modal#contactEmailAddressUpdateModal');
            modal.find('input[name="contact_id"]').val(data.contact_id);
            modal.find('input[name="email_id"]').val(data.email_id);
            modal.find('input[name="email_address"]').val(data.email);
            modal.modal('show');
        },
        prepare_phone: function (data) {
            let modal = $('div.modal#contactPhoneNumberUpdateModal');
            modal.find('input[name="contact_id"]').val(data.contact_id);
            modal.find('input[name="phone_id"]').val(data.phone_id);
            modal.find('input[name="ctry_cd"]').val(data.ctry_code);
            modal.find('input[name="area_cd"]').val(data.area_code);
            modal.find('input[name="phone_no"]').val(data.phone_no);
            modal.find('input[name="ext"]').val(data.extension);
            modal.modal('show');
        },
        prepare_address: function (data) {
            let modal = $('div.modal#contactAddressUpdateModal');
            modal.find('input[name="contact_id"]').val(data.contact_id);
            modal.find('input[name="address_id"]').val(data.id);
            modal.find('input[name="street_add_1"]').val(data.street_addr_1);
            modal.find('input[name="street_add_2"]').val(data.street_addr_2);
            modal.find('input[name="street_add_3"]').val(data.street_addr_3);
            modal.find('input[name="city"]').val(data.city);
            modal.find('input[name="state"]').val(data.state);
            modal.find('input[name="zipcode"]').val(data.zipcode);
            modal.find('select[name="country"]').val(data.country);
            modal.modal('show');
        },
    }

    $('div.modal:not(#deleteConfirmationModal)').on('hidden.bs.modal', function (e) {
        let form = $(this).find('form')[0];
        if (form) {
            form.reset();
            form.classList.remove('was-validated');
            $(this).find('.alert.alert-danger').addClass('d-none');
        }
    }).on('show.bs.modal', function (e) {
        let $collapse = $(e.relatedTarget).closest('div.collapse');
        if (!!$collapse && $collapse.length > 0) {
            let contact_id = $collapse[0].id.replace(prefix, '');
            $(this).find('form').find('input[name="contact_id"]').val(contact_id);
        }
    }).find('button.btn-primary').click(function () {
        let callback = this.id.replace('btn', 'callback');
        let modal = $(this).closest('div.modal');
        handler.submit_form(modal, callback);
    });

    $('div.modal#deleteConfirmationModal').on('show.bs.modal', function (e) {
        let contact_id = $(e.relatedTarget).closest('li.list-group-item.single-contact').find('div.collapse')[0].id.replace(prefix, '');
        let action_for = $(e.relatedTarget).data('for');
        let action = 'delete_' + action_for;
        let modal = $(this);
        modal.find('.alert.alert-danger').addClass('d-none');
        $(this).find('button.btn-primary').bind('click', function () {
            if (!!handler[action]) {
                handler[action](modal, $(e.relatedTarget).closest('.single-' + action_for), contact_id);
                modal.modal('hide');
            }
        });
    }).on('hidden.bs.modal', function (e) {
        $(this).find('button.btn-primary').unbind();
    })

    function display_errors(form) {
        form.classList.add('was-validated');
    }

    function callback_delete_fail(response, modal) {
        modal.find('.alert.alert-danger.d-none').removeClass('d-none');
    }

    function callback_fail(response, modal) {
        modal.find('.alert.alert-danger.d-none').removeClass('d-none');
    }

    function callback_after_success(response, modal) {
        modal.modal('hide');
    }

    function make_call(endpoint, data, success, failure) {
        $.post(
            endpoint,
            data,
            success
        ).fail(failure);
    }

    $('body').on('click', 'button.edit', function () {
        let action_for = $(this).data('for');
        let id = $(this).closest('.single-' + action_for).data('id');

        $.get(`/my-account/json/patient-${action_for}/${id}`, null, function (response) {
            let prepare_function = 'prepare_' + action_for;
            if (response.success && !!handler[prepare_function]) {
                handler[prepare_function](response.html);
            } else {
                console.log("Unable to process request");
            }
        })
    })

    let $favorite_form = $('form#frm_patient_favorites');
    $favorite_form.find('i.icon-favorite').click(function () {

        let reference_id = $(this).data('id');
        let type = $(this).data('type');
        let ref = this;
        let token = $favorite_form.find('input[name="csrf_token"]').eq(0).val();
        make_call(
            '/my-account/ajax',
            $.param([{
                name: 'type',
                value: type
            }, {
                name: 'reference_id',
                value: reference_id
            }, {
                name: "action",
                value: 'unmark_favorite'
            }, {
                name: 'csrf_token',
                value: token
            }]),
            function (response) {
                $row = $(ref).closest('div.row');
                $(ref).closest('div.single-item').remove();
                if ($row.find('div.single-item').length === 0) {
                    $row.find('div.not-found').removeClass('d-none');
                }
            }
        );
    });

    if ($.datepicker) {
        $("input#date_of_birth").datepicker({
            inline: true,
            showOn: "button",
            buttonImage: "/assets/images/calendar.jpeg",
            buttonImageOnly: true,
            dateFormat: 'mm/dd/yy',
            changeMonth: true,
            changeYear: true,
            minDate: '-100y',
            yearRange: 'c-100:c',
            maxDate: new Date()
        });
    }
});