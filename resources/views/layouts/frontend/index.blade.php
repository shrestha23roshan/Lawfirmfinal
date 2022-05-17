{{-- @php
    dd($about);
@endphp --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/brands.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/regular.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/solid.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
    <title>HomePage</title>
</head>
<body>
    <div class="home" style="background: url(img/background.jpg);">

    <!-- <div class="container-fluid"> -->
        
        <div class="abc"><p class="smtitle">International Opportunities - Due Diligence & Risk Assessment - Advisory & Planning - Strategies for Success </p></div>
        @include('layouts.backend.alert')

        <!-- <div class="xyz"><p class="maintitle">THE LAW FIRM OF SURENDRA V THAPA</p></div> -->
        <!-- <div class="profile"><img class="photo" src="surendra1.jpg" alt="Surendra V Thapa"></div> -->
    <!-- </div> -->
    </div>
    <footer class="page-footer">
       <div class="xyz"><p class="maintitle">THE LAW FIRM OF SURENDRA V THAPA</p></div>
        <div class="foot">
            <ul class="footer-list">
              {{--------------------------------------About the firm section start -----------------------------------------}}
               <li> <a href="" data-toggle="modal" data-target="#exampleModal1">About the Firm</a> </li>
               @if ($about)
               <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true" >
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel1">About The Firm</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        @foreach ($about as $result)
                            <div class="modal-body">
                                {{-- <div class="photoinner"><img src="surendra1.jpg" alt="Surendra V Thapa" style="border:2px solid rgb(222,226,230);height:150px; width:150px; padding:5px;"></div> --}}
                                <div class="photoinner">
                                      @if (file_exists('uploads/about/'.$result->attachment) && $result->attachment !='')
                                      <img src="{{asset('uploads/about/'.$result->attachment) }}"  alt="Surendra V Thapa" style="border:2px solid rgb(222,226,230);height:150px; width:150px; padding:5px;">
                                  @endif
                                </div>
                                    {!! $result->description !!}
                            </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
               @endif
              {{--------------------------------------End About the firm section start -----------------------------------------}}
              {{--------------------------------------Services section start -----------------------------------------}}
              <li> <a href="" data-toggle="modal" data-target="#exampleModal2">Services</a> </li>
              @if ($services)
              <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true" >
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel2">Services</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      @foreach ($services as $item)
                      <div class="modal-body">
                         {!! $item->description !!}
                     </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              @endif
              {{--------------------------------------Services section start -----------------------------------------}}
              {{--------------------------------------News section start -----------------------------------------}}
             <li> <a href="" data-toggle="modal" data-target="#exampleModal3">News & Development</a> </li>
             <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true" >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel3">News & Development</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Coming soon
                  </div>
                  
                </div>
              </div>
             </div>
          {{-------------------------------------- End News section start -----------------------------------------}}
          {{-------------------------------------- Resources section start -----------------------------------------}}
            <li> <a href="" data-toggle="modal" data-target="#exampleModal4">Resources</a> </li>
            @if ($resources)
            <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true" >
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel4">Resources</h3>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    @foreach ($resources as $item)
                      <div class="modal-body">
                        {!! $item->description !!}
                      </div>
                     @endforeach
                 </div>
               </div>
             </div>
            @endif
          {{--------------------------------------End Resources section start -----------------------------------------}}
          {{--------------------------------------Contact section start -----------------------------------------}}

          <li> <a href="" data-toggle="modal" data-target="#exampleModal5">Contact</a> </li>
            <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5" aria-hidden="true" >
             <div class="modal-dialog" role="document">
               <div class="modal-content">
                 <div class="modal-header">
                   <h3 class="modal-title" id="exampleModalLabel5">Contact Firm</h3>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                    43 West 43rd Street, Suite 161, New York, NY 10036-7424
                    <br>Email: sthapa@thapalaw.com 	Phone: 1(917) 370 6142
                    <br>
                    <br>
                    <b><u>Send your details</u></b>
                    <form action="{{ route('contact.mail') }}" method="POST" role="form" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    {{-- {{ csrf_field() }} --}}
                      <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
                      </div>
                      <div class="form-group">
                          <label for="name">Email *</label>
                        <input id="email" type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                      <div class="form-group">
                        <label for="message">Contact Information *</label>
                        <textarea class="form-control" name="message" id="message" rows="10" cols ="30" placeholder="Enter Contact Information" required></textarea>
                      </div>
                      
                      <button type="submit" class="btn btn-primary">Send</button>
                      {{-- <button type="reset" class="btn btn-danger">Clear</button> --}}
                    </form>


                </div>
                
              </div>
            </div>
          </div>
          {{--------------------------------------End Contact section start -----------------------------------------}}
            </ul>
          
                
            
        </div>
        <div class="address"><p>43 West 43rd Street, Suite 161, New York, NY 10036-7424
                <br>Email: sthapa@thapalaw.com 	Phone: 1(917) 370 6142</p></div>
        
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>