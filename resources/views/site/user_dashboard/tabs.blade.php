<div class="card">
    <div class="card-header text-white text-center" style="background-color: rgb(0, 0, 0);">
        {{ auth()->user()->name }}
    </div>
    <div class="list-group list-group-flush">
       
            <a href="{{ route('user-dashboard.profile') }}" class="list-group-item @if(request()->segment(2) == 'profile') active @endif">
                Profile
            </a>
     
       
            <a href="{{ route('user-dashboard.orders') }}" class="list-group-item @if(request()->segment(2) == 'orders') active @endif">
                Orders
            </a>
      
       
            <a href="{{ route('user-dashboard.address') }}" class="list-group-item @if(request()->segment(2) == 'address') active @endif">
                Address
            </a>
       
    </div>
</div>