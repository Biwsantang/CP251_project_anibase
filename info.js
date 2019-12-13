var title;
function info(id) {
    var query = `
  query ($id: Int) { # Define which variables will be used in the query (id)
    Media (id: $id) { # Insert our variables into the query arguments (id) (type: ANIME is hard-coded in the query)
      id
      title {
        romaji
        english
        native
      }
      description
      coverImage {
          extraLarge
          color
        }
      bannerImage
      format
    episodes
    duration
    status
    startDate {
      year
      month
      day
    }
    endDate {
      year
      month
      day
    }
    season
    studios{
      nodes{
        name
      }
    }
    genres
    isAdult
    trailer {
      id
      site
    }
    streamingEpisodes {
      title
      thumbnail
      url
      site
    }
    }
  }
  `;

    // Define our query variables and values that will be used in the query request
    var variables = {
        id: id
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
        if (data["data"]["Media"]["title"]["english"]!=null) {
          //document.getElementById("title_english").innerHTML = data["data"]["Media"]["title"]["english"];
          $('#title_main').text(data["data"]["Media"]["title"]["english"]);
          //document.getElementById("title_romaji").innerHTML = data["data"]["Media"]["title"]["romaji"];
          $('#title_second').text(data["data"]["Media"]["title"]["romaji"]);
          document.title = data["data"]["Media"]["title"]["english"] + ' - Anibase';
        } else {
          $('#title_main').text(data["data"]["Media"]["title"]["romaji"]);
          $('#title_second').text('');
          document.title = data["data"]["Media"]["title"]["romaji"] + ' - Anibase';
        }
        //document.getElementById("description").innerHTML = data["data"]["Media"]["description"];
        $('#description').html(data["data"]["Media"]["description"]);
        $("#bannerImage_parant").css('background-color',data["data"]["Media"]["coverImage"]["color"]);
        if (data["data"]["Media"]["bannerImage"]!=null||data["data"]["Media"]["bannerImage"]!='unknown') {
          $('#bannerImage').attr('src',data["data"]["Media"]["bannerImage"]);
        }
        //document.getElementById("coverImage_extraLarge").src = data["data"]["Media"]["coverImage"]["extraLarge"];
        $('#coverImage_extraLarge').attr('src',data["data"]["Media"]["coverImage"]["extraLarge"]);
        //document.getElementById("format").innerHTML = data["data"]["Media"]["format"];
        $('#format').text(data["data"]["Media"]["format"]);
        //document.getElementById("episodes").innerHTML = data["data"]["Media"]["episodes"];
        $('#episodes').text(data["data"]["Media"]["episodes"]);
        //document.getElementById("duration").innerHTML = data["data"]["Media"]["duration"];
        $('#duration').text(data["data"]["Media"]["duration"]);
        //document.getElementById("status").innerHTML = data["data"]["Media"]["status"];
        $('#status').text(data["data"]["Media"]["status"]);
        var startDate = data["data"]["Media"]["startDate"]["year"] + ',' + data["data"]["Media"]["startDate"]["month"] + ',' + data["data"]["Media"]["startDate"]["day"];
        //document.getElementById("startDate").innerHTML = startDate;
        $('#startDate').text(startDate);
        var endDate = data["data"]["Media"]["endDate"]["year"] + ',' + data["data"]["Media"]["endDate"]["month"] + ',' + data["data"]["Media"]["endDate"]["day"];
        //document.getElementById("endDate").innerHTML = endDate;
        $('#endDate').text(endDate);
        //document.getElementById("season").innerHTML = data["data"]["Media"]["season"];
        $('#season').text(data["data"]["Media"]["season"]);
        //document.getElementById("studios_nodes_name").innerHTML = data["data"]["Media"]["studios"]["nodes"][0]["name"];
        $('#studios_nodes_name').text(data["data"]["Media"]["studios"]["nodes"][0]["name"]);
        //document.getElementById("genres").innerHTML = data["data"]["Media"]["genres"];
        $('#genres').text(data["data"]["Media"]["genres"]);
        
        if (data["data"]["Media"]["isAdult"]==true) {
          $('#adult_tag').html('<span class="badge badge-danger">18+</span>');
          $('#coverImage_extraLarge').attr('adult',1);
          $('#bannerImage').attr('adult',1);
        }
        try {
        if (data["data"]["Media"]["trailer"]!=null) {
          if (data["data"]["Media"]["trailer"]["site"]=="youtube") {
            var yt='<iframe id="ytplayer" type="text/html" class="w-100 h-100" src="https://www.youtube.com/embed/'+data["data"]["Media"]["trailer"]["id"]+'" frameborder="0"></iframe>';
            $('#video').addClass('h-50');
            $('#video').html(yt);
          }
        }
      } catch(err) {
        $('#video').html('<h2>Sorry. Nothing to show here 😭</h2>');
      }
      try {
        if (data["data"]["Media"]["streamingEpisodes"]!='') {
          $('#episode').html('');
          console.log(data["data"]["Media"]["streamingEpisodes"]);
          for (x in data["data"]["Media"]["streamingEpisodes"]) {
            console.log(data["data"]["Media"]["streamingEpisodes"][x]["title"]);
            var card_episode = '<a href="'+data["data"]["Media"]["streamingEpisodes"][x]["url"]+'"><div class="card mb-3 bg-light"> \
                    <img src="'+data["data"]["Media"]["streamingEpisodes"][x]["thumbnail"]+'" class="card-img-top" alt=""> \
                    <div class="card-body"> \
                      <h5 class="card-title">'+data["data"]["Media"]["streamingEpisodes"][x]["title"]+'</h5> \
                      <p class="card-text"><small class="text-muted">'+data["data"]["Media"]["streamingEpisodes"][x]["site"]+'</small></p> \
                    </div> \
                    </div></a>';
            $('#episode').append(card_episode);
          }
        }
      } catch(err) {
        console.log('no episode');
      }

        disqus_start(title);
      }
      
      function handleError(error) {
        console.log('Error, check console');
          console.error(error);
      }
      }