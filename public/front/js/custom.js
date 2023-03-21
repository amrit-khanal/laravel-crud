;(function ($) {
    $(document).ready(function () {
        var modal = $('.modal')
        var form = $('.form')
        var btnAdd = $('.add'),
            btnSave = $('.btn-save'),
            btnUpdate = $('.btn-update')

        btnAdd.click(function () {
            $('label.error').hide()
            $('.error').removeClass('error')
            modal.modal()
            form.trigger('reset')
            modal.find('.modal-title').text('Add New User')
            btnSave.show()
            btnUpdate.hide()
        })

        jQuery.validator.addMethod(
            'phoneNP',
            function (phone_number, element) {
                phone_number = phone_number.replace(/\s+/g, '')
                return (
                    this.optional(element) ||
                    (phone_number.length > 9 &&
                        phone_number.match(
                            /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/
                        ))
                )
            },
            'Please specify a valid phone number'
        )

        function validateField () {
            jQuery('#addUs').validate({
                rules: {
                    name: { required: true, minlength: 3 },
                    phone: { required: true, number: true, phoneNP: true },
                    email: { required: true, email: true },
                    gender: { required: true },
                    dob: { required: true }
                },
                messages: {
                    name: {
                        required: 'Please enter a name',
                        minlength: 'Name must consist of at least 3 characters'
                    },
                    gender: {
                        required: 'Please select gender'
                    },
                    phone: {
                        required: 'Please enter a Contact number',
                        phoneNP: 'Please enter valid phone number'
                    },
                    email: {
                        required: 'Please enter a Email',
                        email: 'Please enter valid email'
                    },
                    dob: {
                        required: 'Please enter date of birth'
                    }
                }
            })
        }

        btnUpdate.click(function () {
            if (!confirm('Are you sure?')) return
            validateField()

            if ($('#addUs').valid() == true) {
                var formData = form.serialize() + '&_method=PUT'
                var updateId = form.find('input[name="id"]').val()
                $.ajax({
                    type: 'POST',
                    url: '/users/' + updateId,
                    data: formData,
                    success: function (data) {
                        if (data.success) {
                            $.toast({
                                position: 'top-right',
                                heading: 'Success',
                                text: data.message,
                                showHideTransition: 'slide',
                                icon: 'success'
                            })
                            form.trigger('reset')
                            table.draw()
                            modal.modal('hide')
                        } else {
                            $.toast({
                                position: 'top-right',
                                heading: 'Error',
                                text: data.message,
                                showHideTransition: 'slide',
                                icon: 'error'
                            })
                        }
                    }
                })
            } else {
                return false
            }
        })

        $('#addUs')
            .unbind('submit')
            .bind('submit', function (e) {
                e.preventDefault()
                validateField()

                if ($('#addUs').valid() == true) {
                    var form = $(this)
                    var url = form.attr('action')
                    var type = form.attr('method')
                    var formData = new FormData($(this)[0])

                    $.ajax({
                        url: url,
                        type: type,
                        data: formData,
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: false,
                        success: function (response) {
                            if (response.success == true) {
                                $.toast({
                                    position: 'top-right',
                                    heading: 'Success',
                                    text: response.message,
                                    showHideTransition: 'slide',
                                    icon: 'success'
                                })
                                table.draw()
                                form.trigger('reset')
                                modal.modal('hide')
                            } else {
                                $.toast({
                                    position: 'top-right',
                                    heading: 'Error',
                                    text: response.message,
                                    showHideTransition: 'slide',
                                    icon: 'error'
                                })
                            }
                        }
                    })
                } else {
                    return false
                }
            })

        $(document).on('click', '.btn-edit', function () {
            $('label.error').hide()
            $('.error').removeClass('error')
            btnSave.hide()
            btnUpdate.show()

            modal.find('.modal-title').text('Update Record')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData = table.row($(this).parents('tr')).data()

            form.find('input[name="id"]').val(rowData.id)
            form.find('input[name="name"]').val(rowData.name)
            form.find('input[name="phone"]').val(rowData.phone)
            form.find('input[name="dob"]').val(rowData.dob)
            form.find('input[name="country"]').val(rowData.country)
            form.find('input[name="email"]').val(rowData.email)
            form.find('input[name="status"]').val(rowData.status)
            form.find('textarea[name="bio"]').val(
                rowData.bio !== 'NULL' ? rowData.bio : ''
            )
            $('input[name=gender][value=' + rowData.gender + ']').prop(
                'checked',
                true
            )
            modal.modal()
        })

        var table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '',
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'Email'
                },
                {
                    data: 'phone',
                    name: 'Phone'
                },
                {
                    data: 'dob',
                    name: 'Date of Birth'
                },
                {
                    data: 'gender',
                    name: 'Gender'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        })
    })
})(jQuery)
