function GetUserInfo() {
  let APIBaseUrl = $('#APIBaseURL').val();
  let userId = $('#getUserInfoId').val();
  $.ajax({
    url: APIBaseUrl + '/users/s/' + userId + '/',
    type: 'GET',
    contentType: 'application/json',
    dataType: 'json',
    cache: false,
    success: function (data, textStatus, xhr) {
      $('td#GetUserInfoStatusCode').html(xhr.status);
      $('td#GetUserInfooutput').html(JSON.stringify(data));
    },
    error: function (xhr, textStatus, errorThrown) {
      $('td#GetUserInfoStatusCode').html(xhr.status);
      $('td#GetUserInfooutput').html(errorThrown);
      console.log(errorThrown);
    }
  });
}

function GetUsers() {
  let APIBaseUrl = $('#APIBaseURL').val();

  $.ajax({
    url: APIBaseUrl + '/users/',
    type: 'GET',
    contentType: 'application/json',
    dataType: 'json',
    cache: false,
    success: function (data, textStatus, xhr) {
      $('td#GetUserstatusCode').html(xhr.status);
      $('td#GetUsersoutput').html(JSON.stringify(data));
    },
    error: function (xhr, textStatus, errorThrown) {
      $('td#GetUserstatusCode').html(xhr.status);
      $('td#GetUsersoutput').html(errorThrown);
      console.log(errorThrown);
    }
  });
}

function UpdateUser() {
  let APIBaseUrl = $('#APIBaseURL').val();
  let userId = $('#updateUserId').val();
  let model = $('#update_user_displayname_group').val();

  $.ajax({
    url: APIBaseUrl + '/users/u/' + userId + '/',
    type: 'POST',
    contentType: 'application/json',
    dataType: 'json',
    data: model,
    cache: false,
    success: function (data, textStatus, xhr) {
      $('td#UpdateUserInfoStatusCode').html(xhr.status);
      $('td#UpdateUserInfooutput').html(JSON.stringify(data));
    },
    error: function (xhr, textStatus, errorThrown) {
      $('td#UpdateUserInfoStatusCode').html(xhr.status);
      $('td#UpdateUserInfooutput').html(errorThrown);
      console.log(errorThrown);
    }
  });
}

function InsertUser() {
  let APIBaseUrl = $('#APIBaseURL').val();
  let model = $('#insert_user_displayname_group').val();

  $.ajax({
    url: APIBaseUrl + '/users/new/',
    type: 'POST',
    contentType: 'application/json',
    dataType: 'json',
    data: model,
    cache: false,
    success: function (data, textStatus, xhr) {
      $('td#InsertUserInfoStatusCode').html(xhr.status);
      $('td#InsertUserInfooutput').html(JSON.stringify(data));
    },
    error: function (xhr, textStatus, errorThrown) {
      $('td#InsertUserInfoStatusCode').html(xhr.status);
      $('td#InsertUserInfooutput').html(errorThrown);
      console.log(errorThrown);
    }
  });
}

function DeleteUser() {
  let APIBaseUrl = $('#APIBaseURL').val();
  let userId = $('#deleteUserId').val();
  $.ajax({
    url: APIBaseUrl + '/users/d/' + userId + '/',
    type: 'POST',
    contentType: 'application/json',
    dataType: 'json',
    cache: false,
    success: function (data, textStatus, xhr) {
      $('td#DeleteUserStatusCode').html(xhr.status);
      $('td#DeleteUseroutput').html(JSON.stringify(data));
    },
    error: function (xhr, textStatus, errorThrown) {
      $('td#DeleteUserStatusCode').html(xhr.status);
      $('td#DeleteUseroutput').html(errorThrown);
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
  document.execCommand("Copy", false, null);
}
