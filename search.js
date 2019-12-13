var card_templete = '<div id="id_here" class="card bg-white border-0 shadow" data-aos="fade-in"> \
                        <a href="link_here"><div class="row no-gutters"> \
                          <div class="col-4"> \
                              <img id="modal_coverImage_extraLarge" src="" class="card-img" alt=""> \
                          </div> \
                          <div class="col-8"> \
                              <div class="card-body"> \
                                  <h4 id="modal_title_1" class="card-title">Card title</h4> \
                                  <h6 id="modal_title_2"></h6> \
                                  <h8 id="adult_tag"></h8> \
                              </div> \
                          </div> \
                      </div> \
                  </a></div>';
var seemore_templete = '<button name="seemore" id="seemore" class="btn btn-primary btn-block shadow" type="button">\
                            <span id="search_count_left" class="badge badge-light"></span> \
                            </button>';

var currentName;
var currentPage;

function search(name) {
  // Here we define our query as a multi-line string
  // Storing it in a separate .graphql/.gql file is also possible
  var query = `
query ($id: Int, $page: Int, $perPage: Int, $search: String, $type: MediaType) {
  Page (page: $page, perPage: $perPage) {
    pageInfo {
      total
      currentPage
      lastPage
      hasNextPage
      perPage
    }
    media (id: $id, search: $search, type: $type) {
      id
      coverImage {
        extraLarge
      }
      siteUrl
      title {
        english
        romaji
      }
      isAdult
    }
  }
}
`;
  console.log(name, currentName);
  if (currentPage != undefined && currentName == name) {
    page = page + 1
    $("#seemore").remove();
  } else {
    clear();
    page = 1
  }
  $('#search_progress').width('35%');

  var variables = {
    type: "ANIME",
    search: name,
    page: page,
    perPage: 6
  };


  // Define the config we'll need for our Api request
  var url = 'https://graphql.anilist.co',
    options = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify({
        query: query,
        variables: variables
      })
    };

  // Make the HTTP Api request
  fetch(url, options).then(handleResponse)
    .then(handleData)
    .catch(handleError);

  function handleResponse(response) {
    return response.json().then(function (json) {
      return response.ok ? json : Promise.reject(json);
    });
  }

  function handleData(data) {
    console.log(data);
    $('#search_progress').width('70%');
    currentName = name;
    var adult_tag ='';
    for (x in data["data"]["Page"]["media"]) {
      //document.getElementById("card-columns").insertAdjacentHTML( 'beforeend', card_templete );
      $('#card-columns').append(card_templete);
      var id_tag = '#' + data["data"]["Page"]["media"][x]["id"];
      $('#id_here').attr('id', data["data"]["Page"]["media"][x]["id"]);
      $(id_tag + ' a[href="link_here"]').attr('href', '/anime.php?id=' + data["data"]["Page"]["media"][x]["id"]);
      //document.getElementById("modal_coverImage_extraLarge").src = data["data"]["Page"]["media"][x]["coverImage"]["extraLarge"];
      $(id_tag + ' #modal_coverImage_extraLarge').attr('src', data["data"]["Page"]["media"][x]["coverImage"]["extraLarge"]);
      //document.getElementById("modal_title_1").innerHTML = data["data"]["Page"]["media"][x]["title"]["english"];
      //$(id_tag + ' #modal_title_1').text(data["data"]["Page"]["media"][x]["title"]["english"]);
      //document.getElementById("modal_title_2").innerHTML = data["data"]["Page"]["media"][x]["title"]["romaji"];
      //$(id_tag + ' #modal_title_2').text(data["data"]["Page"]["media"][x]["title"]["romaji"]);


      if (data["data"]["Page"]["media"][x]["title"]["english"]!=null) {
        //document.getElementById("title_english").innerHTML = data["data"]["Media"]["title"]["english"];
        $(id_tag + ' #modal_title_1').html(data["data"]["Page"]["media"][x]["title"]["english"]);
        //document.getElementById("title_romaji").innerHTML = data["data"]["Media"]["title"]["romaji"];
        $(id_tag + ' #modal_title_2').html(data["data"]["Page"]["media"][x]["title"]["romaji"]);
        //document.title = data["data"]["Media"]["title"]["english"] + ' - Anibase';
      } else {
        $(id_tag + ' #modal_title_1').html(data["data"]["Page"]["media"][x]["title"]["romaji"]);
        $(id_tag + ' #modal_title_2').html('');
        //document.title = data["data"]["Media"]["title"]["romaji"] + ' - Anibase';
      }

      if (data["data"]["Page"]["media"][x]["isAdult"]==true) {
        $(id_tag + ' #adult_tag').html('<span class="badge badge-danger">18+</span>');
        $(id_tag + ' #modal_coverImage_extraLarge').attr('adult', 1);
      }

    }

    if (data["data"]["Page"]["pageInfo"]["hasNextPage"] == true) {
      $('#seemore_parent').html(seemore_templete);
      $('#search_count_left').text(data["data"]["Page"]["pageInfo"]["total"] - data["data"]["Page"]["pageInfo"]["perPage"] * data["data"]["Page"]["pageInfo"]["currentPage"]);
      currentPage = data["data"]["Page"]["pageInfo"]["currentPage"];
    }
    $('#search_progress').width('100%');
  }

  function handleError(error) {
    console.log('Error, check console');
    console.error(error);
  }
}
$(document).ready(function () {
  $('#search_modal').on('hidden.bs.modal', function () {
    // do something...
    console.log("Search Closed");
    $('#search_box').val('');
    clear();
  });

  $('#search_modal').on('shown.bs.modal', function () {
    // do something...
    console.log("Search Opened");
    $('#search_box').focus();
  });

  var timeout = null;
  $('#search_box').on('input',function () {
    console.log("Typing");
    $('#search_progress').width('0%');
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      if (!isEmpty($('#search_box').val())) {
        console.log('search', $('#search_box').val());
        search($('#search_box').val());
      }
    }, 800);
  });

  $('#seemore_parent').on('click','#seemore',function () {
    console.log('seemore is clicked');
    search(currentName);
  });

  $('#close_modal').on('click','#close_modal_button',function () {
    console.log('Closed is clicked');
    $('#search_modal').modal('hide');
    $('#search_box').val('');
    clear();
  });

  var text_max = 280;
    $('#comment_box').on('input',function() {
        var text_length = $('#comment_box').val().length;
        var text_remaining = text_max - text_length;

        $('#char_counter').text(text_remaining);
    });

});


function isEmpty(str) {
  return !str.trim().length;
}


function clear() {
  currentName = null;
  currentPage = null;
  $('#search_progress').width('0%');
  var card = document.getElementById("card-columns");
  while (card.hasChildNodes()) {
    card.removeChild(card.firstChild);
  }
  var seemore_button = document.getElementById("seemore_parent");
  if (seemore_button.hasChildNodes()) {
    seemore_button.removeChild(seemore_button.firstChild);
  }
}