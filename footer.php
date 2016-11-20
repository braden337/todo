  <div id="footer" class="col-xs-12 text-xs-center">
    <?php if (isset($user) && $user) ?>
    <div class="text-muted">made with <span class="love">&hearts;</span> by <a href="https://github.com/braden337/todo">braden</a></div>
  </div>

  </div>
  <script src="assets/jquery.min.js"></script>
  <script src="assets/bootstrap.min.js"></script>
  <script>

    // document.write('<script src="http://' +
    //   (location.host || 'localhost').split(':')[0] +
    //   ':35729/livereload.js?snipver=1"></' +
    //   'script>');

    $(document).ready(function() {

      if (!localStorage.learned) {
        $('#instructions').show();
      }

      setTimeout(function(){
        $('#flash').slideUp({duration: 250, easing: 'swing'});
      }, 3000);

      $('#todoInput').focus();
      
      $('.todo').hover(function() {
        $(this).toggleClass('bg-danger');
      });

      $('.todo').click(function() {
        var id = $(this).attr('data-id');
        if (confirm('Are you sure you want to delete this item?')) {
          window.location = `/delete.php?id=${id}`;
        }
      });

      $('#instructions').click(function() {
        $('#instructions').hide();
        localStorage.learned = true;
      });

    });
  </script>
</body>
</html>