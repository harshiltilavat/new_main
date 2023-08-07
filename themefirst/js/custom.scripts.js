$(document).ready(function($) {
    $('#myform').submit(function(e) {
        e.preventDefault();       

        var isValid = true;

        // Username
        var username = $("#username").val();
        var minLength = 5;
        if (username.trim() === "" || username.length < minLength) {
            isValid = false;
            $("#username").addClass("error");
            if (username.length === 0) {
                $("#username-error").text("Please Enter Username");
            } else {
                $("#username-error").text("Username must be at least " + minLength + " characters long");
            }
        } else {
            $("#username").removeClass("error");
            $("#username-error").text("");
        }

        // Email
        var email = $("#email").val();
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.trim() === "" || !emailRegex.test(email)) {
            isValid = false;
            $("#email").addClass("error");
            $("#email-error").text("Please Enter Valid Email");
        } else {
            $("#email").removeClass("error");
            $("#email-error").text("");
        }

        // Gender
        var gender = $("input[name='gender']:checked").val();
        if (!gender) {
            isValid = false;
            $("input[name='gender']").addClass("error");
            $("#gender-error").text("Please select any one");
        } else {
            $("input[name='gender']").removeClass("error");
            $("#gender-error").text("");
        }

        // Mobile
        var mobile = $("#mobile").val();
        var mobileRegex = /^[0-9]{10}$/;
        if (!mobileRegex.test(mobile)) {
            isValid = false;
            $("#mobile").addClass("error");
            $("#number-error").text("Please enter valid number");
        } else {
            $("#mobile").removeClass("error");
            $("#number-error").text("");
        }

        // Hobbies
        var hobbies = $("input[name='hobbies[]']:checked").length;
        if (hobbies === 0) {
            isValid = false;
            $("input[name='hobbies[]']").addClass("error");
            $("#hobbies-error").text("Please choose at least one");
        } else {
            $("input[name='hobbies[]']").removeClass("error");
            $("#hobbies-error").text("");
        }

        // Image
        var profileImageInput = $("#profile_image")[0];
        var profileImage = profileImageInput.files[0];
        if (!profileImage) {
            isValid = false;
            $("#profile_image").addClass("error");
            $("#image-error").text("Please choose an image");
        } else {
            var fileType = profileImage.type;
            var validImageTypes = ["image/jpeg", "image/png"];
            if (!validImageTypes.includes(fileType)) {
                isValid = false;
                $("#profile_image").addClass("error");
                $("#image-error").text("Please choose a valid image (JPG, JPEG, PNG)");
            } else {
                $("#profile_image").removeClass("error");
                $("#image-error").text("");
            }
        }

        if (isValid) {
            var formData = new FormData(this);
            formData.append('action', 'form_submission_data');
            formData.append('mynonce', form_submission_data.mynonce);
            formData.append('hobbies', $('input[name="hobbies[]"]:checked').map(function(){return this.value;}).get());


            $.ajax({
                url: form_submission_data.myajaxurl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {                    
                    
                    if (response === 'success') {
                        console.log('Form submitted successfully!');
                        
                    } else {
                        console.log('Form submission failed.');
                    }
                    
                },
                error: function(xhr, status, error) {
                    
                    console.log('AJAX request failed:', status, error);
                    alert('An error occurred during form submission.');                    
                }
            });
        }
    });
});
