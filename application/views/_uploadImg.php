<script type="text/javascript" >
   
  </script>


 <input type="file" id="files" name="files[]" multiple data-bind=" event:{change: $root.fileSelect}" />
 <output id="list"></output>

 <ul>    
  <!-- ko foreach: files-->
  <li>
    <span data-bind ="text: name"></span>: <img class="thumb" data-bind = "attr: {'src': src, 'title': name}"/>
  </li>
  <!-- /ko -->  
</ul>



<script type="text/javascript">
    var ViewModel = function() {
      var self = this;     
      self.files=  ko.observableArray([]);

      self.fileSelect= function (elemet,event) {
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
            return function(e) {                             
              self.files.push(new FileModel(escape(theFile.name),e.target.result));
            };                            
          })(f);
          // Read in the image file as a data URL.
          reader.readAsDataURL(f);
        }
      };


    };

    var FileModel= function (name, src) {
      var self = this;
      this.name = name;
      this.src= src ;
    };

    ko.applyBindings(new ViewModel());

  </script>



  <script>
    $(document).ready(function () { 
      model.Processing(true);
      material.fileSelect();
    });
  </script>

  <style type="text/css">
  .thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }
</style>