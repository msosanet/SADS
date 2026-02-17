<!DOCTYPE html>
<html>
<head>
  <title>Arrastrar y soltar archivos</title>
  <style>
    .drop-area {
      width: 300px;
      height: 200px;
      border: 2px dashed #ccc;
      border-radius: 5px;
      text-align: center;
      padding: 40px;
      font-size: 20px;
      margin: 20px;
    }
  </style>
  <script>
    var files = [];

    function handleFileDrop(event) {
      event.preventDefault();
      var droppedFiles = event.dataTransfer.files;
      for (var i = 0; i < droppedFiles.length; i++) {
        files.push(droppedFiles[i]);
        var fileName = droppedFiles[i].name;
        var fileItem = document.createElement('li');
        fileItem.textContent = fileName;
        document.getElementById('file-list').appendChild(fileItem);
      }
    }

    function enviarArchivos() {
      var formData = new FormData();
      for (var i = 0; i < files.length; i++) {
        formData.append("archivo[]", files[i]);
      }

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "up.php", true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          alert(xhr.responseText);
        }
      };
      xhr.send(formData);
    }
  </script>
</head>
<body>
  <div class="drop-area" ondrop="handleFileDrop(event)" ondragover="event.preventDefault()">
    Arrastra y suelta archivos aquí
  </div>
  <ul id="file-list"></ul>
  <button onclick="enviarArchivos()">Subir</button>
</body>
</html>
