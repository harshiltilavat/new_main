// $(document).ready(function() {
//   $('#myform').submit(function(event) {
//       var isValid = true;

//       // Clear previous error messages
//       $('.error').text('');

//       // Validate Username
//       var username = $("#username").val().trim();
//       var minLength = 5;

//       if (username === "" || username.length < minLength) {
//           isValid = false;
//           $("#username").addClass("error");
//           $("#username-error").text(username === "" ? "Please Enter Username" : "Username must be at least " + minLength + " characters long");
//       } else {
//           $("#username").removeClass("error");
//           $("#username-error").text("");
//       }

//     //   // Validate Email
//     //   var email = $("#email").val().trim();
//     //   var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     //   if (email === "" || !emailRegex.test(email)) {
//     //       isValid = false;
//     //       $("#email").addClass("error");
//     //       $("#email-error").text(email === "" ? "Please Enter Email" : "Please Enter Valid Email");
//     //   } else {
//     //       $("#email").removeClass("error");
//     //       $("#email-error").text("");
//     //   }

//     //   // Validate Gender
//     //   var gender = $("input[name='gender']:checked").val();
//     //   if (!gender) {
//     //       isValid = false;
//     //       $("input[name='gender']").addClass("error");
//     //       $("#gender-error").text("Please select any one");
//     //   } else {
//     //       $("input[name='gender']").removeClass("error");
//     //       $("#gender-error").text("");
//     //   }

//     //   // Validate Mobile
//     //   var mobile = $("#mobile").val().trim();
//     //   var mobileRegex = /^[0-9]{10}$/;
//     //   if (!mobileRegex.test(mobile)) {
//     //       isValid = false;
//     //       $("#mobile").addClass("error");
//     //       $("#number-error").text(mobile === "" ? "Please Enter Mobile Number" : "Please enter valid number");
//     //   } else {
//     //       $("#mobile").removeClass("error");
//     //       $("#number-error").text("");
//     //   }

//     //   // Validate Hobbies
//     //   var hobbies = $("input[name='hobbies[]']:checked").length;
//     //   if (hobbies === 0) {
//     //       isValid = false;
//     //       $("input[name='hobbies[]']").addClass("error");
//     //       $("#hobbies-error").text("Please choose at least one");
//     //   } else {
//     //       $("input[name='hobbies[]']").removeClass("error");
//     //       $("#hobbies-error").text("");
//     //   }

//     //   // Validate Image
//     //   var profileImageInput = $("#profile_image")[0];
//     //   var profileImage = profileImageInput.files[0];
//     //   if (!profileImage) {
//     //       isValid = false;
//     //       $("#profile_image").addClass("error");
//     //       $("#image-error").text("Please choose an image");
//     //   } else {
//     //       var fileType = profileImage.type;
//     //       var validImageTypes = ["image/jpeg", "image/png"];
//     //       if (!validImageTypes.includes(fileType)) {
//     //           isValid = false;
//     //           $("#profile_image").addClass("error");
//     //           $("#image-error").text("Please choose a valid image (JPG, JPEG, PNG)");
//     //       } else {
//     //           $("#profile_image").removeClass("error");
//     //           $("#image-error").text("");
//     //       }
//     //   }

//       // If validation fails, prevent form submission
//       if (!isValid) {
//           event.preventDefault();
//       }
//   });
// });