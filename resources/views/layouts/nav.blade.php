 <!-- ########## START: LEFT PANEL ########## -->
 <div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i>MealDeal</a></div>
 <div class="sl-sideleft">
   <div class="input-group input-group-search">
     <input type="search" name="search" class="form-control" placeholder="Search">
     <span class="input-group-btn">
       <button class="btn"><i class="fa fa-search"></i></button>
     </span><!-- input-group-btn -->
   </div><!-- input-group -->

   <label class="sidebar-label">Navigation</label>
   <div class="sl-sideleft-menu">
    <a href="{{ url('/') }}" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
          <span class="menu-item-label">Home Page</span>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
     <a href="{{ url('/dashboard') }}" class="sl-menu-link">
       <div class="sl-menu-item">
         <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
         <span class="menu-item-label">Dashboard</span>
       </div><!-- menu-item -->
     </a><!-- sl-menu-link -->
     @if (Auth::user()->role != 11)
     <a href="{{ url('/addmoney') }}" class="sl-menu-link">
       <div class="sl-menu-item">
         <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
         <span class="menu-item-label">Add Money</span>
       </div><!-- menu-item -->
     </a><!-- sl-menu-link -->
     <a href="{{ url('/sendmail') }}" class="sl-menu-link">
       <div class="sl-menu-item">
         <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
         <span class="menu-item-label">Send Mail</span>
       </div><!-- menu-item -->
     </a><!-- sl-menu-link -->
     <a href="{{ url('/addcost') }}" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
          <span class="menu-item-label">Add Cost</span>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
     @php
         $user_company = Auth::user()->company;
         $members = App\Models\User::all()->where('company' ,'==',$user_company);
     @endphp
      <a href="{{ url('/addmeal') }}" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
          <span class="menu-item-label">Add Meal</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
          @foreach ($members as $member)
          @if ($member->id == Auth::user()->id && $member->type != 91)
          <li class="nav-item"><a href="/addmeal" class="nav-link">{{ $member->name; }}</a></li>
          @elseif($member->id != Auth::user()->id)
          <li class="nav-item"><a href="{{url('/addmeal/bymanager')}}/{{ $member->id }}" class="nav-link">{{ $member->name; }}</a></li>
          @endif
          @endforeach
      </ul>
     @endif
     @if (Auth::user()->role == 22 && Auth::user()->type == 91)
     <a href="{{ url('/package') }}" class="sl-menu-link">
        <div class="sl-menu-item">
          <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
          <span class="menu-item-label">Add Package</span>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->

     @endif

     @if (Auth::user()->role == 11)
     <a href="{{ url('/addmeal') }}" class="sl-menu-link">
       <div class="sl-menu-item">
         <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
         <span class="menu-item-label">Add Meal</span>
       </div><!-- menu-item -->
     </a><!-- sl-menu-link -->
     <div class="dropdown-menu dropdown-menu-header wd-200">
        <ul class="list-unstyled user-profile-nav">
          <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
          <li><a href=""><i class="icon ion-ios-gear-outline"></i> Settings</a></li>
          <li><a href=""><i class="icon ion-ios-download-outline"></i> Downloads</a></li>
          <li><a href=""><i class="icon ion-ios-star-outline"></i> Favorites</a></li>
          <li><a href=""><i class="icon ion-ios-folder-outline"></i> Collections</a></li>
          <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon ion-power"></i> Sign Out</a>
             <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                 @csrf
             </form>
         </li>
        </ul>
      </div><!-- dropdown-menu -->
     @endif
   </div><!-- sl-sideleft-menu -->

   <br>
 </div><!-- sl-sideleft -->
 <!-- ########## END: LEFT PANEL ########## -->

 <!-- ########## START: HEAD PANEL ########## -->
 <div class="sl-header">
   <div class="sl-header-left">
     <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
     <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
   </div><!-- sl-header-left -->
   <div class="sl-header-right">
     <nav class="nav">
       <div class="dropdown">
        <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
            {{-- {{Auth::user()->name}} --}}
            {{-- {{ asset('uploads/profile') }}/{{ Auth::user()->profile_pic }} --}}
          <span class="logged-name">{{ Auth::user()->name }}</span>
          <img src="{{ asset('uploads/profile') }}/{{ Auth::user()->profile_pic }}" class="wd-32 rounded-circle" alt="">
        </a>
         <div class="dropdown-menu dropdown-menu-header wd-200">
           <ul class="list-unstyled user-profile-nav">
            <li><a href="{{ url('/profile/edit') }}" ><i class="icon ion-ios-person-outline"></i> Edit Profile</a>
            </li>
             <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon ion-power"></i> Sign Out</a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                    @csrf
                </form>
            </li>
           </ul>
         </div><!-- dropdown-menu -->
       </div><!-- dropdown -->
     </nav>
     <div class="navicon-right">
       <a id="btnRightMenu" href="" class="pos-relative">
         <i class="icon ion-ios-bell-outline"></i>
         <!-- start: if statement -->
         <span class="square-8 bg-danger"></span>
         <!-- end: if statement -->
       </a>
     </div><!-- navicon-right -->
   </div><!-- sl-header-right -->
 </div><!-- sl-header -->
 <!-- ########## END: HEAD PANEL ########## -->

 <!-- ########## START: RIGHT PANEL ########## -->
 <div class="sl-sideright">
   <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
     <li class="nav-item">
       <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages (2)</a>
     </li>
     <li class="nav-item">
       <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notifications (8)</a>
     </li>
   </ul><!-- sidebar-tabs -->

   <!-- Tab panes -->
   <div class="tab-content">
     <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="messages" role="tabpanel">
       <div class="media-list">
         <!-- loop starts here -->
         <a href="" class="media-list-link">
           <div class="media">
             <img src="../img/img3.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Donna Seay</p>
               <span class="d-block tx-11 tx-gray-500">2 minutes ago</span>
               <p class="tx-13 mg-t-10 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
             </div>
           </div><!-- media -->
         </a>
         <!-- loop ends here -->
         <a href="" class="media-list-link">
           <div class="media">
             <img src="../img/img4.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Samantha Francis</p>
               <span class="d-block tx-11 tx-gray-500">3 hours ago</span>
               <p class="tx-13 mg-t-10 mg-b-0">My entire soul, like these sweet mornings of spring.</p>
             </div>
           </div><!-- media -->
         </a>
         <a href="" class="media-list-link">
           <div class="media">
             <img src="../img/img7.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Robert Walker</p>
               <span class="d-block tx-11 tx-gray-500">5 hours ago</span>
               <p class="tx-13 mg-t-10 mg-b-0">I should be incapable of drawing a single stroke at the present moment...</p>
             </div>
           </div><!-- media -->
         </a>
         <a href="" class="media-list-link">
           <div class="media">
             <img src="../img/img5.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Larry Smith</p>
               <span class="d-block tx-11 tx-gray-500">Yesterday, 8:34pm</span>

               <p class="tx-13 mg-t-10 mg-b-0">When, while the lovely valley teems with vapour around me, and the meridian sun strikes...</p>
             </div>
           </div><!-- media -->
         </a>
         <a href="" class="media-list-link">
           <div class="media">
             <img src="../img/img3.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Donna Seay</p>
               <span class="d-block tx-11 tx-gray-500">Jan 23, 2:32am</span>
               <p class="tx-13 mg-t-10 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
             </div>
           </div><!-- media -->
         </a>
       </div><!-- media-list -->
       <div class="pd-15">
         <a href="" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View More Messages</a>
       </div>
     </div><!-- #messages -->

     <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="notifications" role="tabpanel">
       <div class="media-list">
         <!-- loop starts here -->
         <a href="" class="media-list-link read">
           <div class="media pd-x-20 pd-y-15">
             <img src="../img/img8.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
               <span class="tx-12">October 03, 2017 8:45am</span>
             </div>
           </div><!-- media -->
         </a>
         <!-- loop ends here -->
         <a href="" class="media-list-link read">
           <div class="media pd-x-20 pd-y-15">
             <img src="../img/img9.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Social Network</strong></p>
               <span class="tx-12">October 02, 2017 12:44am</span>
             </div>
           </div><!-- media -->
         </a>
         <a href="" class="media-list-link read">
           <div class="media pd-x-20 pd-y-15">
             <img src="../img/img10.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="tx-13 mg-b-0 tx-gray-700">20+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
               <span class="tx-12">October 01, 2017 10:20pm</span>
             </div>
           </div><!-- media -->
         </a>
         <a href="" class="media-list-link read">
           <div class="media pd-x-20 pd-y-15">
             <img src="../img/img5.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
               <span class="tx-12">October 01, 2017 6:08pm</span>
             </div>
           </div><!-- media -->
         </a>
         <a href="" class="media-list-link read">
           <div class="media pd-x-20 pd-y-15">
             <img src="../img/img8.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 12 others in a post.</p>
               <span class="tx-12">September 27, 2017 6:45am</span>
             </div>
           </div><!-- media -->
         </a>
         <a href="" class="media-list-link read">
           <div class="media pd-x-20 pd-y-15">
             <img src="../img/img10.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="tx-13 mg-b-0 tx-gray-700">10+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
               <span class="tx-12">September 28, 2017 11:30pm</span>
             </div>
           </div><!-- media -->
         </a>
         <a href="" class="media-list-link read">
           <div class="media pd-x-20 pd-y-15">
             <img src="../img/img9.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Great Pyramid</strong></p>
               <span class="tx-12">September 26, 2017 11:01am</span>
             </div>
           </div><!-- media -->
         </a>
         <a href="" class="media-list-link read">
           <div class="media pd-x-20 pd-y-15">
             <img src="../img/img5.jpg" class="wd-40 rounded-circle" alt="">
             <div class="media-body">
               <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
               <span class="tx-12">September 23, 2017 9:19pm</span>
             </div>
           </div><!-- media -->
         </a>
       </div><!-- media-list -->
     </div><!-- #notifications -->

   </div><!-- tab-content -->
 </div><!-- sl-sideright -->
 <!-- ########## END: RIGHT PANEL ########## --->
