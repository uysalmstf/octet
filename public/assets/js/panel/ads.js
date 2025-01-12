function addTypeSave(page_id) {
  "use strict";

  document.getElementById("page_button").disabled = true;
  document.getElementById("page_button").innerHTML = "Please Wait...";

  var formData = new FormData();

  if (page_id != "undefined") {
    formData.append("page_id", page_id);
  } else {
    formData.append("page_id", null);
  }
  formData.append("title", $("#title").val());
  formData.append("type", $("#type").val());

  console.log(formData);

  $.ajax({
    type: "post",
    url: "/dashboard/admin/ad_types/save",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      toastr.success("Ad Type Saved Succesfully.");
      document.getElementById("page_button").disabled = false;
      document.getElementById("page_button").innerHTML = "Save";
    },
    error: function (data) {
      var err = data.responseJSON.errors;
      $.each(err, function (index, value) {
        toastr.error(value);
      });
      document.getElementById("page_button").disabled = false;
      document.getElementById("page_button").innerHTML = "Save";
    },
  });
  return false;
}

function addSave(page_id) {
  "use strict";

  document.getElementById("page_button").disabled = true;
  document.getElementById("page_button").innerHTML = "Please Wait...";

  var formData = new FormData();

  if (page_id != "undefined") {
    formData.append("page_id", page_id);
  } else {
    formData.append("page_id", null);
  }
  formData.append("title", $("#title").val());
  formData.append("ad_type_id", $("#ad_type_id").val());
  formData.append("redirected_url", $("#redirected_url").val());

  console.log(formData);

  $.ajax({
    type: "post",
    url: "/dashboard/admin/ads/save",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      toastr.success("Ad Saved Succesfully.");
      document.getElementById("page_button").disabled = false;
      document.getElementById("page_button").innerHTML = "Save";
    },
    error: function (data) {
      var err = data.responseJSON.errors;
      $.each(err, function (index, value) {
        toastr.error(value);
      });
      document.getElementById("page_button").disabled = false;
      document.getElementById("page_button").innerHTML = "Save";
    },
  });
  return false;
}
