<script>
  model.masterModel = { 
    // KODEKATEGORI: "",
    // NAMAKATEGORI:""

    name:"",
    src:"",
  }
  var material = {
    Recordmaterial: ko.mapping.fromJS(model.masterModel), 
    Listmaterial: ko.observableArray([]),
    Mode: ko.observable(''),
    FilterText: ko.observable(''),
    DataFilter: ko.observableArray(['name']),
    FilterValue: ko.observable('name'),
    files: ko.observableArray([]);
  }

  material.fileSelect = function(elemet,event) {
        var files =  event.target.files;// FileList object

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

          // Only process image files.
          if (!f.type.match('image.*')) {
            continue;
          }          

          var reader = new FileReader();

          // Closure to capture the file information.
          reader.onload = (function(theFile) {
            return function(e){
              self.files.push(new FileModel(escape(theFile.name),e.target.result));
            };
          })(f);
          // Read in the image file as a data URL.
          reader.readAsDataURL(f);
        }
      }
    </script>



    <input type="file" id="files" name="files[]" multiple data-bind=" onclick: $root.material.fileSelect" />
    <output id="list"></output>

    <ul>
      <!-- ko foreach: files-->
      <li>
        <span data-bind ="text: name"></span>: <img class="thumb" data-bind = "attr: {'src': src, 'title': name}"/>
      </li>
      <!-- /ko -->
    </ul>



    <script type="text/javascript">
      $(document).ready(function () { 
       material.fileSelect();
     }


   </script>

   <style type="text/css">
   .thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }
</style>