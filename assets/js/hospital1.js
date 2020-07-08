$(document).ready(function () {
    var prefix = 'hospitalDetail';
    var handler = {
        handle: function (response, _cb) {
            if (response.success) {
                _cb(response);
            } else {
                let modal = $('div.modal#operationFailureAlertModal');
                modal.find('div.modal-body > div.alert').html(response.message);
                modal.modal('show');
                console.log(response.message);
            }
        },
        callback_delete_department: function (response, $el) {
            handler.handle(response, function (r) {
                let $parent = $el.parent();
                $el.remove();
                if ($parent.find('li:not(.not-found)').length == 0) {
                    $parent.find('li.not-found').removeClass('d-none');
                }
            });
        },
        callback_delete_service: function (response, $el) {
            handler.handle(response, function (r) {
                let $parent = $el.parent();
                $el.remove();
                if ($parent.find('div.single-service:not(.not-found)').length == 0) {
                    $parent.find('div.not-found').removeClass('d-none');
                }
            });
        },
        callback_delete_hospital_email: function (response, $el) {
            handler.handle(response, function (r) {
                let $parent = $el.parent();
                $el.remove();
                if ($parent.find('div.single-email').length == 0) {
                    $parent.find('div.not-found').removeClass('d-none');
                }
            });
        },
        callback_delete_hospital_address: function (response, $el) {
            handler.handle(response, function (r) {
                let $parent = $el.parent();
                $el.remove();
                if ($parent.find('div.single-address').length == 0) {
                    $parent.find('div.not-found').removeClass('d-none');
                }
            });
        },
        callback_delete_hospital_phone: function (response, $el) {
            handler.handle(response, function (r) {
                let $parent = $el.parent();
                $el.remove();
                if ($parent.find('div.single-phone').length == 0) {
                    $parent.find('div.not-found').removeClass('d-none');
                }
            });
        },
        delete_email: function (modal, $el) {
            let node = $el.closest('div.single-contact');
            let email_id = $el.data('id');
            let xref_id = node.data('xrefId');
            let token = $('input[name="csrf_token"]').eq(0).val();

            make_call(
                '/my-account/ajax',
                $.param([{
                    name: 'email_id',
                    value: email_id
                }, {
                    name: 'xref_id',
                    value: xref_id
                }, {
                    name: "action",
                    value: "hospital_contact_email_delete"
                }, {
                    name: 'csrf_token',
                    value: token
                }]),
                function (response) {
                    handler['callback_delete_hospital_email'](response, $el);
                },
                function (response) {
                    callback_delete_fail(response, modal);
                }
            );
        },
        delete_address: function (modal, $el) {
            let node = $el.closest('div.single-contact');
            let xref_id = node.data('xrefId');
            let address_id = $el.data('id');
            let token = $('input[name="csrf_token"]').eq(0).val();

            make_call(
                '/my-account/ajax',
                $.param([{
                    name: 'address_id',
                    value: address_id
                }, {
                    name: 'xref_id',
                    value: xref_id
                }, {
                    name: "action",
                    value: "hospital_contact_address_delete"
                }, {
                    name: 'csrf_token',
                    value: token
                }]),
                function (response) {
                    handler['callback_delete_hospital_address'](response, $el);
                },
                function (response) {
                    callback_delete_fail(response, modal);
                }
            );
        },
        delete_phone: function (modal, $el) {
            let node = $el.closest('div.single-contact');
            let xref_id = node.data('xrefId');
            let phone_id = $el.data('id');
            let token = $('input[name="csrf_token"]').eq(0).val();

            make_call(
                '/my-account/ajax',
                $.param([{
                    name: 'phone_id',
                    value: phone_id
                }, {
                    name: 'xref_id',
                    value: xref_id
                }, {
                    name: "action",
                    value: "hospital_contact_phone_delete"
                }, {
                    name: 'csrf_token',
                    value: token
                }]),
                function (response) {
                    handler['callback_delete_hospital_phone'](response, $el);
                },
                function (response) {
                    callback_delete_fail(response, modal);
                }
            );
        },
        callback_delete_contact: function (response, $el) {
            handler.handle(response, function (r) {
                let $parent = $el.parent();
                $el.remove();
                if ($parent.find('div.single-contact:not(.not-found)').length == 0) {
                    $parent.find('div.not-found').removeClass('d-none');
                }
            });
        },
        callback_delete_affiliate: function (response, $el) {
            handler.handle(response, function (r) {
                let $parent = $el.parent();
                $el.remove();
                if ($parent.children('li:not(.not-found)').length == 0) {
                    $parent.children('li.not-found').removeClass('d-none');
                }
            });
        },
        delete_contact: function (modal, $el) {
            let token = $('input[name="csrf_token"]').eq(0).val();
            let contact_id = $el.data('xrefId');
            make_call(
                '/my-account/ajax',
                $.param([{
                    name: 'contact_id',
                    value: contact_id
                }, {
                    name: "action",
                    value: "hospital_contact_detach"
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
        delete_service: function (modal, $el) {
            let token = $('input[name="csrf_token"]').eq(0).val();
            let service_id = $el.data('id');
            make_call(
                '/my-account/ajax',
                $.param([{
                    name: 'service_id',
                    value: service_id
                }, {
                    name: "action",
                    value: "hospital_service_detach"
                }, {
                    name: 'csrf_token',
                    value: token
                }]),
                function (response) {
                    handler['callback_delete_service'](response, $el);
                },
                function (response) {
                    callback_delete_fail(response, modal);
                }
            );
        },
        delete_department: function (modal, $el, hospital_id) {
            let token = $('input[name="csrf_token"]').eq(0).val();
            let department_id = $el.data('id');
            make_call(
                '/my-account/ajax',
                $.param([{
                    name: 'hospital_dept_id',
                    value: department_id
                }, {
                    name: 'hospital_id',
                    value: hospital_id
                }, {
                    name: "action",
                    value: "hospital_department_detach"
                }, {
                    name: 'csrf_token',
                    value: token
                }]),
                function (response) {
                    handler['callback_delete_department'](response, $el);
                },
                function (response) {
                    callback_delete_fail(response, modal);
                }
            );
        },
        delete_affiliate: function (modal, $el, hospital_id) {
            let token = $('input[name="csrf_token"]').eq(0).val();
            let affiliate_id = $el.data('id');
            make_call(
                '/my-account/ajax',
                $.param([{
                    name: 'affiliate_hospital_id',
                    value: affiliate_id
                }, {
                    name: 'hospital_id',
                    value: hospital_id
                }, {
                    name: "action",
                    value: "hospital_affiliate_detach"
                }, {
                    name: 'csrf_token',
                    value: token
                }]),
                function (response) {
                    handler['callback_delete_affiliate'](response, $el);
                },
                function (response) {
                    callback_delete_fail(response, modal);
                }
            );
        },
        callback_hospital_contact_email_address_update(response, hospital_id, department_id, modal) {
            let id = modal.find('input[name="email_id"]').val();
            $('div.single-email#row-email-' + id).replaceWith(response.html);
        },
        callback_hospital_contact_address_update(response, hospital_id, department_id, modal) {
            let id = modal.find('input[name="address_id"]').val();
            $('div.single-address#row-address-' + id).replaceWith(response.html);
        },
        callback_hospital_contact_phone_number_update(response, hospital_id, department_id, modal) {
            let id = modal.find('input[name="phone_id"]').val();
            $('div.single-phone#row-phone-' + id).replaceWith(response.html);
        },
        callback_hospital_department_attach: function (response, hospital_id) {
            let list = $(`ul.departments-list`);
            list.find('li.not-found').addClass('d-none').before(response.html);
        },
        callback_hospital_contact_add: function (response, hospital_id, department_id) {
            let list = $(`li#row-department-${department_id} div.contacts-list`);
            list.children('div.not-found').addClass('d-none').before(response.html);
        },
        callback_hospital_contact_address_add: function (response, hospital_id, department_id, modal) {
            $xref_id = modal.find('input[name="xref_id"]').val();
            let list = $('div#contactDetail' + $xref_id).find('div.address-list');
            list.children('div.not-found').addClass('d-none').before(response.html);
        },
        callback_hospital_contact_email_address_add: function (response, hospital_id, department_id, modal) {
            $xref_id = modal.find('input[name="xref_id"]').val();
            let list = $('div#contactDetail' + $xref_id).find('div.emails-list');
            list.children('div.not-found').addClass('d-none').before(response.html);
        },
        callback_hospital_contact_phone_number_add: function (response, hospital_id, department_id, modal) {
            $xref_id = modal.find('input[name="xref_id"]').val();
            let list = $('div#contactDetail' + $xref_id).find('div.phones-list');
            list.children('div.not-found').addClass('d-none').before(response.html);
        },
        callback_hospital_contact_update: function (response, hospital_id, department_id, modal) {
            xref_id = modal.find('input[name="xref_id"]').val();
            $('div.single-contact[data-xref-id=' + xref_id + ']').replaceWith(response.html);
        },
        callback_hospital_service_attach: function (response, hospital_id, department_id) {
            let list = $(`li#row-department-${department_id} div.services-list`);
            list.find('div.not-found').addClass('d-none').before(response.html);
        },
        callback_hospital_service_update: function (response) {
            let id = $(response.html)[0].id;
            $('div#' + id).replaceWith(response.html);
        },
        callback_hospital_affiliate_attach: function (response, hospital_id) {
            let list = $(`ul.affiliates-list`);
            list.find('li.not-found').addClass('d-none').before(response.html);
        },
        submit_form: function (modal, callback) {
            var form = modal.find('form');
            var hospital_id = form.find('input[name="hospital_id"]').val();
            var department_id = form.find('input[name="department_id"]').val();
            if (form[0].checkValidity() === false) {
                display_errors(form[0]);
            } else {
                make_call(
                    '/my-account/ajax',
                    $.param(form.serializeArray()),
                    function (response) {
                        if (!!handler[callback]) {
                            handler[callback](response, hospital_id, department_id, modal);
                        }
                        callback_after_success(response, modal);
                    },
                    function (response) {
                        callback_fail(response, modal);
                    }
                )
            }
        },
        prepare_hospital: function (data) {
            let modal = $('div.modal#hospitalUpdateModal');
            modal.find('input[name="hospital_id"]').val(data.hospital_id);
            modal.find('input[name="hospital_name"]').val(data.hospital_name);
            modal.find('input[name="hospital_type"]').val(data.hospital_type);
            modal.find('input[name="hospital_url"]').val(data.hospital_url);
            modal.find('select[name="in_contract"]').val(data.in_contract);
            modal.modal('show');
        },
        prepare_services: function (data, hospital_id, department_id) {
            let modal = $('div.modal#serviceAttachModal');
            modal.find('div#new_service').addClass('d-none');
            let list = $(`li#row-department-${department_id} div.services-list > div`);
            modal.find('select').html(handler.make_dropdown(data, list, 'service-id'));
            $('<option value="add_new">-- Add New --</option>').insertAfter(modal.find('select option.first'));
            modal.find('select').unbind('change').bind('change', function () {
                $el = modal.find('div#new_service');
                if ($(this).val() === 'add_new') {
                    $el.removeClass('d-none');
                } else {
                    $el.addClass('d-none');
                }
            });
            modal.find('input[name="hospital_id"]').val(hospital_id);
            modal.find('input[name="department_id"]').val(department_id);
            modal.modal('show');
        },
        prepare_service: function (data) {
            let modal = $('div.modal#serviceUpdateModal');
            modal.find('input[name="hs_id"]').val(data.hs_id);
            modal.find('input[name="hospital_id"]').val(data.hospital_id);
            modal.find('input[name="department_id"]').val(data.department_id);
            modal.find('div.service_name').text(data.service_name);
            modal.find('input[name="min_price"]').val(data.min_price);
            modal.find('input[name="max_price"]').val(data.max_price);
            modal.find('textarea[name="comments"]').val(data.comments);
            modal.modal('show');
        },
        prepare_contacts: function (data, hospital_id, department_id) {
            let modal = $('div.modal#contactAttachModal');
            let list = $(`li#row-hospital-${hospital_id} li#row-department-${department_id} div.contacts-list > div`);
            modal.find('select').html(handler.make_dropdown(data, list, 'contact-id'));
            modal.find('input[name="hospital_id"]').val(hospital_id);
            modal.find('input[name="department_id"]').val(department_id);
            modal.modal('show');
        },
        prepare_departments: function (data, hospital_id) {
            let modal = $('div.modal#departmentAttachModal');
            modal.find('div#new_department').addClass('d-none');
            let list = $(`li#row-hospital-${hospital_id} ul.departments-list li`);
            modal.find('select').html(handler.make_dropdown(data, list));
            $('<option value="add_new">-- Add New --</option>').insertAfter(modal.find('select option.first'));
            modal.find('select').unbind('change').bind('change', function () {
                $el = modal.find('div#new_department');
                if ($(this).val() === 'add_new') {
                    $el.removeClass('d-none');
                } else {
                    $el.addClass('d-none');
                }
            });
            modal.find('input[name="hospital_id"]').val(hospital_id);
            modal.modal('show');
        },
        prepare_affiliates: function (data, hospital_id) {
            let modal = $('div.modal#affiliateAttachModal');
            let list = $(`ul.affiliates-list > li`);
            modal.find('select').html(handler.make_dropdown(data, list));
            modal.find('input[name="hospital_id"]').val(hospital_id);
            modal.modal('show');
        },
        prepare_hospital_contact: function (data, contact_id, xref_id) {
            let modal = $('div.modal#contactUpdateModal');

            modal.find('input[name="xref_id"]').val(xref_id);
            modal.find('input[name="contact_id"]').val(data.contact_id);
            modal.find('input[name="salutation"]').val(data.salutation);
            modal.find('input[name="first_name"]').val(data.first_name);
            modal.find('input[name="middle_name"]').val(data.middle_name);
            modal.find('input[name="last_name"]').val(data.last_name);
            modal.find('input[name="job_title"]').val(data.job_title);
            modal.find('input[name="job_function"]').val(data.job_function);
            modal.find('input[name="job_role"]').val(data.job_role);
            modal.modal('show');
        },
        prepare_hospital_email: function (data) {
            let modal = $('div.modal#contactEmailAddressUpdateModal');
            modal.find('input[name="email_id"]').val(data.email_id);
            modal.find('input[name="email_address"]').val(data.email);
            modal.modal('show');
        },
        prepare_hospital_phone: function (data) {
            let modal = $('div.modal#contactPhoneNumberUpdateModal');
            modal.find('input[name="phone_id"]').val(data.phone_id);
            modal.find('input[name="ctry_cd"]').val(data.ctry_code);
            modal.find('input[name="area_cd"]').val(data.area_code);
            modal.find('input[name="phone_no"]').val(data.phone_no);
            modal.find('input[name="ext"]').val(data.extension);
            modal.modal('show');
        },
        prepare_hospital_address: function (data) {
            let modal = $('div.modal#contactAddressUpdateModal');
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
        make_dropdown: function (data, list, identifier = 'id') {
            let html = '<option class="first">-- Select --</option>';
            for (i in data) {
                if (list.filter(`[data-${identifier}="${data[i].id}"]`).length > 0) continue;
                html += `<option value="${data[i].id}">${data[i].label}</option>`;
            }
            return html;
        }
    }

    $('div.modal:not(#deleteConfirmationModal)').on('hidden.bs.modal', function (e) {
        let form = $(this).find('form')[0];
        if (form) {
            form.reset();
            form.classList.remove('was-validated');
            $(this).find('.alert.alert-danger').addClass('d-none');
        }
    }).on('show.bs.modal', function (e) {
        if (this.id == 'contactAddModal') {
            $btn = $(e.relatedTarget);
            let hospital_id = $('input#hospital_id').val();
            let department_id = $($btn).closest('li.single-department').data('id');
            $(this).find('input[name="hospital_id"]').val(hospital_id);
            $(this).find('input[name="department_id"]').val(department_id);
        } else if (this.id == 'contactAddressAddModal' || this.id == 'contactEmailAddressAddModal' || this.id == 'contactPhoneNumberAddModal') {
            $btn = $(e.relatedTarget);
            $data = $btn.closest('div.single-contact').data();
            $(this).find('input[name="contact_id"]').val($data.id);
            $(this).find('input[name="xref_id"]').val($data.xrefId);
        }
    }).find('button.btn-primary').click(function () {
        let callback = this.id.replace('btn', 'callback');
        let modal = $(this).closest('div.modal');
        handler.submit_form(modal, callback);
    });

    $('div.modal#deleteConfirmationModal').on('show.bs.modal', function (e) {
        let hospital_id = $('input#hospital_id').val();
        let action_for = $(e.relatedTarget).data('for');
        let action = 'delete_' + action_for;
        let modal = $(this);
        modal.find('.alert.alert-danger').addClass('d-none');
        $(this).find('button.btn-primary').bind('click', function () {
            if (!!handler[action]) {
                handler[action](modal, $(e.relatedTarget).closest('.single-' + action_for), hospital_id);
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
        var id = null;
        var did = null;
        if (action_for == 'hospital_contact') {
            id = $(this).closest('div.single-contact').data('id');
            did = $(this).closest('div.single-contact').data('xrefId');
        } else if (action_for == 'hospital_address' || action_for == 'hospital_phone' || action_for == 'hospital_email') {
            id = $(this).closest('div.single-' + action_for.replace('hospital_', '')).data('id');
        } else if (action_for == 'service') {
            id = $(this).closest('div.single-service').data('id');
        } else {
            id = $('input#hospital_id').val();
            did = $(this).closest('li.single-department').data('id');
        }

        $.get(`/my-account/json/${action_for}/${id}`, null, function (response) {
            let prepare_function = 'prepare_' + action_for;
            if (response.success && !!handler[prepare_function]) {
                handler[prepare_function](response.html, id, did);
            } else {
                console.log("Unable to process request");
            }
        })
    })
});