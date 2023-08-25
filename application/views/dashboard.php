<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>Dashboard</title>

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: monospace;
        height: auto;
        background-image: linear-gradient(rgba(0, 8, 51, 0.9), rgba(0, 8, 51, 0.9)), url(https://cdn.pixabay.com/photo/2017/06/15/16/50/panorama-2405958_960_720.jpg);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
      }

      .containerx {
        width: 100%;
        min-height: 80vh;
        padding: 5%;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .search_bar {
        display: flex;
        width: 100%;
        max-width: 500px;
        background: rgba(255, 255, 255, 0.2);
        align-items: center;
        border-radius: 64px;
        padding: 12px;
        backdrop-filter: blur(4px) saturate(180%);
      }

      .search_bar input {
        background: transparent;
        flex: 1;
        border: none;
        outline: none;
        padding: 8px 12px;
        font-size: 24px;
        color: #cac7ff;
      }
      ::placeholder {
        color: #cac7ff;
      }
      .search_bar button {
        width: 24px;
        border: 0;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        align-items: flex-end;
      }

      .image-gallery {
        margin: 0 64px;
        display: flex;
        flex-direction: row;
        gap: 16px;
      }
      .image-gallery > .column {
        width: calc(100% / 3 - 5px);
        display: flex;
        flex-direction: column;
        gap: 10px;
      }
      .image-gallery > .column > .image-items > img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    </style>
  </head>
  <body>
    <!-- <nav class="navbar">
      <div class="container-fluid">
        <a class="navbar-brand text-white"><h1>Vega Six</h1></a>
      </div>
    </nav> -->
    <div class="container containerx">
      <form class="search_bar">
        <input type="text" name="search" id="search" placeholder="Search Anything" />
        <span style="color: red" id="error" hidden>NO Data</span>
        <button type="submit" id="submit" class="text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
    </div>

    <div class="image-gallery" id="images"></div>

    <div class="container">
      <div class="row" style="gap: 16px"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
      let search_input = document.querySelector("#search");
      let submit = document.querySelector("#submit");
      let images = document.querySelector("#images");

      submit.addEventListener("click", (e) => {
        e.preventDefault();
        let val = search_input.value;
        console.log(val);
        fetchdata(val);
      });

      function fetchdata(val) {
        const apiKey = "39044227-6a3b84606839ce55e0c497927";
        const apiUrl = `https://pixabay.com/api/?key=${apiKey}&q=${val}&image_type=photo`;

        fetch(apiUrl)
          .then((response) => response.json())
          .then((data) => {
            if (data.hits) {
              $(images).hide();
              $(images).html("");
              let picture = data.hits;
              let k = 0;
              let i = k + 4;
              for (let index = 0; index < 3; index++) {
                let column = $("<div>", { class: "column" });
                for (let img = k; img < i; img++) {
                  if (picture[img]) column.append($("<img>", { src: picture[img].previewURL }));
                }
                $(images).append(column);
                k = i;
                i = k + 4;
              }

              $(images).show();
            } else {
              var span = document.getElementById("error");
              span.hidden = false;
            }
          })
          .catch((error) => {
            console.error("Error fetching data:", error);
          });
      }
    </script>
  </body>
</html>
