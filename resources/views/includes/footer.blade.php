
<style>
.footer {
  background-color: #f8f9fa; /* Ganti dengan warna latar belakang yang diinginkan */
  /* border-radius: 10px;  */
  box-shadow: 0 -2px 2px #ff873e; /* Bayangan yang menonjol ke atas */
  border-bottom:2px solid #ff873e;
  padding: 20px; /* Padding untuk ruang di dalam footer */
  margin-top: 20px; /* Jarak atas dari elemen sebelumnya */
}
.rounded-social-buttons .social-button {
  display: inline-block;
  position: relative;
  cursor: pointer;
  width: 3.125rem;
  height: 3.125rem;
  /* border: 0.125rem solid transparent; */
  padding: 0;
  text-decoration: none;
  text-align: center;
  color: #fefefe;
  font-size: 1.5625rem;
  font-weight: normal;
  line-height: 2em;
  border-radius: 1.6875rem;
  transition: all 0.5s ease;
  margin-right: 0.25rem;
  margin-bottom: 0.25rem;
}

.rounded-social-buttons .social-button:hover, .rounded-social-buttons .social-button:focus {
  -webkit-transform: rotate(360deg);
      -ms-transform: rotate(360deg);
          transform: rotate(360deg);
}

.rounded-social-buttons .fa-twitter, .fa-facebook-f, .fa-linkedin, .fa-tiktok, .fa-youtube, .fa-instagram {
  font-size: 25px;
}

.rounded-social-buttons .social-button.facebook {
  background: #3b5998;
}

.rounded-social-buttons .social-button.facebook:hover, .rounded-social-buttons .social-button.facebook:focus {
  color: #3b5998;
  background: #fefefe;
  border-color: #3b5998;
}

.rounded-social-buttons .social-button.twitter {
  background: #55acee;
}

.rounded-social-buttons .social-button.twitter:hover, .rounded-social-buttons .social-button.twitter:focus {
  color: #55acee;
  background: #fefefe;
  border-color: #55acee;
}

.rounded-social-buttons .social-button.linkedin {
  background: #25D366
  ;
}

.rounded-social-buttons .social-button.linkedin:hover, .rounded-social-buttons .social-button.linkedin:focus {
  color: #007bb5;
  background: #fefefe;
  border-color: #007bb5;
}

.rounded-social-buttons .social-button.tiktok {
  background: #000000;
}

.rounded-social-buttons .social-button.tiktok:hover, .rounded-social-buttons .social-button.tiktok:focus {
  color: #000000;
  background: #fefefe;
  border-color: #000000;
}

.rounded-social-buttons .social-button.youtube {
  background: #bb0000;
}

.rounded-social-buttons .social-button.youtube:hover, .rounded-social-buttons .social-button.youtube:focus {
  color: #bb0000;
  background: #fefefe;
  border-color: #bb0000;
}

.rounded-social-buttons .social-button.instagram {
  background: #125688;
}

.rounded-social-buttons .social-button.instagram:hover, .rounded-social-buttons .social-button.instagram:focus {
  color: #125688;
  background: #fefefe;
  border-color: #125688;
}
</style>

<footer class="footer mt-50" style="background-color:white">

    <div class="container">
        <div class="row">

            <div class="col-md-4 col-sm-12">
                <a href="/"><img alt="jobhub" src="{{ asset('https://admin.trainingkerja.com/public/storage/' . ($dataTk->item_file_2 ?? '')) }}" /></a>
                <div class="mt-20 mb-20">

                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <h6 style="color: #5A5B5C; font-weight: bold;margin-top: 10px;font-family:Arial, Helvetica, sans-serif">Company</h6>
                <ul class="menu-footer mt-10">
                    <li><a href="{{route('companybrief')}}" style="color: #5A5B5C; font-weight: normal;font-size:16px;font-family:Arial, Helvetica, sans-serif">About us</a></li>
                    <li><a href="{{route('visimisi')}}" style="color: #5A5B5C; font-weight: normal;font-size:16px;font-family:Arial, Helvetica, sans-serif">Vision and mission</a></li>
                    <li hidden><a href="" style="color: #5A5B5C; font-weight: normal;font-size:16px;font-family:Arial, Helvetica, sans-serif">Cooperation</a></li>
                    <li><a href="{{route('contact')}}" style="color: #5A5B5C; font-weight: normal;font-size:16px;font-family:Arial, Helvetica, sans-serif">Contact</a></li>
                </ul>
                <br>
                <br>
                <ul class="menu-footer mt-20">
                    <div class="rounded-social-buttons">
                        @foreach ($socialmediafooter as $values )

                            @if ($values->idsosialmedia == 1)
                                <a class="social-button facebook" href="{{$values->url}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            @elseif($values->idsosialmedia == 2)
                                <a class="social-button instagram" href="{{$values->url}}" target="_blank"><i class="fab fa-instagram"></i></a>
                            @elseif($values->idsosialmedia == 3)
                                <a class="social-button facebook" href="{{$values->url}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            @elseif($values->idsosialmedia == 4)
                                <a class="social-button youtube" href="{{$values->url}}" target="_blank"><i class="fab fa-youtube"></i></a>
                            @elseif($values->idsosialmedia == 5)
                                <a class="social-button twitter" href="{{$values->url}}" target="_blank"><i class="fab fa-twitter"></i></a>
                            @elseif($values->idsosialmedia == 6)
                                <a class="social-button linkedin" href="{{$values->url}}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            @else

                            @endif
                        @endforeach

                    </div>
                </ul>
            </div>
            <div class="col-md-4 col-xs-12">
                <iframe class="mt-10" src="{{$dataTk->item_link}}" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 100%; height: 205px;">
                </iframe>
            </div>
        </div>
        <div class="footer-bottom mt-50">
            <div class="row">
                <div class="col-md-6" style="color: #5A5B5C">
                    Copyright ©2024 <a href="trainingkerja.com"><strong style="color: #5A5B5C">Training Kerja </strong></a>. All Rights Reserved
                </div>

            </div>
        </div>
    </div>
</footer>
