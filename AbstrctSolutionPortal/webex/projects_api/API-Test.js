$(document).ready(function () {
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
});

function GetProjects() {

  let APIBaseUrl = $('#APIBaseURL').val();

  $.ajax({
    url: APIBaseUrl + '/projects/',
    type: 'GET',
    contentType: 'application/json',
    dataType: 'json',
    cache: false,
    success: function (data, textStatus, xhr) {
      $('td#GetProjectsStatusCode').html(xhr.status);
      $('td#GetProjectsoutput').html(JSON.stringify(data));
    },
    error: function (xhr, textStatus, errorThrown) {
      $('td#GetProjectsStatusCode').html(xhr.status);
      $('td#GetProjectsoutput').html(errorThrown);
      console.log(errorThrown);
    }
  });
}

function GetUploadProjectById() {
  let APIBaseUrl = $('#APIBaseURL').val();
  let projectId = $('#getProjectId').val();

  $.ajax({
    url: APIBaseUrl + '/projects/s/' + projectId + '/',
    type: 'GET',
    contentType: 'application/json',
    dataType: 'json',
    cache: false,
    success: function (data, textStatus, xhr) {
      $('td#GetProjectStatusCode').html(xhr.status);
      $('td#GetProjectoutput').html(JSON.stringify(data));
    },
    error: function (xhr, textStatus, errorThrown) {
      $('td#GetProjectStatusCode').html(xhr.status);
      $('td#GetProjectoutput').html(errorThrown);
      console.log(errorThrown);
    }
  });
}

function uploadProject() {

  var form = new FormData();
  form.append('file', $('#fileupload').get(0).files[0]);
  form.append('userId',  $('#uploadUserId').val());
  $.ajax({
    url: 'ajaxupload.php',
    type: 'POST',
    processData: false, // Don't process the files
    contentType: false, 
    mimeType: 'multipart/form-data',
    data: form,
    cache: false,
    success: function (data, textStatus, xhr) {
      $('td#UploadProjectStatusCode').html(xhr.status);
      $('td#UploadProjectsoutput').html(JSON.stringify(data));
    },
    error: function (xhr, textStatus, errorThrown) {
      $('td#UploadProjectStatusCode').html(xhr.status);
      $('td#UploadProjectsoutput').html(errorThrown);
      console.log(errorThrown);
    }
  });
}

function updateProjectMetaData() {
  let APIBaseUrl = $('#APIBaseURL').val();
  let projectId = $('#projectId').val();

  $.ajax({
    url: APIBaseUrl + '/projects/u/' + projectId + '/',
    type: 'POST',
    contentType: 'application/json',
    dataType: 'json',
    cache: false,
    data: JSON.stringify({
      "displayName": $('#update_metadata_displayname').val(),
      "description": $('#update_metadata_description').val()
    }),
    success: function (data, textStatus, xhr) {
      $('td#UpdateProjectMetadataStatusCode').html(xhr.status);
      $('td#UpdateProjectMetadataoutput').html(JSON.stringify(data));
    },
    error: function (xhr, textStatus, errorThrown) {
      $('td#UpdateProjectMetadataStatusCode').html(xhr.status);
      $('td#UpdateProjectMetadataoutput').html(errorThrown);
      console.log(errorThrown);
    }
  });
}

function deleteProject() {

  let APIBaseUrl = $('#APIBaseURL').val();
  let projectId = $('#delete_projectId').val();

  $.ajax({
    url: APIBaseUrl + '/projects/d/' + projectId+ '/',
    type: 'POST',
    contentType: 'application/json',
    cache: false,
    dataType: 'json',
    success: function (data, textStatus, xhr) {
      $('td#DeleteProjectStatusCode').html(xhr.status);
      $('td#DeleteProjectoutput').html(JSON.stringify(data));
    },
    error: function (xhr, textStatus, errorThrown) {
      $('td#DeleteProjectStatusCode').html(xhr.status);
      $('td#DeleteProjectoutput').html(errorThrown);
      console.log(errorThrown);
    }
  });
}

function shareProject() {
  let APIBaseUrl = $('#APIBaseURL').val();
  let projectId = $('#shareproject_projectId').val();

  $.ajax({
    url: APIBaseUrl + '/projects/' + projectId + '/share/',
    type: 'POST',
    contentType: 'application/json',
    dataType: 'json',
    data: $('#shareproject_userids').val(),
    cache: false,
    success: function (data, textStatus, xhr) {
      $('td#ShareProjectStatusCode').html(xhr.status);
      $('td#ShareProjectoutput').html(JSON.stringify(data));
    },
    error: function (xhr, textStatus, errorThrown) {
      $('td#ShareProjectStatusCode').html(xhr.status);
      $('td#ShareProjectoutput').html(xhr.responseText);
      console.log(errorThrown);
    }
  });
}

function unshareProject() {
  let APIBaseUrl = $('#APIBaseURL').val();
  let projectId = $('#unshareproject_projectId').val();

  $.ajax({
    url: APIBaseUrl + '/projects/' + projectId + '/unshare/',
    type: 'POST',
    contentType: 'application/json',
    dataType: 'json',
    data: $('#unshareproject_userids').val(),
    cache: false,
    success: function (data, textStatus, xhr) {
      $('td#UnshareProjectStatusCode').html(xhr.status);
      $('td#UnshareProjectoutput').html(JSON.stringify(data));
    },
    error: function (xhr, textStatus, errorThrown) {
      $('td#UnshareProjectStatusCode').html(xhr.status);
      $('td#UnshareProjectoutput').html(xhr.responseText);
      console.log(errorThrown);
    }
  });
}

function CopyToClipboard(containerid) {
  if (window.getSelection) {
    if (window.getSelection().empty) {
      window.getSelection().empty();
    } else if (window.getSelection().removeAllRanges) {
      window.getSelection().removeAllRanges();
    }
  } else if (document.selection) {
    document.selection.empty();
  }
  let range = document.createRange();
  range.selectNode(document.getElementById(containerid));
  window.getSelection().addRange(range);
  document.execCommand("Copy", false, null);;
}