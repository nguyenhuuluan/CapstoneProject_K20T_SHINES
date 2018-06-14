<footer class="site-footer">

  <!-- Top section -->
  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-3">
        <h6>Việc làm theo ngành nghề</h6>
        <ul class="footer-links">

  @foreach ($faculties as $faculty)
          <li><a href="{{ route('recruitments.search', 'searchtext='.$faculty->name) }}">{{ $faculty->name }}</a></li>
          @if(($loop->index + 1)>19)
          @break
          @else
          @if(($loop->index + 1)%5 ==0 )
          </ul>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-3">
          <ul class="footer-links">
          <br>
          @endif
          @endif
          
          @endforeach
        </ul>
      </div>

    </div>

    <hr>
  </div>
  <!-- END Top section -->

  <!-- Bottom section -->
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-6 col-xs-12">
        <p class="copyright-text">Copyrights &copy; 2017 All Rights Reserved by <a href="#">Shines Team</a>.</p>
      </div>

      <div class="col-md-4 col-sm-6 col-xs-12">
        <ul class="social-icons">
          <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
          <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
          <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- END Bottom section -->

</footer>

<!-- Back to top button -->
<a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
          <!-- END Back to top button -->