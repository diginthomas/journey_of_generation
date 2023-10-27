$("#edit-profile-form").validate({
    rules: {
        first_name: {
            required: true,
            minlength: 3,
            maxlength: 30,
        },

        last_name: {
            required: true,
            minlength: 3,
            maxlength: 30,
        },

        phone: {
            minlength: 8,
            maxlength: 12,
        },
        // user_image:{
        //     extension: "jpg|jpeg|png|ico|bmp"
        // }
    },
    messages: {
        first_name: {
            required: " Please enter first name",
            minlength: "Minimum 3 character required",
            maxlength: "Maximum 30 character is allowed",
        },
        last_name: {
            required: " Please enter last name",
            // minlength: "Minimum 3 character required",
            maxlength: "Maximum 30 character is allowed",
        },

        phone: {
            minlength: "Please enter valid phone number",
            maxlength: "Please enter valid phone number",
        },
        // user_image:{
        //     extension: "Invalid image"
        // }
    },

    submitHandler: function (form, e) {
        e.preventDefault();
        $("#edit-profile-submit").prop("disabled", true);
        $("#edit-profile-submit").html("saving...");
        var formData = new FormData(form);
        //  console.log(form);
        $.ajax({
            url: "/profile/update",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            data: formData,
            statusCode: {
                500: function () {
                    toastr.error("Error,Please try again");
                    $("#edit-profile-submit").prop("disabled", false);
                    $("#edit-profile-submit").html("save");
                },
            },
            success: function (data) {
                if (data["error"] != null) {
                    toastr.error(data["error"]);
                } else {
                    window.location.replace("/profile");
                    toastr.success("profile updated");
                }
                $("#edit-profile-submit").prop("disabled", false);
                $("#edit-profile-submit").html("save");
            },
        });
    },
});

$("#change-password-form").validate({
    rules: {
        old_password: {
            required: true,
        },
        new_password: {
            required: true,
            minlength: 8,
        },
        password_confirmation: {
            required: true,
            minlength: 8,
            equalTo: "#new-password",
        },
    },
    messages: {
        old_password: {
            required: "Please enter old password",
        },
        new_password: {
            required: "Please enter password",
            minlength: "At least 8 character required",
        },
        password_confirmation: {
            required: "Please enter password",
            minlength: "At least 8 character required",
            equalTo: "Password does not match",
        },
    },

    submitHandler: function (form, e) {
        e.preventDefault();
        $("#change-password-submit").prop("disabled", true);
        $("#change-password-submit").html("changing...");
        var formData = new FormData(form);
        $.ajax({
            url: "/profile/change/password",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            data: formData,
            statusCode: {
                500: function () {
                    toastr.error("Error,Please try again ");
                    $("#change-password-submit").prop("disabled", false);
                    $("#change-password-submit").html("Change Password");
                },
            },
            success: function (data) {
                if (data["error"] != null) {
                    toastr.error(data["error"]);
                } else {
                    window.location.replace("/logout");
                    toastr.success("Password updated");
                }
                $("#change-password-submit").prop("disabled", false);
                $("#change-password-submit").html("Change Password");
            },
        });
    },
});
